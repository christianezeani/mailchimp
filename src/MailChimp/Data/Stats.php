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
    'member_count' => ['type' => 'float'],
    'unsubscribe_count' => ['type' => 'float'],
    'cleaned_count' => ['type' => 'float'],
    'member_count_since_send' => ['type' => 'float'],
    'unsubscribe_count_since_send' => ['type' => 'float'],
    'cleaned_count_since_send' => ['type' => 'float'],
    'campaign_last_sent' => ['type' => 'string'],
    'merge_field_count' => ['type' => 'int'],
    'avg_sub_rate' => ['type' => 'float'],
    'avg_unsub_rate' => ['type' => 'float'],
    'avg_open_rate' => ['type' => 'float'],
    'avg_click_rate' => ['type' => 'float'],
    'target_sub_rate' => ['type' => 'float'],
    'open_rate' => ['type' => 'float'],
    'click_rate' => ['type' => 'float'],
    'last_sub_date' => ['type' => 'string'],
    'last_unsub_date' => ['type' => 'string'],
  ];

}

