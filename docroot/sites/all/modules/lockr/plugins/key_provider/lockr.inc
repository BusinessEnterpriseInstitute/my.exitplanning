<?php

/**
 * @file
 * Key provider plugin for lockr.
 */

use Lockr\Exception\LockrServerException;

$plugin = array(
  'label' => t('Lockr'),
  'description' => t('Use Lockr: a secure off-site hosted key manager.'),
  'storage method' => 'lockr',
  'key value' => array(
    'accepted' => TRUE,
    'required' => FALSE,
  ),
  'default configuration' => 'key_provider_lockr_default_configuration',
  'build configuration form' => 'key_provider_lockr_build_configuration_form',
  'get key value' => 'key_provider_lockr_get_key_value',
  'set key value' => 'key_provider_lockr_set_key_value',
  'delete key value' => 'key_provider_lockr_delete_key_value',
  'obscure key value' => '_key_default_obscure_key_value',
);

/**
 * The default plugin configuration.
 */
function key_provider_lockr_default_configuration() {
  return array('encoded' => '');
}

/**
 * The settings form.
 */
function key_provider_lockr_build_configuration_form($form, &$form_state) {
  try {
    $status = lockr_check_registration();
  }
  catch (LockrServerException $e) {
    watchdog_exception('lockr', $e);
    drupal_set_message('The Lockr service has returned an error. Please try again.', 'error');
    return $form;
  }
  $exists = $status['exists'];

  if (!$exists) {
    $form['need_register'] = array(
      '#prefix' => '<p>',
      '#markup' => t('This site has not yet registered with Lockr, please <a href="@link">click here to register</a>.',
        array('@link' => 'admin/config/system/lockr')
      ),
      '#suffix' => '</p>',
    );
  }

  return $form;
}

/**
 * Get callback for key_provider plugin.
 *
 * @param array $config
 *   Key configuration array.
 *
 * @return string|NULL
 *   The key value or NULL.
 */
function key_provider_lockr_get_key_value($config) {
  if (!isset($config['id'])) {
    return '';
  }
  $key_name = $config['id'];
  $encoded = isset($config['key_provider_settings']['encoded'])
    ? $config['key_provider_settings']['encoded']
    : NULL;
  $key_value = _lockr_get_key($key_name, $encoded);
  return $key_value ?: NULL;
}

/**
 * Set callback for key_provider plugin.
 */
function key_provider_lockr_set_key_value($config, &$form_state, $key_value) {
  $name = $config['id'];
  $label = $config['label'];
  $old_encoded = NULL;
  if (isset($form_state['storage']['original_key']['key_provider_settings']['encoded'])) {
    $old_encoded = $form_state['storage']['original_key']['key_provider_settings']['encoded'];
  }
  $new_encoded = _lockr_set_key($name, $key_value, $label, $old_encoded);
  if (!$new_encoded) {
    form_set_error('', t(
      'An error occurred in Lockr. Please try again in a moment.'
    ));
  }
  else {
    $form_state['values']['encoded'] = $new_encoded;
  }
}

/**
 * Delete key form submit callback.
 *
 * @param array $config
 *   The key config.
 */
function key_provider_lockr_delete_key_value($config) {
  $key_name = $config['name'];
  _lockr_delete_key($key_name);
}

/**
 * Obscure key values for display in the admin form.
 *
 * @param string $key_value
 *   The value to obscure.
 * @param array $config
 *   The key config.
 *
 * @return string
 *   The placeholder text.
 */
function key_provider_lockr_key_value_obscure($key_value, $config) {
  return $key_value;
}
