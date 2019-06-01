<?php
namespace MailChimp\Data;

use MailChimp\Core\Data;


/**
 * @property string $selector
 *  A string that identifies the element selector. 
 * 
 *  #### Possible Values:
 *  * page_background
 *  * page_header
 *  * page_outer_wrapper
 *  * body_background
 *  * body_link_style
 *  * forms_buttons
 *  * forms_buttons_hovered
 *  * forms_field_label
 *  * forms_field_text
 *  * forms_required
 *  * forms_required_legend
 *  * forms_help_text
 *  * forms_errors
 *  * monkey_rewards_badge
 * 
 * @property SignupFormStyleOption[] $options
 *  A collection of options for a selector.
 */
class SignupFormStyle extends Data {

  /**
   * @ignore 
   */
  protected $fields = [
    'selector' => [
      'type' => 'string',
      'allowed' => [
        'page_background',
        'page_header',
        'page_outer_wrapper',
        'body_background',
        'body_link_style',
        'forms_buttons',
        'forms_buttons_hovered',
        'forms_field_label',
        'forms_field_text',
        'forms_required',
        'forms_required_legend',
        'forms_help_text',
        'forms_errors',
        'monkey_rewards_badge'
      ]
    ],
    'options' => ['type' => SignupFormStyleOption::class.'[]'],
  ];

}

