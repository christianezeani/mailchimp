<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\InterestCategory;
use MailChimp\Response\InterestCategoryListResponse;


class InterestCategoryTest extends MailChimpTestCase {

  public function testCanBeCreated() {
    $this->assertInstanceOf(InterestCategory::class, new InterestCategory());
  }

  public function testCanCreateCategory() {
    $category = self::$mailChimp->model(InterestCategory::class, [
      'list_id' => MAILCHIMP_LIST_ID,
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
  public function testCanDeleteCategory($category) {
    if (!($category instanceof InterestCategory)) {
      $this->fail("Expected an instance of ".InterestCategory::class.".");
      return $category;
    }

    $data = $category->delete();

    $this->assertEquals(null, $data, self::getErrorDetails($data));
  }

}

