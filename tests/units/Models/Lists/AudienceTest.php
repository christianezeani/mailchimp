<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Audience;

use MailChimp\Response\AudienceListResponse;
use MailChimp\Response\BatchMemberResponse;

class AudienceTest extends MailChimpTestCase {

  public function mailChimpInstanceProvider() {
    return [
      'MailChimp Instance' => [$this->mailChimpInstance()]
    ];
  }

  public function testCanBeCreated() {
    $this->assertInstanceOf(Audience::class, new Audience());
  }

  public function testCanReferenceProperty() {
    $audience = new Audience();

    $audience->reference($name, 'name');
    $audience->reference($name_2, 'name');

    $audience->name = 'Christian Ezeani';

    $this->assertEquals($name, $audience->name);
    $this->assertEquals($name, $name_2);
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanReadAudience($mailChimp) {
    $audience = $mailChimp->model(Audience::class, [
      'id' => MAILCHIMP_LIST_ID
    ]);

    $data = $audience->read();

    $this->assertInstanceOf(Audience::class, $data);
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanCreateAudience($mailChimp) {
    $audience = $mailChimp->model(Audience::class, [
      'name' => 'Christian Ezeani MailChimp Test ',
      'contact' => [
        'company' => 'Demo Company Inc.',
        'address1' => 'Just a demo address',
        'city' => 'Nnewi South',
        'state' => 'Anambra',
        'zip' => '23401',
        'country' => 'Nigeria',
        'phone' => '+2347000000000'
      ],
      'permission_reminder' => 'Demo permission reminder',
      'campaign_defaults' => [
        'from_name' => 'Christian Ezeani',
        'from_email' => 'christian@example.com',
        'subject' => 'Demo Subject',
        'language' => 'en'
      ],
      'email_type_option' => false,
      'visibility' => 'prv'
    ]);

    $data = $audience->create();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Audience::class, $data);
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanEditAudience($mailChimp) {
    $audience = $mailChimp->model(Audience::class, [
      'id' => MAILCHIMP_LIST_ID
    ])->read();

    $audience->merge([
      // 'name' => 'Demo Audience'
    ]);

    $data = $audience->edit();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Audience::class, $data);
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanGetAllAudienceLists($mailChimp) {
    $audience = $mailChimp->model(Audience::class);

    $data = $audience->all();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(AudienceListResponse::class, $data);
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanUpdateMembers($mailChimp) {
    $audience = $mailChimp->model(Audience::class, [
      'id' => MAILCHIMP_LIST_ID
    ]);

    $audience->update_existing = true;
    $audience->members = [
      [
        'email_address' => MAILCHIMP_TEST_EMAIL,
        'merge_fields' => ['FNAME' => 'Christian', 'LNAME' => 'Ezeani'],
        'status' => 'subscribed'
      ]
    ];

    $data = $audience->updateMembers();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(BatchMemberResponse::class, $data);
  }

}
