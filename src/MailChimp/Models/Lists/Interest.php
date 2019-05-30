<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Response\InterestListResponse;


/**
 * Manage interests for a specific Mailchimp list. Assign subscribers to interests 
 * to group them together. Interests are referred to as 'group names' in the Mailchimp 
 * application.
 * 
 * @property string $id
 *  The ID for the interest.
 * 
 * @property string $list_id
 *  The ID for the list that this interest belongs to.
 * 
 * @property string $category_id
 *  The id for the interest category.
 * 
 * @property string $name
 *  The name of the interest. This can be shown publicly on a subscription form.
 * 
 * @property string $subscriber_count
 *  The number of subscribers associated with this interest.
 * 
 * @property int $display_order
 *  The display order for interests.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * @method Interest create()
 *  Create a new interest or 'group name' for a specific category.
 * 
 * @method Interest edit()
 *  Update interests or 'group names' for a specific category.
 * 
 * @method mixed all()
 *  Get a list of this category's interests.
 * 
 * @method Interest read()
 *  Get interests or 'group names' for a specific category.
 * 
 * @method mixed delete()
 *  Delete interests or group names in a specific category.
 */
class Interest extends Model {

  /**
   * @ignore
   */
  protected $path = '/lists/{list_id}/interest-categories/{interest_category_id}/interests';

  /**
   * @ignore
   */
  protected $params = [
    'interest_category_id' => 'category_id'
  ];

  /**
   * @ignore
   */
  protected $fields = [
    'id' => ['type' => 'string'],
    'list_id' => ['type' => 'string'],
    'category_id' => ['type' => 'string'],
    'name' => ['type' => 'string'],
    'subscriber_count' => ['type' => 'string'],
    'display_order' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]']
  ];

  /**
   * @ignore
   */
  protected $action = [
    'create' => [
      'method' => 'POST',
      'fields' => [
        'name' => ['reference' => 'name', 'required' => true],
        'display_order' => ['reference' => 'display_order']
      ]
    ],

    'edit' => [
      'method' => 'PATCH',
      'path' => '/{interest_id}',
      'params' => [
        'interest_id' => 'id'
      ],
      'fields' => [
        'name' => ['reference' => 'name', 'required' => true],
        'display_order' => ['reference' => 'display_order']
      ]
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => InterestListResponse::class
    ],

    'read' => [
      'method' => 'GET',
      'path' => '/{interest_id}',
      'params' => [
        'interest_id' => 'id'
      ]
    ],

    'delete' => [
      'method' => 'DELETE',
      'path' => '/{interest_id}',
      'params' => [
        'interest_id' => 'id'
      ]
    ]
  ];

}


