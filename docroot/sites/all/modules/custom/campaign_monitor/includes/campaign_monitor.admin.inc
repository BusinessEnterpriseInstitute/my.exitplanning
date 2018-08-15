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
/*
 * Campaign Lists form.
 */
function cm_client_lists_form($form, &$form_state, $client) {
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  if ($client) {
    $client_uri = entity_uri('cm_client', $client);
    $breadcrumb[] = l(t('@client', array('@client' => $client->name)), $client_uri['path']);
  }
    drupal_set_breadcrumb($breadcrumb);
  $lists_query = new EntityFieldQuery();
  $lists_query->entityCondition('entity_type', 'cm_list');
  $lists_query->propertyCondition('cid', $client->id, '=');
  $lists_result = $lists_query->execute();
  $header = array(t('Title'), t('Operations'), t('Preview'));
  $rows = array();
  if (isset($lists_result['cm_list'])) {
    $list_ids = array_keys($lists_result['cm_list']);
    $lists = entity_load('cm_list', $list_ids);
    foreach ($lists as $list) {
      $list_uri = entity_uri('cm_list', $list);
      $destination = drupal_get_destination();
      $row = array(
        'data' => array(
          array('data' => l($list->title, $list_uri['path'])),
          array('data' => l(t('edit'), 'cm-list/' . $list->id . '/edit', array('query' => array($destination)))),
          array('data' => l(t('preview'), 'cm-list/' . $list->id . '/raw', array('attributes' => array('target' => '_blank')))),
        ),
        'no_striping' => TRUE,
      );
      $rows[] = $row;
    }
  }
  $form['lists_table'] = array(
    '#type' => 'container',
    '#theme' => 'table',
    '#header' => $header,
    '#rows' => $rows,
    '#empty' => 'No lists exist.',
  );
  $form_state['client'] = $client;
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Import/Update lists'),
  );
  return $form;
}
function cm_client_lists_form_submit(&$form, &$form_state) {
  $client = $form_state['client'];
  $cm = campaign_monitor_get_api_object('CS_REST_Clients', $client->client_id);
  $cm_list = NULL;
  if ($cm) {
    $result = $cm->get_lists();
    if ($result->was_successful()) {
      $lists = $result->response;
      foreach ($lists as $list_item) {
        $list_exists = db_query('SELECT l.id FROM {campaign_monitor_lists} l WHERE l.list_id = :list_id', array(':list_id' => $list_item->ListID))->fetchField();
        $list_api = campaign_monitor_get_api_object('CS_REST_Lists', $list_item->ListID);
        $list_result = $list_api->get();
        if ($list_result->was_successful()) {
          $list = $list_result->response;
          if (!$list_exists) {
            $cm_list = entity_create('cm_list', array(
              'cid' => $client->id,
              'uid' => $client->uid,
              'list_id' => $list->ListID,
              'title' => $list->Title,
              'list_data' => array('details' => $list, 'webhooks' => array()),
            ));
            $cm_list->save();
          }
          else {
            $cm_list = cm_list_load($list_exists);
            if ($cm_list) {
              dpm($cm_list);
            }
          }
        }
        else {
          $error = $result->response->Message;
          $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
          drupal_set_message($message, 'error');
        }
      }
    }
    else {
      $error = $result->response->Message;
      $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }
}
/*
 * List entity form.
 */
function cm_list_form($form, &$form_state, $cm_list = NULL, $client = NULL) {
  global $user;
  if (!isset($cm_list->id)) {
    $cm_list = entity_create('cm_list', array(
      'cid' => $client->id,
      'uid' => $user->uid
    ));
  }
  $data = isset($cm_list->id) ? $cm_list->list_data : array();
  $is_new = isset($cm_list->is_new) ? TRUE : FALSE;
  $tabs_type = 'container';
  if (!$is_new) {
    $title = entity_label('cm_list', $cm_list);
    $tabs_type = 'horizontal_tabs';
  }
  else {
    $title = 'Create list';
  }
  drupal_set_title($title);
  $form_state['client'] = $client;
  $form_state['list'] = $cm_list;
  $form['tabs'] = array(
    '#type' => $tabs_type,
  );
  $form['tabs']['settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Settings'),
  );
  $form['tabs']['settings']['title'] = array(
    '#type' => 'textfield',
    '#title' => t('List Name'),
    '#required' => TRUE,
    '#default_value' => isset($cm_list->title) ? $cm_list->title : '',
  );
  $form['tabs']['settings']['unsubscribe_page'] = array(
    '#type' => 'textfield',
    '#title' => t('Unsubscribe page'),
    '#default_value' => isset($data['details']->UnsubscribePage) ? $data['details']->UnsubscribePage : '',
  );
  $form['tabs']['settings']['unsubscribe_setting'] = array(
    '#type' => 'radios',
    '#title' => t('Unsubscribe Setting'),
    '#description' => t('When someone unsubscribes from a list, should he/she be unsubscribed from all lists or just this one?'),
    '#options' => array(
      'AllClientLists' => t('All client lists'),
      'OnlyThisList' => t('Only this list'),
    ),
    '#default_value' => isset($data['details']->UnsubscribeSetting) ? $data['details']->UnsubscribeSetting : 'AllClientLists',
    '#required' => TRUE,
  );
  $form['tabs']['settings']['confirmed_opt_in'] = array(
    '#type' => 'checkbox',
    '#title' => t('Confirmed opt in'),
    '#default_value' => isset($data['details']->ConfirmedOptIn) ? $data['details']->ConfirmedOptIn : false,
  );
  $form['tabs']['settings']['confirmation_success_page'] = array(
    '#type' => 'textfield',
    '#title' => t('Confirmation success page'),
    '#default_value' => isset($data['details']->ConfirmationSuccessPage) ? $data['details']->ConfirmationSuccessPage : '',
  );
  // Attach field api fields.
  if (!$is_new) {
    field_attach_form('cm_list', $cm_list, $form, $form_state);
    // Attaches css and js from the field group module.
    $form['#attached']['css'] = array(
      drupal_get_path('module', 'field_group') . '/horizontal-tabs/horizontal-tabs.css',
    );
    $form['#attached']['js'] = array(
      drupal_get_path('module', 'field_group') . '/horizontal-tabs/horizontal-tabs.js',
    );
    $form['tabs']['design'] = array(
      '#type' => 'fieldset',
      '#title' => t('Design'),
      '#weight' => -10,
    );
    $form['tabs']['design']['background_color'] = array(
      '#type' => 'colorfield_picker',
      '#title' => t('Background Color'),
      '#description' => t('This field allows you to customize the background color of the email body.
                          If left blank, your newsletter template will inherit the color defined in profile
                          settings under Branding Options.'),
      '#default_value' => array(
        'colorfield_picker' => isset($data['design']['background_color']['colorfield_picker']) ? $data['design']['background_color']['colorfield_picker'] : '#000000',
      ),
      '#element_validate' => array('campaign_monitor_color_validate'),
    );
    if (isset($form['field_mc_banner'])) {
      $form['tabs']['design']['field_mc_banner'] = $form['field_mc_banner'];
      unset($form['field_mc_banner']);
    }
  }
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => $is_new ? t('Next') : t('Save'),
    '#attributes' => array(
      'class' => array('button small'),
    ),
  );
  return $form;
}
function cm_list_form_submit(&$form, &$form_state) {
  $values = $form_state['values'];
  $client = $form_state['client'];
  $list = $form_state['list'];
  if (isset($list->is_new)) {
    $cm = campaign_monitor_get_api_object('CS_REST_Lists', NULL);
    if ($cm) {
      $result = $cm->create($client->client_id, array(
        'Title' => $values['title'],
        'UnsubscribeSetting' => $values['unsubscribe_setting'],
        'UnsubscribePage' => $values['unsubscribe_page'],
        'ConfirmationSuccessPage' => $values['confirmation_success_page'],
        'ConfirmedOptIn' => $values['confirmed_opt_in'],
      ));
      if ($result->was_successful()) {
        $id = $result->response;
        $list_api = campaign_monitor_get_api_object('CS_REST_Lists', $id);
        if ($list_api) {
          $list_result = $list_api->get();
          if ($list_result->was_successful()) {
            $list->list_id = $id;
            $list->title = $values['title'];
            $list->list_data = array(
              'details' => $list_result->response,
              'webhooks' => array(),
            );
            $webhook = $list_api->create_webhook(array(
              'Events' => array(CS_REST_LIST_WEBHOOK_SUBSCRIBE, CS_REST_LIST_WEBHOOK_DEACTIVATE, CS_REST_LIST_WEBHOOK_UPDATE),
              'Url' => campaign_monitor_webhook_url(),
              'PayLoadFormat' => CS_REST_WEBHOOK_FORMAT_JSON,
            ));
            $webhooks = $list_api->get_webhooks();
            if ($webhooks->was_successful()) {
              $list->list_data['webhooks'] = $webhooks->response;
            }
            //field_attach_submit('cm_list', $list, $form, $form_state);
            $list->save();
            $form_state['redirect'] = 'cm-list/' . entity_id('cm_list', $list) . '/edit';
            $message = t('Added new list %title to Campaign Monitor', array('%title' => $values['title']));
            drupal_set_message($message);
          }
        }
      }
      else {
        $error = $result->response->Message;
        $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
        drupal_set_message($message, 'error');
      }
    }
  }
  else {
    $cm = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
    if ($cm) {
      $result = $cm->update(array(
        'Title' => $values['title'],
        'UnsubscribeSetting' => $values['unsubscribe_setting'],
        'UnsubscribePage' => $values['unsubscribe_page'],
        'ConfirmationSuccessPage' => $values['confirmation_success_page'],
        'ConfirmedOptIn' => $values['confirmed_opt_in'],
      ));
      if ($result->was_successful()) {
        $list_result = $cm->get();
        if ($list_result->was_successful()) {
          $list->title = $values['title'];
          $list->list_data['details'] = $list_result->response;
          $list->list_data['design'] = array(
            'background_color' => $values['background_color'],
          );
          field_attach_submit('cm_list', $list, $form, $form_state);
          $list->save();
          $message = t('Updated list %title on Campaign Monitor', array('%title' => $values['title']));
          drupal_set_message($message);
        }
        else {
          $error = $result->response->Message;
          $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
          drupal_set_message($message, 'error');
        }
      }
      else {
        $error = $result->response->Message;
        $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
        drupal_set_message($message, 'error');
      }
    }
  }
}
