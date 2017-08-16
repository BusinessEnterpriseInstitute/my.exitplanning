<?php
function bei_recurly_views_default_views() {
$views = array();

/* BEGIN subscription_plans */
$view = new view();
$view->name = 'subscription_plans';
$view->description = '';
$view->tag = 'default';
$view->base_table = 'node';
$view->human_name = 'Subscription Plans';
$view->core = 7;
$view->api_version = '3.0';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Master */
$handler = $view->new_display('default', 'Master', 'default');
$handler->display->display_options['title'] = 'Subscription Plans';
$handler->display->display_options['use_more_always'] = FALSE;
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['cache']['type'] = 'none';
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['exposed_form']['type'] = 'basic';
$handler->display->display_options['pager']['type'] = 'some';
$handler->display->display_options['pager']['options']['items_per_page'] = '10';
$handler->display->display_options['style_plugin'] = 'responsive_grid';
$handler->display->display_options['style_options']['columns'] = '2';
$handler->display->display_options['row_plugin'] = 'fields';
/* Field: Wrapper Div openers */
$handler->display->display_options['fields']['nothing']['id'] = 'nothing';
$handler->display->display_options['fields']['nothing']['table'] = 'views';
$handler->display->display_options['fields']['nothing']['field'] = 'nothing';
$handler->display->display_options['fields']['nothing']['ui_name'] = 'Wrapper Div openers';
$handler->display->display_options['fields']['nothing']['label'] = '';
$handler->display->display_options['fields']['nothing']['alter']['text'] = '<div class="grid-wrap"><div class="div-wrap-inner">';
$handler->display->display_options['fields']['nothing']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['nothing']['element_default_classes'] = FALSE;
/* Field: Content: Title */
$handler->display->display_options['fields']['title']['id'] = 'title';
$handler->display->display_options['fields']['title']['table'] = 'node';
$handler->display->display_options['fields']['title']['field'] = 'title';
$handler->display->display_options['fields']['title']['label'] = '';
$handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
$handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
$handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['title']['link_to_node'] = FALSE;
$handler->display->display_options['fields']['title']['node_in_colorbox_width'] = '600';
$handler->display->display_options['fields']['title']['node_in_colorbox_height'] = '600';
$handler->display->display_options['fields']['title']['node_in_colorbox_rel'] = '';
/* Field: Content: Brief Description */
$handler->display->display_options['fields']['field_brief_description']['id'] = 'field_brief_description';
$handler->display->display_options['fields']['field_brief_description']['table'] = 'field_data_field_brief_description';
$handler->display->display_options['fields']['field_brief_description']['field'] = 'field_brief_description';
$handler->display->display_options['fields']['field_brief_description']['label'] = '';
$handler->display->display_options['fields']['field_brief_description']['element_type'] = '0';
$handler->display->display_options['fields']['field_brief_description']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_brief_description']['element_wrapper_type'] = '0';
$handler->display->display_options['fields']['field_brief_description']['element_default_classes'] = FALSE;
$handler->display->display_options['fields']['field_brief_description']['field_api_classes'] = TRUE;
/* Field: Content: Price Field */
$handler->display->display_options['fields']['field_price_field']['id'] = 'field_price_field';
$handler->display->display_options['fields']['field_price_field']['table'] = 'field_data_field_price_field';
$handler->display->display_options['fields']['field_price_field']['field'] = 'field_price_field';
$handler->display->display_options['fields']['field_price_field']['label'] = '';
$handler->display->display_options['fields']['field_price_field']['alter']['alter_text'] = TRUE;
$handler->display->display_options['fields']['field_price_field']['alter']['text'] = '<div class="field-price">Starting at <span>[field_price_field]</span></div>';
$handler->display->display_options['fields']['field_price_field']['alter']['preserve_tags'] = '<span>';
$handler->display->display_options['fields']['field_price_field']['element_type'] = '0';
$handler->display->display_options['fields']['field_price_field']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_price_field']['element_wrapper_type'] = '0';
$handler->display->display_options['fields']['field_price_field']['element_default_classes'] = FALSE;
/* Field: Content: Plan Checkout Link */
$handler->display->display_options['fields']['field_plan_checkout_link']['id'] = 'field_plan_checkout_link';
$handler->display->display_options['fields']['field_plan_checkout_link']['table'] = 'field_data_field_plan_checkout_link';
$handler->display->display_options['fields']['field_plan_checkout_link']['field'] = 'field_plan_checkout_link';
$handler->display->display_options['fields']['field_plan_checkout_link']['label'] = '';
$handler->display->display_options['fields']['field_plan_checkout_link']['element_type'] = '0';
$handler->display->display_options['fields']['field_plan_checkout_link']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['field_plan_checkout_link']['element_wrapper_type'] = '0';
$handler->display->display_options['fields']['field_plan_checkout_link']['element_default_classes'] = FALSE;
$handler->display->display_options['fields']['field_plan_checkout_link']['click_sort_column'] = 'url';
$handler->display->display_options['fields']['field_plan_checkout_link']['field_api_classes'] = TRUE;
/* Field: Content: Link */
$handler->display->display_options['fields']['view_node']['id'] = 'view_node';
$handler->display->display_options['fields']['view_node']['table'] = 'views_entity_node';
$handler->display->display_options['fields']['view_node']['field'] = 'view_node';
$handler->display->display_options['fields']['view_node']['label'] = '';
$handler->display->display_options['fields']['view_node']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['view_node']['text'] = 'Learn more about membership';
$handler->display->display_options['fields']['view_node']['node_in_colorbox_width'] = '600';
$handler->display->display_options['fields']['view_node']['node_in_colorbox_height'] = '600';
$handler->display->display_options['fields']['view_node']['node_in_colorbox_rel'] = '';
/* Field: Wrapper Div closures */
$handler->display->display_options['fields']['nothing_1']['id'] = 'nothing_1';
$handler->display->display_options['fields']['nothing_1']['table'] = 'views';
$handler->display->display_options['fields']['nothing_1']['field'] = 'nothing';
$handler->display->display_options['fields']['nothing_1']['ui_name'] = 'Wrapper Div closures';
$handler->display->display_options['fields']['nothing_1']['label'] = '';
$handler->display->display_options['fields']['nothing_1']['alter']['text'] = '</div></div>';
$handler->display->display_options['fields']['nothing_1']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['nothing_1']['element_default_classes'] = FALSE;
/* Sort criterion: Content: Post date */
$handler->display->display_options['sorts']['created']['id'] = 'created';
$handler->display->display_options['sorts']['created']['table'] = 'node';
$handler->display->display_options['sorts']['created']['field'] = 'created';
$handler->display->display_options['sorts']['created']['order'] = 'DESC';
/* Filter criterion: Content: Published */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = 1;
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* Filter criterion: Content: Type */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'subscription_plan' => 'subscription_plan',
);

/* Display: Block */
$handler = $view->new_display('block', 'Block', 'block');
$views[$view->name] = $view;  
/* END subscription_plans */
  
return $views;
}