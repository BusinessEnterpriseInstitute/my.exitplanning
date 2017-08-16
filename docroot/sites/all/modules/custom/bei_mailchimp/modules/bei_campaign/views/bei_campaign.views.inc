<?php

/**
 * @file
 * Providing extra functionality for the BEI Campaigns via views.
 */


/**
 * Implements hook_views_data()
 */

function bei_campaign_views_data() {

  // Group
  $data['bei_campaign']['table']['group'] = t('BEI Campaign');
  /*
  $data ['bei_campaign']['table']['base'] = array(
    'field' => 'nid',
    'help' => t('List of course progress stats'),
    'title' => t('LMS Courses in Progress'),
    'weight' => -10,
  );*/


  // Joins
  $data['bei_campaign']['table']['join'] = array(
    'node' => array(
        'left_field' => 'nid',
        'field' => 'nid',
    ),
  );

  // Fields
  $data['bei_campaign']['campaign_status'] = array(
    'title' => t('Campaign: Status'),
    'help' => t('The status of the campaign on Mailchimp.'),
    'field' => array(
      'group' => 'BEI Campaign',
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
  $data['bei_campaign']['sent_date'] = array(
    'title' => t('Campaign: Sent date'),
    'help' => t('The date the campaign was sent on Mailchimp.'),
    'field' => array(
        'group' => 'BEI Campaign',
        'handler' => 'views_handler_field_date',
        'click sortable' => TRUE,
    ),
    'argument' => array(
        'handler' => 'views_handler_argument_date',
    ),
    'filter' => array(
        'handler' => 'views_handler_filter_date',
    ),
    'sort' => array(
        'handler' => 'views_handler_sort_date',
    ),
  );
  $data['bei_campaign']['schedule_date'] = array(
    'title' => t('Campaign: Schedule date'),
    'help' => t('The date scheduled for the campaign to be sent on Mailchimp.'),
    'field' => array(
        'group' => 'BEI Campaign',
        'handler' => 'views_handler_field_date',
        'click sortable' => TRUE,
    ),
    'argument' => array(
        'handler' => 'views_handler_argument_date',
    ),
    'filter' => array(
        'handler' => 'views_handler_filter_date',
    ),
    'sort' => array(
        'handler' => 'views_handler_sort_date',
    ),
  );

  return $data;
}
