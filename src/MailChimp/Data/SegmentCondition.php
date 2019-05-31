<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property string $condition_type
 *  The type of segment, for example: date, language, Mandrill, static, and more.
 */
class SegmentCondition extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'condition_type' => ['type' => 'string']
  ];

}

