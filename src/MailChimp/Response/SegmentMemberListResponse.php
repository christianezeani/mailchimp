<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Lists\Member;


/**
 * @property Member[] $members
 *  An array of objects, each representing a specific list member.
 * 
 * @property string $list_id
 *  The list id.
 * 
 * @property int $segment_id
 *  The segment id.
 * 
 * @property int $total_items
 *  The total number of items matching the query regardless of pagination.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 */
class SegmentMemberListResponse extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'members' => ['type' => Member::class.'[]'],
    'list_id' => ['type' => 'string'],
    'segment_id' => ['type' => 'int'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]']
  ];
  
}

