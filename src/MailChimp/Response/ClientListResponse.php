<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Lists\Client;


/**
 * @property Client[] $clients 
 * An array of top email clients.
 * 
 * @property string $list_id 
 *  The list id.
 * 
 * @property int $total_items
 *  The total number of items matching the query regardless of pagination.
 * 
 * @property Link[] $_links 
 *  A list of link types and descriptions for the API schema documents.
 */
class ClientListResponse extends Data {

  /**
   * @ignore
   */
  protected $fields = [
    'clients' => ['type' => Client::class.'[]'],
    'list_id' => ['type' => 'string'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]']
  ];

}

