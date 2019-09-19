<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Templates\TemplateFolder;


/**
 * @property TemplateFolder[] $lists
 *  An array of objects representing template folders.
 * 
 * @property Link $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * @property int $total_items
 *  The total number of items matching the query regardless of pagination.
 */
class TemplateFolderListResponse extends Data {

  protected $fields = [
    'folders' => ['type' => Template::class.'[]'],
    '_links' => ['type' => Link::class.'[]'],
    'total_items' => ['type' => 'int'],
  ];

}

