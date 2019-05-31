<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Location;
use MailChimp\Response\LocationListResponse;


class LocationTest extends MailChimpTestCase {

  public function testCanGetAllLocations() {
    $location = self::$mailChimp->model(Location::class, [
      'list_id' => MAILCHIMP_LIST_ID
    ]);

    $data = $location->all();

    $this->assertInstanceOf(LocationListResponse::class, $data, self::getErrorDetails($data));
  }

}