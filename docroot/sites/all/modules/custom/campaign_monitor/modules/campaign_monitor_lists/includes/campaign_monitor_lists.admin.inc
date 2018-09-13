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
            $author = user_load($client->uid);
            $cm_list = entity_create('cm_list', array(
              'cid' => $client->id,
              'client_id' => $client->client_id,
              'uid' => $client->uid,
              'list_id' => $list->ListID,
              'title' => $list->Title,
              'from_name' => $author->realname,
              'from_email' => $author->mail,
              'reply_to' => $author->mail,
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
  $is_administrator = user_access('administer campaign monitor');
  if (!isset($list->id)) {
    $author = user_load($client->uid);
    $list = entity_create('cm_list', array(
      'title' => entity_label('cm_client', $client) . ' Newsletter',
      'cid' => $client->id,
      'client_id' => $client->client_id,
      'uid' => $client->uid,
      'from_name' => $author->realname,
      'from_email' => $author->mail,
      'reply_to' => $author->mail,
    ));
  }
  else {
    $author = user_load($list->uid);
    $client = cm_client_load($list->cid);
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
  // Settings tab.
  $form['tabs']['settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Settings'),
    '#weight' => 1,
  );
  $form['tabs']['settings']['title'] = array(
    '#type' => 'textfield',
    '#title' => t('List Name'),
    '#required' => TRUE,
    '#default_value' => isset($list->title) ? $list->title : '',
  );
  $form['tabs']['settings']['manage_campaigns'] = array(
    '#type' => 'checkbox',
    '#title' => t('Manage Campaigns'),
    '#description' => t('Check this box if you prefer to create and send your own campaigns. Otherwise, BEI
                        will select a unique article from our Newsletter library and send campaigns for you bi-weekly
                        based on a template comprised of the design elements from this list.'),
    '#default_value' => $list->manage_campaigns,
  );
  $form['tabs']['settings']['confirmed_opt_in'] = array(
    '#type' => 'checkbox',
    '#title' => t('Confirmed opt in'),
    '#default_value' => $list->confirmed_opt_in,
    '#description' => t('Require new subscribers to opt in via e-mail before being added to the list.'),
  );
  $form['tabs']['settings']['unsubscribe_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Unsubscribe settings'),
  );
  $form['tabs']['settings']['unsubscribe_settings']['unsubscribe_setting'] = array(
    '#type' => 'radios',
    '#title' => t('When someone unsubscribes from this list...'),
    '#description' => t('To make sure you don\'t risk sending an email to someone who has previously unsubscribed, we
                        recommend removing them from all lists.'),
    '#options' => array(
      'AllClientLists' => t('Remove them from all @client lists (recommended)', array('@client' => entity_label('cm_client', $client))),
      'OnlyThisList' => t('Only remove them from this list'),
    ),
    '#default_value' => $list->unsubscribe_setting,
    '#required' => TRUE,
  );
  $form['tabs']['settings']['unsubscribe_settings']['unsubscribe_page'] = array(
    '#type' => 'textfield',
    '#title' => t('Unsubscribe page'),
    '#default_value' => $list->unsubscribe_page,
    '#description' => t('What web page would you like to be displayed after someone clicks an unsubscribe link in your email?
                        If you don\'t specify a page, a generic confirmation page will be displayed to the subscriber.')
  );
  /* This appears to only be effective when using an embedded campaign monitor subscribe form. We will pass an empty value for now.
  $form['tabs']['settings']['confirmation_success_page'] = array(
    '#type' => 'textfield',
    '#title' => t('Confirmation success page'),
    '#default_value' => isset($data['details']->ConfirmationSuccessPage) ? $data['details']->ConfirmationSuccessPage : '',
    '#description' => t(''),
  );*/
  // Defaults tab.
  $form['tabs']['defaults'] = array(
    '#type' => 'fieldset',
    '#title' => t('Campaign Defaults'),
    '#weight' => $is_new ? 2 : -11,
  );
  // Only allow administrators to set author.
  if ($is_administrator) {
    $form['tabs']['defaults']['author'] = array(
      '#type' => 'textfield',
      '#title' => t('Authored by'),
      '#maxlength' => 60,
      '#autocomplete_path' => 'user/autocomplete',
      '#default_value' => $author->name,
      '#required' => TRUE,
    );
  }
  $form['tabs']['defaults']['from_name'] = array(
    '#type' => 'textfield',
    '#title' => t('From name'),
    '#description' => t('This is who your emails will come from. Use something they\'ll instantly recognize, like your company name.'),
    '#default_value' => $list->from_name,
    '#required' => TRUE,
  );
  $form['tabs']['defaults']['from_email'] = array(
    '#type' => 'textfield',
    '#title' => t('From e-mail'),
    '#description' => t('This is the e-mail address your campaigns will come from.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => $list->from_email,
    '#required' => TRUE,
  );
  $form['tabs']['defaults']['reply_to'] = array(
    '#type' => 'textfield',
    '#title' => t('Replies should be sent to'),
    '#description' => t('Enter a valid email address that replies will be sent to.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => $list->reply_to,
    '#required' => TRUE,
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
    // Design tab.
    $form['tabs']['design'] = array(
      '#type' => 'fieldset',
      '#title' => t('Campaign Template'),
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
      '#weight' => -9,
    );
    // Banner region.
    $form['tabs']['design']['banner_region'] = array(
      '#type' => 'fieldset',
      '#title' => t('Banner region'),
      '#weight' => 3,
    );
    $form['tabs']['design']['banner_region']['banner_region_status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#default_value' => $list->banner_region_status,
      '#weight' => 1,
    );
    $form['tabs']['design']['banner_region']['banner_wrapper'] = array(
      '#type' => 'container',
      '#weight' => 2,
      '#states' => array(
        'visible' => array(
          ':input[name="banner_region_status"]' => array('checked' => TRUE),
        ),
      ),
    );
    if (isset($form['field_mc_banner'])) {
      $form['tabs']['design']['banner_region']['banner_wrapper']['field_mc_banner'] = $form['field_mc_banner'];
      $form['tabs']['design']['banner_region']['banner_wrapper']['field_mc_banner']['#weight'] = 2;
      unset($form['field_mc_banner']);
    }
    // Logo region.
    $form['tabs']['design']['logo_region'] = array(
      '#type' => 'fieldset',
      '#title' => t('Logo region'),
      '#weight' => 3,
    );
    $form['tabs']['design']['logo_region']['logo_region_status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#default_value' => $list->logo_region_status,
      '#weight' => 1,
    );
    $form['tabs']['design']['logo_region']['logo_wrapper'] = array(
      '#type' => 'container',
      '#weight' => 2,
      '#states' => array(
        'visible' => array(
          ':input[name="logo_region_status"]' => array('checked' => TRUE),
        ),
      ),
    );
    if (isset($form['field_mc_logo'])) {
      $form['tabs']['design']['logo_region']['logo_wrapper']['field_mc_logo'] = $form['field_mc_logo'];
      $form['tabs']['design']['logo_region']['logo_wrapper']['field_mc_logo']['#weight'] = 2;
      unset($form['field_mc_logo']);
    }
    $form['tabs']['design']['logo_region']['logo_wrapper']['logo_background_color'] = array(
      '#type' => 'colorfield_picker',
      '#title' => t('Logo Background Color'),
      '#description' => t('This field allows you to customize the background color of the logo region in your template.
                          If left blank, your newsletter template will inherit the color defined in profile
                          settings under Branding Options.'),
      '#default_value' => array(
        'colorfield_picker' => !empty($list->logo_background_color) ? $list->logo_background_color : '#FFFFFF',
      ),
      '#element_validate' => array('campaign_monitor_color_validate'),
      '#weight' => 3,
    );
    // Profile region.
    $form['tabs']['design']['profile_region'] = array(
      '#type' => 'fieldset',
      '#title' => t('Profile region'),
      '#weight' => 4,
    );
    $form['tabs']['design']['profile_region']['profile_region_status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#default_value' => $list->profile_region_status,
      '#weight' => 1,
    );
    $form['tabs']['design']['profile_region']['profile_wrapper'] = array(
      '#type' => 'container',
      '#weight' => 2,
      '#states' => array(
        'visible' => array(
          ':input[name="profile_region_status"]' => array('checked' => TRUE),
        ),
      ),
    );
    if (isset($form['field_mc_profile_pic'])) {
      $form['tabs']['design']['profile_region']['profile_wrapper']['field_mc_profile_pic'] = $form['field_mc_profile_pic'];
      $form['tabs']['design']['profile_region']['profile_wrapper']['field_mc_profile_pic']['#weight'] = 5;
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
/**
 * Implements hook_validate().
 *
 * Performs validation checks on the given list.
 */
function cm_list_form_validate($form, &$form_state) {
  $values = $form_state['values'];
  // Validate the "authored by" field.
  if (!empty($values['author'])) {
    if (!($account = user_load_by_name($values['author']))) {
      form_set_error('author', t('The username %name does not exist.', array('%name' => $values['author'])));
    }
    else {
      $form_state['author_loaded'] = user_load_by_name($values['author']);
    }
  }
}
function cm_list_form_submit(&$form, &$form_state) {
  $values = $form_state['values'];
  $client = $form_state['cm_client'];
  $list = $form_state['cm_list'];
  $author = $form_state['author_loaded'];
  dpm($author);
  /*
  if (!empty($values['author'])) {
    if ($account = user_load_by_name($values['author'])) {
      $list->uid = $account->uid;
    }
  }
  if (isset($list->is_new)) {
    $cm = campaign_monitor_get_api_object('CS_REST_Lists', NULL);
    if ($cm) {
      $result = $cm->create($client->client_id, array(
        'Title' => $values['title'],
        'UnsubscribeSetting' => $values['unsubscribe_setting'],
        'UnsubscribePage' => $values['unsubscribe_page'],
        'ConfirmationSuccessPage' => '', // Change to submitted value later if using. @see form element comment.
        'ConfirmedOptIn' => $values['confirmed_opt_in'],
      ));
      if ($result->was_successful()) {
        $id = $result->response;
        $list_api = campaign_monitor_get_api_object('CS_REST_Lists', $id);
        if ($list_api) {
          $list_result = $list_api->get();
          if ($list_result->was_successful()) {
            $list->manage_campaigns = $values['manage_campaigns'];
            $list->list_id = $id;
            $list->title = $values['title'];
            $list->confirmed_opt_in = $values['confirmed_opt_in'];
            $list->unsubscribe_page = $values['unsubscribe_page'];
            $list->unsubscribe_setting = $values['unsubscribe_setting'];
            $list->confirmation_success_page = $values['confirmation_success_page'];
            //field_attach_submit('cm_list', $list, $form, $form_state);
            $list_id = $list->save();
            // Now create the webhook.
            $webhook_settings = array(
              'Events' => array(CS_REST_LIST_WEBHOOK_SUBSCRIBE, CS_REST_LIST_WEBHOOK_DEACTIVATE, CS_REST_LIST_WEBHOOK_UPDATE),
              'Url' => campaign_monitor_webhook_url(),
              'PayLoadFormat' => CS_REST_WEBHOOK_FORMAT_JSON,
            );
            $webhook_create = $list_api->create_webhook($webhook_settings);
            if ($webhook_create->was_successful()) {
              $webhook_entity = entity_create('cm_webhook', array(
                'lid' => $list_id,
                'webhook_id' => $webhook_create->response,
                'url' => campaign_monitor_webhook_url(),
                'status' => 'Active',
                'events' => serialize($webhook_settings['Events']),
                'payload_format' => CS_REST_WEBHOOK_FORMAT_JSON,
              ));
              $webhook_entity->save();
            }
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
    $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
    if ($wrap) {
      $result = $wrap->update(array(
        'Title' => $values['title'],
        'UnsubscribeSetting' => $values['unsubscribe_setting'],
        'UnsubscribePage' => $values['unsubscribe_page'],
        'ConfirmationSuccessPage' => '', // Change to submitted value later if using. @see form element comment.
        'ConfirmedOptIn' => $values['confirmed_opt_in'],
      ));
      if ($result->was_successful()) {
        $list_result = $cm->get();
        if ($list_result->was_successful()) {
          $list->title = $values['title'];
          $list->from_name = $values['from_name'];
          $list->from_email = $values['from_email'];
          $list->reply_to = $values['reply_to'];
          $list->manage_campaigns = $values['manage_campaigns'];
          $list->background_color = $values['background_color']['colorfield_picker'];
          $list->logo_background_color = $values['logo_background_color']['colorfield_picker'];
          $list->logo_region_status = $values['logo_region_status'];
          $list->banner_region_status = $values['banner_region_status'];
          $list->profile_region_status = $values['profile_region_status'];
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
  }*/
}

/**
 * Delete confirmation form.
 */
function cm_list_delete_form($form, &$form_state, $cm_list) {
  $form_state['cm_list'] = $cm_list;
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
      $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }

  $form_state['redirect'] = $redirect;
}
/*
 * Webhook entity add form.
 */
function cm_webhook_add_form($form, &$form_state, $list) {
  $is_new = isset($webhook->is_new) || !isset($webhook->id);
  $form_state['cm_list'] = $list;
  $form['events'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Events'),
    '#options' => array(
      'Subscribe' => t('Subscribe'),
      'Deactivate' => t('Deactivate'),
      'Update' => t('Update'),
    ),
    '#required' => TRUE,
  );
  $form['payload_format'] = array(
    '#type' => 'radios',
    '#title' => t('Payload Format'),
    '#options' => array(
      'json' => t('json'),
      'xml' => t('xml'),
    ),
    '#required' => TRUE,
  );
  $form['url_option'] = array(
    '#type' => 'radios',
    '#title' => t('URL Location'),
    '#options' => array(
      0 => t('This site'),
      1 => t('Custom'),
    ),
    '#required' => TRUE,
    '#default_value' => FALSE,
  );
  $form['url'] = array(
    '#type' => 'textfield',
    '#title' => t('Custom URL'),
    '#attributes' => array(
      'placeholder' => t('e.g. http://www.mysite.com/webhook-receiver-page'),
    ),
    '#states' => array(
      'visible' => array(
        ':input[name="url_option"]' => array('value' => '1'),
      ),
    ),
  );
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );
  return $form;
}
function cm_webhook_add_form_submit(&$form, &$form_state) {
  $list = $form_state['cm_list'];
  $values = $form_state['values'];
  $url = empty($values['url_option']) ? campaign_monitor_webhook_url() : $values['url'];
  $events = array();
  foreach ($values['events'] as $event) {
    if (!empty($event)) {
      $events[] = $event;
    }
  }
  $webhook_settings = array(
    'Events' => $events,
    'Url' => $url,
    'PayLoadFormat' => $values['payload_format'],
  );
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
  $result = $wrap->create_webhook($webhook_settings);
  if ($result->was_successful()) {
    $webhook_entity = entity_create('cm_webhook', array(
      'lid' => entity_id('cm_list', $list),
      'status' => 'Active',
      'webhook_id' => $result->response,
      'url' => $url,
      'payload_format' => $values['payload_format'],
      'events' => $events,
    ));
    $webhook_entity->save();
    $message = t('Added new webhook with id: %id to %list', array('%id' => $result->response, '%list' => entity_label('cm_list', $list)));
    drupal_set_message($message);
  }
  else {
    $error = $result->response->Message;
    $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
    drupal_set_message($message, 'error');
  }
  $form_state['redirect'] = 'cm-list/' . entity_id('cm_list', $list) . '/webhooks';
}
/**
 * Webhook delete confirmation form.
 */
function cm_webhook_delete_form($form, &$form_state, $webhook) {
  $form_state['cm_webhook'] = $webhook;
  $list = cm_list_load($webhook->lid);
  $form_state['cm_list'] = $list;
  $cancel_uri = 'cm-list/' . entity_id('cm_list', $list) . '/webhooks';
  return confirm_form($form,
    t('Are you sure you want to delete webhook id: %id?', array('%id' => entity_label('cm_webhook', $webhook))),
    $cancel_uri,
    t('This action cannot be undone.'),
    t('Delete'),
    t('Cancel')
  );
}
/**
 * Delete form submit handler.
 */
function cm_webhook_delete_form_submit($form, &$form_state) {
  $webhook = $form_state['cm_webhook'];
  $list = $form_state['cm_list'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
  if ($wrap) {
    $result = $wrap->delete_webhook($webhook->webhook_id);
    // Delete our entity if list could be deleted on CM or the webhook couldn't be found.
    if ($result->was_successful() || $result->response->Code == 699) {
      entity_delete('cm_webhook', entity_id('cm_webhook', $webhook));
      drupal_set_message(t('Webhook id: %id deleted.', array('%id' => entity_label('cm_webhook', $webhook))));
    }
    else {
      $error = $result->response->Message;
      $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }
  $form_state['redirect'] = 'cm-list/' . entity_id('cm_list', $list) . '/webhooks';
}
// Test a webhook
function campaign_monitor_lists_webhook_test($webhook) {
  $list = cm_list_load($webhook->lid);
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
  $result = $wrap->test_webhook($webhook->webhook_id);
  if ($result->was_successful()) {
    drupal_set_message(t('Webhook id: %id successfully processed!', array('%id' => $webhook->webhook_id)));
  }
  else {
    $error = $result->response->Message;
    $message = t('Webhook failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
    drupal_set_message($message, 'error');
  }
  drupal_goto();
}
// Deactivate a webhook
function campaign_monitor_lists_webhook_deactivate($webhook) {
  $list = cm_list_load($webhook->lid);
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
  $result = $wrap->deactivate_webhook($webhook->webhook_id);
  if ($result->was_successful()) {
    $webhook->status = 'Inactive';
    $webhook->save();
    $message = t('Deactivated webhook id: @id for %list.', array('@id' => $webhook->webhook_id, '%list' => entity_label('cm_list', $list)));
    drupal_set_message($message);
  }
  else {
    $error = $result->response->Message;
    $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
    drupal_set_message($message, 'error');
  }
  drupal_goto();
}
// Activate a webhook
function campaign_monitor_lists_webhook_activate($webhook) {
  $list = cm_list_load($webhook->lid);
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
  $result = $wrap->activate_webhook($webhook->webhook_id);
  if ($result->was_successful()) {
    $webhook->status = 'Active';
    $webhook->save();
    $message = t('Activated webhook id: @id for %list.', array('@id' => $webhook->webhook_id, '%list' => entity_label('cm_list', $list)));
    drupal_set_message($message);
  }
  else {
    $error = $result->response->Message;
    $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
    drupal_set_message($message, 'error');
  }
  drupal_goto();
}

/**
 * Menu callback to run webhook actions from Campaign Monitor.
 */
function campaign_monitor_lists_webhook_callback() {
  $data = json_decode(file_get_contents('php://input'));
  // The campaign_monitor_subscribers module must be enabled.
  if (!module_exists('campaign_monitor_subscribers')) {
    return "BEI List Webhook Endpoint.";
  }
  if (empty($data)) {
    return "BEI List Webhook Endpoint.";
  }
  $events = $data->Events;
  $list_id = $data->ListID;
  foreach ($events as $event) {
    $type = $event->Type;
    switch ($type) {
      case 'update':
        break;
    }
    // Log event:
    watchdog('campaign_monitor', 'Webhook type @type has been processed for list id: %list.', array('@type' => $type, '%list' => $list_id), WATCHDOG_INFO);
  }
  return NULL;
}
