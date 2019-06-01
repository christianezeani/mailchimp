<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Lists\Webhook;


/**
 * @property Webhook[] $webhooks
 *  An array of objects, each representing a specific list member.
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
class WebhookListResponse extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'webhooks' => ['type' => Webhook::class.'[]'],
    'list_id' => ['type' => 'string'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]'],
  ];

}


