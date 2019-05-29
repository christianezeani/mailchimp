<?php
namespace MailChimp\Core;

class Collection extends Core implements JsonSerializable, ArrayAccess {

  private $_type = NULL;

  private $data = [];

  function __construct(array $data = NULL, string $type = NULL) {
    $this->_type = $type;

    if (!is_array($data)) return;
    if (array_keys($data) !== range(0, count($data) - 1)) return;
    $this->data = Field::cast($data, $type.'[]');
  }

  protected function type() {
    return $this->_type;
  }

  public function clear() {
    $this->data = [];
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
    if (is_null($offset)) {
      $this->data[] = $value;
    } else if (is_numeric($offset)) {
      $offset = (int)$offset;
      $this->data[$offset] = $value;
    }
  }

  public function offsetUnset($offset) {
    unset($this->data[$offset]);
  }

}

