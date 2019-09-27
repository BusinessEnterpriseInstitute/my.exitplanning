<?php

/**
 * @file
 * Hubspot Backup Admin Include.
 */

/**
 * Admin settings form.
 */
function hubspot_backup_admin_settings($form, &$form_state) {
  $form = [];

  $backup_entities = variable_get('hubspot_backup_entities', array());
  $selected = array();
  foreach ($backup_entities as $backup_entity) {
    if ($backup_entity) {
      $selected[] = $backup_entity;
    }
  }

  $form['hubspot_backup_entities'] = [
    '#type' => 'checkboxes',
    '#title' => t('What would you like to backup?'),
    '#options' =>
      [
        'contacts' => t('Contacts'),
        'deals' => t('Deals'),
        'companies' => t('Companies'),
        'engagements' => t('Engagements'),
      ],
    '#default_value' => $selected,
  ];

  $form['backup'] = [
    '#type' => 'submit',
    '#value' => t('Queue Backup Now'),
    '#submit' => ['hubspot_backup_build_queues'],
  ];

  return system_settings_form($form);
}

/**
 * Builds the queue to start backing up Hubspot.
 */
function hubspot_backup_build_queues($form, &$form_state) {
  system_settings_form_submit($form, $form_state);
  $backup_entities = variable_get('hubspot_backup_entities');
  foreach ($backup_entities as $backup_entity) {
    if ($backup_entity) {
      $fn = "hubspot_backup_build_queue_" . $backup_entity;
      $fn();
    }
  }
  variable_set('hubspot_backup_last_run', date('M'));
}
