<?php
namespace MailChimp\Models\Lists;

use MailChimp\Core\Model;
use MailChimp\Data\Link;
use MailChimp\Response\GrowthHistoryListResponse;


/**
 * View a summary of the month-by-month growth activity for a specific list.
 * 
 * @property string $list_id
 *  The list id for the growth activity report.
 * 
 * @property string $month
 *  The month that the growth history is describing.
 * 
 * @property int $existing
 *  Existing members on the list for a specific month.
 * 
 * @property int $imports
 *  Imported members on the list for a specific month.
 * 
 * @property int $optins
 *  Newly opted-in members on the list for a specific month.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 * 
 * @method GrowthHistoryListResponse all()
 *  Get a month-by-month summary of a specific list’s growth activity.
 * 
 * @method GrowthHistory read()
 *  Get a summary of a specific list’s growth activity for a specific month and year.
 */
class GrowthHistory extends Model {

  /**
   * @ignore 
   */
  protected $path = '/lists/{list_id}/growth-history';

  /**
   * @ignore 
   */
  protected $fields = [
    'list_id' => ['type' => 'string'],
    'month' => ['type' => 'string'],
    'existing' => ['type' => 'int'],
    'imports' => ['type' => 'int'],
    'optins' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]'],
  ];

  /**
   * @ignore 
   */
  protected $action = [
    'all' => [
      'method' => 'GET',
      'responseType' => GrowthHistoryListResponse::class
    ],

    'read' => [
      'method' => 'GET',
      'path' => '/{month}'
    ],
  ];

}


