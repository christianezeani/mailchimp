<?php
namespace MailChimp\Core;

class Core {

  public static function __callStatic($name, $arguments) {
    return (new static)->{$name}(...$arguments);
  }

}

// https://<dc>.api.mailchimp.com/3.0