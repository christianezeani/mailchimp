<?php
namespace MailChimp\Models;

use MailChimp\Core\Model;

use MailChimp\Data\Contact;
use MailChimp\Data\CampaignDefaults;
use MailChimp\Data\Stats;
use MailChimp\Data\Link;


/**
* @property string $id Audience List ID
* @property string $name The name of the Audience list.
* @property \MailChimp\Data\Contact $contact Contact information displayed in campaign footers to comply with international spam laws.
* @property string $permission_reminder
* @property \MailChimp\Data\CampaignDefaults $campaign_defaults
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
* @property \MailChimp\Data\Stats $stats
* @property \MailChimp\Data\Link[] $_links
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
        'name' => ['reference' => 'name'],
        'contact' => ['reference' => 'contact'],
        'permission_reminder' => ['reference' => 'permission_reminder'],
        'use_archive_bar' => ['reference' => 'use_archive_bar'],
        'campaign_defaults' => ['reference' => 'campaign_defaults'],
        'notify_on_subscribe' => ['reference' => 'notify_on_subscribe'],
        'notify_on_unsubscribe' => ['reference' => 'notify_on_unsubscribe'],
        'email_type_option' => ['reference' => 'email_type_option'],
        'visibility' => ['reference' => 'visibility', 'default' => 'pubprv'],
        'double_optin' => ['type' => 'bool', 'required' => true, 'default' => false],
        'marketing_permissions' => ['type' => 'bool', 'required' => true, 'default' => false]
      ]
    ],
    
    'update' => [],

    'delete' => [],

    'get' => [],

    'read' => []
  ];
  
}


/*
double_optin	
Type: Boolean	
Title: Double Opt In	
Read only: false	Whether or not to require the subscriber to confirm subscription via email.

marketing_permissions	
Type: Boolean	
Title: Marketing Permissions	
Read only: false	Whether or not the list has marketing permissions (eg. GDPR) enabled.
*/