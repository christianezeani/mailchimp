<?php
namespace MailChimp\Framework\Laravel;

use MailChimp\Config;
use MailChimp\MailChimp;

use Illuminate\Support\ServiceProvider;

class MailChimpServiceProvider extends ServiceProvider {
  
  public function register() {
    $config = new Config(env('MAILCHIMP_API_KEY'));
    $mailChimp = new MailChimp($config);
    $this->app->instance(MailChimp::class, $mailChimp);
  }
  
}

