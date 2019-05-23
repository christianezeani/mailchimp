<?php
namespace MailChimp;

use MailChimp\Core\Core;
use MailChimp\Interfaces\MailChimpInterface;

use MailChimp\Models\Audience;

class MailChimp extends Core implements MailChimpInterface {

  function __construct(Config $config) {
    $this->setApi($this);

    if (!$config) {
      $config = new Config();
    }

    $this->setConfig($config);
  }

  public function audience(array $data = NULL): Audience {
    return $this->c(new Audience($data));
  }

}
