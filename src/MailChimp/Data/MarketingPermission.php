<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property string $marketing_permission_id
 * @property boolean $enabled
 */
class MarketingPermission extends Data {

  protected $fields = [
    'marketing_permission_id' => ['type' => 'string'],
    'enabled' => ['type' => 'boolean']
  ];

}

