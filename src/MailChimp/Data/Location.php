<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property float $latitude
 * @property float $longitude
 * @property int $gmtoff
 * @property int $dstoff
 * @property string $country_code
 * @property string $timezone
 */
class Location extends Data {

  protected $fields = [
    'latitude' => ['type' => 'float'],
    'longitude' => ['type' => 'float'],
    'gmtoff' => ['type' => 'int'],
    'dstoff' => ['type' => 'int'],
    'country_code' => ['type' => 'string'],
    'timezone' => ['type' => 'string']
  ];

}

