<?php
namespace MailChimp\Core;

class Http extends Core {

  function __construct() {
    // 
  }

  public function request($method, $path, array $data=NULL, array $headers=NULL) {
    // 
  }

  public function get($path, array $data=NULL, array $headers=NULL) {
    return $this->request('GET', $path, $data, $headers);
  }

  public function post($path, array $data=NULL, array $headers=NULL) {
    return $this->request('POST', $path, $data, $headers);
  }

  public function patch($path, array $data=NULL, array $headers=NULL) {
    return $this->request('PATCH', $path, $data, $headers);
  }

  public function put($path, array $data=NULL, array $headers=NULL) {
    return $this->request('PUT', $path, $data, $headers);
  }

  public function delete($path, array $data=NULL, array $headers=NULL) {
    return $this->request('DELETE', $path, $data, $headers);
  }

}
