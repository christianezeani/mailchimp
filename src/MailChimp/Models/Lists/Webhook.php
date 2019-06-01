<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Data\WebhookEvents;
use MailChimp\Data\WebhookSources;
use MailChimp\Response\WebhookListResponse;


/**
 * Manage webhooks for a specific Mailchimp list.
 * 
 * @property string $id
 *  A string that uniquely identifies this webhook.
 * 
 * @property string $url
 *  A valid URL for the Webhook.
 * 
 * @property WebhookEvents $events
 *  The events that can trigger the webhook and whether they are enabled.
 * 
 * @property WebhookSources $sources
 *  The possible sources of any events that can trigger the webhook and whether they are enabled.
 * 
 * @property string $list_id
 *  The unique id for the list.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * @method Webhook create()
 *  Create a new webhook for a specific list.
 * 
 * @method Webhook edit()
 *  Update the settings for an existing webhook.
 * 
 * @method WebhookListResponse all()
 *  Get information about all webhooks for a specific list.
 * 
 * @method Webhook read()
 *  Get information about a specific webhook.
 * 
 * @method mixed methodName()
 * @method mixed methodName()
 */
class Webhook extends Model {

  /**
   * @ignore 
   */
  protected $path = '/lists/{list_id}/webhooks';

  /**
   * @ignore 
   */
  protected $params = [
    'webhook_id' => 'id'
  ];

  /**
   * @ignore 
   */
  protected $fields = [
    'id' => ['type' => 'string'],
    'url' => ['type' => 'string'],
    'events' => ['type' => WebhookEvents::class],
    'sources' => ['type' => WebhookSources::class],
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
        'url' => ['reference' => 'url'],
        'events' => ['reference' => 'events'],
        'sources' => ['reference' => 'sources'],
      ]
    ],

    'edit' => [
      'method' => 'PATCH',
      'path' => '/{webhook_id}',
      'fields' => [
        'url' => ['reference' => 'url'],
        'events' => ['reference' => 'events'],
        'sources' => ['reference' => 'sources'],
      ]
    ],

    'all' => [
      'method' => 'GET',
      'responseType' => WebhookListResponse::class
    ],

    'read' => [
      'method' => 'GET',
      'path' => '/{webhook_id}'
    ],

    'delete' => [
      'method' => 'DELETE',
      'path' => '/{webhook_id}'
    ],
  ];

}


