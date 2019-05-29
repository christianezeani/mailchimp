<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;

use MailChimp\Data\Link;
use MailChimp\Response\AbuseReportListResponse;


/**
 * @property float $id
 * @property string $campaign_id
 * @property string $list_id
 * @property string $email_id
 * @property string $email_address
 * @property string $date
 * @property \MailChimp\Data\Link[] $links
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
    'date' => ['type' => 'string'],
    'links' => ['type' => Link::class.'[]']
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


