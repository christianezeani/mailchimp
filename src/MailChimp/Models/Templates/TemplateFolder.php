<?php
namespace MailChimp\Models\Templates;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Response\TemplateFolderListResponse;


/**
 * Organize your templates using folders.
 * 
 * @property string $id
 *  A string that uniquely identifies this template folder.
 * 
 * @property string $name
 *  The name of the folder.
 * 
 * @property int $count
 *  The number of templates in the folder.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * 
 * @method Template create(array $data = [])
 *  Create a new template folder.
 * 
 * @method Template edit(array $data = [])
 *  Update a specific folder used to organize templates.
 * 
 * @method Template delete()
 *  Delete a specific template folder, and mark all the templates in the folder as 'unfiled'.
 * 
 * @method Template all(array $params = [])
 *  Get all folders used to organize templates.
 * 
 * @method Template read(array $params = [])
 *  Get information about a specific folder used to organize templates.
 */
class TemplateFolder extends Model {

  /**
   * @ignore
   */
  protected $path = '/template-folders';
  
  /**
   * @ignore
   */
  protected $fields = [
    'id' => ['type' => 'string'],
    'name' => ['type' => 'string'],
    'count' => ['type' => 'int'],
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
        'name' => ['reference' => 'name', 'required' => true]
      ]
    ],
    
    'edit' => [
      'method' => 'PATCH',
      'path' => '/{folder_id}',
      'params' => ['folder_id' => 'id'],
      'fields' => [
        'name' => ['reference' => 'name', 'required' => true]
      ]
    ],

    'delete' => [
      'method' => 'DELETE',
      'path' => '/{folder_id}',
      'params' => ['folder_id' => 'id']
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => TemplateFolderListResponse::class
    ],

    'read' => [
      'method' => 'GET',
      'path' => '/{folder_id}',
      'params' => ['folder_id' => 'id']
    ]
  ];
  
}

