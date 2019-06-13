<?php
namespace MailChimp\Exceptions;

use MailChimp\Response\ErrorResponse;

class HttpException extends \Exception {

  protected $data, $code;

  function __construct(ErrorResponse $data, $code=500) {
    parent::__construct($data->detail);
    $this->data = $data;
    $this->code = $code;
  }

  public function getData() {
    return $this->data;
  }

}

