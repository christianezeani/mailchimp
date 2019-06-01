<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property string $match
 *  Match type.
 * 
 *  #### Possible Values
 *  * any
 *  * all
 * 
 * @property SegmentCondition[] $conditions
 *  An array of segment conditions.
 */
class SegmentOptions extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'match' => ['type' => 'string', 'allowed' => ['any', 'all']],
    'conditions' => ['type' => SegmentCondition::class.'[]']
  ];

}

