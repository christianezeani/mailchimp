<?php
namespace MailChimp\Models\Templates;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Response\TemplateListResponse;


/**
 * Manage your Mailchimp templates. A template is an HTML file used to create the layout and basic design for a campaign.
 * 
 * @property string $id
 *  The individual id for the template.
 * 
 * @property string $type
 *  The type of template (user, base, or gallery).
 * 
 * @property string $name
 *  The name of the template.
 * 
 * @property bool $drag_and_drop
 *  Whether the template uses the drag and drop editor.
 * 
 * @property bool $responsive
 *  Whether the template contains media queries to make it responsive.
 * 
 * @property string $category
 *  If available, the category the template is listed in.
 * 
 * @property string $date_created
 *  The date and time the template was created in ISO 8601 format.
 * 
 * @property string $date_edited
 *  The date and time the template was edited in ISO 8601 format.
 * 
 * @property string $created_by
 *  The login name for template's creator.
 * 
 * @property string $edited_by
 *  The login name who last edited the template.
 * 
 * @property bool $active
 *  User templates are not 'deleted,' but rather marked as 'inactive.' Returns whether the template is still active.
 * 
 * @property string $folder_id
 *  The id of the folder the template is currently in.
 * 
 * @property string $thumbnail
 *  If available, the URL for a thumbnail of the template.
 * 
 * @property string $share_url
 *  The URL used for template sharing.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * 
 * @method Template create(string $data = [])
 *  Create a new template for the account. Only Classic templates are supported.
 * 
 * @method Template edit(string $data = [])
 *  Update the name, HTML, or folder_id of an existing template.
 * 
 * @method Template delete()
 *  Delete a specific template.
 * 
 * @method Template all()
 *  Get a list of an account's available templates.
 * 
 * @method Template read()
 *  Get information about a specific template.
 */
class Template extends Model {

  /**
   * @ignore
   */
  protected $path = '/templates';
  
  /**
   * @ignore
   */
  protected $fields = [
    'id' => ['type' => 'string'],
    'type' => ['type' => 'string'],
    'name' => ['type' => 'string'],
    'drag_and_drop' => ['type' => 'bool'],
    'responsive' => ['type' => 'bool'],
    'category' => ['type' => 'string'],
    'date_created' => ['type' => 'string'],
    'date_edited' => ['type' => 'string'],
    'created_by' => ['type' => 'string'],
    'edited_by' => ['type' => 'string'],
    'active' => ['type' => 'bool'],
    'folder_id' => ['type' => 'string'],
    'thumbnail' => ['type' => 'string'],
    'share_url' => ['type' => 'string'],
    '_links' => ['type' => Link::class.'[]'],
  ];
  
  /**
   * @ignore
   */
  protected $action = [
    'create' => [
      'method' => 'POST',
      'fields' => [
        'name' => ['reference' => 'name', 'required' => true],
        'folder_id' => ['reference' => 'name', 'required' => false],
        'html' => ['type' => 'string', 'required' => true]
      ]
    ],
    
    'edit' => [
      'method' => 'PATCH',
      'path' => '/{template_id}',
      'params' => ['template_id' => 'id'],
      'fields' => [
        'name' => ['reference' => 'name', 'required' => true],
        'folder_id' => ['reference' => 'name', 'required' => false],
        'html' => ['type' => 'string', 'required' => true]
      ]
    ],

    'delete' => [
      'method' => 'DELETE',
      'path' => '/{template_id}',
      'params' => ['template_id' => 'id']
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => TemplateListResponse::class
    ],

    'read' => [
      'method' => 'GET',
      'path' => '/{template_id}',
      'params' => ['template_id' => 'id']
    ]
  ];
  
}

