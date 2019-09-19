<?php
namespace MailChimp;

use MailChimp\Core\Core;
use MailChimp\Interfaces\MailChimpInterface;

use MailChimp\Exceptions\InvalidModelException;

use MailChimp\Core\Model;
use MailChimp\Models\Lists\Audience;
use MailChimp\Models\Templates\Template;

/**
 * MailChimp Client
 * 
 * @method Audience audience(array $data = [])
 *  A MailChimp list is a powerful and flexible tool that helps you manage your contacts. Learn how to get started with lists in Mailchimp.
 * 
 * @method Template template(array $data = [])
 *  Manage your Mailchimp templates. A template is an HTML file used to create the layout and basic design for a campaign.
 * 
 */
class MailChimp extends Core implements MailChimpInterface {

  const MODELS = [
    'audience' => Audience::class,
    'template' => Template::class
  ];

  function __construct(Config $config) {
    $this->setApi($this);

    if (!$config) {
      $config = new Config();
    }

    $this->setConfig($config);
  }

  public function model(string $name, array $data = NULL) {
    if (!is_subclass_of($name, Model::class)) {
      throw new InvalidModelException("Expected a subclass of '".Model::class."', '$name' supplied!");
    }

    return $this->own($name, $data);
  }

  public function __call($name, $arguments) {
    if (array_key_exists($name, self::MODELS)) {
      $model = self::MODELS[$name];
      return $this->model($model, ...$arguments);
    }

    throw new InvalidModelException("Model does not exist!");
  }

}

