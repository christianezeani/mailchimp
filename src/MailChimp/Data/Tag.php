<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property float $id Tag ID
 * @property string $name Tag Name
 */
class Tag extends Data {

  protected $fields = [
    'id' => ['type' => 'float'],
    'name' => ['type' => 'string']
  ];

}


