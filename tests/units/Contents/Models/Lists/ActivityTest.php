<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Activity;
use MailChimp\Response\ActivityListResponse;


class ActivityTest extends MailChimpTestCase {

  public function testCanCreateInstance() {
    $this->assertInstanceOf(Activity::class, new Activity());
  }

  public function testCanGetActivities() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $activity = $mailChimp->model(Activity::class, [
      'list_id' => $audience->id
    ]);

    $data = $activity->get();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(ActivityListResponse::class, $data);
  }

}