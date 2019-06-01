<?php
namespace MailChimp\Response;

use MailChimp\Core\Data;
use MailChimp\Data\Link;
use MailChimp\Data\SegmentBatchError;
use MailChimp\Models\Lists\Member;
use MailChimp\Models\Lists\Segment;


/**
 * @property Member[] $members_added
 *  An array of objects, each representing a new member that was added to the static segment.
 * 
 * @property Member[] $members_removed
 *  An array of objects, each representing an existing list member that got deleted from the static segment.
 * 
 * @property SegmentBatchError[] $errors
 *  An array of objects, each representing an array of email addresses that could not be added to 
 *  the segment or removed and an error message providing more details.
 * 
 * @property int $total_added
 *  The total number of items matching the query, irrespective of pagination.
 * 
 * @property int $total_removed
 *  The total number of items matching the query, irrespective of pagination.
 * 
 * @property int $error_count
 *  The total number of items matching the query, irrespective of pagination.
 * 
 * @property Link[] $_links
 *  A list of link types and descriptions for the API schema documents.
 */
class SegmentBatchResponse extends Data {

  protected $fields = [
    'members_added' => ['type' => Member::class.'[]'],
    'members_removed' => ['type' => Member::class.'[]'],
    'errors' => ['type' => SegmentBatchError::class.'[]'],
    'total_added' => ['type' => 'int'],
    'total_removed' => ['type' => 'int'],
    'error_count' => ['type' => 'int'],
    '_links' => ['type' => Link::class.'[]']
  ];

}
