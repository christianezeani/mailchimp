<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Response\ClientListResponse;


/**
 * Get information about the most popular email clients for subscribers in a specific Mailchimp list.
 * 
 * @property string $client
 *  The name of the email client.
 * 
 * @property int $members
 *  The number of subscribed members who used this email client.
 * 
 * @property string $list_id
 *  The list id
 * 
 * @method ClientListResponse get()
 *  Get a list of the top email clients based on user-agent strings.
 */
class Client extends Model {

  /**
   * @ignore 
   */
  protected $path = '/lists/{list_id}/clients';

  /**
   * @ignore 
   */
  protected $fields = [
    'client' => ['type' => 'string'],
    'members' => ['type' => 'int'],
    'list_id' => ['type' => 'string']
  ];

  /**
   * @ignore 
   */
  protected $action = [
    'get' => [
      'method' => 'GET',
      'responseType' => ClientListResponse::class
    ]
  ];

}


