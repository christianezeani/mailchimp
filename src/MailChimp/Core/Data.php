<?php
namespace MailChimp\Core;

class Data extends Core {

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

  function __construct(array $data=NULL) {
    $this->data = new \stdClass;
    $this->merge($data);
  }

  public function merge($data) {
    if (!is_array($data)) return;

    foreach ($this->fields as $name => $type) {
      if (!array_key_exists($name, $data)) continue;
      $this->__set($name, $data[$name]);
    }
  }

  public function clear() {
    $this->data = new \stdClass;
  }


  /**
   * @ignore
   */
  public function __get($name) {
    return $this->data->{$name};
  }

  /**
   * @ignore
   */
  public function __set($name, $value) {
    if (!array_key_exists($name, $this->fields)) return;

    $type = $this->fields[$name];
    $isArray = (\substr($type, -2) === '[]');

    if ($isArray) $type = \substr($type, 0, -2);
    
    if (class_exists($type)) {
      if ($isArray) {
        $this->data->{$name}[] = new $type($value);
      } else {
        $this->data->{$name} = new $type($value);
      }
    } else {
      settype($value, $type);

      if ($isArray) {
        $this->data->{$name}[] = $value;
      } else {
        $this->data->{$name} = $value;
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
