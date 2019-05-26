<?php
namespace MailChimp\Core;

use MailChimp\Interfaces\ModelInterface;
use MailChimp\Exceptions\ActionNotDefinedException;

class Builder extends Core {

  private $http;
  private $model;
  private $modelClass;
  
  function __construct(ModelInterface &$model, Http $http) {
    $this->modelClass = get_class($model);
    $this->model = &$modal;
    $this->http = $http;
  }

  private function getAction($action) {
    $info = $this->model->getAction($action);
    if (!$info) throw new ActionNotDefinedException("No action for defined for '$action'.");
  }
  
  public function create() {
    $info = $this->getAction(__FUNCTION__);
  }
  
  public function edit() {
    $info = $this->getAction(__FUNCTION__);
  }
  
  public function delete() {
    $info = $this->getAction(__FUNCTION__);
  }
  
  public function get() {
    $info = $this->getAction(__FUNCTION__);
  }
  
  public function read() {
    $info = $this->getAction(__FUNCTION__);
  }
  
  public function clear() {
    $this->model->clear();
  }
  
}
