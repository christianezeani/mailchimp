<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Member;

use MailChimp\Response\MemberListResponse;
use MailChimp\Response\BatchMemberResponse;


class MemberTest extends MailChimpTestCase {

  public function deleteMembersProvider() {
    $instance = $this->mailChimpInstance();
    return [
      MAILCHIMP_TEST_EMAIL_2 => [$instance, MAILCHIMP_TEST_EMAIL_2]
    ];
  }

  public function testCanCreateInstance() {
    $this->assertInstanceOf(Member::class, new Member());
  }

  public function testCanCreateMember() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $member = $mailChimp->model(Member::class, [
      'list_id' => $audience->id,
      'email_address' => MAILCHIMP_TEST_EMAIL_2,
      'status' => 'subscribed'
    ]);

    $data = $member->create();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Member::class, $data);

    return $data;
  }

  /**
   * @depends testCanCreateMember
   */
  public function testCanEditMember($member) {
    $data = $member->edit([
      'status' => 'unsubscribed'
    ]);

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Member::class, $data);

    return $data;
  }

  /**
   * @depends testCanEditMember
   */
  public function testCanAddOrEditMember($member) {
    $data = $member->addOrEdit([
      'status_if_new' => 'subscribed',
      'status' => 'unsubscribed'
    ]);

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Member::class, $data);

    return $data;
  }

  /**
   * @depends testCanAddOrEditMember
   */
  public function testCanReadMember($member) {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $member = $mailChimp->model(Member::class, [
      'list_id' => $audience->id,
      'email_address' => $member->email_address
    ]);

    $data = $member->read();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Member::class, $data);
  }


  public function testCanGetAllMembers() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $member = $mailChimp->model(Member::class, [
      'list_id' => $audience->id
    ]);

    $data = $member->all();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(MemberListResponse::class, $data);
  }

  /**
   * @dataProvider deleteMembersProvider
   */
  public function testCanDeleteMember($mailChimp, $email) {
    $audience = $this->audience();

    $member = $mailChimp->model(Member::class, [
      'list_id' => $audience->id,
      'email_address' => $email
    ]);

    $data = $member->delete();

    self::checkAndPrintError($data);

    $this->assertEquals(null, $data);
  }

}
