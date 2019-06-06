<?php

use MailChimp\Config;
use MailChimp\MailChimp;

class MailChimpTest extends MailChimpTestCase {

  public function testCanBeCreated() {
    $config = new Config(MAILCHIMP_API_KEY);

    $this->assertInstanceOf(
      MailChimp::class,
      new MailChimp($config)
    );
  }
  
}

