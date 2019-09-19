<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Templates\Template;


/**
 * @property \MailChimp\Models\Lists\Template[] $lists
 *  All of an account's saved or custom templates.
 * 
 * @property \MailChimp\Data\Link $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * @property int $total_items
 *  The total number of items matching the query regardless of pagination.
 */
class TemplateListResponse extends Data {

  protected $fields = [
    'templates' => ['type' => Template::class.'[]'],
    '_links' => ['type' => Link::class.'[]'],
    'total_items' => ['type' => 'int'],
  ];

}

