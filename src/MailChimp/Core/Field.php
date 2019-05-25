<?php
namespace MailChimp\Core;

use MailChimp\Exceptions\InvalidFieldException;


class Field extends Core {

  private $_name;
  private $_type;
  private $_required = false;
  private $_default = NULL;

  function __construct($name, $type, $required = false, $default = NULL) {
    $this->name($name);
    $this->type($type);
    $this->required($required);
    $this->default($default);
  }

  public static function create($name, $type, $required = false, $default = NULL) {
    return new static($name, $type, $required, $default);
  }

  public function name() {
    $args = func_get_args();
    if (!count($args)) return $this->_name;

    if (!is_string($args[0])) throw new InvalidFieldException("Invalid value for 'name'.");

    $this->_name = $args[0];
    return $this;
  }

  public function type() {
    $args = func_get_args();
    if (!count($args)) return $this->_type;

    if (!is_string($args[0])) throw new InvalidFieldException("Invalid value for 'type'.");

    $this->_type = $args[0];
    return $this;
  }

  public function required() {
    $args = func_get_args();
    if (!count($args)) return $this->_required;

    if (!is_bool($args[0])) throw new InvalidFieldException("Invalid value for 'required'.");

    $this->_required = $args[0];
    return $this;
  }

  public function default() {
    $args = func_get_args();
    if (!count($args)) return $this->_default;

    $this->_default = $args[0];
    return $this;
  }

  public static function cast($data, $type) {
    $isArray = (\substr($type, -2) === '[]');

    if ($isArray) {
      $type = \substr($type, 0, -2);
    }

    if (class_exists($type)) {
      if ($isArray) {
        $value = [];
        if (is_array($data)) {
          foreach ($data as $item) {
            $value[] = new $type($item);
          }
        }
        return $value;
      }

      return new $type($data);
    }
    
    settype($data, $type);
    return $data;
  }

}

