<?php

/**
 * @file
 * Campaign Monitor campaigns module admin settings.
 */

/*
 * Campaign entity form.
 */
function cm_campaign_form($form, &$form_state, $campaign = NULL, $list = NULL) {
  $is_new = isset($campaign->is_new) || !isset($campaign->id) ? TRUE : FALSE;
  $disabled = $is_new || empty($campaign->campaign_status) ? FALSE : TRUE;
  if ($is_new) {
    $title = 'Create campaign';
    $tabs_type = 'container';
    $campaign = entity_create('cm_campaign', array(
      'lid' => $list->id,
      'uid' => $list->uid,
      'list_id' => $list->list_id,
      'client_id' => $list->client_id,
      'subject' => '',
      'from_name' => $list->from_name,
      'from_email' => $list->from_email,
      'reply_to' => $list->reply_to,
    ));
  }
  else {
    $title = entity_label('cm_campaign', $campaign);
    $tabs_type = 'horizontal_tabs';
    $list = cm_list_load($campaign->lid);
  }
  drupal_set_title($title);
  $form_state['cm_list'] = $list;
  $form_state['cm_campaign'] = $campaign;
  $form['tabs'] = array(
    '#type' => $tabs_type,
    '#disabled' => $disabled,
  );
  if ($is_new) {
    $form['tabs']['content'] = array(
      '#type' => 'container',
    );
    $form['tabs']['content']['email_settings'] = array(
      '#type' => 'container',
    );
  }
  else {
    $form['tabs']['content'] = array(
      '#type' => 'fieldset',
      '#title' => t('Content'),
    );
    $form['tabs']['content']['email_settings'] = array(
      '#type' => 'fieldset',
      '#title' => t('E-mail Settings'),
    );
  }
  $form['tabs']['content']['email_settings']['from_name'] = array(
    '#type' => 'textfield',
    '#title' => t('From name'),
    '#description' => t('This is who your emails will come from. Use something they\'ll instantly recognize, like your company name.'),
    '#default_value' => $campaign->from_name,
    '#required' => TRUE,
  );
  $form['tabs']['content']['email_settings']['from_email'] = array(
    '#type' => 'textfield',
    '#title' => t('From e-mail'),
    '#description' => t('This is the e-mail address your campaigns will come from.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => $campaign->from_email,
    '#required' => TRUE,
  );
  $form['tabs']['content']['email_settings']['reply_to'] = array(
    '#type' => 'textfield',
    '#title' => t('Replies should be sent to'),
    '#description' => t('Enter a valid email address that replies will be sent to.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => $campaign->reply_to,
    '#required' => TRUE,
  );
  // Attach field api fields.
  if (!$is_new) {
    if (!empty($form_state['values']['article_reference'])) {
      $node = node_load($form_state['values']['article_reference']);
      if ($node) {
        $article_title = $node->title;
        $article_body = $node->body['und'][0]['value'];
        unset($form_state['input']['article_reference']);
        unset($form_state['input']['article_title']);
        unset($form_state['input']['article_body']);
        unset($form_state['input']['subject']);
      }
    }
    // Content Region
    $form['tabs']['content']['content_region'] = array(
      '#type' => 'fieldset',
      '#title' => t('Content region'),
    );
    $form['tabs']['content']['content_region']['article'] = array(
      '#type' => 'container',
      '#prefix' => '<div id="article-wrapper">',
      '#suffix' => '</div>',
    );
    $form['tabs']['content']['content_region']['article']['article_reference'] = array(
      '#type' => 'textfield',
      '#title' => t('Newsletter Reference'),
      '#description' => t('Choose an article from our database to populate the article fields or create your own content.'),
      '#autocomplete_path' => 'campaign-monitor/newsletter-autocomplete',
      '#attributes' => array(
        'placeholder' => t('Enter some keywords'),
      ),
      '#ajax' => array(
        'wrapper' => 'article-wrapper',
        'method' => 'replace',
        'callback' => 'cm_campaign_form_refresh_article',
      ),
    );
    $form['tabs']['content']['content_region']['article']['subject'] = array(
      '#type' => 'textfield',
      '#title' => t('Write a subject line'),
      '#description' => t('This text will display in the Subject field in your recipient\'s email client.'),
      '#required' => TRUE,
      '#default_value' => isset($article_title) ? $article_title : $campaign->subject,
    );
    $form['tabs']['content']['content_region']['article']['article_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Article Title'),
      '#default_value' => isset($article_title) ? $article_title : $campaign->article_title,
      '#required' => TRUE,
      '#maxlength' => 255,
    );
    $form['tabs']['content']['content_region']['article']['article_body'] = array(
      '#type' => 'text_format',
      '#title' => t('Article Body'),
      '#default_value' => isset($article_body) ? $article_body : $campaign->article_body,
      '#format' => 'epic',
      '#rows' => 10,
      '#required' => TRUE,
      '#after_build' => array('campaign_monitor_hide_format_info'),
    );
    $form['tabs']['content']['content_region']['promotional_text'] = array(
      '#type' => 'text_format',
      '#title' => t('Promotional Text'),
      '#default_value' => isset($campaign->promotional_text) ? $campaign->promotional_text : '',
      '#format' => 'epic',
      '#rows' => 10,
      '#after_build' => array('campaign_monitor_hide_format_info'),
    );
    $form['tabs']['content']['content_region']['disclaimer_text'] = array(
      '#type' => 'text_format',
      '#title' => t('Disclaimers'),
      '#default_value' => isset($campaign->disclaimer_text) ? $campaign->disclaimer_text : '',
      '#format' => 'epic',
      '#rows' => 10,
      '#after_build' => array('campaign_monitor_hide_format_info'),
    );
    field_attach_form('cm_campaign', $campaign, $form, $form_state);
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
      '#title' => t('Design'),
    );
    $form['tabs']['design']['background_color'] = array(
      '#type' => 'colorfield_picker',
      '#title' => t('Background Color'),
      '#description' => t('This field allows you to customize the background color of the email body.'),
      '#default_value' => array(
        'colorfield_picker' => !empty($campaign->background_color) ? $campaign->background_color : '#E4E4E4',
      ),
      '#element_validate' => array('campaign_monitor_color_validate'),
      '#required' => TRUE,
    );
    // Logo region.
    $form['tabs']['design']['logo_region'] = array(
      '#type' => 'fieldset',
      '#title' => t('Logo region'),
    );
    $form['tabs']['design']['logo_region']['logo_region_status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#default_value' => $campaign->logo_region_status,
    );
    $form['tabs']['design']['logo_region']['logo_wrapper'] = array(
      '#type' => 'container',
      '#states' => array(
        'visible' => array(
          ':input[name="logo_region_status"]' => array('checked' => TRUE),
        ),
      ),
    );
    $form['tabs']['design']['logo_region']['logo_wrapper']['logo_background_color'] = array(
      '#type' => 'colorfield_picker',
      '#title' => t('Logo Background Color'),
      '#description' => t('This field allows you to customize the background color of the logo region in your template.'),
      '#default_value' => array(
        'colorfield_picker' => !empty($campaign->logo_background_color) ? $campaign->logo_background_color : '#FFFFFF',
      ),
      '#element_validate' => array('campaign_monitor_color_validate'),
      '#weight' => 1,
    );
    $form['tabs']['design']['logo_region']['logo_wrapper']['logo_link'] = array(
      '#type' => 'textfield',
      '#title' => t('Logo Link'),
      '#description' => t('Enter a valid url to link the logo to a page on the web.'),
      '#default_value' => isset($campaign->logo_link) ? $campaign->logo_link : '',
      '#weight' => 2,
      '#maxlength' => 128,
      '#attributes' => array(
        'placeholder' => t('http://'),
      ),
      '#element_validate' => array('campaign_monitor_url_validate'),
    );
    if (isset($form['field_mc_logo'])) {
      $form['tabs']['design']['logo_region']['logo_wrapper']['field_mc_logo'] = $form['field_mc_logo'];
      $form['tabs']['design']['logo_region']['logo_wrapper']['field_mc_logo']['#weight'] = 3;
      unset($form['field_mc_logo']);
    }
    // Banner region.
    $form['tabs']['design']['banner_region'] = array(
      '#type' => 'fieldset',
      '#title' => t('Banner region'),
    );
    $form['tabs']['design']['banner_region']['banner_region_status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#default_value' => $campaign->banner_region_status,
    );
    $form['tabs']['design']['banner_region']['banner_wrapper'] = array(
      '#type' => 'container',
      '#states' => array(
        'visible' => array(
          ':input[name="banner_region_status"]' => array('checked' => TRUE),
        ),
      ),
    );
    $form['tabs']['design']['banner_region']['banner_wrapper']['banner_link'] = array(
      '#type' => 'textfield',
      '#title' => t('Banner Link'),
      '#description' => t('Enter a valid url to link the banner image to a page on the web.'),
      '#default_value' => isset($campaign->banner_link) ? $campaign->banner_link : '',
      '#weight' => 1,
      '#maxlength' => 128,
      '#attributes' => array(
        'placeholder' => t('http://'),
      ),
    );
    if (isset($form['field_mc_banner'])) {
      $form['tabs']['design']['banner_region']['banner_wrapper']['field_mc_banner'] = $form['field_mc_banner'];
      $form['tabs']['design']['banner_region']['banner_wrapper']['field_mc_banner']['#weight'] = 2;
      unset($form['field_mc_banner']);
    }
    // Profile region.
    $form['tabs']['design']['profile_region'] = array(
      '#type' => 'fieldset',
      '#title' => t('Profile region'),
    );
    $form['tabs']['design']['profile_region']['profile_region_status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#default_value' => $campaign->profile_region_status,
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
  if ($is_new || !$is_new && empty($campaign->campaign_status)) {
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $is_new ? t('Next') : t('Finish'),
      '#attributes' => array(
        'class' => array('button small'),
      ),
    );
  }
  if (!$is_new && empty($campaign->campaign_status)) {
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
 * AJAX callback for author form element.
 */
function cm_campaign_form_refresh_article($form, $form_state) {
  return $form['tabs']['content']['content_region']['article'];
}
/**
 * Implements hook_validate().
 *
 * Performs validation checks on the given list.
 */
/*
function cm_campaign_form_validate($form, &$form_state) {
  $values = $form_state['values'];
  // Validate the Article reference field.
  if (!empty($values['article_reference'])) {
    $node = node_load($values['article_reference']);
    if (!$node) {
      form_set_error('article_reference', t('The newsletter referenced does not exist.'));
    }
    elseif ($form_state['triggering_element']['#name'] == 'article_reference') {
      $form_state['article_selected'] = $node;
    }
  }
}*/

function cm_campaign_form_submit(&$form, &$form_state) {
  $values = $form_state['values'];
  $list = $form_state['cm_list'];
  $campaign = $form_state['cm_campaign'];
  $is_new = isset($campaign->is_new) ? TRUE : FALSE;
  if ($is_new) {
    // Save it now to get the entity id for unique campaign name.
    $campaign->save();
    // Set a unique campaign name to use on Campaign Monitor.
    $campaign->name = 'Campaign ' . entity_id('cm_campaign', $campaign);
    // Set values for field_api fields from list.
    $list_logo = field_get_items('cm_list', $list, 'field_mc_logo');
    $list_banner = field_get_items('cm_list', $list, 'field_mc_banner');
    $list_profile_pic = field_get_items('cm_list', $list, 'field_mc_profile_pic');
    if ($list_logo) {
      $file = file_load($list_logo[0]['fid']);
      $campaign->field_mc_logo[LANGUAGE_NONE][0] = (array) $file;
    }
    if ($list_banner) {
      $file = file_load($list_banner[0]['fid']);
      $campaign->field_mc_banner[LANGUAGE_NONE][0] = (array) $file;
    }
    if ($list_profile_pic) {
      $file = file_load($list_profile_pic[0]['fid']);
      $campaign->field_mc_profile_pic[LANGUAGE_NONE][0] = (array) $file;
    }
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
    // Save field_api fields.
    field_attach_submit('cm_campaign', $campaign, $form, $form_state);
  }
  $campaign->subject = $is_new ? '' : $values['subject'];
  $campaign->from_name = $values['from_name'];
  $campaign->from_email = $values['from_email'];
  $campaign->reply_to = $values['reply_to'];
  $campaign->background_color = $is_new ? $list->background_color : $values['background_color']['colorfield_picker'];
  $campaign->logo_background_color = $is_new ? $list->logo_background_color : $values['logo_background_color']['colorfield_picker'];
  $campaign->logo_region_status = $is_new ? $list->logo_region_status : $values['logo_region_status'];
  $campaign->logo_link = $is_new ? $list->logo_link : $values['logo_link'];
  $campaign->banner_region_status = $is_new ? $list->banner_region_status : $values['banner_region_status'];
  $campaign->banner_link = $is_new ? $list->banner_link : $values['banner_link'];
  $campaign->profile_region_status = $is_new ? $list->profile_region_status : $values['profile_region_status'];
  $campaign->disclaimer_text = $is_new ? $list->disclaimer_text : $values['disclaimer_text']['value'];
  $campaign->promotional_text = $is_new ? $list->promotional_text : $values['promotional_text']['value'];
  $campaign->article_title = !empty($values['article_title']) ? $values['article_title'] : '';
  $campaign->article_body = !empty($values['article_body']['value']) ? $values['article_body']['value'] : '';
  $campaign->save();
  $form_state['redirect'] = $redirect;
}

/**
 * Delete confirmation form.
 */
function cm_campaign_delete_form($form, &$form_state, $campaign) {
  $form_state['cm_campaign'] = $campaign;
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
  // Scheduled date.
  if ($send_option == 2) {
    $date = new DateTime($values['send_date'], new DateTimeZone('America/Denver'));
    $schedule_date = $date->format('Y-m-d H:i');
    $message = t('Your campaign has been scheduled!');
  }
  // Send immediately.
  else {
    $schedule_date = 'Immediately';
    $message = t('Your campaign has been sent!');
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
        $campaign->campaign_status = 1;
        $campaign->save();
      }
      else {
        $error = $result->response->Message;
        $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
        drupal_set_message($message, 'error');
      }
    }
  }
  if (!empty($campaign_id)) {
    $wrap = campaign_monitor_get_api_object('CS_REST_Campaigns', $campaign_id);
    $result = $wrap->send(array(
      'ConfirmationEmail' => 'confirmations@exitplanning.com',
      'SendDate' => $schedule_date,
    ));
    if ($result->was_successful()) {
      $campaign->campaign_status = 3;
      $campaign->send_date = $send_option == 1 ? REQUEST_TIME : strtotime($schedule_date);
      $campaign->save();
      drupal_set_message($message);
    }
    else {
      // Check for list size approval error which is code 334.
      // @see https://www.campaignmonitor.com/api/campaigns/#sending-draft-campaign
      if ($result->http_status_code == 334) {
        $campaign->campaign_status = 2;
        $campaign->save();
      }
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
/**
 * Helper function to schedule or send a campaign.
 */
/*
function campaign_monitor_campaigns_send($campaign, $campaign_id, $send_option, $send_date) {
  $wrap = campaign_monitor_get_api_object('CS_REST_Campaigns', $campaign_id);
  $result = $wrap->send(array(
    'ConfirmationEmail' => 'amarquis@exitplanning.com',
    'SendDate' => $send_date,
  ));
  if ($result->was_successful()) {
    $campaign->campaign_status = $new_status;
    $campaign->send_date = $send_option == 1 ? REQUEST_TIME : strtotime($schedule_date);
    $campaign->save();
    return TRUE;
  }
  else {
    return;
  }
}*/

