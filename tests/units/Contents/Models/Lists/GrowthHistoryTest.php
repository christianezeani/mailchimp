<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\GrowthHistory;

use MailChimp\Response\GrowthHistoryListResponse;


class GrowthHistoryTest extends MailChimpTestCase {

  public function testCanCreateInstance() {
    $this->assertInstanceOf(GrowthHistory::class, new GrowthHistory());
  }

  public function testCanGetHistories() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $history = $mailChimp->model(GrowthHistory::class, [
      'list_id' => $audience->id
    ]);

    $data = $history->all();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(GrowthHistoryListResponse::class, $data);
  }

}

