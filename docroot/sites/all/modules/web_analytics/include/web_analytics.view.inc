<?php

/**
 * @file
 * Update Stats of View which comes from any other Domain.
 */

/**
 * Implements Custom Function named web_analytics_update_view_stats()`.
 */
function web_analytics_update_view_stats() {
  if (isset($_POST['vid']) && !empty($_POST['vid']) && is_numeric($_POST['vid'])
    && isset($_POST['type']) && !empty($_POST['type'])) {

    $get_settings = variable_get('web_analytics_settings', '');
    if (!empty($get_settings)) {
      $get_settings = unserialize($get_settings);
    }
    else {
      return;
    }

    if (!isset($_POST['access_from'])
      || $_POST['access_from'] != $get_settings['settings']['accessible']) {
      return;
    }

    if (isset($get_settings['settings']['enable'])
      && $get_settings['settings']['enable'] == 1) {

      $check_view = db_select('web_analytics', 'w')
        ->fields('w', array('total_views'))
        ->condition('id', $_POST['vid'], '=')
        ->condition('type', 'view', '=')
        ->execute()
        ->fetchObject();
      if (empty($check_view)) {
        db_insert('web_analytics')
          ->fields(array(
            'id'          => $_POST['vid'],
            'type'        => 'view',
            'name'        => $_POST['type'],
            'total_views' => 1,
            'first_view'  => time(),
            'last_view'   => time(),
          ))
          ->execute();
      }
      else {
        $update_views = $check_view->total_views + 1;
        db_update('web_analytics')
          ->fields(array(
            'total_views' => $update_views,
            'last_view'   => time(),
          ))
          ->condition('id', $_POST['vid'], '=')
          ->condition('type', 'view', '=')
          ->execute();
      }
    }
  }

  return '';
}
