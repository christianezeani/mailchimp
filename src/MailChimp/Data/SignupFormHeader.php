<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property string $image_url
 *  Header image URL.
 * 
 * @property string $text
 *  Header text.
 * 
 * @property string $image_width
 *  Image width, in pixels.
 * 
 * @property string $image_height
 *  Image height, in pixels.
 * 
 * @property string $image_alt
 *  Alt text for the image.
 * 
 * @property string $image_link
 *  The URL that the header image will link to.
 * 
 * @property string $image_align
 *  Image alignment.
 * 
 *  #### Possible Values:
 *  * none
 *  * left
 *  * center
 *  * right
 * 
 * @property string $image_border_width
 *  Image border width.
 * 
 * @property string $image_border_style
 *  Image border style.
 * 
 *  #### Possible Values:
 *  * none
 *  * solid
 *  * dotted
 *  * dashed
 *  * double
 *  * groove
 *  * outset
 *  * inset
 *  * ridge
 * 
 * @property string $image_border_color
 *  Image border color.
 * 
 * @property string $image_target
 *  Image link target. 
 * 
 *  #### Possible Values:
 *  * _blank
 *  * null
 */
class SignupFormHeader extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'image_url' => ['type' => 'string'],
    'text' => ['type' => 'string'],
    'image_width' => ['type' => 'string'],
    'image_height' => ['type' => 'string'],
    'image_alt' => ['type' => 'string'],
    'image_link' => ['type' => 'string'],
    'image_align' => ['type' => 'string', 'allowed' => ['none', 'left', 'center', 'right']],
    'image_border_width' => ['type' => 'string'],
    'image_border_style' => ['type' => 'string', 'allowed' => ['none', 'solid', 'dotted', 'dashed', 'double', 'groove', 'outset', 'inset', 'ridge']],
    'image_border_color' => ['type' => 'string'],
    'image_target' => ['type' => 'string', 'allowed' => ['_blank', 'null']]
  ];

}


