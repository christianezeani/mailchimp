<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Activity;
use MailChimp\Response\ActivityListResponse;


class ActivityTest extends MailChimpTestCase {

  public function listIdProvider() {
    $instance = $this->mailChimpInstance();
    return [
      MAILCHIMP_LIST_ID => [$instance, MAILCHIMP_LIST_ID]
    ];
  }

  public function testCanBeCreated() {
    $this->assertInstanceOf(Activity::class, new Activity());
  }

  /**
   * @dataProvider listIdProvider
   */
  public function testCanGetActivities($mailChimp, $listId) {
    $activity = $mailChimp->model(Activity::class, [
      'list_id' => $listId
    ]);

    $data = $activity->get();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(ActivityListResponse::class, $data);
  }

}