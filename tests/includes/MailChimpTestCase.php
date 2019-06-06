<?php

use PHPUnit\Framework\TestCase;

use MailChimp\Config;
use MailChimp\MailChimp;
use MailChimp\Response\ErrorResponse;

class MailChimpTestCase extends TestCase {

  protected static $mailChimp;
  
  protected static $audience;

  public static function initialize() {
    $config = new Config(MAILCHIMP_API_KEY);
    self::$mailChimp = new MailChimp($config);
  }

  protected function mailChimpInstance() {
    return static::$mailChimp;
  }

  protected function audience() {
    return static::$audience;
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

        foreach ($data->errors as $error) {
          $message .= sprintf("---> '%s' => %s", $error['field'], $error['message']);
          $message .= "\n";
        }
      }

      $message .= "------------------------------\n\n";
    }

    return $message;
  }

  protected static function checkAndPrintError($data) {
    echo static::getErrorDetails($data);
  }

}

