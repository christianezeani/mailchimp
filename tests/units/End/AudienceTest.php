<?php
namespace End\Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Audience;

use MailChimp\Response\AudienceListResponse;
use MailChimp\Response\BatchMemberResponse;

class AudienceTest extends MailChimpTestCase {

  public function testCanDeleteAudience() {
    $mailChimp = $this->mailChimpInstance();
    $audience = $this->audience();

    $data = $audience->delete();

    $this->assertEquals(NULL, $data);
  }

}
