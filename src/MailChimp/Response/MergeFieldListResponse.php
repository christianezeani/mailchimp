<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Lists\MergeField;


/**
 * @property MergeField[] $merge_fields
 *  An array of objects, each representing a merge field resource.
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
class MergeFieldListResponse extends Data {

  protected $fields = [
    'merge_fields' => ['type' => MergeField::class.'[]'],
    'list_id' => ['type' => 'string'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]']
  ];

}

