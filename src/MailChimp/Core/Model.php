<?php
namespace MailChimp\Core;

use MailChimp\Interfaces\ModelInterface;

/**
 * Base Model
 */
class Model extends Data implements ModelInterface {

  /**
   * API Endpoint
   * 
   * @var string
   */
  protected $path = '/';

  /**
   * Methods Allowed
   * 
   * @var array
   */
  protected $methods = [];

  /**
   * Request Fields Configurations
   * 
   * @var array
   */
  protected $action = [];

  /**
   * API Query builder
   * 
   * @var Builder
   */
  private $builder;

  function __construct(array $data=NULL) {
    parent::__construct($data);
    $this->builder = $this->c(new Builder($this));
  }

  /**
   * Return API Path
   * 
   * @return string
   */
  public function getPath() {
    return $this->path;
  }

  /**
   * Returns all allowed methods
   * 
   * @return string[]
   */
  function getMethods() {
    return $this->methods;
  }


  public function clear() {
    $this->builder->clear();
    parent::clear();
  }

  public function __call($name, $arguments) {
    return $this->builder->{$name}(...$arguments);
  }

}
