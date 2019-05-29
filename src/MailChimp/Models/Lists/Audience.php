<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;

use MailChimp\Data\Contact;
use MailChimp\Data\CampaignDefaults;
use MailChimp\Data\Stats;
use MailChimp\Data\Link;

use MailChimp\Response\AudienceListResponse;
use MailChimp\Response\BatchMemberResponse;


/**
* @property string $id Audience List ID
* @property string $name The name of the Audience list.
* @property Contact $contact Contact information displayed in campaign footers to comply with international spam laws.
* @property string $permission_reminder
* @property CampaignDefaults $campaign_defaults
* @property string $notify_on_subscribe
* @property string $notify_on_unsubscribe
* @property string $date_created
* @property int $list_rating
* @property bool $email_type_option
* @property string $subscribe_url_short
* @property string $subscribe_url_long
* @property string $beamer_address
* @property string $visibility
* @property array $modules
* @property Stats $stats
* @property Link[] $_links
*/
class Audience extends Model {

  /**
   * @ignore
   */
  protected $path = '/lists';
  
  /**
  * @ignore
  */
  protected $fields = [
    'id' => ['type' => 'string'],
    'name' => ['type' => 'string'],
    'contact' => ['type' => Contact::class],
    'permission_reminder' => ['type' => 'string'],
    'use_archive_bar' => ['type' => 'bool'],
    'campaign_defaults' => ['type' => CampaignDefaults::class],
    'notify_on_subscribe' => ['type' => 'string'],
    'notify_on_unsubscribe' => ['type' => 'string'],
    'date_created' => ['type' => 'string'],
    'list_rating' => ['type' => 'int'],
    'email_type_option' => ['type' => 'bool'],
    'subscribe_url_short' => ['type' => 'string'],
    'subscribe_url_long' => ['type' => 'string'],
    'beamer_address' => ['type' => 'string'],
    'visibility' => ['type' => 'string'],
    'modules' => ['type' => 'array'],
    'stats' => ['type' => Stats::class],
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
        'contact' => ['reference' => 'contact', 'required' => true],
        'permission_reminder' => ['reference' => 'permission_reminder', 'required' => true],
        'use_archive_bar' => ['reference' => 'use_archive_bar'],
        'campaign_defaults' => ['reference' => 'campaign_defaults', 'required' => true],
        'notify_on_subscribe' => ['reference' => 'notify_on_subscribe'],
        'notify_on_unsubscribe' => ['reference' => 'notify_on_unsubscribe'],
        'email_type_option' => ['reference' => 'email_type_option', 'required' => true],
        'visibility' => ['reference' => 'visibility', 'default' => 'prv'],
        'double_optin' => ['type' => 'bool', 'default' => false],
        'marketing_permissions' => ['type' => 'bool', 'default' => false]
      ]
    ],
    
    'edit' => [
      'method' => 'PATCH',
      'path' => '/{list_id}',
      'params' => ['list_id' => 'id'],
      'fields' => [
        'name' => ['reference' => 'name', 'required' => true],
        'contact' => ['reference' => 'contact', 'required' => true],
        'permission_reminder' => ['reference' => 'permission_reminder', 'required' => true],
        'use_archive_bar' => ['reference' => 'use_archive_bar'],
        'campaign_defaults' => ['reference' => 'campaign_defaults', 'required' => true],
        'notify_on_subscribe' => ['reference' => 'notify_on_subscribe'],
        'notify_on_unsubscribe' => ['reference' => 'notify_on_unsubscribe'],
        'email_type_option' => ['reference' => 'email_type_option', 'required' => true],
        'visibility' => ['reference' => 'visibility', 'default' => 'prv'],
        'double_optin' => ['type' => 'bool', 'default' => false],
        'marketing_permissions' => ['type' => 'bool', 'default' => false]
      ]
    ],

    'delete' => [
      'method' => 'DELETE',
      'path' => '/{list_id}',
      'params' => ['list_id' => 'id']
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => AudienceListResponse::class
    ],

    'read' => [
      'method' => 'GET',
      'path' => '/{list_id}',
      'params' => ['list_id' => 'id']
    ],

    'updateMembers' => [
      'method' => 'POST',
      'path' => '/{list_id}',
      'params' => ['list_id' => 'id'],
      'fields' => [
        'members' => ['type' => Member::class.'[]', 'required' => true],
        'update_existing' => ['type' => 'boolean']
      ],
      'responseType' => BatchMemberResponse::class
    ]
  ];
  
}


