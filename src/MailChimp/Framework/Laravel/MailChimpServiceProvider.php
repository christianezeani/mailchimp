<?php
namespace MailChimp\Framework\Laravel;

use MailChimp\Config;
use MailChimp\MailChimp;
use MailChimp\Exceptions\InvalidKeyException;

use Illuminate\Support\ServiceProvider;

class MailChimpServiceProvider extends ServiceProvider {
  
  public function register() {
    $key = env('MAILCHIMP_API_KEY');

    if (is_null($key) || empty($key)) {
      throw new InvalidKeyException('Please provide a valid API key!');
    }

    $this->app->singleton(MailChimp::class, function ($app) use ($key) {
      $config = new Config($key);
      return new MailChimp($config);
    });
  }
  
}

