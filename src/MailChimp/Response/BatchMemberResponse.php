<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Model\Member;

/**
 * @property \MailChimp\Model\Member[] $new_members
 * @property \MailChimp\Model\Member[] $updated_members
 * @property Member[] $errors
 * @property int $total_created
 * @property int $total_updated
 * @property int $error_count
 */
class BatchMemberResponse extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'new_members' => ['type' => Member::class.'[]'],
    'updated_members' => ['type' => Member::class.'[]'],
    'errors' => ['type' => Error::class.'[]'],
    'total_created' => ['type' => 'int'],
    'total_updated' => ['type' => 'int'],
    'error_count' => ['type' => 'int'],
  ];

}


