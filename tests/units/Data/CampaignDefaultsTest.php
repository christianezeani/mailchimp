<?php
namespace Data;

use MailChimpTestCase;
use MailChimp\Data\CampaignDefaults;

class CampaignDefaultsTest extends MailChimpTestCase {

  public function testCanBeCreated() {
    $this->assertInstanceOf(CampaignDefaults::class, new CampaignDefaults());
  }

}
