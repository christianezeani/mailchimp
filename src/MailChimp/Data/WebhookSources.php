<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property boolean $user
 *  Whether the webhook is triggered by subscriber-initiated actions.
 * 
 * @property boolean $admin
 *  Whether the webhook is triggered by admin-initiated actions in the web interface.
 * 
 * @property boolean $api
 *  Whether the webhook is triggered by actions initiated via the API.
 */
class WebhookSources extends Data {

  protected $fields = [
    'user' => ['type' => 'boolean'],
    'admin' => ['type' => 'boolean'],
    'api' => ['type' => 'boolean']
  ];

}

