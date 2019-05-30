<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();

$dotenv->required([
  'MAILCHIMP_LIST_ID',
  'MAILCHIMP_API_KEY',
  'MAILCHIMP_TEST_EMAIL',
  'MAILCHIMP_TEST_EMAIL_2'
]);

define('MAILCHIMP_LIST_ID', getenv('MAILCHIMP_LIST_ID'));
define('MAILCHIMP_API_KEY', getenv('MAILCHIMP_API_KEY'));

define('MAILCHIMP_TEST_EMAIL', getenv('MAILCHIMP_TEST_EMAIL'));
define('MAILCHIMP_TEST_EMAIL_2', getenv('MAILCHIMP_TEST_EMAIL_2'));


require_once(__DIR__ . '/includes/MailChimpTestCase.php');

MailChimpTestCase::initialize();
