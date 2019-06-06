<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\MergeField;
use MailChimp\Response\MergeFieldListResponse;


class MergeFieldTest extends MailChimpTestCase {

  public function testCanGetAllMergeFields() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();
    
    $mergeField = $mailChimp->model(MergeField::class, [
      'list_id' => $audience->id
    ]);

    $data = $mergeField->all();

    $this->assertInstanceOf(MergeFieldListResponse::class, $data, self::getErrorDetails($data));
  }

  public function testCanCreateMergeField() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $mergeField = $mailChimp->model(MergeField::class, [
      'list_id' => $audience->id,
      'name' => 'FAVORITEJOKE',
      'type' => 'text'
    ]);

    $data = $mergeField->create();

    $this->assertInstanceOf(MergeField::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanCreateMergeField
   */
  public function testCanReadMergeField($mergeField) {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $mergeField = $mailChimp->model(MergeField::class, [
      'list_id' => $audience->id,
      'merge_id' => $mergeField->merge_id
    ]);

    $data = $mergeField->read();

    $this->assertInstanceOf(MergeField::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanReadMergeField
   */
  public function testCanEditMergeField($mergeField) {
    $data = $mergeField->edit([
      'name' => 'FAVORITEJOKE2'
    ]);

    $this->assertInstanceOf(MergeField::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanEditMergeField
   */
  public function testCanDeleteMergeField($mergeField) {
    $data = $mergeField->delete();

    $this->assertEquals(null, $data, self::getErrorDetails($data));
  }

}
