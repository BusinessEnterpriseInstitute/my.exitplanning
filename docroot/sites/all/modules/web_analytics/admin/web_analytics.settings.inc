<?php

/**
 * @file
 * Settings Page for the Web Analytics Module.
 */

/**
 * Implements hook_form().
 */
function web_analytics_settings_form($form, &$form_state) {
  $node_types = node_type_get_types();
  $vocabulary = taxonomy_get_vocabularies();

  $get_settings = variable_get('web_analytics_settings', '');
  if (!empty($get_settings)) {
    $get_settings = unserialize($get_settings);
  }

  $domain = '';
  if (isset($get_settings['settings']['domain'])) {
    $domain = $get_settings['settings']['domain'];
  }

  global $base_url;
  $accessible = $base_url;
  if (isset($get_settings['settings']['accessible'])) {
    $accessible = $get_settings['settings']['accessible'];
  }

  $enable = '';
  if (isset($get_settings['settings']['enable'])) {
    $enable = $get_settings['settings']['enable'];
  }

  $username = '';
  if (isset($get_settings['settings']['username'])) {
    $username = $get_settings['settings']['username'];
  }

  $password = '';
  if (isset($get_settings['settings']['password'])) {
    $password = $get_settings['settings']['password'];
  }

  $ajax_enable = '';
  if (isset($get_settings['settings']['use_ajax'])) {
    $ajax_enable = $get_settings['settings']['use_ajax'];
  }

  $proxy_path = '';
  if (isset($get_settings['settings']['proxy_path'])) {
    $proxy_path = $get_settings['settings']['proxy_path'];
  }

  $proxy_enable = '';
  if (isset($get_settings['settings']['proxy_enable'])) {
    $proxy_enable = $get_settings['settings']['proxy_enable'];
  }

  $form['multi_domain'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Pass the Statistics to another Domain
                          Like: Dev/Stage etc.'),
    '#collapsible'  => TRUE,
  );

  $form['multi_domain']['domain'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Domain URI'),
    '#description'   => t('Add the Domain URI only. Like: http://www.example.com'),
    '#default_value' => $domain,
    '#attributes'    => array(
      'placeholder'  => 'http://www.example.com',
    ),
  );

  $form['multi_domain']['accessible'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Accessible From'),
    '#description'   => t('Add the Domain URI only from which the multi domain
                          needs to be updated.
                          Like: http://stage-www.example.com'),
    '#default_value' => $accessible,
    '#attributes'    => array(
      'placeholder'  => 'http://stage-www.example.com',
    ),
  );

  $form['multi_domain']['enable'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Enable'),
    '#default_value' => $enable,
  );

  $form['multi_domain']['http_auth'] = array(
    '#type'        => 'fieldset',
    '#title'       => t('HTTP Auth'),
    '#description' => t('If you need to update any other Domain (Dev/Stage)
                        which may have Auth so, add your credentials here.'),
    '#collapsible' => TRUE,
    '#collapsed'   => TRUE,
  );

  $form['multi_domain']['http_auth']['username'] = array(
    '#type'          => 'textfield',
    '#title'         => t('HTTP Auth Username'),
    '#description'   => t('Add HTTP Auth username.'),
    '#default_value' => $username,
    '#size'          => 60,
    '#maxlength'     => 64,
    '#attributes'    => array(
      'placeholder'  => 'username',
    ),
  );

  $form['multi_domain']['http_auth']['password'] = array(
    '#type'          => 'password',
    '#title'         => t('HTTP Auth password'),
    '#description'   => t('Add HTTP Auth password.'),
    '#default_value' => $password,
    '#size'          => 60,
    '#maxlength'     => 64,
    '#attributes'    => array(
      'placeholder'  => 'password',
    ),
  );

  $form['ajax'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Use Ajax / Maintain Stats with Page Cache'),
    '#collapsible'  => TRUE,
  );

  $form['ajax']['use_ajax'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Enable'),
    '#default_value' => $ajax_enable,
  );

  $form['ajax']['proxy_settings'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Proxy Settings'),
    '#collapsible'  => TRUE,
    '#collapsed'   => TRUE,
  );

  $form['ajax']['proxy_settings']['proxy_path'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Enter Path for the Proxy'),
    '#description'   => t('Enter Path which needs to be called and
                         log the Stats for your site. Provided URL would
                         be created and only used with Ajax.'),
    '#default_value' => $proxy_path,
    '#size'          => 60,
    '#attributes'    => array(
      'placeholder'  => 'docs/web_analytics',
    ),
  );

  $form['ajax']['proxy_settings']['proxy_enable'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Enable'),
    '#default_value' => $proxy_enable,
  );

  $form['ajax']['proxy_settings']['note'] = array(
    '#type'   => 'markup',
    '#markup' => t('Note: Please Flush Cache to make Ajax works
                  properly with Proxy.'),
  );

  $form['web_analytics_selection'] = array(
    '#type' => 'vertical_tabs',
  );

  $form['node_types'] = array(
    '#type'        => 'fieldset',
    '#title'       => t('Content'),
    '#collapsible' => TRUE,
    '#collapsed'   => FALSE,
    '#group'       => 'web_analytics_selection',
  );

  foreach ($node_types as $row) {
    $default_value = 0;
    if (isset($get_settings['node_types'][$row->type])) {
      if ($get_settings['node_types'][$row->type] == 1) {
        $default_value = 1;
      }
    }
    $form['node_types']['node_types_' . $row->type] = array(
      '#type'          => 'checkbox',
      '#title'         => $row->name,
      '#default_value' => $default_value,
      '#group'         => 'web_analytics_selection',
    );
  }

  $form['taxonomy_types'] = array(
    '#type'        => 'fieldset',
    '#title'       => t('Taxonomies'),
    '#collapsible' => TRUE,
    '#collapsed'   => FALSE,
    '#group'       => 'web_analytics_selection',
  );

  foreach ($vocabulary as $row) {
    $default_value = 0;
    if (isset($get_settings['taxonomy_types'][$row->machine_name])) {
      if ($get_settings['taxonomy_types'][$row->machine_name] == 1) {
        $default_value = 1;
      }
    }
    $form['taxonomy_types']['taxonomy_types_' . $row->machine_name] = array(
      '#type'          => 'checkbox',
      '#title'         => $row->name,
      '#default_value' => $default_value,
      '#group'         => 'web_analytics_selection',
    );
  }

  if (module_exists('views')) {
    $views = views_get_all_views();
    $form['views'] = array(
      '#type'        => 'fieldset',
      '#title'       => t('Views'),
      '#collapsible' => TRUE,
      '#collapsed'   => FALSE,
      '#group'       => 'web_analytics_selection',
    );

    foreach ($views as $row) {
      if (isset($row->disabled) && $row->disabled == 1) {
        continue;
      }
      elseif (!isset($row->display['page'])) {
        continue;
      }
      $default_value = 0;
      if (isset($get_settings['views'][$row->name])
        && $get_settings['views'][$row->name] == 1) {
        $default_value = 1;
      }
      $form['views']['views_' . $row->name] = array(
        '#type'          => 'checkbox',
        '#title'         => $row->human_name,
        '#default_value' => $default_value,
        '#group'         => 'web_analytics_selection',
      );
    }
  }

  $form['submit_button'] = array(
    '#type'  => 'submit',
    '#value' => t('Save Settings'),
  );

  return $form;
}

/**
 * Implements hook_form_validate().
 */
function web_analytics_settings_form_validate($form, &$form_state) {
  if (isset($form_state['values']['proxy_enable'])
    && $form_state['values']['proxy_enable'] == 1) {

    if (isset($form_state['values']['proxy_path'])
      && empty($form_state['values']['proxy_path'])) {
      form_set_error('proxy_path', 'Path is required to enable proxy.');
    } elseif (isset($form_state['values']['proxy_path'])
      && empty(ltrim($form_state['values']['proxy_path'], '/'))) {
      form_set_error('proxy_path', 'Please provide the valid path to enable proxy.');
    }
  }
}

/**
 * Implements hook_form_submit().
 */
function web_analytics_settings_form_submit($form, &$form_state) {
  $node_types      = array();
  $taxonomy_types  = array();
  $views           = array();
  $apply_analytics = array();

  if (isset($form_state['values']['domain']) && !empty($form_state['values']['domain'])) {
    $apply_analytics['settings']['domain'] = $form_state['values']['domain'];
  }
  if (isset($form_state['values']['accessible']) && !empty($form_state['values']['accessible'])) {
    $apply_analytics['settings']['accessible'] = $form_state['values']['accessible'];
  }
  if (isset($form_state['values']['enable']) && !empty($form_state['values']['enable'])) {
    $apply_analytics['settings']['enable'] = $form_state['values']['enable'];
  }
  if (isset($form_state['values']) && !empty($form_state['values']['username'])) {
    $apply_analytics['settings']['username'] = $form_state['values']['username'];
  }
  if (isset($form_state['values']['password']) && !empty($form_state['values']['password'])) {
    $apply_analytics['settings']['password'] = $form_state['values']['password'];
  }
  elseif (isset($form['multi_domain']['http_auth']['password']['#default_value'])
    && !empty($form['multi_domain']['http_auth']['password']['#default_value'])) {
    $apply_analytics['settings']['password'] = $form['multi_domain']['http_auth']['password']['#default_value'];
  }

  if (isset($form_state['values']['use_ajax']) && !empty($form_state['values']['use_ajax'])) {
    $apply_analytics['settings']['use_ajax'] = $form_state['values']['use_ajax'];
  }

  if (isset($form_state['values']['proxy_path']) && !empty($form_state['values']['proxy_path'])) {
    $apply_analytics['settings']['proxy_path'] = ltrim($form_state['values']['proxy_path'], '/');
  }
  if (isset($form_state['values']['proxy_enable']) && !empty($form_state['values']['proxy_enable'])) {
    $apply_analytics['settings']['proxy_enable'] = $form_state['values']['proxy_enable'];
  }

  foreach ($form_state['values'] as $key => $value) {
    if (strpos($key, 'node_types_') !== FALSE && $value == 1) {
      $name              = str_replace('node_types_', '', $key);
      $node_types[$name] = $value;
    }
    elseif (strpos($key, 'taxonomy_types_') !== FALSE && $value == 1) {
      $name                  = str_replace('taxonomy_types_', '', $key);
      $taxonomy_types[$name] = $value;
    }
    elseif (strpos($key, 'views_') !== FALSE && $value == 1) {
      $name         = str_replace('views_', '', $key);
      $views[$name] = $value;
    }
  }

  if (!empty($node_types)) {
    $apply_analytics['node_types'] = $node_types;
  }
  if (!empty($taxonomy_types)) {
    $apply_analytics['taxonomy_types'] = $taxonomy_types;
  }
  if (!empty($views)) {
    $apply_analytics['views'] = $views;
  }
  $save_settings = serialize($apply_analytics);

  variable_set('web_analytics_settings', $save_settings);
  drupal_set_message(t('Your settings have been saved successfully'));
}
