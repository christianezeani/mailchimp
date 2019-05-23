<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property string $rel
 * @property string $href
 * @property string $method
 * @property string $targetSchema
 * @property string $schema
 */
class Link extends Data {

  protected $fields = [
    'rel' => 'string',
    'href' => 'string',
    'method' => 'string',
    'targetSchema' => 'string',
    'schema' => 'string'
  ];

}

