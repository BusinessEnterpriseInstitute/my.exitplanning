<?php

/**
 * @file
 * Key provider plugin for lockr.
 */

use Lockr\Exception\LockrApiException;

$plugin = [
  'label' => t('Lockr'),
  'description' => t('Use Lockr: a secure off-site hosted key manager.'),
  'storage method' => 'lockr',
  'key value' => [
    'accepted' => TRUE,
    'required' => FALSE,
  ],
  'default configuration' => 'key_provider_lockr_default_configuration',
  'build configuration form' => 'key_provider_lockr_build_configuration_form',
  'get key value' => 'key_provider_lockr_get_key_value',
  'set key value' => 'key_provider_lockr_set_key_value',
  'delete key value' => 'key_provider_lockr_delete_key_value',
  'obscure key value' => '_key_default_obscure_key_value',
];

/**
 * The default plugin configuration.
 */
function key_provider_lockr_default_configuration() {
  return [];
}

/**
 * The settings form.
 */
function key_provider_lockr_build_configuration_form($form, &$form_state) {
  $lc = lockr_client();
  try {
    $info = $lc->getInfo();
  }
  catch (LockrApiException $e) {
    $info = NULL;
  }

  if (is_null($info)) {
    $form['need_register'] = [
      '#prefix' => '<p>',
      '#markup' => t('This site has not yet registered with Lockr, please <a href="@link">click here to register</a>.',
        ['@link' => 'admin/config/system/lockr']
      ),
      '#suffix' => '</p>',
    ];
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
  return _lockr_get_key($key_name) ?: NULL;
}

/**
 * Set callback for key_provider plugin.
 */
function key_provider_lockr_set_key_value($config, &$form_state, $key_value) {
  $name = $config['id'];
  $label = $config['label'];
  $result = _lockr_set_key($name, $key_value, $label);
  if (!$result) {
    form_set_error('', t(
      'An error occurred in Lockr. Please try again in a moment.'
    ));
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
