<?php
namespace MailChimp\Core;

use MailChimp\Interfaces\ModelInterface;
use MailChimp\Exceptions\InvalidDataException;

/**
 * Base Model
 */
class Model extends Data implements ModelInterface {

  /**
   * API Endpoint
   * 
   * @var string
   */
  protected $path = '/';

  /**
   * Action Fields Configurations
   * 
   * @var array
   */
  protected $action = [];

  /**
   * Data holder for action fields
   *
   * @var array
   */
  private $data = [];

  /**
   * API Query builder
   * 
   * @var Builder
   */
  private $builder;

  function __construct(array $data=NULL) {
    parent::__construct($data);
    $this->builder = $this->c(new Builder($this));
    $this->initialize();
  }

  private function initialize() {
    foreach ($this->action as $action => &$config) {
      $this->data[$action] = new \stdClass;
      if (!array_key_exists('fields', $config)) continue;

      $fields = &$config['fields'];
      foreach ($fields as $name => &$info) {
        if (!is_array($info)) throw new InvalidDataException("Invalid field setting at '$name'.");

        if (!array_key_exists('type', $info)) {
          if (array_key_exists('reference', $info)) {
            if (!($rfield = $this->getField($info['reference']))) {
              throw new InvalidDataException("Type info not set for '$name'.");
            }
            $info['type'] = $rfield->type();
          } else {
            throw new InvalidDataException("Type info not set for '$name'.");
          }
        }
        
        $field = new ActionField($name, $info['type']);
        if (array_key_exists('required', $info)) $field->required($info['required']);
        if (array_key_exists('default', $info)) $field->default($info['default']);

        if (array_key_exists('reference', $info)) {
          $field->reference($info['reference']);
          $this->reference(
            $this->data[$action]->{$name},
            $info['reference']
          );
        }

        $info = $field;
      }
    }
  }

  /**
   * Return API Path
   * 
   * @return string
   */
  public function getPath() {
    return $this->path;
  }

  /**
   * Returns an array of action fields for an action
   *
   * @param string $action
   * @return array
   */
  public function getActionFields($action) {
    if (!array_key_exists($action, $this->fields)) return NULL;

    $config = $this->fields[$action];
    if (!array_key_exists('fields', $config)) return NULL;

    return $config['fields'];
  }

  /**
   * Returns an ActionField object specified by `$action` and `$name`
   *
   * @param string $action Action Name
   * @param string $name Field Name
   * @return ActionField
   */
  public function getActionField($action, $name) {
    $fields = $this->getActionFields($action);
    if (!$fields) return NULL;

    if (!array_key_exists($name, $fields)) return NULL;
    return $fields[$name];
  }

  public function clear() {
    parent::clear();

    foreach ($this->data as $action => &$data) {
      $data = new \stdClass;
    }
  }



  public function __call($name, $arguments) {
    return $this->builder->{$name}(...$arguments);
  }

  public function __get($name) {
    if (parent::hasField($name)) return parent::__get($name);
    // TODO: Return value of action fields
    return NULL;
  }

  public function __set($name, $value) {
    if (parent::hasField($name)) {
      parent::__set($name, $value);
      return;
    }

    // TODO: Set value for action fields
  }

}
