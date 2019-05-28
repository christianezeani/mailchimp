<?php

use MailChimp\Config;
use MailChimp\MailChimp;

class MailChimpTest extends MailChimpTestCase {

  public function instanceProvider() {
    return [
      'MailChimp Instance' => [$this->mailChimpInstance()]
    ];
  }

  public function audienceValidPropertyProvider() {
    $instance = $this->mailChimpInstance();
    
    return [
      'name' => [$instance, 'name', 'Christian Ezeani'],
      'contact' => [$instance, 'contact', []],
      'permission_reminder' => [$instance, 'permission_reminder', 'yes']
    ];
  }

  public function audienceInvalidPropertyProvider() {
    $instance = $this->mailChimpInstance();

    return [
      'name_1' => [$instance, 'name_1', 'Christian Ezeani'],
      'contact_1' => [$instance, 'contact_1', []],
      'permission_reminder_1' => [$instance, 'permission_reminder_1', 'yes']
    ];
  }
  

  public function testCanBeCreated() {
    $config = new Config(MAILCHIMP_API_KEY);

    $this->assertInstanceOf(
      MailChimp::class,
      new MailChimp($config)
    );
  }
  
  /**
   * @depends testCanBeCreated
   * @dataProvider instanceProvider
   */
  public function testCanReturnAudienceModel(MailChimp $instance) {
    $this->assertInstanceOf(
      \MailChimp\Models\Audience::class,
      $instance->audience()
    );
  }

  /**
   * @depends testCanBeCreated
   * @depends testCanReturnAudienceModel
   * @dataProvider audienceValidPropertyProvider
   */
  public function testReturnedAudienceModelCanSetAllowedProperty(MailChimp $instance, $property, $value) {
    $audience = $instance->audience();

    $audience->{$property} = $value;

    $this->assertTrue(isset($audience->{$property}));
  }

  /**
   * @depends testCanBeCreated
   * @depends testCanReturnAudienceModel
   * @dataProvider audienceInvalidPropertyProvider
   */
  public function testReturnedAudienceModelCannotSetUnallowedProperty(MailChimp $instance, $property, $value) {
    $audience = $instance->audience();

    $audience->{$property} = $value;

    $this->assertFalse(isset($audience->{$property}));
  }
  
}

