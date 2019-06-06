<?php
namespace Start\Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Audience;

use MailChimp\Response\AudienceListResponse;
use MailChimp\Response\BatchMemberResponse;

class AudienceTest extends MailChimpTestCase {

  public function testCanCreateAudience() {
    $mailChimp = $this->mailChimpInstance();

    $audience = $mailChimp->model(Audience::class, [
      'name' => 'Christian Ezeani MailChimp Test',
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
        'from_email' => MAILCHIMP_TEST_EMAIL,
        'subject' => 'Demo Subject',
        'language' => 'en'
      ],
      'email_type_option' => false,
      'visibility' => 'prv'
    ]);

    $data = $audience->create();

    if ($data instanceof Audience) {
      self::$audience = $data;
    }

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Audience::class, $data);
  }

  
  public function testCanUpdateMembers() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $audience = $mailChimp->model(Audience::class, [
      'id' => $audience->id
    ]);

    $data = $audience->updateMembers([
      'update_existing' => true,
      'members' => [
        [
          'email_address' => MAILCHIMP_TEST_EMAIL,
          'merge_fields' => ['FNAME' => 'Christian', 'LNAME' => 'Ezeani'],
          'status' => 'subscribed'
        ]
      ]
    ]);

    self::checkAndPrintError($data);

    $this->assertInstanceOf(BatchMemberResponse::class, $data);
  }

}
