<?php

use PHPUnit\Framework\TestCase;

use MailChimp\Config;
use MailChimp\Exceptions\InvalidKeyException;

class ConfigTest extends TestCase {

  public function validKeyProvider() {
    return [
      'xxxxxxxxxxxxxxxxxxxxx-us17' => ['xxxxxxxxxxxxxxxxxxxxx-us17']
    ];
  }

  public function invalidKeyProvider() {
    return [
      '-us17' => ['-us17'],
      'xxxxxxxxxxxxxxxxxxxxx-' => ['xxxxxxxxxxxxxxxxxxxxx-'],
      'us17' => ['us17'],
      'xxxxxxxxxxxxxxxxxxxxx' => ['xxxxxxxxxxxxxxxxxxxxx']
    ];
  }

  public function instanceProvider() {
    return [
      [new Config()]
    ];
  }


  public function testCanBeCreated() {
    $this->assertInstanceOf(Config::class, new Config());
  }

  /**
   * @depends testCanBeCreated
   * @dataProvider validKeyProvider
   */
  public function testCanAcceptKeyThatAppearsToBeValid($key) {
    $config = new Config();
    $config->setKey($key);

    $this->assertTrue(true);
  }

  /**
   * @depends testCanBeCreated
   * @dataProvider invalidKeyProvider
   */
  public function testCanNotAcceptKeyThatAppearsToBeInvalid($key) {
    $this->expectException(InvalidKeyException::class);

    $config = new Config();
    $config->setKey($key);
  }

  /**
   * @depends testCanBeCreated
   * @depends testCanAcceptKeyThatAppearsToBeValid
   * @dataProvider validKeyProvider
   */
  public function testCanReturnEndpoint($key) {
    $config = new Config();
    $config->setKey($key);

    $this->assertFalse(empty($config->endpoint()));
  }

}