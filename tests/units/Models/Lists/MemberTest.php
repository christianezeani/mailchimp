<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Member;

use MailChimp\Response\MemberListResponse;
use MailChimp\Response\BatchMemberResponse;


class MemberTest extends MailChimpTestCase {

  public function mailChimpInstanceProvider() {
    return [
      'MailChimp Instance' => [$this->mailChimpInstance()]
    ];
  }

  public function deleteMembersProvider() {
    $instance = $this->mailChimpInstance();
    return [
      MAILCHIMP_TEST_EMAIL => [$instance, MAILCHIMP_TEST_EMAIL],
      MAILCHIMP_TEST_EMAIL_2 => [$instance, MAILCHIMP_TEST_EMAIL_2]
    ];
  }

  public function testCanBeCreated() {
    $this->assertInstanceOf(Member::class, new Member());
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanCreateMember($mailChimp) {
    $member = $mailChimp->model(Member::class, [
      'list_id' => MAILCHIMP_LIST_ID,
      'email_address' => MAILCHIMP_TEST_EMAIL_2,
      'status' => 'subscribed'
    ]);

    $data = $member->create();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Member::class, $data);
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanEditMember($mailChimp) {
    $member = $mailChimp->model(Member::class, [
      'list_id' => MAILCHIMP_LIST_ID,
      'email_address' => MAILCHIMP_TEST_EMAIL,
      'status' => 'unsubscribed'
    ]);

    $data = $member->edit();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Member::class, $data);
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanAddOrEditMember($mailChimp) {
    $member = $mailChimp->model(Member::class, [
      'list_id' => MAILCHIMP_LIST_ID,
      'email_address' => MAILCHIMP_TEST_EMAIL_2,
      'status_if_new' => 'subscribed',
      'status' => 'unsubscribed'
    ]);

    $data = $member->addOrEdit();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Member::class, $data);
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanReadMember($mailChimp) {
    $audience = $mailChimp->model(Member::class, [
      'list_id' => MAILCHIMP_LIST_ID,
      'email_address' => MAILCHIMP_TEST_EMAIL
    ]);

    $data = $audience->read();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Member::class, $data);
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanGetAllMembers($mailChimp) {
    $audience = $mailChimp->model(Member::class, [
      'list_id' => MAILCHIMP_LIST_ID
    ]);

    $data = $audience->all();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(MemberListResponse::class, $data);
  }

  /**
   * @dataProvider deleteMembersProvider
   */
  public function testCanDeleteMember($mailChimp, $email) {
    $audience = $mailChimp->model(Member::class, [
      'list_id' => MAILCHIMP_LIST_ID,
      'email_address' => $email
    ]);

    $data = $audience->delete();

    self::checkAndPrintError($data);

    $this->assertEquals(null, $data);
  }

}
