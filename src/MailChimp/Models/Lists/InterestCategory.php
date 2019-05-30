<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Response\InterestCategoryListResponse;


/**
 * Manage interest categories for a specific list. Interest categories organize interests,
 * which are used to group subscribers based on their preferences. These correspond to 'group titles'
 * in the Mailchimp application. Learn more about groups in Mailchimp.
 * 
 * @property string $id
 *  The id for the interest category.
 * 
 * @property string $list_id
 *  The unique list id for the category.
 * 
 * @property string $title
 *  The text description of this category. This field appears on signup forms and is often phrased as a question.
 * 
 * @property int $display_order
 *  The order that the categories are displayed in the list. Lower numbers display first.
 * 
 * @property string $type
 *  Determines how this category’s interests appear on signup forms.
 * 
 *  #### Possible Values:
 *  * checkboxes
 *  * dropdown
 *  * radio
 *  * hidden
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * @method InterestCategory create()
 *  Create a new interest category.
 * 
 * @method InterestCategory edit()
 *  Update a specific interest category.
 * 
 * @method InterestCategoryListResponse all()
 *  Get information about a list’s interest categories.
 * 
 * @method InterestCategory read()
 *  Get information about a specific interest category.
 * 
 * @method mixed delete()
 *  Delete a specific interest category.
 */
class InterestCategory extends Model {

  /**
   * @ignore 
   */
  protected $path = '/lists/{list_id}/interest-categories';

  /**
   * @ignore 
   */
  protected $fields = [
    'id' => ['type' => 'string'],
    'list_id' => ['type' => 'string'],
    'title' => ['type' => 'string'],
    'display_order' => ['type' => 'int'],
    'type' => ['type' => 'string', 'allowed' => ['checkboxes', 'dropdown', 'radio', 'hidden']],
    '_links' => ['type' => Link::class.'[]']
  ];

  /**
   * @ignore 
   */
  protected $action = [
    'create' => [
      'method' => 'POST',
      'fields' => [
        'title' => ['reference' => 'title', 'required' => true],
        'display_order' => ['reference' => 'display_order'],
        'type' => ['reference' => 'type', 'required' => true]
      ]
    ],

    'edit' => [
      'method' => 'PATCH',
      'path' => '/{interest_category_id}',
      'params' => [
        'interest_category_id' => 'id'
      ],
      'fields' => [
        'title' => ['reference' => 'title', 'required' => true],
        'display_order' => ['reference' => 'display_order'],
        'type' => ['reference' => 'type', 'required' => true]
      ]
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => InterestCategoryListResponse::class
    ],

    'read' => [
      'method' => 'GET',
      'path' => '/{interest_category_id}',
      'params' => [
        'interest_category_id' => 'id'
      ]
    ],

    'delete' => [
      'method' => 'DELETE',
      'path' => '/{interest_category_id}',
      'params' => [
        'interest_category_id' => 'id'
      ]
    ]
  ];

}


