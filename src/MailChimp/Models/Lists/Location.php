<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Response\LocationListResponse;


/**
 * Get the locations (countries) that the list’s subscribers have been 
 * tagged to based on geocoding their IP address.
 * 
 * @property string $country
 *  The name of the country.
 * 
 * @property string $cc
 *  The ISO 3166 2 digit country code.
 * 
 * @property int $percent
 *  The percent of subscribers in the country.
 * 
 * @property int $total
 *  The total number of subscribers in the country.
 * 
 * @method LocationListResponse all()
 *  Get the locations (countries) that the list’s subscribers have been tagged to based on geocoding their IP address.
 */
class Location extends Model {

  /**
   * @ignore 
   */
  protected $path = '/lists/{list_id}/locations';

  /**
   * @ignore 
   */
  protected $fields = [
    'country' => ['type' => 'string'],
    'cc' => ['type' => 'string'],
    'percent' => ['type' => 'int'],
    'total' => ['type' => 'int']
  ];

  /**
   * @ignore 
   */
  protected $action = [
    'all' => [
      'method' => 'GET',
      'fields' => [
        'list_id' => ['type' => 'string', 'required' => true]
      ],
      'responseType' => LocationListResponse::class
    ]
  ];

}

