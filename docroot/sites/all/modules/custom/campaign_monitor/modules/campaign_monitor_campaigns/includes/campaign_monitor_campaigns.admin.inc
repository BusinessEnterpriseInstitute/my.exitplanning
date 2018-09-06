<?php

/**
 * @file
 * Campaign Monitor campaigns module admin settings.
 */

/*
 * Campaign entity form.
 */
function cm_campaign_form($form, &$form_state, $campaign = NULL, $list = NULL) {
  if (!isset($campaign->id)) {
    $campaign = entity_create('cm_campaign', array(
      'lid' => $list->id,
      'uid' => $list->uid,
      'list_id' => $list->list_id,
      'client_id' => $list->client_id,
      'status' => 'Design',
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
  /*
  $form['tabs']['settings']['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Name this campaign'),
    '#description' => t('The campaign name is shown in your reports and your email archive.'),
    '#required' => TRUE,
    '#default_value' => isset($campaign->name) ? $campaign->name : '',
  );*/
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
    '#default_value' => $is_new ? $list->from_name : $campaign->from_name,
    '#required' => TRUE,
  );
  $form['tabs']['settings']['from_email'] = array(
    '#type' => 'textfield',
    '#title' => t('From e-mail'),
    '#description' => t('This is the e-mail address your campaigns will come from.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => $is_new ? $list->from_email : $campaign->from_email,
    '#required' => TRUE,
  );
  $form['tabs']['settings']['reply_to'] = array(
    '#type' => 'textfield',
    '#title' => t('Replies should be sent to'),
    '#description' => t('Enter a valid email address that replies will be sent to.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => $is_new ? $list->reply_to : $campaign->reply_to,
    '#required' => TRUE,
  );
  $form['tabs']['settings']['article_reference'] = array(
    '#type' => 'textfield',
    '#title' => t('Newsletter Reference'),
    '#description' => t('Choose an article from our database'),
    '#autocomplete_path' => 'campaign-monitor/newsletter-autocomplete'
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
      '#value' => $is_new ? t('Next') : t('Finish'),
      '#attributes' => array(
        'class' => array('button small'),
      ),
    );
  }
  if (!$is_new && $campaign->status == 'Design') {
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
function cm_campaign_form_submit(&$form, &$form_state) {
  $values = $form_state['values'];
  $list = $form_state['cm_list'];
  $campaign = $form_state['cm_campaign'];
  if (isset($campaign->is_new)) {
    //$campaign->lid = $list->id;
    //$campaign->list_id = $list->list_id;
    //$campaign->status = 'Design';
    $campaign->save();
    // Set a unique campaign name now.
    $campaign->name = 'Campaign ' . entity_id('cm_campaign', $campaign);
    $redirect = 'cm-campaign/' . entity_id('cm_campaign', $campaign) . '/edit';
  }
  else {
    $query_string = array();
    $query_parameters = drupal_get_query_parameters();
    if (!empty($query_parameters)) {
      foreach ($query_parameters as $key => $value) {
        $query_string[$key] = $value;
      }
    }
    if ($form_state['clicked_button']['#name'] == 'save_edit') {
      $redirect = url('cm-campaign/' . entity_id('cm_campaign', $campaign) . '/edit', array('query' => $query_string, 'absolute' => TRUE));
      unset($_GET['destination']);
    }
    else {
      $redirect = 'cm-list/' . entity_id('cm_list', $list) . '/campaigns';
    }
  }
  $campaign->subject = $values['subject'];
  $campaign->from_name = $values['from_name'];
  $campaign->from_email = $values['from_email'];
  $campaign->reply_to = $values['reply_to'];
  field_attach_submit('cm_campaign', $campaign, $form, $form_state);
  $campaign->save();
  $form_state['redirect'] = $redirect;
  /*
  elseif ($campaign->status == 'Design') {
    $wrap = campaign_monitor_get_api_object('CS_REST_Campaigns', NULL);
    $html_url = $GLOBALS['base_url'] . '/cm-campaign/' . entity_id('cm_campaign', $campaign) . '/raw';
    if ($wrap) {
      $result = $wrap->create($client->client_id, array(
        'Subject' => $values['subject'],
        'Name' => entity_label('cm_campaign', $campaign),
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
    // Delete our entity if campaign could be deleted on CM or the campaign id couldn't be found.
    if ($result->was_successful() || $result->response->Code == 404) {
      cm_campaign_delete($campaign);
      drupal_set_message(t('Campaign %title deleted.', array('%title' => entity_label('cm_campaign', $campaign))));
    }
    else {
      $error = $result->response->Message;
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
  $form['#prefix'] = '<div id="send-form-wrapper">';
  $form['#suffix'] = '</div>';
  $values = !empty($form_state['values']) ? $form_state['values'] : NULL;
  $list = cm_list_load($campaign->lid);
  $form_state['cm_campaign'] = $campaign;
  $form_state['cm_list'] = $list;
  $form['send_options'] = array(
    '#type' => 'radios',
    '#title' => t('Sending options'),
    '#options' => array(
      1 => t('Send immediately'),
      2 => t('Schedule for specific date and time'),
    ),
    '#default_value' => $values ? $values['send_options'] : NULL,
    '#required' => TRUE,
    '#ajax' => array(
      'event' => 'change',
      'wrapper' => 'send-form-wrapper',
      'callback' => 'cm_campaign_send_form_refresh',
    ),
  );
  if ($values) {
    if ($values['send_options'] == 2) {
      $form['send_date'] = array(
        '#type' => 'date_popup',
        '#date_format' => 'Y-m-d h:i:sa',
        '#date_year_range' => '0:+1',
        '#date_timezone' => date_default_timezone(),
        '#title' => t('Schedule Date'),
        '#description' => t('Choose a time in which this campaign should be sent.'),
        '#default_value' => '',
        '#element_validate' => array('campaign_monitor_campaigns_schedule_date_validate'),
        '#datepicker_options' => array('minDate' => 0),
        '#date_increment' => 15,
        '#required' => TRUE,
      );
    }
    $form['actions'] = array(
      '#type' => 'actions',
    );
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $values['send_options'] == 1 ? t('Send') : t('Schedule'),
    );
  }
  return $form;
}
/**
 * Ajax callback.
 */
function cm_campaign_send_form_refresh($form, $form_state) {
  return $form;
}
function cm_campaign_send_form_submit($form, &$form_state) {
  $campaign = $form_state['cm_campaign'];
  $list = $form_state['cm_list'];
  $values = $form_state['values'];
  $send_option = $values['send_options'];
  $campaign_id = !empty($campaign->campaign_id) ? $campaign->campaign_id : NULL;
  if ($send_option == 2) {
    $date = new DateTime($values['send_date'], new DateTimeZone('America/Denver'));
    $schedule_date = $date->format('Y-m-d H:i');
  }
  else {
    $schedule_date = 'Immediately';
  }
  // First create a draft campaign.
  if (!$campaign_id) {
    $wrap = campaign_monitor_get_api_object('CS_REST_Campaigns', NULL);
    $html_url = $GLOBALS['base_url'] . '/cm-campaign/' . entity_id('cm_campaign', $campaign) . '/raw';
    if ($wrap) {
      $result = $wrap->create($campaign->client_id, array(
        'Subject' => $campaign->subject,
        'Name' => entity_label('cm_campaign', $campaign),
        'FromName' => $campaign->from_name,
        'FromEmail' => $campaign->from_email,
        'ReplyTo' => $campaign->reply_to,
        'HtmlUrl' => $html_url,
        'ListIDs' => array($campaign->list_id),
      ));
      if ($result->was_successful()) {
        $campaign_id = $result->response;
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
  if ($campaign_id) {
    $wrap = campaign_monitor_get_api_object('CS_REST_Campaigns', $campaign_id);
    $result = $wrap->send(array(
      'ConfirmationEmail' => 'amarquis@exitplanning.com',
      'SendDate' => $schedule_date,
    ));
    if ($result->was_successful()) {
      $new_status = $send_option == 1 ? 'Sent' : 'Scheduled';
      $campaign->status = $new_status;
      $campaign->send_date = $send_option == 1 ? REQUEST_TIME : strtotime($schedule_date);
      $campaign->save();
    }
    else {
      $error = $result->response->Message;
      $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }
  $form_state['redirect'] = 'cm-list/' . entity_id('cm_list', $list) . '/campaigns';
}
/**
 * Helper function to ensure schedule date is not in the past.
 */
function campaign_monitor_campaigns_schedule_date_validate($element, &$form_state, $form) {
  $now = strtotime('now');
  $schedule_date = strtotime($element['#value']['date'] . ' ' . $element['#value']['time']);
  if ($schedule_date <= $now) {
    form_error($element, t($element['#title'] . '  must be in the future.'));
  }
}
