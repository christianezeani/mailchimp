<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Client;

use MailChimp\Response\ClientListResponse;


class ClientTest extends MailChimpTestCase {

  public function mailChimpInstanceProvider() {
    return [
      'MailChimp Instance' => [$this->mailChimpInstance()]
    ];
  }

  public function testCanBeCreated() {
    $this->assertInstanceOf(Client::class, new Client());
  }

  /**
   * @dataProvider mailChimpInstanceProvider
   */
  public function testCanGetRecentClients($mailChimp) {
    $client = $mailChimp->model(Client::class, [
      'list_id' => MAILCHIMP_LIST_ID
    ]);

    $data = $client->get();

    self::checkAndPrintError($data);

    $this->assertInstanceOf(ClientListResponse::class, $data);
  }

}

