<?php
namespace MailChimp\Core;

use MailChimp\Interfaces\ModelInterface;
use MailChimp\Exceptions\FieldRequiredException;
use MailChimp\Exceptions\ActionNotDefinedException;

class Builder extends Core {

  private $http;
  private $model;
  private $modelClass;

  const ACTIONS = ['create', 'edit', 'delete', 'all', 'read'];
  
  function __construct(ModelInterface &$model) {
    $this->modelClass = get_class($model);
    $this->model = &$model;
  }

  protected function __initialize__() {
    $config = $this->config();

    $this->http = $this->own(Http::class, $this->modelClass);
    $this->http->withHeader('Authorization', 'Basic ' . $config->getKey());
  }

  private function getAction($name) {
    if (!($info = $this->model->getAction($name))) {
      throw new ActionNotDefinedException("No action for defined for '$name'.");
    }
    return $info;
  }

  private function getActionPath($action) {
    if (!array_key_exists('path', $action)) $action['path'] = '';
    if (!array_key_exists('params', $action)) $action['params'] = [];
    return $this->model->getPath($action['path'], $action['params']);
  }

  private function getActionData($action) {
    $data = [];

    if (array_key_exists('fields', $action)) {
      foreach ($action['fields'] as $name => $field) {
        $value = $this->model->{$name};

        if (is_null($value)) {
          if ($field->required()) {
            throw new FieldRequiredException("'$name' field is required");
          }
          continue;
        }

        $data[$name] = $value;
      }
    }

    return $data;
  }
  
  public function clear() {
    $this->model->clear();
  }


  public function __call($name, $arguments) {
    if ($action = $this->getAction($name)) {
      $path = $this->getActionPath($action);
      $data = $this->getActionData($action);

      if (array_key_exists('responseType', $action)) {
        $this->http->as($action['responseType']);
      } else {
        $this->http->as($this->modelClass);
      }

      $query = [];

      if (array_key_exists(0, $arguments) && is_array($arguments[0])) {
        $query = array_merge($query, $arguments[0]);
      }

      if ($action['method'] === 'GET') {
        $data = $query;
      } else {
        $data = array_merge($data, $query);
      }

      if (array_key_exists(1, $arguments) && $arguments[1] === true) {
        var_dump($path);
      }

      return $this->http->request($action['method'], $path, $data);
    }

    return NULL;
  }
  
}
