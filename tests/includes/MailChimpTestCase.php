<?php

use PHPUnit\Framework\TestCase;

use MailChimp\Config;
use MailChimp\MailChimp;

class MailChimpTestCase extends TestCase {

  protected function mailChimpInstance() {
    $config = new Config(MAILCHIMP_API_KEY);
    return new MailChimp($config);
  }

}

