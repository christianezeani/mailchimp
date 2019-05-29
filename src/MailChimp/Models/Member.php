<?php
namespace MailChimp\Models;

use MailChimp\Core\Model;
use MailChimp\Core\HashMap;

use MailChimp\Data\Tag;
use MailChimp\Data\Stats;
use MailChimp\Data\Location;
use MailChimp\Data\Link;
use MailChimp\Data\MarketingPermission;

use MailChimp\Response\MemberListResponse;


class Member extends Model {

  /**
   * @ignore
   */
  protected $path = '/lists/{list_id}/members';

  /**
  * @ignore
  */
  protected $fields = [
    'id' => ['type' => 'string'],
    'email_address' => ['type' => 'string'],
    'unique_email_id' => ['type' => 'string'],
    'email_type' => ['type' => 'string'],
    'status' => ['type' => 'string', 'allowed' => ['subscribed', 'unsubscribed', 'cleaned', 'pending']],
    'status_if_new' => ['type' => 'string'],
    'merge_fields' => ['type' => HashMap::class],
    'interests' => ['type' => HashMap::class],
    'stats' => ['type' => Stats::class],
    'ip_signup' => ['type' => 'string'],
    'timestamp_signup' => ['type' => 'string'],
    'ip_opt' => ['type' => 'string'],
    'timestamp_opt' => ['type' => 'string'],
    'member_rating' => ['type' => 'int'],
    'last_changed' => ['type' => 'string'],
    'language' => ['type' => 'string'],
    'vip' => ['type' => 'boolean'],
    'email_client' => ['type' => 'string'],
    'location' => ['type' => Location::class],
    'tags_count' => ['type' => 'int'],
    'tags' => ['type' => Tag::class.'[]'],
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
        'email_address' => ['reference' => 'email_address', 'required' => true],
        'email_type' => ['reference' => 'email_type'],
        'status' => ['reference' => 'status', 'required' => true],
        'merge_fields' => ['reference' => 'merge_fields'],
        'interests' => ['reference' => 'interests'],
        'language' => ['reference' => 'language'],
        'vip' => ['reference' => 'vip'],
        'location' => ['reference' => 'location'],
        'marketing_permissions' => ['type' => MarketingPermission::class.'[]'],
        'ip_signup' => ['reference' => 'ip_signup'],
        'timestamp_signup' => ['reference' => 'timestamp_signup'],
        'ip_opt' => ['reference' => 'ip_opt'],
        'tags' => ['reference' => 'tags']
      ]
    ],

    'edit' => [
      'method' => 'PATCH',
      'fields' => []
    ],

    'delete' => [
      'method' => 'POST',
      'path' => '/{subscriber_hash}/actions/delete-permanent',
      'params' => [
        'subscriber_hash' => 'subscriber_hash()'
      ]
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => MemberListResponse::class
    ],
    
    'read' => [
      'method' => 'GET',
      'path' => '/{subscriber_hash}',
      'params' => [
        'subscriber_hash' => 'subscriber_hash()'
      ]
    ]
  ];

  protected function subscriber_hash() {
    $email = strtolower($this->email_address);
    return hash('md5', $email);
  }

}



/*

*/

