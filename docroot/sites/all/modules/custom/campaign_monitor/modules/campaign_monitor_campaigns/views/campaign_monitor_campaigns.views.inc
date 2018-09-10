<?php

/**
 * @file
 * Providing extra functionality for the campaign_monitor_campaigns module via views.
 */

/*
 * Implements hook_views_default_views().
 */
function campaign_monitor_campaigns_views_default_views() {
  $views = array();
  
  $view = new view();
  $view->name = 'campaign_monitor_campaigns';
  $view->description = '';
  $view->tag = 'campaign monitor';
  $view->base_table = 'campaign_monitor_campaigns';
  $view->human_name = 'Campaign Monitor Campaigns';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
  
  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'none';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['columns'] = array(
    'id' => 'id',
    'name' => 'name',
    'subject' => 'subject',
    'status' => 'status',
    'created' => 'created',
    'edit_url' => 'edit_url',
    'delete_url' => 'delete_url',
  );
  $handler->display->display_options['style_options']['default'] = 'created';
  $handler->display->display_options['style_options']['info'] = array(
    'id' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'name' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'subject' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'status' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'created' => array(
      'sortable' => 1,
      'default_sort_order' => 'desc',
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
  $handler->display->display_options['empty']['area']['content'] = 'No results found.';
  $handler->display->display_options['empty']['area']['format'] = 'raw_html';
  /* Field: Campaign: Campaign ID */
  $handler->display->display_options['fields']['id']['id'] = 'id';
  $handler->display->display_options['fields']['id']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['fields']['id']['field'] = 'id';
  /* Field: Campaign: Subject */
  $handler->display->display_options['fields']['subject']['id'] = 'subject';
  $handler->display->display_options['fields']['subject']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['fields']['subject']['field'] = 'subject';
  /* Field: Campaign: Status */
  $handler->display->display_options['fields']['status']['id'] = 'status';
  $handler->display->display_options['fields']['status']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['fields']['status']['field'] = 'status';
  /* Field: Campaign: Date created */
  $handler->display->display_options['fields']['created']['id'] = 'created';
  $handler->display->display_options['fields']['created']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['fields']['created']['field'] = 'created';
  $handler->display->display_options['fields']['created']['date_format'] = 'short';
  $handler->display->display_options['fields']['created']['second_date_format'] = 'search_api_facetapi_YEAR';
  /* Field: Campaign: Edit Link */
  $handler->display->display_options['fields']['edit_url']['id'] = 'edit_url';
  $handler->display->display_options['fields']['edit_url']['table'] = 'views_entity_cm_campaign';
  $handler->display->display_options['fields']['edit_url']['field'] = 'edit_url';
  $handler->display->display_options['fields']['edit_url']['label'] = '';
  $handler->display->display_options['fields']['edit_url']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['edit_url']['alter']['text'] = '<i class="icon-pencil"></i>';
  $handler->display->display_options['fields']['edit_url']['element_class'] = 'icon';
  $handler->display->display_options['fields']['edit_url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['edit_url']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['edit_url']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['edit_url']['link_to_entity'] = 0;
  /* Field: Campaign: Delete Link */
  $handler->display->display_options['fields']['delete_url']['id'] = 'delete_url';
  $handler->display->display_options['fields']['delete_url']['table'] = 'views_entity_cm_campaign';
  $handler->display->display_options['fields']['delete_url']['field'] = 'delete_url';
  $handler->display->display_options['fields']['delete_url']['label'] = '';
  $handler->display->display_options['fields']['delete_url']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['delete_url']['alter']['text'] = '<i class="icon-remove"></i>';
  $handler->display->display_options['fields']['delete_url']['element_class'] = 'icon';
  $handler->display->display_options['fields']['delete_url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['delete_url']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['delete_url']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['delete_url']['link_to_entity'] = 0;
  /* Field: Campaign: Send date */
  $handler->display->display_options['fields']['send_date']['id'] = 'send_date';
  $handler->display->display_options['fields']['send_date']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['fields']['send_date']['field'] = 'send_date';
  $handler->display->display_options['fields']['send_date']['date_format'] = 'short';
  $handler->display->display_options['fields']['send_date']['second_date_format'] = 'search_api_facetapi_YEAR';
  /* Field: Campaign: Send link */
  $handler->display->display_options['fields']['send_link']['id'] = 'send_link';
  $handler->display->display_options['fields']['send_link']['table'] = 'views_entity_cm_campaign';
  $handler->display->display_options['fields']['send_link']['field'] = 'send_link';
  $handler->display->display_options['fields']['send_link']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['send_link']['alter']['text'] = 'Send campaign';
  $handler->display->display_options['fields']['send_link']['hide_empty'] = TRUE;
  $handler->display->display_options['fields']['send_link']['link_to_entity'] = 0;
  /* Contextual filter: Campaign: List */
  $handler->display->display_options['arguments']['lid']['id'] = 'lid';
  $handler->display->display_options['arguments']['lid']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['arguments']['lid']['field'] = 'lid';
  $handler->display->display_options['arguments']['lid']['default_action'] = 'empty';
  $handler->display->display_options['arguments']['lid']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['lid']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['lid']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['lid']['summary_options']['items_per_page'] = '25';
  
  $views['campaign_monitor_campaigns'] = $view;
  $views['administer_campaign_monitor_campaigns'] = _campaign_monitor_campaigns_views_admin();
  return $views;
}
/**
 * Callback to create an admin view for campaigns.
 * @return $view
 */
function _campaign_monitor_campaigns_views_admin() {
  $view = new view();
  $view->name = 'administer_campaign_monitor_campaigns';
  $view->description = 'Administrative view to manage campaigns.';
  $view->tag = 'campaign monitor';
  $view->base_table = 'campaign_monitor_campaigns';
  $view->human_name = 'Administer Campaign Monitor Campaigns';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
  
  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
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
  );
  $handler->display->display_options['style_options']['default'] = '-1';
  $handler->display->display_options['style_options']['info'] = array(
    'id' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
  );
  /* No results behavior: Global: Text area */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = 'No results found.';
  $handler->display->display_options['empty']['area']['format'] = 'raw_html';
  /* Relationship: Campaign: List */
  $handler->display->display_options['relationships']['lid']['id'] = 'lid';
  $handler->display->display_options['relationships']['lid']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['relationships']['lid']['field'] = 'lid';
  /* Relationship: Campaign: User */
  $handler->display->display_options['relationships']['uid']['id'] = 'uid';
  $handler->display->display_options['relationships']['uid']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['relationships']['uid']['field'] = 'uid';
  /* Field: Campaign: Campaign ID */
  $handler->display->display_options['fields']['id']['id'] = 'id';
  $handler->display->display_options['fields']['id']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['fields']['id']['field'] = 'id';
  $handler->display->display_options['fields']['id']['exclude'] = TRUE;
  /* Field: Campaign: Rendered Campaign */
  $handler->display->display_options['fields']['rendered_entity']['id'] = 'rendered_entity';
  $handler->display->display_options['fields']['rendered_entity']['table'] = 'views_entity_cm_campaign';
  $handler->display->display_options['fields']['rendered_entity']['field'] = 'rendered_entity';
  $handler->display->display_options['fields']['rendered_entity']['label'] = 'Campaign Name';
  $handler->display->display_options['fields']['rendered_entity']['link_to_entity'] = 1;
  $handler->display->display_options['fields']['rendered_entity']['view_mode'] = 'full';
  $handler->display->display_options['fields']['rendered_entity']['bypass_access'] = 0;
  /* Field: Campaign: Subject */
  $handler->display->display_options['fields']['subject']['id'] = 'subject';
  $handler->display->display_options['fields']['subject']['table'] = 'campaign_monitor_campaigns';
  $handler->display->display_options['fields']['subject']['field'] = 'subject';
  /* Field: List: Rendered List */
  $handler->display->display_options['fields']['rendered_entity_1']['id'] = 'rendered_entity_1';
  $handler->display->display_options['fields']['rendered_entity_1']['table'] = 'views_entity_cm_list';
  $handler->display->display_options['fields']['rendered_entity_1']['field'] = 'rendered_entity';
  $handler->display->display_options['fields']['rendered_entity_1']['relationship'] = 'lid';
  $handler->display->display_options['fields']['rendered_entity_1']['label'] = 'List';
  $handler->display->display_options['fields']['rendered_entity_1']['link_to_entity'] = 1;
  $handler->display->display_options['fields']['rendered_entity_1']['view_mode'] = 'full';
  $handler->display->display_options['fields']['rendered_entity_1']['bypass_access'] = 0;
  /* Field: User: Name */
  $handler->display->display_options['fields']['name']['id'] = 'name';
  $handler->display->display_options['fields']['name']['table'] = 'users';
  $handler->display->display_options['fields']['name']['field'] = 'name';
  $handler->display->display_options['fields']['name']['relationship'] = 'uid';
  $handler->display->display_options['fields']['name']['label'] = 'Author';
  /* Field: Campaign: Preview Link */
  $handler->display->display_options['fields']['preview_url']['id'] = 'preview_url';
  $handler->display->display_options['fields']['preview_url']['table'] = 'views_entity_cm_campaign';
  $handler->display->display_options['fields']['preview_url']['field'] = 'preview_url';
  $handler->display->display_options['fields']['preview_url']['label'] = '';
  $handler->display->display_options['fields']['preview_url']['exclude'] = TRUE;
  $handler->display->display_options['fields']['preview_url']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['preview_url']['alter']['text'] = 'Preview';
  $handler->display->display_options['fields']['preview_url']['alter']['make_link'] = TRUE;
  $handler->display->display_options['fields']['preview_url']['alter']['path'] = '[preview_url]';
  $handler->display->display_options['fields']['preview_url']['alter']['target'] = '_blank';
  $handler->display->display_options['fields']['preview_url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['preview_url']['link_to_entity'] = 0;
  /* Field: Campaign: Edit Link */
  $handler->display->display_options['fields']['edit_url']['id'] = 'edit_url';
  $handler->display->display_options['fields']['edit_url']['table'] = 'views_entity_cm_campaign';
  $handler->display->display_options['fields']['edit_url']['field'] = 'edit_url';
  $handler->display->display_options['fields']['edit_url']['label'] = '';
  $handler->display->display_options['fields']['edit_url']['exclude'] = TRUE;
  $handler->display->display_options['fields']['edit_url']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['edit_url']['alter']['text'] = 'Edit';
  $handler->display->display_options['fields']['edit_url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['edit_url']['link_to_entity'] = 0;
  /* Field: Global: Dropdown links */
  $handler->display->display_options['fields']['ctools_dropdown']['id'] = 'ctools_dropdown';
  $handler->display->display_options['fields']['ctools_dropdown']['table'] = 'views';
  $handler->display->display_options['fields']['ctools_dropdown']['field'] = 'ctools_dropdown';
  $handler->display->display_options['fields']['ctools_dropdown']['label'] = 'Operations';
  $handler->display->display_options['fields']['ctools_dropdown']['fields'] = array(
    'preview_url' => 'preview_url',
    'edit_url' => 'edit_url',
  );
  $handler->display->display_options['fields']['ctools_dropdown']['check_access'] = 0;
  /* Filter criterion: List: Label */
  $handler->display->display_options['filters']['title']['id'] = 'title';
  $handler->display->display_options['filters']['title']['table'] = 'campaign_monitor_lists';
  $handler->display->display_options['filters']['title']['field'] = 'title';
  $handler->display->display_options['filters']['title']['relationship'] = 'lid';
  $handler->display->display_options['filters']['title']['operator'] = 'contains';
  $handler->display->display_options['filters']['title']['exposed'] = TRUE;
  $handler->display->display_options['filters']['title']['expose']['operator_id'] = 'title_op';
  $handler->display->display_options['filters']['title']['expose']['label'] = 'List';
  $handler->display->display_options['filters']['title']['expose']['description'] = 'Search by name of list.';
  $handler->display->display_options['filters']['title']['expose']['operator'] = 'title_op';
  $handler->display->display_options['filters']['title']['expose']['identifier'] = 'list';
  $handler->display->display_options['filters']['title']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    18 => 0,
    9 => 0,
    7 => 0,
    16 => 0,
    8 => 0,
    17 => 0,
    6 => 0,
    15 => 0,
    5 => 0,
    11 => 0,
    14 => 0,
    12 => 0,
    3 => 0,
  );
  /* Filter criterion: User: Name */
  $handler->display->display_options['filters']['uid']['id'] = 'uid';
  $handler->display->display_options['filters']['uid']['table'] = 'users';
  $handler->display->display_options['filters']['uid']['field'] = 'uid';
  $handler->display->display_options['filters']['uid']['relationship'] = 'uid';
  $handler->display->display_options['filters']['uid']['value'] = '';
  $handler->display->display_options['filters']['uid']['exposed'] = TRUE;
  $handler->display->display_options['filters']['uid']['expose']['operator_id'] = 'uid_op';
  $handler->display->display_options['filters']['uid']['expose']['label'] = 'Author';
  $handler->display->display_options['filters']['uid']['expose']['operator'] = 'uid_op';
  $handler->display->display_options['filters']['uid']['expose']['identifier'] = 'uid';
  $handler->display->display_options['filters']['uid']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    18 => 0,
    9 => 0,
    7 => 0,
    16 => 0,
    8 => 0,
    17 => 0,
    6 => 0,
    15 => 0,
    5 => 0,
    11 => 0,
    14 => 0,
    12 => 0,
    3 => 0,
  );
  
  /* Display: System */
  $handler = $view->new_display('system', 'System', 'system_1');
  $handler->display->display_options['defaults']['access'] = FALSE;
  $handler->display->display_options['path'] = 'admin/campaign-monitor/campaigns';
  return $view;
}
