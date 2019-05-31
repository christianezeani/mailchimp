<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property int $default_country
 *  In an address field, the default country code if none supplied.
 * 
 * @property string $phone_format
 *  In a phone field, the phone number type: US or International.
 * 
 * @property string $date_format
 *  In a date or birthday field, the format of the date.
 * 
 * @property string[] $choices
 *  In a radio or dropdown non-group field, the available options for members to pick from.
 * 
 * @property int $size
 *  In a text field, the default length of the text field.
 */
class MergeFieldOptions extends Data {

  protected $fields = [
    'default_country' => ['type' => 'int'],
    'phone_format' => ['type' => 'string'],
    'date_format' => ['type' => 'string'],
    'choices' => ['type' => 'string[]'],
    'size' => ['type' => 'int']
  ];
  
}


