<?php

/**
 * @file
 * Admin settings for commerce_tax_services.
 *
 * Copyright (C) Alexander Bischoff, adTumbler.com
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 */

/**
 * Admin settings menu callback.
 * @param $form
 * @param $form_state
 * @return mixed
 */
function form_tracking_admin_settings($form, &$form_state) {
  $form['options'] = form_tracking_admin_options();
  $form['forms'] = form_tracking_admin_forms();

  $form['#submit'][] = 'form_tracking_admin_settings_submit';

  drupal_alter('form_tracking_admin_options', $form, $form_state);

  return system_settings_form($form);
}

function form_tracking_admin_settings_submit($form, &$form_state) {
  $hook = 'form_tracking_setup';
  $info = form_tracking_form_type_info();

  foreach (form_tracking_admin_get_tracking_forms($form_state) as $form_type => $forms) {
    if (!array_key_exists($form_type, $info)) {
      continue;
    }

    $module = $info[$form_type]['module'];

    if (module_hook($module, $hook)) {
      foreach ($forms as $form_id) {
        module_invoke($module, $hook, $form_id);
      }
    }
  }
}

function form_tracking_admin_get_tracking_forms(&$form_state) {
  $forms = [];

  $info = form_tracking_form_type_info();

  foreach ($info as $form_type_id => $form_type) {
    $key = "form_tracking_enabled_forms_$form_type_id";

    $forms[$form_type_id] = [];

    if (!empty($form_state['values'][$key])) {
      foreach ($form_state['values'][$key] as $form_id => $enabled) {
        if ($enabled) {
          $forms[$form_type_id][] = $form_id;
        }
      }
    }
  }

  return $forms;
}

function form_tracking_admin_forms() {
  $forms = array(
    '#type' => 'container',
    '#prefix' => '<div id="form_tracking_forms">',
    '#suffix' => '</div>',
    '#tree' => FALSE,
  );

  $info = form_tracking_form_type_info();

  $hook = 'form_tracking_forms';

  foreach ($info as $form_type_id => $form_type_info) {
    if (!empty($form_type_info['module'])) {
      if (module_hook($form_type_info['module'], $hook)) {
        $id = "form_tracking_enabled_forms_$form_type_id";

        $forms[$id] = array(
          '#type' => 'checkboxes',
          '#title' => t('Forms of type: @name', array('@name' => $form_type_info['name'])),
          '#description' => t('Select the @name forms to enable form tracking for.', array('@name' => $form_type_info['name'])),
          '#default_value' => variable_get($id),
          '#options' => module_invoke($form_type_info['module'], $hook),
        );
      }
    }
  }

  return $forms;
}

function form_tracking_admin_options() {
  $options = array(
    '#type' => 'container',
    '#prefix' => '<div id="form_tracking_options">',
    '#suffix' => '</div>',
    '#tree' => FALSE,
  );

  $options['form_tracking_enabled'] = [
    '#type' => 'checkbox',
    '#title' => 'Enable form tracking',
    '#description' => t('Unchecking this will turn off form tracking globally.'),
    '#default_value' => variable_get('form_tracking_enabled'),
  ];

  $options['form_tracking_keys'] = form_tracking_admin_keys_options();

  return $options;
}

function form_tracking_admin_keys_options() {
  $options = [
    '#type' => 'container',
    '#prefix' => '<div id="form_tracking_key_options">',
    '#suffix' => '</div>',
    '#tree' => FALSE,
  ];

  $keys = form_tracking_data_keys();

  foreach ($keys as $key => $key_info) {
    $title = (!empty($key['title']) && $key['title'] != $key) ? "{$key['title']} ($key)" : $key;

    $options['form_tracking_key_' . $key] = [
      '#type' => 'fieldset',
      '#title' => t('Key: @name', array('@name' => $title)),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#tree' => FALSE,
    ];

    $options['form_tracking_key_' . $key]['options'] = form_tracking_admin_key_options($key, $key_info);
  }

  return $options;
}

function form_tracking_admin_key_options($key, $key_info) {
  $options = [];

  $options['form_tracking_key_visible_' . $key] = [
    '#type' => 'checkbox',
    '#title' => t('Visible'),
    '#description' => t("Check to show {$key_info['title']} in tracking information."),
    '#default_value' => $key_info['visible'],
  ];

  $hook = 'form_tracking_key_options';

  if (module_hook($key_info['module'], $hook)) {
    $options += module_invoke($key_info['module'], $hook, $key, $key_info);
  }

  return $options;
}