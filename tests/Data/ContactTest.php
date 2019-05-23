<?php
namespace Data;

use PHPUnit\Framework\TestCase;

use MailChimp\Data\Contact;

class ContactTest extends TestCase {

  public function testCanBeCreated() {
    $this->assertInstanceOf(Contact::class, new Contact());
  }

}
