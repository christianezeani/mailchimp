<?php
namespace MailChimp\Core;

class PageCollection extends Collection {

  private $info = [
    'page' => ['type' => 'int']
  ];

  private $data;

  function __construct(array $data = NULL, string $type = NULL) {
    parent::__construct($data, $type);
    $this->data = new \stdClass;

    if (\is_null($data)) return;

    foreach ($this->info as $name => &$info) {
      if (array_key_exists($name, $data)) {
        $this->__set($name, $data[$name]);
      } else {
        $this->__set($name, NULL);
      }
    }
  }

  public function clear() {
    parent::clear();
    $this->data = new \stdClass();
  }

  public function jsonSerialize() {
    $data = $this->data;
    $data->data = parent::jsonSerialize();
    return $data;
  }

  public function __get($name) {
    if (!isset($this->data->{$name})) return NULL;
    return $this->data->{$name};
  }

  public function __set($name, $value) {
    if (!array_key_exists($name, $this->info)) return;

    $info = $this->info[$name];
    $this->data->{$name} = Field::cast($value, $info['type']);
  }

  public function __isset($name) {
    return isset($this->data->{$name});
  }

  public function __unset($name) {
    unset($this->data->{$name});
  }

}

