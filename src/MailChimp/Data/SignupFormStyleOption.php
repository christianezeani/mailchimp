<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property string $property
 *  A string that identifies the property.
 * 
 * @property string $value
 *  A string that identifies value of the property.
 */
class SignupFormStyleOption extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'property' => ['type' => 'string'],
    'value' => ['type' => 'string']
  ];

}


