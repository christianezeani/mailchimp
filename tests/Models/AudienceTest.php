<?php
namespace Models;

use PHPUnit\Framework\TestCase;

use MailChimp\Models\Audience;

class AudienceTest extends TestCase {

  public function testCanBeCreated() {
    $this->assertInstanceOf(Audience::class, new Audience());
  }

}
