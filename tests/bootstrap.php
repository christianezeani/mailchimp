<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();

$dotenv->required([
  'MAILCHIMP_API_KEY',
  'MAILCHIMP_TEST_EMAIL'
]);

define('MAILCHIMP_API_KEY', getenv('MAILCHIMP_API_KEY'));
define('MAILCHIMP_TEST_EMAIL', getenv('MAILCHIMP_TEST_EMAIL'));

$emailPrefix = 'mailchimp.' . time();

define('MAILCHIMP_TEST_EMAIL_2', $emailPrefix.'_2@gmail.com');
define('MAILCHIMP_TEST_EMAIL_3', $emailPrefix.'_3@gmail.com');


require_once(__DIR__ . '/includes/MailChimpTestCase.php');

MailChimpTestCase::initialize();
