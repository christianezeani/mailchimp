<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Audience;

use MailChimp\Response\AudienceListResponse;
use MailChimp\Response\BatchMemberResponse;

class AudienceTest extends MailChimpTestCase {

  public function testCanReadAudience() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();
    
    $audience = $mailChimp->model(Audience::class, [
      'id' => $audience->id
    ]);

    $data = $audience->read();

    if ($data instanceof Audience) {
      self::$audience = $data;
    }

    $this->assertInstanceOf(Audience::class, $data);

    return $data;
  }

  /**
   * @depends testCanReadAudience
   */
  public function testCanEditAudience($audience) {
    $mailChimp = $this->mailChimpInstance();

    $audience = $mailChimp->model(Audience::class, [
      'id' => $audience->id
    ])->read();

    $audience->merge([
      'name' => 'Christian Ezeani MailChimp Test (Edited)'
    ]);

    $data = $audience->edit();

    if ($data instanceof Audience) {
      self::$audience = $data;
    }

    self::checkAndPrintError($data);

    $this->assertInstanceOf(Audience::class, $data);
  }

  public function testCanGetAllAudienceLists() {
    $mailChimp = $this->mailChimpInstance();

    $audience = $mailChimp->model(Audience::class);

    $data = $audience->all();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(AudienceListResponse::class, $data);
  }

}
