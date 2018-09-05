<?php

/**
 * @file
 * Campaign Monitor campaigns module admin settings.
 */

/*
 * Campaign entity form.
 */
function cm_campaign_form($form, &$form_state, $campaign = NULL, $list = NULL) {
  global $user;
  if (!isset($campaign->id)) {
    $campaign = entity_create('cm_campaign', array(
      'lid' => $list->id,
      'uid' => $user->uid,
      'list_id' => $list->list_id,
    ));
  }
  //$data = isset($cm_list->id) ? $cm_list->list_data : array();
  $is_new = isset($campaign->is_new) ? TRUE : FALSE;
  $tabs_type = 'container';
  if (!$is_new) {
    $title = entity_label('cm_campaign', $campaign);
    $tabs_type = 'horizontal_tabs';
    $list = cm_list_load($campaign->lid);
  }
  else {
    $title = 'Create campaign';
  }
  drupal_set_title($title);
  $form_state['cm_list'] = $list;
  $form_state['cm_campaign'] = $campaign;
  $form['tabs'] = array(
    '#type' => $tabs_type,
  );
  $form['tabs']['settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Settings'),
  );
  $form['tabs']['settings']['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Name this campaign'),
    '#description' => t('The campaign name is shown in your reports and your email archive.'),
    '#required' => TRUE,
    '#default_value' => isset($campaign->name) ? $campaign->name : '',
  );
  $form['tabs']['settings']['subject'] = array(
    '#type' => 'textfield',
    '#title' => t('Write a subject line'),
    '#description' => t('This text will display in the Subject field in your recipient\'s email client.'),
    '#required' => TRUE,
    '#default_value' => isset($campaign->subject) ? $campaign->subject : '',
  );
  $form['tabs']['settings']['from_name'] = array(
    '#type' => 'textfield',
    '#title' => t('From name'),
    '#description' => t('This is who your emails will come from. Use something they\'ll instantly recognize, like your company name.'),
    '#default_value' => isset($campaign->from_name) ? $campaign->from_name : '',
    '#required' => TRUE,
  );
  $form['tabs']['settings']['from_email'] = array(
    '#type' => 'textfield',
    '#title' => t('From e-mail'),
    '#description' => t('This is the e-mail address your campaigns will come from.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => isset($campaign->from_email) ? $campaign->from_email : '',
    '#required' => TRUE,
  );
  $form['tabs']['settings']['reply_to'] = array(
    '#type' => 'textfield',
    '#title' => t('Replies should be sent to'),
    '#description' => t('Enter a valid email address that replies will be sent to.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => isset($campaign->reply_to) ? $campaign->reply_to : '',
    '#required' => TRUE,
  );
  // Attach field api fields.
  if (!$is_new) {
    field_attach_form('cm_campaign', $campaign, $form, $form_state);
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
  if ($is_new || !$is_new && $campaign->status == 'Design') {
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $is_new ? t('Next') : t('Save'),
      '#attributes' => array(
        'class' => array('button small'),
      ),
    );
  }
  return $form;
}
function cm_campaign_form_submit(&$form, &$form_state) {
  $values = $form_state['values'];
  $list = $form_state['cm_list'];
  $campaign = $form_state['cm_campaign'];
  $client = cm_client_load($list->cid);
  if (isset($campaign->is_new)) {
    $campaign->lid = $list->id;
    $campaign->list_id = $list->list_id;
    $campaign->name = $values['name'];
    $campaign->subject = $values['subject'];
    $campaign->from_name = $values['from_name'];
    $campaign->from_email = $values['from_email'];
    $campaign->reply_to = $values['reply_to'];
    $campaign->status = 'Design';
    $campaign->save();
    $form_state['redirect'] = 'cm-campaign/' . entity_id('cm_campaign', $campaign) . '/edit';
  }
  elseif ($campaign->status == 'Design') {
    $wrap = campaign_monitor_get_api_object('CS_REST_Campaigns', NULL);
    $html_url = $GLOBALS['base_url'] . '/cm-campaign/' . entity_id('cm_campaign', $campaign) . '/raw';
    if ($wrap) {
      $result = $wrap->create($client->client_id, array(
        'Subject' => $values['subject'],
        'Name' => $values['name'],
        'FromName' => $values['from_name'],
        'FromEmail' => $values['from_email'],
        'ReplyTo' => $values['reply_to'],
        'HtmlUrl' => $html_url,
        'ListIDs' => array($campaign->list_id),
      ));
      if ($result->was_successful()) {
        $campaign->campaign_id = $result->response;
        $campaign->status = 'Draft';
        $campaign->save();
      }
      else {
        $error = $result->response->Message;
        $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
        drupal_set_message($message, 'error');
      }
    }
  }
  /*
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
          $list->list_data['defaults'] = $values['defaults'];
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
  }*/
}

/**
 * Delete confirmation form.
 */
function cm_campaign_delete_form($form, &$form_state, $campaign) {
  $form_state['cm_campaign'] = $campaign;
  // Always provide entity id in the same form key as in the entity edit form.
  //$form['list_id'] = array('#type' => 'value', '#value' => entity_id('cm_list', $cm_list));
  $campaign_uri = entity_uri('cm_campaign', $campaign);
  return confirm_form($form,
    t('Are you sure you want to delete campaign %title?', array('%title' => entity_label('cm_campaign', $campaign))),
    $campaign_uri['path'],
    t('This action cannot be undone.'),
    t('Delete'),
    t('Cancel')
  );
}
/**
 * Delete form submit handler.
 */
function cm_campaign_delete_form_submit($form, &$form_state) {
  $campaign = $form_state['cm_campaign'];
  $lid = $campaign->lid;
  $redirect = 'cm-list/' . $lid . '/campaigns';
  $wrap = campaign_monitor_get_api_object('CS_REST_Campaigns', $campaign->campaign_id);
  if ($wrap) {
    $result = $wrap->delete();
    // Delete our entity if list could be deleted on CM or the campaign id couldn't be found.
    if ($result->was_successful() || $result->response->Code == 101) {
      cm_campaign_delete($campaign);
      drupal_set_message(t('Campaign %title deleted.', array('%title' => entity_label('cm_campaign', $campaign))));
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

/**
 * Campaign Send form.
 */
function cm_campaign_send_form($form, &$form_state, $campaign) {
  $form['send_options'] = array(
    '#type' => 'radios',
    '#title' => t('Sending options'),
    '#options' => array(
      1 => t('Send immediately'),
      2 => t('Schedule for specific date and time'),
    ),
  );
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
    '#attributes' => array(
      'class' => array('button small'),
    ),
  );
  return $form;
}
