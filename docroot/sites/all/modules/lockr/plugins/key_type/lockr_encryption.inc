<?php

/**
 * @file
 * Plugin definition for the Lockr encryption key type.
 */

$plugin = array(
  'label' => t('Lockr Encryption'),
  'description' => t('A key type that generates keys via Lockr.'),
  'group' => 'encryption',
  'key value' => array(
    'plugin' => 'generate'
  ),
  'default configuration' => 'key_type_lockr_encryption_default_configuration',
  'build configuration form' => 'key_type_lockr_encryption_build_configuration_form',
  'generate key value' => 'key_type_lockr_encryption_generate_key_value',
	'validate key value' => 'key_type_lockr_encryption_validate_key_value',
);

/**
 * The default plugin configuration.
 *
 * @return array
 *   The default plugin configuration.
 */
function key_type_lockr_encryption_default_configuration() {
  return array(
    'key_size' => '256',
  );
}

/**
 * Build the plugin configuration form.
 *
 * @param array $form
 * @param array $form_state
 *
 * @return array
 *   The plugin configuration form.
 */
function key_type_lockr_encryption_build_configuration_form($form, &$form_state) {
  $config = $form_state['storage']['key_config'];
  $plugin_config = $config['key_type_settings'] + key_type_lockr_encryption_default_configuration();

  $form['key_size'] = array(
    '#type' => 'select',
    '#title' => t('Key size'),
    '#description' => t('The size of the key in bits.'),
    '#options' => array(
      '128' => 128,
      '192' => 192,
      '256' => 256,
    ),
    '#default_value' => $plugin_config['key_size'],
    '#required' => TRUE,
  );

  return $form;
}

/**
 * Generate a key value.
 *
 * @param array $configuration
 *
 * @return string
 *   A random key.
 */
function key_type_lockr_encryption_generate_key_value(array $config) {
  $bits = isset($config['key_type_settings']['key_size'])
    ? $config['key_type_settings']['key_size']
    : 256;
  $client = lockr_key_client();

  return $client->create($bits);
}

/**
 * Validate the key value.
 *
 * @param string $key_value
 *   The key value to validate.
 */
function key_type_lockr_encryption_validate_key_value($form, &$form_state, $key_value) {
  if (empty($form_state['values']['key_size'])) {
    return;
  }

  // Validate the key size.
  $bytes = $form_state['values']['key_size'] / 8;
  if (strlen($key_value) != $bytes) {
    form_set_error('key_size', t('The selected key size does not match the actual size of the key.'));
    return;
  }
}
