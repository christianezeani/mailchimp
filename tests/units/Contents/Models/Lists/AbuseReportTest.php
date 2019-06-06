<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\AbuseReport;
use MailChimp\Response\AbuseReportListResponse;


class AbuseReportTest extends MailChimpTestCase {

  public function testCanCreateInstance() {
    $this->assertInstanceOf(AbuseReport::class, new AbuseReport());
  }

  public function testCanGetAllReports() {
    $mailChimp = $this->mailChimpInstance();
    $audience = $this->audience();

    $report = $mailChimp->model(AbuseReport::class, [
      'list_id' => $audience->id
    ]);

    $data = $report->all();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(AbuseReportListResponse::class, $data);
  }

}

