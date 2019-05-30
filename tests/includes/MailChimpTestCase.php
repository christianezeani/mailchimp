<?php

use PHPUnit\Framework\TestCase;

use MailChimp\Config;
use MailChimp\MailChimp;
use MailChimp\Response\ErrorResponse;

class MailChimpTestCase extends TestCase {

  protected static $mailChimp;

  public static function initialize() {
    $config = new Config(MAILCHIMP_API_KEY);
    self::$mailChimp = new MailChimp($config);
  }

  protected function mailChimpInstance() {
    return self::$mailChimp;
  }

  public function mailChimpInstanceProvider() {
    return [
      'MailChimp Instance' => [$this->mailChimpInstance()]
    ];
  }

  protected static function getErrorDetails($data) {
    $message = '';

    if ($data instanceof ErrorResponse) {
      $message .= "------------------------------\n";
      $message .= "ERROR: \n";
      $message .= "- {$data->title} \n";
      $message .= "- {$data->detail} \n";

      if (isset($data->errors)) {
        $message .= "- Error List: \n";

        ob_start();
        print_r($data->errors);
        
        $message .= ob_get_clean();
        $message .= "\n";
      }

      $message .= "------------------------------\n\n";
    }

    return $message;
  }

  protected static function checkAndPrintError($data) {
    echo self::getErrorDetails($data);
  }

}

