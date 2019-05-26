<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();

$dotenv->required([
  'MAILCHIMP_LIST_ID',
  'MAILCHIMP_API_KEY'
]);

define('MAILCHIMP_LIST_ID', getenv('MAILCHIMP_LIST_ID'));
define('MAILCHIMP_API_KEY', getenv('MAILCHIMP_API_KEY'));
