<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Lists\Location;


/**
 * @property Location[] $locations
 *  An array of objects, each representing a list’s top subscriber locations.
 * 
 * @property string $list_id
 *  The unique id for the list.
 * 
 * @property int $total_items
 *  The total number of items matching the query regardless of pagination.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 */
class LocationListResponse extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'locations' => ['type' => Location::class.'[]'],
    'list_id' => ['type' => 'string'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]']
  ];

}


