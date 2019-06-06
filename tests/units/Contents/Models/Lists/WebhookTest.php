<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Webhook;
use MailChimp\Response\WebhookListResponse;


class WebhookTest extends MailChimpTestCase {

  public function testCanGetAllWebhooks() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $webhook = $mailChimp->model(Webhook::class, [
      'list_id' => $audience->id
    ]);

    $data = $webhook->all();

    $this->assertInstanceOf(WebhookListResponse::class, $data, self::getErrorDetails($data));
  }

  public function testCanCreateWebhook() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $webhook = $mailChimp->model(Webhook::class, [
      'list_id' => $audience->id,
      'url' => 'https://www.demo.com/webhook',
      'events' => ['subscribe' => true]
    ]);

    $data = $webhook->create();

    $this->assertInstanceOf(Webhook::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanCreateWebhook
   */
  public function testCanReadWebhook($webhook) {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $webhook = $mailChimp->model(Webhook::class, [
      'id' => $webhook->id,
      'list_id' => $audience->id
    ]);

    $data = $webhook->read();

    $this->assertInstanceOf(Webhook::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanReadWebhook
   */
  public function testCanEditWebhook($webhook) {
    $data = $webhook->edit([
      'url' => 'https://www.demo.com/webhook/latest'
    ]);

    $this->assertInstanceOf(Webhook::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanEditWebhook
   */
  public function testCanDeleteWebhook($webhook) {
    $data = $webhook->delete();

    $this->assertEquals(NULL, $data, self::getErrorDetails($data));
  }

}
