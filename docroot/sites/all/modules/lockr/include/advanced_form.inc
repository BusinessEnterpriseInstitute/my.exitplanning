<?php

/**
 * @file
 * Form handlers for advanced admin settings.
 */

/**
 * Returns form array for advanced settings.
 */
function lockr_admin_advanced_form() {
  $form = array(
    '#type' => 'fieldset',
    '#title' => t('Advanced'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['region'] = array(
    '#type' => 'radios',
    '#title' => t('Region'),
    '#default_value' => variable_get('lockr_region', 'us'),
    '#options' => array(
      'us' => t('US'),
      'eu' => t('EU'),
    ),
  );

  $form['custom'] = array(
    '#type' => 'checkbox',
    '#title' => 'Set custom certificate location',
    '#default_value' => variable_get('lockr_custom'),
  );

  $form['custom_cert'] = array(
    '#type' => 'textfield',
    '#title' => t('Certificate Path'),
    '#default_value' => variable_get('lockr_cert'),
    '#states' => array(
      'visible' => array(
        ':input[name="custom"]' => array('checked' => TRUE),
      ),
    ),
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
    '#validate' => array('lockr_admin_advanced_validate'),
    '#submit' => array('lockr_admin_advanced_submit'),
  );

  return $form;
}

/**
 * Validate advanced settings.
 */
function lockr_admin_advanced_validate($form, &$form_state) {
  $values = $form_state['values'];

  if (!$values['custom']) {
    return;
  }

  $cert_path = $values['custom_cert'];

  if (!$cert_path) {
    form_set_error(
      'custom_cert',
      t('Certificate location is required for custom certs')
    );
    return;
  }

  if (substr($cert_path, 0, 10) === 'private://') {
    $private_wrapper = new DrupalPrivateStreamWrapper();
    $private_wrapper->setUri($cert_path);
    $cert_path = $private_wrapper->realpath();
  }
  elseif ($cert_path[0] !== '/') {
    $cert_path = DRUPAL_ROOT . "/$cert_path";
  }

  if (is_dir($cert_path) || !is_readable($cert_path)) {
    form_set_error(
      'custom_cert',
      t('Certificate must be a readable file')
    );
  }
}

/**
 * Save advanced settings.
 */
function lockr_admin_advanced_submit($form, &$form_state) {
  $values = $form_state['values'];

  variable_set('lockr_region', $values['region']);

  $custom = $values['custom'];

  $cert_path = $values['custom_cert'];

  if (!preg_match('/^(\/|.+:\/\/)/', $cert_path)) {
    $cert_path = DRUPAL_ROOT . "/$cert_path";
  }

  variable_set('lockr_custom', $custom);
  if ($custom) {
    variable_set('lockr_cert', $cert_path);
  }
  else {
    variable_del('lockr_cert');
  }
}
