<?php
namespace Data;

use MailChimpTestCase;
use MailChimp\Data\Contact;

class ContactTest extends MailChimpTestCase {

  public function testCanBeCreated() {
    $this->assertInstanceOf(Contact::class, new Contact());
  }

}
