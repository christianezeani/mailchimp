<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Data\MergeFieldOptions;
use MailChimp\Response\MergeFieldListResponse;


/**
 * Manage merge fields (formerly merge vars) for a specific list.
 * 
 * @property int $merge_id
 *  An unchanging id for the merge field.
 * 
 * @property string $tag
 *  The tag used in Mailchimp campaigns and for the /members endpoint.
 * 
 * @property string $name
 *  The name of the merge field.
 * 
 * @property string $type
 *  The type for the merge field.
 * 
 * @property boolean $required
 *  The boolean value if the merge field is required.
 * 
 * @property string $default_value
 *  The default value for the merge field if null.
 * 
 * @property boolean $public
 *  Whether the merge field is displayed on the signup form.
 * 
 * @property int $display_order
 *  The order that the merge field displays on the list signup form.
 * 
 * @property MergeFieldOptions $options
 *  Extra options for some merge field types.
 * 
 * @property string $help_text
 *  Extra text to help the subscriber fill out the form.
 * 
 * @property string $list_id
 *  A string that identifies this merge field collections’ list.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * @method MergeField create()
 *  Add a new merge field for a specific list.
 * 
 * @method MergeField edit()
 *  Update a specific merge field in a list.
 * 
 * @method MergeFieldListResponse all()
 *  Get a list of all merge fields (formerly merge vars) for a list.
 * 
 * @method MergeField read()
 *  Get information about a specific merge field in a list.
 * 
 * @method mixed delete()
 *  Delete a specific merge field in a list.
 */
class MergeField extends Model {

  /**
   * @ignore 
   */
  protected $path = '/lists/{list_id}/merge-fields';

  /**
   * @ignore 
   */
  protected $fields = [
    'merge_id' => ['type' => 'int'],
    'tag' => ['type' => 'string'],
    'name' => ['type' => 'string'],
    'type' => ['type' => 'string', 'allowed' => ['text', 'number', 'address', 'phone', 'date', 'url', 'imageurl', 'radio', 'dropdown', 'birthday', 'zip']],
    'required' => ['type' => 'boolean'],
    'default_value' => ['type' => 'string'],
    'public' => ['type' => 'boolean'],
    'display_order' => ['type' => 'int'],
    'options' => ['type' => MergeFieldOptions::class],
    'help_text' => ['type' => 'string'],
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
        'tag' => ['reference' => 'tag'],
        'name' => ['reference' => 'name', 'required' => true],
        'type' => ['reference' => 'type', 'required' => true],
        'required' => ['reference' => 'required'],
        'default_value' => ['reference' => 'default_value'],
        'public' => ['reference' => 'public'],
        'display_order' => ['reference' => 'display_order'],
        'options' => ['reference' => 'options'],
        'help_text' => ['reference' => 'help_text']
      ]
    ],

    'edit' => [
      'method' => 'PATCH',
      'path' => '/{merge_id}',
      'fields' => [
        'tag' => ['reference' => 'tag'],
        'name' => ['reference' => 'name', 'required' => true],
        'required' => ['reference' => 'required'],
        'default_value' => ['reference' => 'default_value'],
        'public' => ['reference' => 'public'],
        'display_order' => ['reference' => 'display_order'],
        'options' => ['reference' => 'options'],
        'help_text' => ['reference' => 'help_text']
      ]
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => MergeFieldListResponse::class
    ],

    'read' => [
      'method' => 'GET',
      'path' => '/{merge_id}'
    ],

    'delete' => [
      'method' => 'DELETE',
      'path' => '/{merge_id}'
    ]
  ];

}


