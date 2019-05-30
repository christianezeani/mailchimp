<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Data\Link;

use MailChimp\Response\ActivityListResponse;


/**
 * Get recent daily, aggregated activity stats for your list. For example, view unsubscribes, signups, total emails sent, opens, clicks, and more, for up to 180 days.
 * 
 * @property string $day The date for the activity summary.
 * @property int $emails_sent The total number of emails sent on the date for the activity summary.
 * @property int $unique_opens The number of unique opens.
 * @property int $recipient_clicks The number of clicks.
 * @property int $hard_bounce The number of hard bounces.
 * @property int $soft_bounce The number of soft bounces
 * @property int $subs The number of subscribes.
 * @property int $unsubs The number of unsubscribes.
 * @property int $other_adds The number of subscribers who may have been added outside of the double opt-in process, such as imports or API activity.
 * @property int $other_removes The number of subscribers who may have been removed outside of unsubscribing or reporting an email as spam (for example, deleted subscribers).
 * @property string $list_id The unique id for the list.
 * @property int $total_items The total number of items matching the query regardless of pagination.
 * @property Link[] $_links A list of link types and descriptions for the API schema documents.
 */
class Activity extends Model {

  /**
   * @ignore
   */
  protected $path = '/lists/{list_id}/activity';

  /**
   * @ignore
   */
  protected $fields = [
    'day' => ['type' => 'string'],
    'emails_sent' => ['type' => 'int'],
    'unique_opens' => ['type' => 'int'],
    'recipient_clicks' => ['type' => 'int'],
    'hard_bounce' => ['type' => 'int'],
    'soft_bounce' => ['type' => 'int'],
    'subs' => ['type' => 'int'],
    'unsubs' => ['type' => 'int'],
    'other_adds' => ['type' => 'int'],
    'other_removes' => ['type' => 'int'],
    'list_id' => ['type' => 'string'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]'],
  ];

  /**
   * @ignore 
   */
  protected $action = [
    'get' => [
      'method' => 'GET',
      'responseType' => ActivityListResponse::class
    ]
  ];

}


