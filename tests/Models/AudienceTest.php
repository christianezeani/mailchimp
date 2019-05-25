<?php
namespace Models;

use PHPUnit\Framework\TestCase;

use MailChimp\Models\Audience;

class AudienceTest extends TestCase {

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

}
