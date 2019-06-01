<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\SignupForm;
use MailChimp\Response\SignupFormListResponse;


class SignupFormTest extends MailChimpTestCase {

  public function testCanGetAllSignupForms() {
    $signupForm = self::$mailChimp->model(SignupForm::class, [
      'list_id' => MAILCHIMP_LIST_ID
    ]);

    $data = $signupForm->all();

    $this->assertInstanceOf(SignupFormListResponse::class, $data, self::getErrorDetails($data));
  }

  public function testCanCreateSignupForm() {
    $signupForm = self::$mailChimp->model(SignupForm::class, [
      'list_id' => MAILCHIMP_LIST_ID,
      'header' => [
        'text' => 'Demo text'
      ],
      'contents' => [
        ['section' => 'signup_message', 'value' => 'Demo signup message']
      ]
    ]);

    $data = $signupForm->create();

    $this->assertInstanceOf(SignupForm::class, $data, self::getErrorDetails($data));
  }

}
