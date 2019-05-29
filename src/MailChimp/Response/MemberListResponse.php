<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Model\Member;

/**
 * @property \MailChimp\Model\Member[] $members
 * @property string $list_id
 * @property \MailChimp\Data\Link[] $_links
 * @property float $total_items
 */
class MemberListResponse extends Data {

  protected $fields = [
    'members' => ['type' => Member::class.'[]'],
    'list_id' => ['type' => 'string'],
    '_links' => ['type' => Link::class.'[]'],
    'total_items' => ['type' => 'float'],
  ];

}


