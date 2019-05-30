<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\GrowthHistory;

use MailChimp\Response\GrowthHistoryListResponse;


class GrowthHistoryTest extends MailChimpTestCase {

  public function mailChimpInstanceProvider() {
    return [
      'MailChimp Instance' => [$this->mailChimpInstance()]
    ];
  }

  public function testCanBeCreated() {
    $this->assertInstanceOf(GrowthHistory::class, new GrowthHistory());
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanGetHistories($mailChimp) {
    $history = $mailChimp->model(GrowthHistory::class, [
      'list_id' => MAILCHIMP_LIST_ID
    ]);

    $data = $history->all();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(GrowthHistoryListResponse::class, $data);
  }

}

