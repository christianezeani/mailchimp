<?php
namespace MailChimp\Framework\Laravel;

use MailChimp\Config;
use MailChimp\MailChimp;

use Illuminate\Support\ServiceProvider;

class MailChimpServiceProvider extends ServiceProvider {
  
  public function register() {
    $this->app->singleton(MailChimp::class, function ($app) {
      $config = new Config(env('MAILCHIMP_API_KEY'));
      return new MailChimp($config);
    });
  }
  
}

