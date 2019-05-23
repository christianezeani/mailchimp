<?php
namespace MailChimp\Core;

use MailChimp\Interfaces\ConfigInterface;
use MailChimp\Interfaces\MailChimpInterface;

class Core {

  private $_api;
  private $_config;

  protected function setApi(MailChimpInterface &$api) {
    if ($this !== $api) return;
    $this->_api = $api;
  }

  protected function api(): MailChimpInterface {
    return $this->_api;
  }

  protected function setConfig(ConfigInterface &$config) {
    if (!$this->_api || $this !== $this->_api) return;
    $this->_config = $config;
  }

  protected function config(): ConfigInterface {
    return $this->_config;
  }

  protected function c(Core $obj) {
    $obj->_config = $this->_config;
    $obj->_api = $this->_api;

    return $obj;
  }


  public static function __callStatic($name, $arguments) {
    return (new static)->{$name}(...$arguments);
  }

}
