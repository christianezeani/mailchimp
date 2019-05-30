<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Lists\Interest;


/**
 * @property Interest[] $interests
 *  An array of this category’s interests
 * 
 * @property string $list_id
 *  The unique list id that the interests belong to.
 * 
 * @property string $category_id
 *  The id for the interest category.
 * 
 * @property int $total_items
 *  The total number of items matching the query regardless of pagination.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 */
class InterestListResponse extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'interests' => ['type' => Interest::class.'[]'],
    'list_id' => ['type' => 'string'],
    'category_id' => ['type' => 'string'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]']
  ];

}

