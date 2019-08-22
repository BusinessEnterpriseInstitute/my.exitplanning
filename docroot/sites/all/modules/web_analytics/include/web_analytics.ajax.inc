<?php

/**
 * @file
 * Add/Update Stats using AJAX Call.
 */

/**
 * Implements Custom Function named web_analytics_stats_using_ajax()`.
 */
function web_analytics_stats_using_ajax() {
  if (isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])
    && isset($_POST['type']) && !empty($_POST['type'])
    && isset($_POST['name']) && !empty($_POST['name'])) {

    $get_settings = variable_get('web_analytics_settings', '');
    if (!empty($get_settings)) {
      $get_settings = unserialize($get_settings);
    }
    else {
      return;
    }

    if ($_POST['type'] == 'node') {
      if (!isset($get_settings['node_types'][$_POST['name']])
        || $get_settings['node_types'][$_POST['name']] != 1) {
        return;
      }
    }
    elseif ($_POST['type'] == 'term') {
      if (!isset($get_settings['taxonomy_types'][$_POST['name']])
        || $get_settings['taxonomy_types'][$_POST['name']] != 1) {
        return;
      }
    }
    elseif ($_POST['type'] == 'view') {
      if (!isset($get_settings['views'][$_POST['name']])
        || $get_settings['views'][$_POST['name']] != 1) {
        return;
      }
    }

    $check_view = db_select('web_analytics', 'w')
      ->fields('w', array('total_views'))
      ->condition('id', $_POST['id'], '=')
      ->condition('type', $_POST['type'], '=')
      ->execute()
      ->fetchObject();
    if (empty($check_view)) {
      db_insert('web_analytics')
        ->fields(array(
          'id'          => $_POST['id'],
          'type'        => $_POST['type'],
          'name'        => $_POST['name'],
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
        ->condition('id', $_POST['id'], '=')
        ->condition('type', $_POST['type'], '=')
        ->execute();
    }

    if (isset($get_settings['settings']['enable'])
      && $get_settings['settings']['enable'] == 1) {

      if (isset($get_settings['settings']['domain'])
        && !empty($get_settings['settings']['domain'])) {

        global $base_url;
        if ($base_url != $get_settings['settings']['accessible']) {
          return;
        }

        if ($_POST['type'] == 'node') {
          $url = $get_settings['settings']['domain'] . '/admin/config/system/web-analytics/update-node';

          $data = array(
            'nid'         => $_POST['id'],
            'node_type'   => $_POST['name'],
            'access_from' => $base_url,
          );
        }
        elseif ($_POST['type'] == 'term') {
          $url = $get_settings['settings']['domain'] . '/admin/config/system/web-analytics/update-term';
        
          $data = array(
            'tid'         => $_POST['id'],
            'term_type'   => $_POST['name'],
            'access_from' => $base_url,
          );
        }
        elseif ($_POST['type'] == 'view') {
          $url = $get_settings['settings']['domain'] . '/admin/config/system/web-analytics/update-view';

          $data = array(
            'vid'         => $_POST['id'],
            'type'        => $_POST['name'],
            'access_from' => $base_url,
          );
        }
        else {
          return;
        }

        $ch = curl_init($url);

        if (isset($get_settings['settings']['username'])
          && isset($get_settings['settings']['password'])) {

          if (!empty($get_settings['settings']['username'])
            && !empty($get_settings['settings']['password'])) {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD,
              $get_settings['settings']['username'] . ":" . $get_settings['settings']['password']);
          }
        }

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        curl_close($ch);
      }
    }

    return;
  }
  else {
    drupal_goto('<front>');
  }
}
