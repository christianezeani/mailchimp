<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property string $company The company name for the list
 * @property string $address1 The street address for the list contact
 * @property string $address2 The street address for the list contact
 * @property string $city The city for the list contact
 * @property string $state The state for the list contact
 * @property string $zip The postal or zip code for the list contact
 * @property string $country A two-character ISO3166 country code. Defaults to US if invalid
 * @property string $phone The phone number for the list contact
 */
class Contact extends Data {

  /**
   * @ignore
   */
  protected $fields = [
    'company' => 'string',
    'address1' => 'string',
    'address2' => 'string',
    'city' => 'string',
    'state' => 'string',
    'zip' => 'string',
    'country' => 'string',
    'phone' => 'string'
  ];

}


