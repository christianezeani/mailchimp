<?php
namespace MailChimp;

use MailChimp\Interfaces\ConfigInterface;
use MailChimp\Exceptions\InvalidKeyException;

class Config implements ConfigInterface {

  private $_resource = 'https://<dc>.api.mailchimp.com/3.0';
  private $_endpoint;
  private $_key;
  
  function __construct($key = NULL) {
    if (!empty($key)) $this->setKey($key);
  }

  public function endpoint(string $path = NULL): string {
    return $this->_endpoint;
  }

  public function setKey($key) {
    @list($misc, $dc) = explode('-', $key);

    if (empty($misc) || empty($dc)) {
      throw new InvalidKeyException('Invalid API Key Supplied!');
    }

    $this->_endpoint = str_replace('<dc>', $dc, $this->_resource);
    $this->_key = $key;
  }

  public function getKey(): string {
    return $this->_key;
  }

}
