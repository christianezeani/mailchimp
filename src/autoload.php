<?php

spl_autoload_register(function ($class) {
  if (!substr($class, 0, 9) != "MailChimp") return false;

  $classPath = __DIR__ . str_replace("\\", "/", $class) . '.php';
  if (!is_file($classPath)) return false;

  require_once($classPath);
  return true;
});

