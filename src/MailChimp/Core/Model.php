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
   * Info for all action fields
   *
   * @var array
   */
  private $_action = [];

  /**
   * Data holder for unreferenced action fields
   *
   * @var array
   */
  private $data = [];

  /**
   * Info for unreferenced action fields
   *
   * @var array
   */
  private $_fields = [];

  /**
   * API Query builder
   * 
   * @var Builder
   */
  private $builder;


  protected function __initialize__() {
    $this->builder = $this->own(Builder::class, $this);

    $this->data = new \stdClass;
    $this->_action = $this->action;

    foreach ($this->_action as $action => &$config) {
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
        } else {
          $this->_fields[$name] = $field;
          $this->data->{$name} = NULL;
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
  public function getPath(string $child = NULL, array $params = NULL) {
    $path = $this->path;

    if (!empty($child)) {
      if (substr($child, 0, 1) !== '/') $child = '/' . $child;
      $path .= $child;
    }

    if ($params && count($params)) {
      $path = preg_replace_callback("/\{([\w]+)\}/", function ($match) use (&$params) {
        if (!array_key_exists($match[1], $params)) return '';
        return $params[$match[1]];
      }, $path);
    }

    return $path;
  }

  public function getAction($name) {
    if (!array_key_exists($name, $this->_action)) return NULL;
    return $this->_action[$name];
  }

  /**
   * Returns an array of action fields for an action
   *
   * @param string $action
   * @return array
   */
  public function getActionFields($action) {
    $info = $this->getAction($action);
    if (!$info || !array_key_exists('fields', $info)) return NULL;

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

    foreach ($this->data as &$data) {
      $data = NULL;
    }
  }



  public function __call($name, $arguments) {
    return $this->builder->{$name}(...$arguments);
  }

  public function __get($name) {
    if (parent::hasField($name)) return parent::__get($name);

    if (isset($this->data->{$name})) {
      return $this->data->{$name};
    }
    
    return NULL;
  }

  public function __set($name, $value) {
    if (parent::hasField($name)) {
      parent::__set($name, $value);
      return;
    }

    if (array_key_exists($name, $this->_fields)) {
      $field = $this->_fields[$name];
      $this->data->{$name} = Field::cast($value, $field->type());
    }
  }

}
