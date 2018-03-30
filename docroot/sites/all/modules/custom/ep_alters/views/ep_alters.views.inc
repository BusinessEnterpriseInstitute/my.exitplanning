<?php
/*
 * Implements hook_views_query_alter().
 */
function ep_alters_views_query_alter(&$view, &$query) {
  if ($view->name == 'article_series') {
    global $user;
    if (isset($user->uid) && $user->uid !== 0) {
      $time_zone = date_default_timezone();
      $now = new DateTime();
      $date = DateTime::createFromFormat('U', $user->created);
      $days = $now->diff($date)->format('%a');
      foreach ($query->where as &$condition_group) {
        foreach ($condition_group['conditions'] as &$condition) {
          if ($condition['field'] == 'field_data_field_series_number.field_series_number_value') {
            $condition['value'] = $days;
          }
        }
      }
    }
  }
}
