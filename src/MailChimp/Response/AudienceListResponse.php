<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Audience;


/**
 * @property \MailChimp\Models\Audience[] $lists
 * @property \MailChimp\Data\Link $_links
 * @property int $total_items
 */
class AudienceListResponse extends Data {

  protected $fields = [
    'lists' => ['type' => Audience::class.'[]'],
    '_links' => ['type' => Link::class.'[]'],
    'total_items' => ['type' => 'int'],
  ];

}


