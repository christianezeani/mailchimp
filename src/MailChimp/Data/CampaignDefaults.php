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
    'from_name' => ['type' => 'string', 'required' => true],
    'from_email' => ['type' => 'string', 'required' => true],
    'subject' => ['type' => 'string', 'required' => true],
    'language' => ['type' => 'string', 'required' => true, 'default' => 'en']
  ];

}

