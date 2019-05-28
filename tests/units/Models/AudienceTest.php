<?php
namespace Models;

use MailChimpTestCase;

use MailChimp\Config;
use MailChimp\MailChimp;
use MailChimp\Models\Audience;
use MailChimp\Data\Error;

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

    if ($data instanceof Error) {
      echo "ERROR: \n";
      echo "- {$data->title} \n";
      echo "- {$data->detail} \n";

      if (isset($data->errors)) {
        echo "- Error List: \n";
        print_r($data->errors);
      }
    }

    $this->assertInstanceOf(Audience::class, $data);
  }

}
