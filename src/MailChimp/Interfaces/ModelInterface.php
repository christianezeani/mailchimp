<?php
namespace MailChimp\Interfaces;


interface ModelInterface {

  /**
   * Return API Path
   * 
   * @return string
   */
  public function getPath();

  /**
   * clear(): void
   * 
   * Clears the data within the model
   * 
   * @return void
   */
  public function clear();

}