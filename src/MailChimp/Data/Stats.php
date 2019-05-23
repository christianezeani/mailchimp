<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property float $member_count
 * @property float $unsubscribe_count
 * @property float $cleaned_count
 * @property float $member_count_since_send
 * @property float $unsubscribe_count_since_send
 * @property float $cleaned_count_since_send
 * @property string $campaign_last_sent
 * @property int $merge_field_count
 * @property float $avg_sub_rate
 * @property float $avg_unsub_rate
 * @property float $target_sub_rate
 * @property float $open_rate
 * @property float $click_rate
 * @property string $last_sub_date
 * @property string $last_unsub_date
 */
class Stats extends Data {

  protected $fields = [
    'member_count' => 'float',
    'unsubscribe_count' => 'float',
    'cleaned_count' => 'float',
    'member_count_since_send' => 'float',
    'unsubscribe_count_since_send' => 'float',
    'cleaned_count_since_send' => 'float',
    'campaign_last_sent' => 'string',
    'merge_field_count' => 'int',
    'avg_sub_rate' => 'float',
    'avg_unsub_rate' => 'float',
    'target_sub_rate' => 'float',
    'open_rate' => 'float',
    'click_rate' => 'float',
    'last_sub_date' => 'string',
    'last_unsub_date' => 'string',
  ];

}

