<?php

function bei_order_views_default_views() {
  $view = new view();
  $view->name = 'my_material_orders';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'bei_order';
  $view->human_name = 'My Material Orders';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
  
  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'My Material Orders';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['access']['perm'] = 'create order entity';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '10';
  $handler->display->display_options['style_plugin'] = 'table';
  /* Header: Global: Text area */
  $handler->display->display_options['header']['area']['id'] = 'area';
  $handler->display->display_options['header']['area']['table'] = 'views';
  $handler->display->display_options['header']['area']['field'] = 'area';
  $handler->display->display_options['header']['area']['empty'] = TRUE;
  $handler->display->display_options['header']['area']['content'] = '<a href="/bei-order/add?destination=user/!1/orders" class="button alert">Create Order</a>';
  $handler->display->display_options['header']['area']['format'] = 'raw_html';
  $handler->display->display_options['header']['area']['tokenize'] = TRUE;
  /* No results behavior: Global: Text area */
  $handler->display->display_options['empty']['area']['id'] = 'area';
  $handler->display->display_options['empty']['area']['table'] = 'views';
  $handler->display->display_options['empty']['area']['field'] = 'area';
  $handler->display->display_options['empty']['area']['empty'] = TRUE;
  $handler->display->display_options['empty']['area']['content'] = 'No orders have been created.';
  $handler->display->display_options['empty']['area']['format'] = 'raw_html';
  /* Field: Bei Order: Order ID */
  $handler->display->display_options['fields']['id']['id'] = 'id';
  $handler->display->display_options['fields']['id']['table'] = 'bei_order';
  $handler->display->display_options['fields']['id']['field'] = 'id';
  /* Field: Bei Order: Created date */
  $handler->display->display_options['fields']['created']['id'] = 'created';
  $handler->display->display_options['fields']['created']['table'] = 'bei_order';
  $handler->display->display_options['fields']['created']['field'] = 'created';
  $handler->display->display_options['fields']['created']['date_format'] = 'short';
  $handler->display->display_options['fields']['created']['second_date_format'] = 'search_api_facetapi_YEAR';
  /* Field: Bei Order: Changed date */
  $handler->display->display_options['fields']['changed']['id'] = 'changed';
  $handler->display->display_options['fields']['changed']['table'] = 'bei_order';
  $handler->display->display_options['fields']['changed']['field'] = 'changed';
  $handler->display->display_options['fields']['changed']['label'] = 'Last updated';
  $handler->display->display_options['fields']['changed']['date_format'] = 'short';
  $handler->display->display_options['fields']['changed']['second_date_format'] = 'search_api_facetapi_YEAR';
  /* Field: Bei Order: Order status */
  $handler->display->display_options['fields']['status']['id'] = 'status';
  $handler->display->display_options['fields']['status']['table'] = 'bei_order';
  $handler->display->display_options['fields']['status']['field'] = 'status';
  /* Contextual filter: Bei Order: Order author */
  $handler->display->display_options['arguments']['uid_1']['id'] = 'uid_1';
  $handler->display->display_options['arguments']['uid_1']['table'] = 'bei_order';
  $handler->display->display_options['arguments']['uid_1']['field'] = 'uid';
  $handler->display->display_options['arguments']['uid_1']['default_action'] = 'default';
  $handler->display->display_options['arguments']['uid_1']['default_argument_type'] = 'current_user';
  $handler->display->display_options['arguments']['uid_1']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['uid_1']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['uid_1']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['uid_1']['specify_validation'] = TRUE;
  
  /* Display: Page */
  $handler = $view->new_display('page', 'Page', 'page');
  $handler->display->display_options['path'] = 'user/%/orders';
  
  // Add view to list of views to provide.
  $views[$view->name] = $view;
  
  // Return array of default views.
  return $views;
}