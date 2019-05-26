<?php
namespace MailChimp\Core;

use MailChimp\Exceptions\InvalidClassException;


class Http extends Core {

  private $_class;
  private $_headers = [];

  function __construct() {}

  public function as($class) {
    if (!is_subclass_of($class, Model::class)) {
      throw new InvalidClassException("Expected a subclass of '".Model::class."', '$class' supplied.");
    }

    $this->_class = $class;
    return $this;
  }

  public function withHeaders(array $headers) {
    return $this;
  }

  public function withoutHeaders(array $headers) {
    return $this;
  }

  public function request($method, $path, array $data=NULL) {
    // 
  }

  public function get($path, array $data=NULL) {
    return $this->request('GET', $path, $data);
  }

  public function post($path, array $data=NULL) {
    return $this->request('POST', $path, $data);
  }

  public function patch($path, array $data=NULL) {
    return $this->request('PATCH', $path, $data);
  }

  public function put($path, array $data=NULL) {
    return $this->request('PUT', $path, $data);
  }

  public function delete($path, array $data=NULL) {
    return $this->request('DELETE', $path, $data);
  }

}
