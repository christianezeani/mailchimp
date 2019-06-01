<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property string $section
 *  The content section name.
 * 
 *  #### Possible Values:
 *  * signup_message
 *  * unsub_message
 *  * signup_thank_you_title
 * 
 * @property string $value
 *  The content section text.
 */
class SignupFormContent extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'section' => ['type' => 'string', 'allowed' => ['signup_message', 'unsub_message', 'signup_thank_you_title']],
    'value' => ['type' => 'string']
  ];

}


