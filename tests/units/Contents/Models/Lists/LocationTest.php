<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Location;
use MailChimp\Response\LocationListResponse;


class LocationTest extends MailChimpTestCase {

  public function testCanGetAllLocations() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $location = $mailChimp->model(Location::class, [
      'list_id' => $audience->id
    ]);

    $data = $location->all();

    $this->assertInstanceOf(LocationListResponse::class, $data, self::getErrorDetails($data));
  }

}

