<?php
/**
 * Implements hook_views_data_alter().
 */
function ep_alters_views_data_alter(&$data) {
  $data['node']['title_count']['title'] = 'Title word count';
  $data['node']['title_count']['help'] = 'Count the number of words in titles.';
  $data['node']['title_count']['filter']['handler'] = 'ep_alters_handler_filter_field_count';
}
