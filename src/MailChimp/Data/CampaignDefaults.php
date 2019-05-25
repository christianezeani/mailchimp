<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;

/**
 * @property string $from_name Sender Name
 * @property string $from_email Sender Email
 * @property string $subject Subject
 * @property string $language Language (defaults to 'en')
 */
class CampaignDefaults extends Data {

  /**
   * @ignore
   */
  protected $fields = [
    'from_name' => ['type' => 'string'],
    'from_email' => ['type' => 'string'],
    'subject' => ['type' => 'string'],
    'language' => ['type' => 'string', 'default' => 'en']
  ];

}

