<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property boolean $subscribe
 *  Whether the webhook is triggered when a list subscriber is added.
 * 
 * @property boolean $unsubscribe
 *  Whether the webhook is triggered when a list member unsubscribes.
 * 
 * @property boolean $profile
 *  Whether the webhook is triggered when a subscriber’s profile is updated.
 * 
 * @property boolean $cleaned
 *  Whether the webhook is triggered when a subscriber’s email address is cleaned from the list.
 * 
 * @property boolean $upemail
 *  Whether the webhook is triggered when a subscriber’s email address is changed.
 * 
 * @property boolean $campaign
 *  Whether the webhook is triggered when a campaign is sent or cancelled.
 */
class WebhookEvents extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'subscribe' => ['type' => 'boolean'],
    'unsubscribe' => ['type' => 'boolean'],
    'profile' => ['type' => 'boolean'],
    'cleaned' => ['type' => 'boolean'],
    'upemail' => ['type' => 'boolean'],
    'campaign' => ['type' => 'boolean']
  ];

}


