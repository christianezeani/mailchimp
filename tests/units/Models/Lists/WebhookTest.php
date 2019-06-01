<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Webhook;
use MailChimp\Response\WebhookListResponse;


class WebhookTest extends MailChimpTestCase {

  public function testCanGetAllWebhooks() {
    $webhook = self::$mailChimp->model(Webhook::class, [
      'list_id' => MAILCHIMP_LIST_ID
    ]);

    $data = $webhook->all();

    $this->assertInstanceOf(WebhookListResponse::class, $data, self::getErrorDetails($data));
  }

  public function testCanCreateWebhook() {
    $webhook = self::$mailChimp->model(Webhook::class, [
      'list_id' => MAILCHIMP_LIST_ID,
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
    $webhook = self::$mailChimp->model(Webhook::class, [
      'id' => $webhook->id,
      'list_id' => MAILCHIMP_LIST_ID
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
