<?php
namespace MailChimp\Core;

use MailChimp\Interfaces\ConfigInterface;
use MailChimp\Interfaces\MailChimpInterface;

use MailChimp\Exceptions\InvalidClassException;

class Core {

  private $_api;
  private $_config;

  protected function setApi(MailChimpInterface &$api) {
    if ($this !== $api) return;
    $this->_api = &$api;
  }

  protected function api(): MailChimpInterface {
    return $this->_api;
  }

  protected function setConfig(ConfigInterface &$config) {
    if (!$this->_api || $this !== $this->_api) return;
    $this->_config = &$config;
  }

  protected function config(): ConfigInterface {
    return $this->_config;
  }

  protected function own($class, ...$args) {
    if (!is_subclass_of($class, self::class)) {
      throw new InvalidClassException("Expected a subclass of '".self::class."', '$class' supplied!");
    }

    $obj = new $class(...$args);
    return $obj($this->_config, $this->_api);
  }


  public static function __callStatic($name, $arguments) {
    return (new static)->{$name}(...$arguments);
  }

  public function __invoke(ConfigInterface &$config, MailChimpInterface &$api) {
    $this->_config = &$config;
    $this->_api = &$api;

    if (method_exists($this, '__initialize__')) {
      $this->__initialize__();
    }

    return $this;
  }

}
