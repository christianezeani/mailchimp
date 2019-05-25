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
   * Returns an array of action fields for an action
   *
   * @param string $action
   * @return array
   */
  public function getActionFields($action);

  /**
   * Returns an ActionField object specified by `$action` and `$name`
   *
   * @param string $action Action Name
   * @param string $name Field Name
   * @return ActionField
   */
  public function getActionField($action, $name);

  /**
   * clear(): void
   * 
   * Clears the data within the model
   * 
   * @return void
   */
  public function clear();

}
