<?php
namespace MailChimp\Core;

use MailChimp\Interfaces\ModelInterface;

class Builder extends Core {

  private $model;
  
  function __construct(ModelInterface &$model) {
    $this->model = &$modal;
  }
  
  public function create() {
    // 
  }
  
  public function update() {
    // 
  }
  
  public function delete() {
    // 
  }
  
  public function get() {
    // 
  }
  
  public function read() {
    // 
  }
  
  public function clear() {
    $this->model->clear();
  }
  
}
