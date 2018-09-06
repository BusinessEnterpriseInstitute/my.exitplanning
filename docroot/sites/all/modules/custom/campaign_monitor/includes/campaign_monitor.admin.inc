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
  $cm = campaign_monitor_get_api_object();
  if ($cm) {
    $result = $cm->get_clients();
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
                'client_data' => serialize($data),
              ))
              ->condition('id', $cid)
              ->execute();
            }
            else {
              $client_key = encrypt($client_response->ApiKey);
              db_insert('campaign_monitor_clients')
              ->fields(array(
                'client_id' => $client->ClientID,
                'name' => $client->Name,
                'client_key' => serialize($client_key),
                'client_data' => serialize($data),
              ))
              ->execute();
            }
          }
        }
      }
    }
  }
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
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => $is_new ? t('Submit') : t('Save Changes'),
  );
  return $form;
}
function cm_client_form_submit(&$form, &$form_state) {
  $form_state['redirect'] = 'admin/config/campaign-monitor/clients';
  $client = entity_ui_form_submit_build_entity($form, $form_state);
  $is_new = isset($client->is_new) ? TRUE : FALSE;
  if ($is_new) {
    $cm = campaign_monitor_get_api_object('CS_REST_Clients', NULL);
    $id = NULL;
    if ($cm) {
      $values = $form_state['values'];
      $new_client = array(
        'CompanyName' => trim($values['name']),
        'Country' => $values['country'],
        'Timezone' => $values['timezone'],
      );
      $result = $cm->create($new_client);
      if ($result->was_successful()) {
        $id = $result->response;
      }
      else {
        $error = $result->response->Message;
        $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
        drupal_set_message($message, 'error');
      }
    }
    if ($id) {
      $cm = campaign_monitor_get_api_object('CS_REST_Clients', $id);
      if ($cm) {
        $client_result = $cm->get();
        if ($client_result->was_successful()) {
          $client_key = encrypt($client_result->response->ApiKey);
          $data = array('BasicDetails' => $client_result->response->BasicDetails, 'BillingDetails' => $client_result->response->BillingDetails);
          $client->client_id = $id;
          $client->client_key = $client_key;
          $client->client_data = $data;
          $client->save();
          $message = t('Created new client %name', array('%name' => $client->name));
          drupal_set_message($message);
        }
      }
    }
  }
  else {
    $original = entity_load_unchanged('cm_client', $client->id);
    $changed = FALSE;
    if ($original->name != $client->name) {
      $changed = TRUE;
    }
    elseif ($original->client_data['BasicDetails']->Country != $client->country) {
      $changed = TRUE;
    }
    elseif ($original->client_data['BasicDetails']->TimeZone != $client->timezone) {
      $changed = TRUE;
    }
    if ($changed) {
      $cm = campaign_monitor_get_api_object('CS_REST_Clients', $client->client_id);
      $client_update = $cm->set_basics(array(
        'CompanyName' => $client->name,
        'Country' => $client->country,
        'Timezone' => $client->timezone
      ));
      if ($client_update->was_successful()) {
        $data = $client->client_data;
        $data['BasicDetails']->Country = $client->country;
        $data['BasicDetails']->TimeZone = $client->timezone;
        $client->client_data = $data;
        $client->save();
        $message = t('Updated client id %id on Campaign Monitor', array('%id' => $client->client_id));
        drupal_set_message($message);
      }
      else {
        $error = $client_update->response->Message;
        $message = t('Failed with code @code. %error', array('@code' => $client_update->http_status_code, '%error' => $error));
        drupal_set_message($message, 'error');
      }
    }
    else {
      $message = t('No changes to save.');
      drupal_set_message($message);
    }
  }
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
    if ($result->was_successful() || $result->response->Code == 101) {
      cm_client_delete($client);
      drupal_set_message(t('Client %name deleted.', array('%name' => entity_label('cm_client', $client))));
    }
    else {
      $error = $result->response->Message;
      $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }

  $form_state['redirect'] = 'admin/config/campaign-monitor/clients';
}
