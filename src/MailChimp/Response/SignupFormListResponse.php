<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Lists\SignupForm;


/**
 * @property SignupForm[] $signup_forms
 *  List signup form.
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
class SignupFormListResponse extends Data {

  protected $fields = [
    'signup_forms' => ['type' => SignupForm::class.'[]'],
    'list_id' => ['type' => 'string'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]']
  ];

}


