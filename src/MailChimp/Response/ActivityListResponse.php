<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;

use MailChimp\Models\Lists\Activity;


/**
 * @property Activity[] $activity Recent list activity.
 * @property string list_id The unique id for the list.
 * @property int $total_items The total number of items matching the query regardless of pagination.
 * @property Link[] $_links A list of link types and descriptions for the API schema documents.
 */
class ActivityListResponse extends Data {

  protected $fields = [
    'activity' => ['type' => Activity::class.'[]'],
    'list_id' => ['type' => 'string'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]'],
  ];

}

