<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;


/**
 * @property object $sections
 *  The sections that you can edit in the template, including each section's default content.
 * 
 * @property \MailChimp\Data\Link $_links
 *  A list of link types and descriptions for the API schema documents.
 */
class TemplateDefaultContentResponse extends Data {

  protected $fields = [
    'sections' => ['type' => 'object'],
    '_links' => ['type' => Link::class.'[]']
  ];

}

