<?php
namespace MailChimp\Traits;

use MailChimp\Core\Field;
use MailChimp\Exceptions\InvalidDataException;
use MailChimp\Exceptions\InvalidFieldReferenceException;

trait UsesMagicFields {

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

  protected function &getData() {
    return $this->data;
  }


  protected function initialize(array $data=NULL) {
    foreach ($this->fields as $name => &$info) {
      if (!is_array($info)) throw new InvalidDataException("Invalid field setting at '$name'.");
      if (!array_key_exists('type', $info)) throw new InvalidDataException("Type info not set for '$name'.");

      $field = new Field($name, $info['type']);
      if (array_key_exists('required', $info)) $field->required($info['required']);
      if (array_key_exists('default', $info)) $field->default($info['default']);

      $info = $field;
    }

    $this->data = new \stdClass;
    $this->merge($data);
  }

  public function merge($data) {
    if (!is_array($data)) return;

    foreach ($data as $name => $value) {
      $this->__set($name, $value);
    }
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

  public function clear() {
    $this->data = new \stdClass;
  }



  /**
   * @ignore
   */
  public function &__get($name) {
    return $this->data->{$name};
  }

  /**
   * @ignore
   */
  public function __set($name, $value) {
    if (!array_key_exists($name, $this->fields)) return;

    $field = &$this->fields[$name];

    $this->data->{$name} = Field::cast($value, $field->type());
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