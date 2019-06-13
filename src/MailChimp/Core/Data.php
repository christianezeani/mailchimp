<?php
namespace MailChimp\Core;

use MailChimp\Exceptions\InvalidDataException;
use MailChimp\Exceptions\InvalidFieldReferenceException;

use JsonSerializable;


class Data extends Core implements JsonSerializable {

  /**
   * Fields for the model
   * 
   * @var array
   */
  protected $fields = [];

  /**
   * Data holder for predefined fields
   * 
   * @var object
   */
  private $data;

  /**
   * Reference map for fields
   *
   * @var array
   */
  private $_reference = [];

  function __construct(array $data=NULL) {
    $this->initialize();

    $this->data = new \stdClass;
    $this->merge($data);
  }

  private function initialize() {
    foreach ($this->fields as $name => &$info) {
      if (!is_array($info)) throw new InvalidDataException("Invalid field setting at '$name'.");
      if (!array_key_exists('type', $info)) throw new InvalidDataException("Type info not set for '$name'.");

      $field = new Field($name, $info['type']);
      if (array_key_exists('required', $info)) $field->required($info['required']);
      if (array_key_exists('default', $info)) $field->default($info['default']);

      $info = $field;
    }
  }

  public function jsonSerialize() {
    return $this->data;
  }

  public function merge($data) {
    if (!is_array($data)) return;

    foreach ($data as $name => $value) {
      $this->__set($name, $value);
    }

    // foreach ($this->fields as $name => $type) {
    //   if (!array_key_exists($name, $data)) continue;
    //   $this->__set($name, $data[$name]);
    // }
  }

  /**
   * Return true if field exists or false otherwise
   *
   * @param string $name Field name
   * @return boolean
   */
  public function hasField($name) {
    return array_key_exists($name, $this->fields);
  }

  /**
   * Returns Field Information
   *
   * @param string $name
   * @return Field
   */
  public function getField($name) {
    if (!$this->hasField($name)) return NULL;
    return $this->fields[$name];
  }

  /**
   * Gets all allowed fields of a Data
   *
   * @return array
   */
  public function getFields() {
    return $this->fields;
  }

  public function reference(&$field, $name) {
    if (!\array_key_exists($name, $this->fields)) {
      throw new InvalidFieldReferenceException("Unable to reference '$name' in '".static::class."'. Field does not exist!");
    }

    $this->_reference[$name][] = &$field;

    if (!isset($this->data->{$name})) {
      $this->data->{$name} = NULL;
    }

    $field = &$this->data->{$name};
  }

  public function clear() {
    $this->data = new \stdClass;
  }


  /**
   * @ignore
   */
  public function &__get($name) {
    if (!$this->__isset($name)) return NULL;
    return $this->data->{$name};
  }

  /**
   * @ignore
   */
  public function __set($name, $value) {
    if (!array_key_exists($name, $this->fields)) return;

    $field = &$this->fields[$name];

    $this->data->{$name} = Field::cast($value, $field->type());

    // Update References
    if (array_key_exists($name, $this->_reference)) {
      foreach ($this->_reference[$name] as &$field) {
        $field = $this->data->{$name};
      }
    }
  }

  /**
   * @ignore
   */
  public function __isset($name) {
    return isset($this->data->{$name});
  }

  /**
   * @ignore
   */
  public function __unset($name) {
    unset($this->data->{$name});
  }

}
