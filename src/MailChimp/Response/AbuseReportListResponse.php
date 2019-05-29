<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Models\Lists\AbuseReport;


/**
 * @property \MailChimp\Models\Lists\AbuseReport[] $abuse_reports
 * @property string $list_id
 * @property int $total_items
 * @property \MailChimp\Data\Link[] $_links
 */
class AbuseReportListResponse extends Data {

  protected $fields = [
    'abuse_reports' => ['type' => AbuseReport::class.'[]'],
    'list_id' => ['type' => 'string'],
    'total_items' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]'],
  ];

}


