<?php

use PHPUnit\Framework\TestCase;

use MailChimp\Config;
use MailChimp\MailChimp;
use MailChimp\Data\Error;

class MailChimpTestCase extends TestCase {

  protected function mailChimpInstance() {
    $config = new Config(MAILCHIMP_API_KEY);
    return new MailChimp($config);
  }

  protected static function checkAndPrintError($data) {
    if ($data instanceof Error) {
      echo "ERROR: \n";
      echo "- {$data->title} \n";
      echo "- {$data->detail} \n";

      if (isset($data->errors)) {
        echo "- Error List: \n";
        print_r($data->errors);
      }
    }
  }

}

