<?php
namespace Models\Lists;

use MailChimpTestCase;

use MailChimp\Models\Lists\SignupForm;
use MailChimp\Response\SignupFormListResponse;


class SignupFormTest extends MailChimpTestCase {

  public function testCanGetAllSignupForms() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $signupForm = $mailChimp->model(SignupForm::class, [
      'list_id' => $audience->id
    ]);

    $data = $signupForm->all();

    $this->assertInstanceOf(SignupFormListResponse::class, $data, self::getErrorDetails($data));
  }

  public function testCanCreateSignupForm() {
    $audience = $this->audience();
    $mailChimp = $this->mailChimpInstance();

    $signupForm = $mailChimp->model(SignupForm::class, [
      'list_id' => $audience->id,
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
