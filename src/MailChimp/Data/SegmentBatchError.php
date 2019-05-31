<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * Email addresses that could not be added to the segment or removed and 
 * an error message providing more details.
 * 
 * @property string $email_addresses
 *  Email addresses added to the static segment or removed
 * 
 * @property string $error
 *  The error message indicating why the email addresses could not be added or updated.
 */
class SegmentBatchError extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'email_addresses' => ['type' => 'string[]'],
    'error' => ['type' => 'string']
  ];

}

