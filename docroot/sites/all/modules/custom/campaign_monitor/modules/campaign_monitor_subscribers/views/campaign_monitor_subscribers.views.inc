<?php

/**
 * @file
 * Providing extra functionality for the campaign_monitor_subscribers module via views.
 */

/*
 * Implements hook_views_default_views().
 */
function campaign_monitor_subscribers_views_default_views() {
  $views = array();
  $view = new view();
  $view->name = 'campaign_monitor_subscribers';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'campaign_monitor_subscribers';
  $view->human_name = 'Campaign Monitor Subscribers';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
  
  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Campaign Monitor Subscribers';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '25';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['pager']['options']['quantity'] = '9';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['columns'] = array(
    'id' => 'id',
    'email' => 'email',
    'name' => 'name',
    'status' => 'status',
    'edit_url' => 'edit_url',
    'delete_url' => 'delete_url',
  );
  $handler->display->display_options['style_options']['default'] = 'email';
  $handler->display->display_options['style_options']['info'] = array(
    'id' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'email' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'name' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'status' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'edit_url' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 1,
    ),
    'delete_url' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 1,
    ),
  );
  /* No results behavior: Global: Text area */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = 'No subscribers found.';
  $handler->display->display_options['empty']['area']['format'] = 'raw_html';
  /* Field: Subscriber: Label */
  $handler->display->display_options['fields']['email']['id'] = 'email';
  $handler->display->display_options['fields']['email']['table'] = 'campaign_monitor_subscribers';
  $handler->display->display_options['fields']['email']['field'] = 'email';
  $handler->display->display_options['fields']['email']['label'] = 'E-mail Address';
  /* Field: Subscriber: Name */
  $handler->display->display_options['fields']['name']['id'] = 'name';
  $handler->display->display_options['fields']['name']['table'] = 'campaign_monitor_subscribers';
  $handler->display->display_options['fields']['name']['field'] = 'name';
  /* Field: Subscriber: Status */
  $handler->display->display_options['fields']['status']['id'] = 'status';
  $handler->display->display_options['fields']['status']['table'] = 'campaign_monitor_subscribers';
  $handler->display->display_options['fields']['status']['field'] = 'status';
  /* Field: Subscriber: Edit Link */
  $handler->display->display_options['fields']['edit_url']['id'] = 'edit_url';
  $handler->display->display_options['fields']['edit_url']['table'] = 'views_entity_cm_subscriber';
  $handler->display->display_options['fields']['edit_url']['field'] = 'edit_url';
  $handler->display->display_options['fields']['edit_url']['label'] = '';
  $handler->display->display_options['fields']['edit_url']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['edit_url']['alter']['text'] = '<i class="icon-pencil"></i>';
  $handler->display->display_options['fields']['edit_url']['element_class'] = 'icon';
  $handler->display->display_options['fields']['edit_url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['edit_url']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['edit_url']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['edit_url']['link_to_entity'] = 0;
  /* Field: Subscriber: Delete Link */
  $handler->display->display_options['fields']['delete_url']['id'] = 'delete_url';
  $handler->display->display_options['fields']['delete_url']['table'] = 'views_entity_cm_subscriber';
  $handler->display->display_options['fields']['delete_url']['field'] = 'delete_url';
  $handler->display->display_options['fields']['delete_url']['label'] = '';
  $handler->display->display_options['fields']['delete_url']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['delete_url']['alter']['text'] = '<i class="icon-remove"></i>';
  $handler->display->display_options['fields']['delete_url']['element_class'] = 'icon';
  $handler->display->display_options['fields']['delete_url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['delete_url']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['delete_url']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['delete_url']['link_to_entity'] = 0;
  /* Contextual filter: Subscriber: List */
  $handler->display->display_options['arguments']['lid']['id'] = 'lid';
  $handler->display->display_options['arguments']['lid']['table'] = 'campaign_monitor_subscribers';
  $handler->display->display_options['arguments']['lid']['field'] = 'lid';
  $handler->display->display_options['arguments']['lid']['default_action'] = 'empty';
  $handler->display->display_options['arguments']['lid']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['lid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['lid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['lid']['summary_options']['items_per_page'] = '25';

  $views['campaign_monitor_subscribers'] = $view;
  return $views;
}
