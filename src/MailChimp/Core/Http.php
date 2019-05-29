<?php
namespace MailChimp\Core;

use MailChimp\Response\ErrorResponse;
use MailChimp\Exceptions\InvalidClassException;


class Http extends Core {

  const DEFAULT_HEADERS = [
    'Content-Type' => 'application/json'
  ];

  private $_class;
  private $_headers = [];
  private $_ssl = true;

  function __construct(string $class) {
    $this->as($class);
  }

  public function as(string $class = NULL) {
    if (!is_null($class)) {
      if ($class === ErrorResponse::class || is_subclass_of($class, ErrorResponse::class)) {
        throw new InvalidClassException("Cannot accept '$class' or a subclass of '".ErrorResponse::class."'.");
      }
  
      if (!is_subclass_of($class, Data::class)) {
        throw new InvalidClassException("Expected a subclass of '".Data::class."', '$class' supplied.");
      }
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

    if ($data) $data = \json_encode($data);

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
    // $options[CURLOPT_HEADER] = true;
    $options[CURLOPT_FOLLOWLOCATION] = true;
    $options[CURLOPT_RETURNTRANSFER] = true;
    $options[CURLOPT_HTTPHEADER] = $this->headers();

    // Basic Auth
    // $options[CURLOPT_HTTPAUTH] = CURLAUTH_ANY;
    // $options[CURLOPT_USERPWD] = "mailchimp:{$key}";

    if (!$this->_ssl) {
      $options[CURLOPT_SSL_VERIFYSTATUS] = false;
      $options[CURLOPT_SSL_VERIFYPEER] = false;
    }

    \curl_setopt_array($ch, $options);
    $response = \curl_exec($ch);
    $info = \curl_getinfo($ch);

    \curl_close($ch);

    $response = @json_decode($response, true);

    if (substr($info['http_code'], 0, 1) === '2') {
      if (is_null($response)) return $response;

      if ($this->_class && is_array($response)) {
        if (array_keys($response) === range(0, count($response) - 1)) {
          $response = Field::cast($response, $this->_class.'[]');
        } else {
          $response = $this->own($this->_class, $response);
        }
      }
      return $response;
    } else {
      $response = $this->own(ErrorResponse::class, $response);
      // print_r($response);
      return $response;
    }
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
