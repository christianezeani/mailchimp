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
   * Path Parameters
   *
   * @var array
   */
  protected $params = [];

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
   * @var object
   */
  private $data;

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


  /**
   * @ignore
   */
  protected function __initialize__(array $data = NULL) {
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

          if (is_array($data) && array_key_exists($name, $data)) {
            $this->__set($name, $data[$name]);
          } else {
            $this->data->{$name} = NULL;
          }
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

    if (!is_array($params)) $params = [];
    $params = array_merge($this->params, $params);

    $closure = $this->parseActionPath($params);
    $path = preg_replace_callback("/\{([\w]+)\}/", $closure, $path);

    return $path;
  }

  private function parseActionPath(&$params) {
    return function ($match) use (&$params) {
      $param = $match[1];

      if (array_key_exists($param, $params)) {
        $reference = $params[$param];

        if (\substr($reference, -2) === '()') {
          $reference = substr($reference, 0, -2);
          if (method_exists($this, $reference)) {
            return $this->{$reference}();
          }

          return '';
        }

        return $this->{$reference};
      }

      return $this->{$param};

      // if (isset($this->{$param})) {
      //   return $this->{$param};
      // }

      // return '';
    };
  }

  public function getAction($name) {
    if (!array_key_exists($name, $this->_action)) return NULL;
    return $this->_action[$name];
  }

  /**
   * Returns an array of action fields for an action
   *
   * @param string $action
   * @return ActionField[]
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



  /**
   * @ignore
   */
  public function __call($name, $arguments) {
    return $this->builder->{$name}(...$arguments);
  }

  /**
   * @ignore
   */
  public function &__get($name) {
    if (parent::hasField($name)) {
      return parent::__get($name);
    }

    if (isset($this->data->{$name})) {
      return $this->data->{$name};
    }
    
    return NULL;
  }

  /**
   * @ignore
   */
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
