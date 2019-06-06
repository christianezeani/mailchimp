<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Client;

use MailChimp\Response\ClientListResponse;


class ClientTest extends MailChimpTestCase {

  public function testCanCreateInstance() {
    $this->assertInstanceOf(Client::class, new Client());
  }

  public function testCanGetRecentClients() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $client = $mailChimp->model(Client::class, [
      'list_id' => $audience->id
    ]);

    $data = $client->get();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(ClientListResponse::class, $data);
  }

}

