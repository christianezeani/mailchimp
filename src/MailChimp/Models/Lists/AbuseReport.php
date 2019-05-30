<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Core\HashMap;

use MailChimp\Data\Link;
use MailChimp\Response\AbuseReportListResponse;


/**
 * Abuse Report
 * 
 * Manage abuse complaints for a specific list. An abuse complaint occurs when your recipient reports an email as spam in their mail program.
 * 
 * @property float $id The id for the abuse report
 * @property string $campaign_id The campaign id for the abuse report
 * @property string $list_id The list id for the abuse report.
 * @property string $email_id The MD5 hash of the lowercase version of the list member’s email address.
 * @property string $email_address Email address for a subscriber.
 * @property HashMap $merge_fields An individual merge var and value for a member.
 * @property boolean $vip VIP status for subscriber.
 * @property string $date Date for the abuse report
 * @property Link[] $_links A list of link types and descriptions for the API schema documents.
 */
class AbuseReport extends Model {

  /**
   * @ignore
   */
  protected $path = '/lists/{list_id}/abuse-reports';

  /**
   * @ignore
   */
  protected $fields = [
    'id' => ['type' => 'float'],
    'campaign_id' => ['type' => 'string'],
    'list_id' => ['type' => 'string'],
    'email_id' => ['type' => 'string'],
    'email_address' => ['type' => 'string'],
    'merge_fields' => ['type' => HashMap::class],
    'vip' => ['type' => 'boolean'],
    'date' => ['type' => 'string'],
    '_links' => ['type' => Link::class.'[]']
  ];

  /**
   * @ignore
   */
  protected $action = [
    'all' => [
      'method' => 'GET',
      'responseType' => AbuseReportListResponse::class
    ],

    'read' => [
      'method' => 'GET',
      'path' => '/{report_id}',
      'params' => [
        'report_id' => 'id'
      ]
    ]
  ];

}


