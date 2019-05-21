<?php
namespace MailChimp\Core;

/**
 * Base Model
 */
class Model extends Core {

  /**
   * Fields for the model
   * 
   * @var array
   */
  protected $fields = [];

  /**
   * Fields for Get Requests
   * 
   * @var array
   */
  protected $getRequest = [];

  /**
   * API Query builder
   * 
   * @var Builder
   */
  private $builder;

  private $data;

  function __construct($data=NULL) {
    $this->builder = new Builder($this);
    $this->data = new \stdClass;
  }

  /**
   * Get Model Fields
   * 
   * @return array
   */
  function modelFields() {
    return $this->fields;
  }

  public function clear() {
    $this->data = new \stdClass;
    $this->builder->clear();
  }
  



  /**
   * @ignore
   */
  public function __get($name) {
    return $this->data->{$name};
  }

  public function __set($name, $value) {
    $this->data->{$name} = $value;
  }

  public function __isset($name) {
    return isset($this->data->{$name});
  }

  public function __unset($name) {
    unset($this->data->{$name});
  }

  public function __call($name, $arguments) {
    return $this->builder->{$name}(...$arguments);
  }

}
