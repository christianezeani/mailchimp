<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\Interest;
use MailChimp\Models\Lists\InterestCategory;
use MailChimp\Response\InterestListResponse;
use MailChimp\Response\InterestCategoryListResponse;


class InterestCategoryTest extends MailChimpTestCase {

  public function testCanCreateInstance() {
    $this->assertInstanceOf(InterestCategory::class, new InterestCategory());
  }

  public function testCanCreateCategory() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $category = $mailChimp->model(InterestCategory::class, [
      'list_id' => $audience->id,
      'title' => 'Test InterestCategory',
      'type' => 'checkboxes'
    ]);

    $data = $category->create();

    $this->assertInstanceOf(InterestCategory::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanCreateCategory
   */
  public function testCanEditCategory($category) {
    if (!($category instanceof InterestCategory)) {
      $this->fail("Expected an instance of ".InterestCategory::class.".");
      return $category;
    }

    $category->title = 'Test InterestCategory Edited';

    $data = $category->edit();

    $this->assertInstanceOf(InterestCategory::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanEditCategory
   */
  public function testCanGetAllInterests($category) {
    if (!($category instanceof InterestCategory)) {
      $this->fail("Expected an instance of ".InterestCategory::class.".");
      return;
    }

    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $interest = $mailChimp->model(Interest::class, [
      'list_id' => $audience->id,
      'category_id' => $category->id
    ]);

    $data = $interest->all();

    $this->assertInstanceOf(InterestListResponse::class, $data, self::getErrorDetails($data));
  }

  /**
   * @depends testCanEditCategory
   */
  public function testCanCreateInterest($category) {
    if (!($category instanceof InterestCategory)) {
      $this->fail("Expected an instance of ".InterestCategory::class.".");
      return;
    }

    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $interest = $mailChimp->model(Interest::class, [
      'list_id' => $audience->id,
      'category_id' => $category->id,
      'name' => 'Test Interest'
    ]);

    $data = $interest->create();

    $this->assertInstanceOf(Interest::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanEditCategory
   * @depends testCanCreateInterest
   */
  public function testCanEditInterest($category, $interest) {
    if (!($category instanceof InterestCategory)) {
      $this->fail("Expected an instance of ".InterestCategory::class.".");
      return;
    }

    if (!($interest instanceof Interest)) {
      $this->fail("Expected an instance of ".Interest::class.".");
      return;
    }

    $data = $interest->edit([
      'name' => 'Test Interest (Edited)'
    ]);

    $this->assertInstanceOf(Interest::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanEditCategory
   * @depends testCanEditInterest
   */
  public function testCanReadInterest($category, $interest) {
    if (!($category instanceof InterestCategory)) {
      $this->fail("Expected an instance of ".InterestCategory::class.".");
      return;
    }

    if (!($interest instanceof Interest)) {
      $this->fail("Expected an instance of ".Interest::class.".");
      return;
    }

    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $interest = $mailChimp->model(Interest::class, [
      'id' => $interest->id,
      'list_id' => $audience->id,
      'category_id' => $category->id
    ]);

    $data = $interest->read();

    $this->assertInstanceOf(Interest::class, $data, self::getErrorDetails($data));

    return $data;
  }

  /**
   * @depends testCanEditCategory
   * @depends testCanReadInterest
   */
  public function testCanDeleteInterest($category, $interest) {
    if (!($category instanceof InterestCategory)) {
      $this->fail("Expected an instance of ".InterestCategory::class.".");
      return;
    }

    if (!($interest instanceof Interest)) {
      $this->fail("Expected an instance of ".Interest::class.".");
      return;
    }

    $data = $interest->delete();

    $this->assertEquals(NULL, $data, self::getErrorDetails($data));
  }

  /**
   * @depends testCanEditCategory
   * @depends testCanDeleteInterest
   */
  public function testCanDeleteCategory($category) {
    if (!($category instanceof InterestCategory)) {
      $this->fail("Expected an instance of ".InterestCategory::class.".");
      return $category;
    }

    $data = $category->delete();

    $this->assertEquals(null, $data, self::getErrorDetails($data));
  }

}

