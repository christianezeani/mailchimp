<?php
namespace MailChimp\Core;

use ArrayAccess;
use JsonSerializable;


class HashMap extends Core implements JsonSerializable, ArrayAccess {

  private $_type = NULL;
  private $data = [];

  function __construct(array $data = NULL, string $type = NULL) {
    $this->_type = $type;

    if (!is_array($data)) return;
    
    foreach ($data as $key => $value) {
      $this->offsetSet($key, $value);
    }
  }

  public function type() {
    return $this->_type;
  }

  public function jsonSerialize() {
    return $this->data;
  }

  public function offsetExists($offset) {
    return isset($this->data[$offset]);
  }

  public function offsetGet($offset) {
    if (!isset($this->data[$offset])) return NULL;
    return $this->data[$offset];
  }

  public function offsetSet($offset, $value) {
    if (!is_string($offset)) return;
    $this->data[$offset] = Field::cast($value, $this->_type);
  }

  public function offsetUnset($offset) {
    unset($this->data[$offset]);
  }

}

