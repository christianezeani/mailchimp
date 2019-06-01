<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Segment;
use MailChimp\Models\Lists\Member;
use MailChimp\Response\SegmentListResponse;
use MailChimp\Response\SegmentBatchResponse;
use MailChimp\Response\SegmentMemberListResponse;


class SegmentTest extends MailChimpTestCase {

  public function testCanGetAllSegments() {
    $segment = self::$mailChimp->model(Segment::class, [
      'list_id' => MAILCHIMP_LIST_ID
    ]);

    $data = $segment->all();

    $this->assertInstanceOf(SegmentListResponse::class, $data, self::getErrorDetails($data));
  }

  public function testCanCreateSegment() {
    $segment = self::$mailChimp->model(Segment::class, [
      'list_id' => MAILCHIMP_LIST_ID,
      'name' => 'Demo Segment',
      'static_segment' => [MAILCHIMP_TEST_EMAIL]
    ]);

    $data = $segment->create();

    $this->assertInstanceOf(Segment::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanCreateSegment
   */
  public function testCanReadSegment($segment) {
    $segment = self::$mailChimp->model(Segment::class, [
      'id' => $segment->id,
      'list_id' => $segment->list_id
    ]);

    $data = $segment->read();

    $this->assertInstanceOf(Segment::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanCreateSegment
   */
  public function testCanEditSegment($segment) {
    $segment->name = 'Demo Segment (Edited)';

    $data = $segment->edit();

    $this->assertInstanceOf(Segment::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanEditSegment
   */
  public function testCanAddOrRemoveMembers($segment) {
    $segment->members_to_remove = [MAILCHIMP_TEST_EMAIL];

    $data = $segment->batch();

    $this->assertInstanceOf(SegmentBatchResponse::class, $data, self::getErrorDetails($data));

    return $segment;
  }

  /**
   * @depends testCanAddOrRemoveMembers
   */
  public function testCanGetAllMembers($segment) {
    $data = $segment->allMembers();

    $this->assertInstanceOf(SegmentMemberListResponse::class, $data, self::getErrorDetails($data));

    return $segment;
  }

  /**
   * @depends testCanGetAllMembers
   */
  public function testCanAddMember($segment) {
    $data = $segment->addMember([
      'email_address' => MAILCHIMP_TEST_EMAIL
    ]);

    $this->assertInstanceOf(Member::class, $data, self::getErrorDetails($data));

    return $segment;
  }

  /**
   * @depends testCanAddMember
   */
  public function testCanDeleteMember($segment) {
    $data = $segment->deleteMember([
      'email_address' => MAILCHIMP_TEST_EMAIL
    ]);

    $this->assertEquals(NULL, $data, self::getErrorDetails($data));

    return $segment;
  }

  /**
   * @depends testCanDeleteMember
   */
  public function testCanDeleteSegment($segment) {
    $data = $segment->delete();
    $this->assertEquals(null, $data, self::getErrorDetails($data));
  }

}

