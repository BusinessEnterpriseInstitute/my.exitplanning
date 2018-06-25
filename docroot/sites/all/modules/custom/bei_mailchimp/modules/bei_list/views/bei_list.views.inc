<?php

/**
 * @file
 * Providing extra functionality for the BEI Lists via views.
 */


/**
 * Implements hook_views_data()
 */

function bei_list_views_data() {

  // Group
  $data['bei_list']['table']['group'] = t('BEI List');

  // Joins
  $data['bei_list']['table']['join'] = array(
    'node' => array(
        'left_field' => 'nid',
        'field' => 'nid',
    ),
  );

  // Fields
  $data['bei_list']['list_id'] = array(
    'title' => t('List: Mailchimp list ID'),
    'help' => t('The List ID on Mailchimp.'),
    'field' => array(
      'group' => 'BEI List',
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'argument' => 'views_handler_argument_string',
  );

  return $data;
}
