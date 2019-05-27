<?php
namespace MailChimp\Core;

use MailChimp\Exceptions\InvalidClassException;


class Http extends Core {

  const DEFAULT_HEADERS = [
    'Content-Type' => 'application/json'
  ];

  private $_class;
  private $_headers = [];
  private $_ssl = true;

  function __construct() {}

  public function as($class) {
    if (!is_subclass_of($class, Model::class)) {
      throw new InvalidClassException("Expected a subclass of '".Model::class."', '$class' supplied.");
    }

    $this->_class = $class;
    return $this;
  }

  public function ssl(bool $value) {
    $this->_ssl = $value;
    return $this;
  }

  public function headers() {
    $header_hash = array_change_key_case(self::DEFAULT_HEADERS, CASE_LOWER);
    $header_hash = array_merge($header_hash, $this->_headers);

    $headers = [];
    foreach ($header_hash as $name => $value) {
      $headers[] = "{$name}: {$value}";
    }

    return $headers;
  }

  public function withHeader(string $name, string $value) {
    if (!empty($name)) {
      $name = strtolower($name);
      $this->_headers[$name] = $value;
    }
    return $this;
  }

  public function withHeaders(array $headers) {
    foreach ($headers as $name => $value) {
      $this->withHeader($name, $value);
    }
    return $this;
  }

  public function request(string $method, $path, array $data=NULL) {
    if (!is_string($method) || empty($method)) $method = 'GET';
    $method = strtoupper($method);

    $ch = \curl_init();
    $config = $this->config();
    $endpoint = $config->endpoint($path);
    $key = $config->getKey();

    switch ($method) {
      case 'GET': {
        if (!$data || !count($data)) break;
        $endpoint .= '?' . http_build_query($data);
      } break;

      case 'POST': {
        $options[CURLOPT_POST] = true;
        $options[CURLOPT_POSTFIELDS] = $data;
      } break;

      case 'PATCH': {
        $options[CURLOPT_CUSTOMREQUEST] = 'PATCH';
        $options[CURLOPT_POSTFIELDS] = $data;
      } break;

      case 'PUT': {
        $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
        $options[CURLOPT_POSTFIELDS] = $data;
      } break;

      case 'DELETE': {
        $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
      } break;
    }

    $options[CURLOPT_URL] = $endpoint;
    $options[CURLOPT_HEADER] = true;
    $options[CURLOPT_FOLLOWLOCATION] = true;
    $options[CURLOPT_RETURNTRANSFER] = true;
    $options[CURLOPT_HTTPHEADER] = $this->headers();

    // Basic Auth
    $options[CURLOPT_HTTPAUTH] = CURLAUTH_ANY;
    $options[CURLOPT_USERPWD] = "mailchimp:{$key}";

    if (!$this->_ssl) {
      $options[CURLOPT_SSL_VERIFYSTATUS] = false;
      $options[CURLOPT_SSL_VERIFYPEER] = false;
    }

    \curl_setopt_array($ch, $options);
    $resp = \curl_exec($ch);
    $info = \curl_getinfo($ch);
    \curl_close($ch);
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
