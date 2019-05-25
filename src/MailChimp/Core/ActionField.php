<?php
namespace MailChimp\Core;

use MailChimp\Exceptions\InvalidFieldException;


class ActionField extends Field {

  /**
   * @ignore
   */
  private $_reference;

  /**
   * reference()
   * 
   * Gets or sets the name of the `Data` field it references.
   *
   * @return string|ActionField
   */
  public function reference() {
    $args = func_get_args();
    if (!count($args)) return $this->_reference;

    if (!is_string($args[0])) throw new InvalidFieldException("Invalid value for 'reference'.");

    $this->_reference = $args[0];
    return $this;
  }

}

