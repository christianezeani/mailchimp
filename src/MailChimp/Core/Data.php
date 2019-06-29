<?php
namespace MailChimp\Core;

use MailChimp\Exceptions\InvalidDataException;
use MailChimp\Exceptions\InvalidFieldReferenceException;

use MailChimp\Traits\UsesMagicFields;

use JsonSerializable;


class Data extends Core implements JsonSerializable {

  use UsesMagicFields;

  function __construct(array $data=NULL) {
    $this->initialize($data);
  }

  public function jsonSerialize() {
    return $this->getData();
  }

}
