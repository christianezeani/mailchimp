<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\AbuseReport;
use MailChimp\Response\AbuseReportListResponse;


class AbuseReportTest extends MailChimpTestCase {

  public function listIdProvider() {
    $instance = $this->mailChimpInstance();
    return [
      MAILCHIMP_LIST_ID => [$instance, MAILCHIMP_LIST_ID]
    ];
  }

  public function testCanBeCreated() {
    $this->assertInstanceOf(AbuseReport::class, new AbuseReport());
  }

  /**
   * @dataProvider listIdProvider
   */
  public function testCanGetAllReports($mailChimp, $listId) {
    $report = $mailChimp->model(AbuseReport::class, [
      'list_id' => $listId
    ]);

    $data = $report->all();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(AbuseReportListResponse::class, $data);
  }

}

