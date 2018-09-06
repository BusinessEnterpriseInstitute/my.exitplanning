<?php

/**
 * @file
 * Campaign Monitor lists module admin settings.
 */

/*
 * Campaign Lists form.
 */
function campaign_monitor_lists_import_form($form, &$form_state, $client) {
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  if ($client) {
    $client_uri = entity_uri('cm_client', $client);
    $breadcrumb[] = l(t('@client', array('@client' => $client->name)), $client_uri['path']);
  }
  drupal_set_breadcrumb($breadcrumb);
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
function campaign_monitor_lists_import_form_submit(&$form, &$form_state) {
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
              'client_id' => $client->client_id,
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
              //dpm($cm_list);
            }
          }
          // Update webhooks.
          $webhooks = $list_api->get_webhooks();
          if ($webhooks->was_successful()) {
            $cm_list->list_data['webhooks'] = $webhooks->response;
            $cm_list->save();
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
function cm_list_form($form, &$form_state, $list = NULL, $client = NULL) {
  global $user;
  if (!isset($list->id)) {
    $list = entity_create('cm_list', array(
      'cid' => $client->id,
      'client_id' => $client->client_id,
      'uid' => $user->uid,
    ));
    $data = array();
  }
  else {
    $data = $list->list_data;
  }
  $is_new = isset($list->is_new) ? TRUE : FALSE;
  $tabs_type = 'container';
  if (!$is_new) {
    $title = entity_label('cm_list', $list);
    $tabs_type = 'horizontal_tabs';
  }
  else {
    $title = 'Create list';
  }
  drupal_set_title($title);
  $form_state['cm_client'] = $client;
  $form_state['cm_list'] = $list;
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
    '#default_value' => isset($list->title) ? $list->title : '',
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
    field_attach_form('cm_list', $list, $form, $form_state);
    // Attaches css and js from the field group module.
    $form['#attached']['css'] = array(
      drupal_get_path('module', 'field_group') . '/horizontal-tabs/horizontal-tabs.css',
    );
    $form['#attached']['js'] = array(
      drupal_get_path('module', 'field_group') . '/horizontal-tabs/horizontal-tabs.js',
    );
    $form['tabs']['defaults'] = array(
      '#type' => 'fieldset',
      '#title' => t('Campaign Defaults'),
      '#weight' => -11,
    );
    $form['tabs']['defaults']['from_name'] = array(
      '#type' => 'textfield',
      '#title' => t('From name'),
      '#description' => t('This is who your emails will come from. Use something they\'ll instantly recognize, like your company name.'),
      '#default_value' => $list->from_name,
    );
    $form['tabs']['defaults']['from_email'] = array(
      '#type' => 'textfield',
      '#title' => t('From e-mail'),
      '#description' => t('This is the e-mail address your campaigns will come from.'),
      '#element_validate' => array('campaign_monitor_email_validate'),
      '#default_value' => $list->from_email,
    );
    $form['tabs']['defaults']['reply_to'] = array(
      '#type' => 'textfield',
      '#title' => t('Replies should be sent to'),
      '#description' => t('Enter a valid email address that replies will be sent to.'),
      '#element_validate' => array('campaign_monitor_email_validate'),
      '#default_value' => $list->reply_to,
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
        'colorfield_picker' => isset($data['design']['background_color']['colorfield_picker']) ? $data['design']['background_color']['colorfield_picker'] : '#E4E4E4',
      ),
      '#element_validate' => array('campaign_monitor_color_validate'),
      '#required' => TRUE,
      '#weight' => 1,
    );
    if (isset($form['field_mc_banner'])) {
      $form['tabs']['design']['field_mc_banner'] = $form['field_mc_banner'];
      $form['tabs']['design']['field_mc_banner']['#weight'] = 2;
      unset($form['field_mc_banner']);
    }
    if (isset($form['field_mc_logo'])) {
      $form['tabs']['design']['field_mc_logo'] = $form['field_mc_logo'];
      $form['tabs']['design']['field_mc_logo']['#weight'] = 3;
      unset($form['field_mc_logo']);
    }
    if (isset($form['field_mc_profile_pic'])) {
      $form['tabs']['design']['field_mc_profile_pic'] = $form['field_mc_profile_pic'];
      $form['tabs']['design']['field_mc_profile_pic']['#weight'] = 4;
      unset($form['field_mc_profile_pic']);
    }
  }
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => $is_new ? t('Next') : t('Finish'),
    '#attributes' => array(
      'class' => array('button small'),
    ),
  );
  if (!$is_new) {
    $form['actions']['save_edit'] = array(
      '#type' => 'submit',
      '#value' => t('Save & Continue'),
      '#weight' => -1,
      '#name' => 'save_edit',
      '#attributes' => array(
        'class' => array('button small'),
      ),
    );
  }
  return $form;
}
function cm_list_form_submit(&$form, &$form_state) {
  $values = $form_state['values'];
  $client = $form_state['cm_client'];
  $list = $form_state['cm_list'];
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
    $query_string = array();
    $query_parameters = drupal_get_query_parameters();
    if (!empty($query_parameters)) {
      foreach ($query_parameters as $key => $value) {
        $query_string[$key] = $value;
      }
    }
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
          $list->from_name = $values['from_name'];
          $list->from_email = $values['from_email'];
          $list->reply_to = $values['reply_to'];
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
    if ($form_state['clicked_button']['#name'] == 'save_edit') {
      $redirect = url('cm-list/' . entity_id('cm_list', $list) . '/edit', array('query' => $query_string, 'absolute' => TRUE));
      unset($_GET['destination']);
    }
    else {
      $redirect = 'cm-client/' . $list->cid . '/lists';
    }
    $form_state['redirect'] = $redirect;
  }
}

/**
 * Delete confirmation form.
 */
function cm_list_delete_form($form, &$form_state, $cm_list) {
  $form_state['cm_list'] = $cm_list;
  // Always provide entity id in the same form key as in the entity edit form.
  //$form['list_id'] = array('#type' => 'value', '#value' => entity_id('cm_list', $cm_list));
  $list_uri = entity_uri('cm_list', $cm_list);
  return confirm_form($form,
    t('Are you sure you want to delete list %title?', array('%title' => entity_label('cm_list', $cm_list))),
    $list_uri['path'],
    t('This action cannot be undone.'),
    t('Delete'),
    t('Cancel')
  );
}
/**
 * Delete form submit handler.
 */
function cm_list_delete_form_submit($form, &$form_state) {
  $list = $form_state['cm_list'];
  $cid = $list->cid;
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
  $redirect = 'cm-client/' . $cid . '/lists';
  if ($wrap) {
    $result = $wrap->delete();
    // Delete our entity if list could be deleted on CM or the list id couldn't be found.
    if ($result->was_successful() || $result->response->Code == 101) {
      cm_list_delete($list);
      drupal_set_message(t('List %title deleted.', array('%title' => entity_label('cm_list', $list))));
    }
    else {
      $error = $result->response->Message;
      if ($result->response->Code == 252) {
      }
      $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }

  $form_state['redirect'] = $redirect;
}
