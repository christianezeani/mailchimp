<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Lists\InterestCategory;


/**
 * @property string $list_id
 *  The ID for the list that this category belongs to.
 * 
 * @property InterestCategory[] $categories
 *  This array contains individual interest categories.
 * 
 * @property int $total_items
 *  The total number of items matching the query regardless of pagination.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 */
class InterestCategoryListResponse extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'list_id' => ['type' => 'string'],
    'categories' => ['type' => InterestCategory::class.'[]'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]'],
  ];

}

