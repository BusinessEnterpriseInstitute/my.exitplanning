<?php

/**
 * @file
 * Campaign Monitor module admin settings.
 */

/**
 * Return the Campaign Monitor global settings form.
 */
function campaign_monitor_admin_settings() {
  $integrator_reference_link = l(t('Read more'), 'https://www.campaignmonitor.com/api/account/#single-sign-on', array(
    'attributes' => array(
      'target' => '_blank',
    ),
    'absolute' => TRUE,
  ));
  $form['campaign_monitor_api_key'] = array(
    '#type' => 'textfield',
    '#title' => t('Campaign Monitor Administrator API Key'),
    '#required' => TRUE,
    '#default_value' => variable_get('campaign_monitor_api_key', ''),
    '#description' => t('The API key for your Campaign Monitor administrator account. Get or generate a valid API key at your !apilink.', array('!apilink' => l(t('Campaign Monitor API Dashboard'), 'https://www.campaignmonitor.com'))),
  );
  $form['campaign_monitor_integrator_id'] = array(
    '#type' => 'textfield',
    '#title' => t('Integrator ID'),
    '#default_value' => variable_get('campaign_monitor_integrator_id', ''),
    '#description' => t('Allows the creation of login sessions for account members, optionally directing them to a specific page. !readmore.', array('!readmore' => $integrator_reference_link)),
  );
  $disclaimer = variable_get('campaign_monitor_disclaimer', FALSE);
  $article = variable_get('campaign_monitor_article_preview', FALSE);
  $form['campaign_monitor_article_preview'] = array(
    '#type' => 'text_format',
    '#title' => t('Article Preview'),
    '#description' => t('A sample article to use during list design.'),
    '#default_value' => isset($article['value']) ? $article['value'] : '',
    '#format' => 'full_html',
  );
  $form['campaign_monitor_disclaimer'] = array(
    '#type' => 'text_format',
    '#title' => t('Disclaimer'),
    '#default_value' => isset($disclaimer['value']) ? $disclaimer['value'] : '',
    '#format' => 'full_html',
  );
  return system_settings_form($form);
}

function campaign_monitor_clients_import_form() {
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Import clients'),
  );
  return $form;
}

function campaign_monitor_clients_import_form_submit($form, &$form_state) {
  global $user;
  $wrap = campaign_monitor_get_api_object();
  $result = $wrap->get_clients();
  $clients_new_counter = 0;
  if($result->was_successful()) {
    $clients = $result->response;
    foreach ($clients as $client) {
      $query = "SELECT c.id FROM {campaign_monitor_clients} c WHERE c.client_id = :client_id";
      $cid = db_query($query, array(':client_id' => $client->ClientID))->fetchField();
      $client_api = campaign_monitor_get_api_object('CS_REST_Clients', $client->ClientID);
      if ($client_api) {
        $client_result = $client_api->get();
        if ($client_result->was_successful()) {
          $client_response = $client_result->response;
          $data = array('BasicDetails' => $client_response->BasicDetails, 'BillingDetails' => $client_response->BillingDetails);
          if ($cid) {
            // Update existing client record.
            db_update('campaign_monitor_clients')
            ->fields(array(
              'name' => $client->Name,
              'timezone' => $client_response->BasicDetails->TimeZone,
              'client_data' => serialize($data),
            ))
            ->condition('id', $cid)
            ->execute();
          }
          else {
            $client_key = encrypt($client_response->ApiKey);
            $new_client = entity_create('cm_client', array(
              'uid' => $user->uid,
              'client_id' => $client->ClientID,
              'name' => $client->Name,
              'timezone' => $client_response->BasicDetails->TimeZone,
              'client_key' => $client_key,
              'client_data' => $data,
            ));
            $new_client->save();
            $clients_new_counter++;
          }
        }
      }
    }
  }
  if ($clients_new_counter > 0) {
    $message_label = $clients_new_counter > 1 ? 'Clients' : 'Client';
    $message = t('Created @count new @clients', array('@count' => $clients_new_counter, '@clients' => $message_label));
    drupal_set_message($message);
  }
  $form_state['redirect'] = 'admin/campaign-monitor/clients';
}

function cm_client_form($form, &$form_state, $cm_client, $op = 'edit') {
  $data = isset($cm_client->id) ? $cm_client->client_data : array();
  $countries = campaign_monitor_get_countries();
  $zones = campaign_monitor_get_timezones();
  $is_new = isset($cm_client->is_new) ? TRUE : FALSE;
  if (isset($cm_client) && $op == 'edit') {
    $title = entity_label('cm_client', $cm_client);
    drupal_set_title($title);
  }
  $author = user_load($cm_client->uid);
  $form['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Company Name'),
    '#required' => TRUE,
    '#default_value' => isset($cm_client->name) ? $cm_client->name : '',
  );
  $form['country'] = array(
    '#type' => 'select',
    '#title' => t('Country'),
    '#empty_value' => '',
    '#default_value' => !empty($data['BasicDetails']->Country) ? $data['BasicDetails']->Country : CAMPAIGN_MONITOR_DEFAULT_COUNTRY,
    '#options' => drupal_map_assoc($countries),
    '#required' => TRUE,
  );
  $form['timezone'] = array(
    '#type' => 'select',
    '#title' => t('Timezone'),
    '#default_value' => !empty($data['BasicDetails']->TimeZone) ? $data['BasicDetails']->TimeZone : CAMPAIGN_MONITOR_DEFAULT_TIMEZONE,
    '#options' => drupal_map_assoc($zones),
    '#required' => TRUE,
  );
  $form['author'] = array(
    '#type' => 'textfield',
    '#title' => t('Authored by'),
    '#maxlength' => 60,
    '#autocomplete_path' => 'user/autocomplete',
    '#default_value' => $author->name,
    '#required' => TRUE,
  );
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => $is_new ? t('Submit') : t('Save Changes'),
  );
  return $form;
}
/**
 * Implements hook_validate().
 *
 * Performs validation checks on the given client.
 */
function cm_client_form_validate($form, &$form_state) {
  $values = $form_state['values'];
  // Validate the "authored by" field.
  if (!empty($values['author']) && !($account = user_load_by_name($values['author']))) {
    // The use of empty() is mandatory in the context of usernames
    // as the empty string denotes the anonymous user. In case we
    // are dealing with an anonymous user we set the user ID to 0.
    form_set_error('author', t('The username %name does not exist.', array('%name' => $values['author'])));
  }
}
function cm_client_form_submit(&$form, &$form_state) {
  $form_state['redirect'] = 'admin/config/campaign-monitor/clients';
  $client = entity_ui_form_submit_build_entity($form, $form_state);
  $is_new = isset($client->is_new) ? TRUE : FALSE;
  $values = $form_state['values'];
  if (!empty($values['author'])) {
    if ($account = user_load_by_name($values['author'])) {
      $client->uid = $account->uid;
    }
  }
  if ($is_new) {
    $wrap = campaign_monitor_get_api_object('CS_REST_Clients', NULL);
    $id = NULL;
    $values = $form_state['values'];
    $new_client = array(
      'CompanyName' => trim($values['name']),
      'Country' => $values['country'],
      'Timezone' => $values['timezone'],
    );
    $result = $wrap->create($new_client);
    if ($result->was_successful()) {
      $id = $result->response;
    }
    else {
      $error = $result->response->Message;
      $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
    if ($id) {
      $wrap = campaign_monitor_get_api_object('CS_REST_Clients', $id);
      $result = $wrap->get();
      if ($result->was_successful()) {
        $client_key = encrypt($result->response->ApiKey);
        $data = array('BasicDetails' => $result->response->BasicDetails, 'BillingDetails' => $result->response->BillingDetails);
        $client->client_id = $id;
        $client->client_key = $client_key;
        $client->client_data = $data;
        $client->save();
        $message = t('Created new client %name', array('%name' => $client->name));
        drupal_set_message($message);
      }
    }
  }
  else {
    $original = entity_load_unchanged('cm_client', $client->id);
    $changed = FALSE;
    if ($original->name != $client->name) {
      $changed = TRUE;
    }
    elseif ($original->uid != $client->uid) {
      $changed = TRUE;
    }
    elseif ($original->client_data['BasicDetails']->Country != $client->country) {
      $changed = TRUE;
    }
    elseif ($original->timezone != $client->timezone) {
      $changed = TRUE;
    }
    if ($changed) {
      $wrap = campaign_monitor_get_api_object('CS_REST_Clients', $client->client_id);
      $result = $wrap->set_basics(array(
        'CompanyName' => $client->name,
        'Country' => $client->country,
        'Timezone' => $client->timezone
      ));
      if ($result->was_successful()) {
        $data = $client->client_data;
        $data['BasicDetails']->Country = $client->country;
        $data['BasicDetails']->TimeZone = $client->timezone;
        $client->client_data = $data;
        $client->save();
        $message = t('Updated client id %id on Campaign Monitor', array('%id' => $client->client_id));
        drupal_set_message($message);
      }
      else {
        $error = $result->response->Message;
        $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
        drupal_set_message($message, 'error');
      }
    }
  }
  $form_state['redirect'] = 'admin/campaign-monitor/clients';
}

/**
 * Delete confirmation form.
 */
function cm_client_delete_form($form, &$form_state, $client) {
  $form_state['cm_client'] = $client;
  $client_uri = entity_uri('cm_client', $client);
  return confirm_form($form,
    t('Are you sure you want to delete client %name?', array('%name' => entity_label('cm_client', $client))),
    $client_uri['path'],
    t('This action cannot be undone.'),
    t('Delete'),
    t('Cancel')
  );
}
/**
 * Delete form submit handler.
 */
function cm_client_delete_form_submit($form, &$form_state) {
  $client = $form_state['cm_client'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Clients', $client->client_id);
  if ($wrap) {
    $result = $wrap->delete();
    // Delete our entity if client could be deleted on CM or the client id couldn't be found.
    if ($result->was_successful() || $result->response->Code == 101 || $result->response->Code == 404) {
      cm_client_delete($client);
      drupal_set_message(t('Client %name deleted.', array('%name' => entity_label('cm_client', $client))));
    }
    else {
      $error = $result->response->Message;
      $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }

  $form_state['redirect'] = 'admin/campaign-monitor/clients';
}
