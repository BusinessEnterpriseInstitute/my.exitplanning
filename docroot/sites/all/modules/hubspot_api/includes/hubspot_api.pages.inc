<?php

/**
 * @file
 * Hubspot API Pages.
 */

/**
 * Redirect form callback.
 *
 * Processes any information and redirects to main settings page.
 */
function hubspot_api_oauth_redirect($form, &$form_state) {
  if (isset($_GET['code'])) {
    global $base_url;

    $options = [
      'method' => 'POST',
      'data' => http_build_query(
        [
          'grant_type' => 'authorization_code',
          'client_id' => variable_get('hubspot_api_client_id', ''),
          'client_secret' => variable_get('hubspot_api_client_secret'),
          'redirect_uri' => $base_url . '/admin/config/services/hubspot/redirect',
          'code' => $_GET['code'],
        ]
      ),
    ];
    hubspot_api_save_tokens($options);
  }
  else {
    if ($_GET['error'] == 'access_denied') {
      // Show error message if access was denied.
      drupal_set_message(t('Access was denied to HubSpot API.'), 'error');
    }
  }

  drupal_goto('admin/config/services/hubspot');

  return $form;
}
