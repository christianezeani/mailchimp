<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Data\SegmentOptions;
use MailChimp\Response\SegmentListResponse;
use MailChimp\Response\SegmentBatchResponse;


/**
 * Manage segments and tags for a specific Mailchimp list. A segment is a section of your list 
 * that includes only those subscribers who share specific common field information. Tags are 
 * labels you create to help organize your contacts.
 * 
 * @property int $id
 *  The unique id for the segment.
 * 
 * @property string $name
 *  The name of the segment.
 * 
 * @property int $member_count
 *  The number of active subscribers currently included in the segment.
 * 
 * @property string $type
 *  The type of segment. Static segments are now known as tags. Learn more about tags.
 * 
 *  #### Possible Values:
 *  * saved
 *  * static
 *  * fuzzy
 * 
 * @property string $created_at
 *  The date and time the segment was created in ISO 8601 format. 
 * 
 * @property string $updated_at
 *  The date and time the segment was last updated in ISO 8601 format.
 * 
 * @property SegmentOptions $options
 *  The conditions of the segment. Static segments (tags) and fuzzy segments don’t have conditions.
 * 
 * @property string $list_id
 *  The list id.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * @method Segment create()
 *  Create a new segment in a specific list.
 * 
 * @method Segment edit()
 *  Update a specific segment in a list.
 * 
 * @method mixed batch()
 *  Batch add/remove list members to static segment
 * 
 * @method SegmentListResponse all()
 *  Get information about all available segments for a specific list.
 * 
 * @method Segment read()
 *  Get information about a specific segment
 * 
 * @method mixed delete()
 *  Delete a specific segment in a list.
 */
class Segment extends Model {

  /**
   * @ignore 
   */
  protected $path = '/lists/{list_id}/segments';

  protected $params = [
    'segment_id' => 'id'
  ];

  /**
   * @ignore 
   */
  protected $fields = [
    'id' => ['type' => 'int'],
    'name' => ['type' => 'string'],
    'member_count' => ['type' => 'int'],
    'type' => ['type' => 'string', 'allowed' => ['saved', 'static', 'fuzzy']],
    'created_at' => ['type' => 'string'],
    'updated_at' => ['type' => 'string'],
    'options' => ['type' => SegmentOptions::class],
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
        'name' => ['reference' => 'name', 'required' => true],
        'static_segment' => ['type' => 'string[]'],
        'options' => ['reference' => 'options']
      ]
    ],

    'edit' => [
      'method' => 'PATCH',
      'path' => '/{segment_id}',
      'fields' => [
        'name' => ['reference' => 'name', 'required' => true],
        'static_segment' => ['type' => 'string[]'],
        'options' => ['reference' => 'options']
      ]
    ],

    'batch' => [
      'method' => 'POST',
      'path' => '/{segment_id}',
      'fields' => [
        'members_to_add' => ['type' => 'string[]'],
        'members_to_remove' => ['type' => 'string[]']
      ],
      'responseType' => SegmentBatchResponse::class
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => SegmentListResponse::class
    ],
    
    'read' => [
      'method' => 'GET',
      'path' => '/{segment_id}'
    ],
    
    'delete' => [
      'method' => 'DELETE',
      'path' => '/{segment_id}'
    ],
  ];

}


