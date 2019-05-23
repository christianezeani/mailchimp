<?php
namespace Data;

use PHPUnit\Framework\TestCase;

use MailChimp\Data\CampaignDefaults;

class CampaignDefaultsTest extends TestCase {

  public function testCanBeCreated() {
    $this->assertInstanceOf(CampaignDefaults::class, new CampaignDefaults());
  }

}
