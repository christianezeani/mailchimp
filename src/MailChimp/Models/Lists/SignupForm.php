<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Data\SignupFormHeader;
use MailChimp\Data\SignupFormContent;
use MailChimp\Data\SignupFormStyle;
use MailChimp\Response\SignupFormListResponse;


/**
 * Manage list signup forms.
 * 
 * @property SignupFormHeader $header
 *  Options for customizing your signup form header.
 * 
 * @property SignupFormContent[] $contents
 *  The signup form body content.
 * 
 * @property SignupFormStyle[] $styles
 *  An array of objects, each representing an element style for the signup form.
 * 
 * @property string $signup_form_url
 *  Signup form URL.
 * 
 * @property string $list_id
 *  The signup form’s list id.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * @method SignupForm create()
 *  Customize a list's default signup form.
 * 
 * @method SignupFormListResponse all()
 *  Get signup forms for a specific list.
 */
class SignupForm extends Model {

  /**
   * @ignore 
   */
  protected $path = '/lists/{list_id}/signup-forms';

  /**
   * @ignore 
   */
  protected $fields = [
    'header' => ['type' => SignupFormHeader::class],
    'contents' => ['type' => SignupFormContent::class.'[]'],
    'styles' => ['type' => SignupFormStyle::class.'[]'],
    'signup_form_url' => ['type' => 'string'],
    'list_id' => ['type' => 'string'],
    '_links' => ['type' => Link::class.'[]']
  ];

  /**
   * @ignore 
   */
  protected $action = [
    'create' => [
      'method' => 'POST',
      'fields' => [
        'header' => ['reference' => 'header'],
        'contents' => ['reference' => 'contents'],
        'styles' => ['reference' => 'styles']
      ]
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => SignupFormListResponse::class
    ]

  ];

}


