<?php

/**
 * @file
 * Hubspot API Admin.
 */

/**
 * Admin settings form.
 */
function hubspot_api_admin_settings($form, &$form_state) {
  // Status.
  $title = t('Status');
  $status = hubspot_api_is_connected() ? t('Connected') : t('Disconnected');
  $color = hubspot_api_is_connected() ? 'green' : 'red';
  $form['status_report'] = [
    '#markup' => '<strong>' . $title . ': </strong><span style="color:' . $color . '">' . $status . '</span>',
  ];

  $form['hubspot_api_client_id'] = [
    '#type' => 'textfield',
    '#title' => t('Client ID'),
    '#required' => TRUE,
    '#default_value' => variable_get('hubspot_api_client_id', ''),
  ];
  $form['hubspot_api_client_secret'] = [
    '#type' => 'textfield',
    '#title' => t('Client secret'),
    '#required' => TRUE,
    '#default_value' => variable_get('hubspot_api_client_secret', ''),
  ];
  $form['oauth'] = [
    '#type' => 'fieldset',
    '#title' => t('OAuth connection'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#access' => (bool) (variable_get('hubspot_api_client_id') && variable_get('hubspot_api_client_secret')),
  ];
  $form['oauth']['tokens'] = [
    '#type' => 'fieldset',
    '#title' => t('Tokens'),
    '#collapsible' => FALSE,
    '#access' => (bool) (variable_get('hubspot_api_access_token') && variable_get('hubspot_api_refresh_token')),
  ];
  $form['oauth']['tokens']['hubspot_api_access_token'] = [
    '#type' => 'textfield',
    '#title' => t('Access token'),
    '#required' => FALSE,
    '#default_value' => variable_get('hubspot_api_access_token', ''),
    '#attributes' => ['readonly' => 'readonly'],
  ];
  $form['oauth']['tokens']['hubspot_api_refresh_token'] = [
    '#type' => 'textfield',
    '#title' => t('Refresh Token'),
    '#required' => FALSE,
    '#default_value' => variable_get('hubspot_api_refresh_token', ''),
    '#attributes' => ['readonly' => 'readonly'],
  ];
  $form['oauth']['button'] = [
    '#type' => 'submit',
    '#value' => t('Authorize'),
    '#submit' => [
      'hubspot_api_oauth_submit',
    ],
    '#access' => (bool) !variable_get('hubspot_api_access_token'),
  ];
  $form['oauth']['disconnect'] = [
    '#type' => 'submit',
    '#value' => t('Disconnect'),
    '#limit_validation_errors' => [],
    '#submit' => ['hubspot_api_oauth_disconnect'],
    '#access' => (bool) variable_get('hubspot_api_access_token'),
  ];

  $form['help'] = [
    '#type' => 'fieldset',
    '#title' => t('Help'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];
  $form['help']['list'] = [
    '#theme' => 'item_list',
    '#type' => 'ol',
    '#items' => [
      t('Log in to <a href="@url" target="_blank">Hubspot</a> developer portal.', ['@url' => 'https://developers.hubspot.com/']),
      t('<a href="@url" target="_blank">Create an app</a>.', ['@url' => 'https://developers.hubspot.com/docs/faq/how-do-i-create-an-app-in-hubspot']),
      t('Get the Client ID and secret and enter the info here.'),
      t('Click authorize and follow the prompts to connect your app.'),
      t('View the <a href="@url" target="_blank">documentation here</a> for more info.', ['@url' => 'https://developers.hubspot.com/docs/overview']),
    ],
  ];

  return system_settings_form($form);
}

/**
 * Hubspot OAuth submit handler.
 */
function hubspot_api_oauth_submit($form, &$form_state) {
  // Build the url to send to the user to the HubSpot login.
  global $base_url;

  $options = [
    'query' => [
      'client_id' => variable_get('hubspot_api_client_id', ''),
      'redirect_uri' => $base_url . '/admin/config/services/hubspot/redirect',
      'scope' => 'contacts',
    ],
    'external' => TRUE,
  ];

  drupal_goto(HUBSPOT_API_LOGIN_URL . HUBSPOT_API_INIT_TOKEN_ENDPOINT, $options);
}

/**
 * Hubspot OAuth disconnect handler.
 */
function hubspot_api_oauth_disconnect() {
  variable_delete('hubspot_api_access_token');
  variable_delete('hubspot_api_refresh_token');
  variable_delete('hubspot_api_expire_date');
}
