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
    $breadcrumb[] = l(t('!client', array('!client' => $client->name)), $client_uri['path']);
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
            $country_options = array(
              'CA' => t('Canada'),
              'US' => t('United States')
            );
            $author_company_name = field_get_items('user', $author, 'field_company_name');
            $author_website = field_get_items('user', $author, 'field_website');
            $author_phone = field_get_items('user', $author, 'field_phone');
            $address = array(
              'company_name' => $author_company_name ? $author_company_name[0]['value'] : '',
              'website' => $author_website ? $author_website[0]['url'] : '',
              'country' => 'US',
              'street' => '',
              'additional' => '',
              'city' => '',
              'state' => NULL,
              'postal_code' => '',
              'phone_number' => $author_phone ? $author_phone[0]['value'] : '',
            );
            $author_address_field = field_get_items('user', $author, 'field_address');
            if ($author_address_field) {
              $default_country = strtoupper($author_address_field[0]['country']);
              if (array_key_exists($default_country, $country_options)) {
                $address['country'] = $default_country;
                $address['state'] = $author_address_field[0]['province'];
              }
              $address['street'] = $author_address_field[0]['street'];
              $address['additional'] = $author_address_field[0]['additional'];
              $address['city'] = $author_address_field[0]['city'];
              $address['postal_code'] = $author_address_field[0]['postal_code'];
            }
            $cm_list = entity_create('cm_list', array(
              'cid' => $client->id,
              'client_id' => $client->client_id,
              'uid' => $client->uid,
              'list_id' => $list->ListID,
              'title' => $list->Title,
              'from_name' => $author->realname,
              'from_email' => $author->mail,
              'reply_to' => $author->mail,
              'address' => $address,
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
  $is_new = isset($list->is_new) || !isset($list->id) ? TRUE : FALSE;
  $is_administrator = user_access('administer campaign monitor');
  // Country options to populate dropdown since we need only a few common.
  $country_options = array(
    'CA' => t('Canada'),
    'US' => t('United States')
  );
  $defaults = array(
    'from_name' => !$is_new ? $list->from_name : '',
    'from_email' => !$is_new ? $list->from_email : '',
    'reply_to' => !$is_new ? $list->reply_to : '',
    'address' => !$is_new ? $list->address : array(
      'company_name' => '',
      'website' => '',
      'country' => 'US',
      'street' => '',
      'additional' => '',
      'city' => '',
      'state' => NULL,
      'postal_code' => '',
      'phone_number' => '',
    ),
  );
  if (!isset($form_state['cm_client'])) {
    $form_state['cm_client'] = !$client ? cm_client_load($list->cid) : $client;
  }
  // Set client to whatever is stored in memory.
  $client = $form_state['cm_client'];
  if (!isset($form_state['author'])) {
    $form_state['author'] = $is_new ? user_load($client->uid) : user_load($list->uid);
  }
  // Set author to whatever is stored in memory.
  $author = $form_state['author'];
  // Set author specific values if changed via ajax request.
  $values = !empty($form_state['values']) ? $form_state['values'] : NULL;
  $author_fields = FALSE;
  if ($values) {
    if ($form_state['triggering_element']['#name'] == 'author') {
      $defaults['from_name'] = $author->realname;
      $defaults['from_email'] = $author->mail;
      $defaults['reply_to'] = $author->mail;
      $defaults['address'] = $values['address'];
      unset($form_state['input']['from_name']);
      unset($form_state['input']['from_email']);
      unset($form_state['input']['reply_to']);
      unset($form_state['input']['address']);
      $author_fields = TRUE;
    }
    if ($form_state['triggering_element']['#name'] == 'address[country]') {
      $defaults['address'] = $values['address'];
      unset($form_state['input']['address']['country']);
    }
  }
  elseif ($is_new) {
    $author_fields = TRUE;
  }
  // If author is changed or on initial page build of new entity, we need to set
  // default values from user profile.
  if ($author_fields) {
    $author_company_name = field_get_items('user', $author, 'field_company_name');
    $author_website = field_get_items('user', $author, 'field_website');
    $author_phone = field_get_items('user', $author, 'field_phone');
    $author_address_field = field_get_items('user', $author, 'field_address');
    $default_country = 'US';
    $default_state = NULL;
    if ($author_address_field) {
      $formatted_country = strtoupper($author_address_field[0]['country']);
      if (array_key_exists($default_country, $country_options)) {
        $default_country = $formatted_country;
        $default_state = $author_address_field[0]['province'];
      }
    }
    $defaults['address'] = array(
      'company_name' => $author_company_name ? $author_company_name[0]['value'] : '',
      'website' => $author_website ? $author_website[0]['url'] : '',
      'country' => $default_country,
      'street' => $author_address_field ? $author_address_field[0]['street'] : '',
      'additional' => $author_address_field ? $author_address_field[0]['additional'] : '',
      'city' => $author_address_field ? $author_address_field[0]['city'] : '',
      'state' => $default_state,
      'postal_code' => $author_address_field ? $author_address_field[0]['postal_code'] : '',
      'phone_number' => $author_phone ? $author_phone[0]['value'] : '',
    );
  }
  if ($is_new) {
    $defaults['from_name'] = $author->realname;
    $defaults['from_email'] = $author->mail;
    $defaults['reply_to'] = $author->mail;
    $list = entity_create('cm_list', array(
      'title' => entity_label('cm_client', $client) . ' Newsletter',
      'cid' => $client->id,
      'client_id' => $client->client_id,
      'uid' => $client->uid,
      'from_name' => $author->realname,
      'from_email' => $author->mail,
      'reply_to' => $author->mail,
      'address' => $defaults['address'],
    ));
  }
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
    '#title' => t('List Settings'),
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
      '#ajax' => array(
        'wrapper' => 'author-wrapper',
        'method' => 'replace',
        'callback' => 'cm_list_form_refresh_author',
      ),
    );
  }
  $form['tabs']['defaults']['author_wrapper'] = array(
    '#type' => 'container',
    '#prefix' => '<div id="author-wrapper">',
    '#suffix' => '</div>',
  );
  $form['tabs']['defaults']['author_wrapper']['from_name'] = array(
    '#type' => 'textfield',
    '#title' => t('From name'),
    '#description' => t('This is who your emails will come from. Use something they\'ll instantly recognize, like your company name.'),
    '#default_value' => $defaults['from_name'],
    '#required' => TRUE,
  );
  $form['tabs']['defaults']['author_wrapper']['from_email'] = array(
    '#type' => 'textfield',
    '#title' => t('From e-mail'),
    '#description' => t('This is the e-mail address your campaigns will come from.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => $defaults['from_email'],
    '#required' => TRUE,
  );
  $form['tabs']['defaults']['author_wrapper']['reply_to'] = array(
    '#type' => 'textfield',
    '#title' => t('Replies should be sent to'),
    '#description' => t('Enter a valid email address that replies will be sent to.'),
    '#element_validate' => array('campaign_monitor_email_validate'),
    '#default_value' => $defaults['reply_to'],
    '#required' => TRUE,
  );
  // Address
  $form['tabs']['defaults']['author_wrapper']['address'] = array(
    '#type' => 'fieldset',
    '#title' => t('Company Information'),
    '#tree' => TRUE,
    '#prefix' => '<div id="address-wrapper">',
    '#suffix' => '</div>',
  );
  $form['tabs']['defaults']['author_wrapper']['address']['company_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Company Name'),
    '#default_value' => $defaults['address']['company_name'],
  );
  $form['tabs']['defaults']['author_wrapper']['address']['country'] = array(
    '#type' => 'select',
    '#title' => t('Country'),
    '#options' => $country_options,
    '#required' => TRUE,
    '#default_value' => $defaults['address']['country'],
    '#ajax' => array(
      'wrapper' => 'address-wrapper',
      'callback' => 'cm_list_form_refresh_address',
    ),
  );
  $form['tabs']['defaults']['author_wrapper']['address']['street'] = array(
    '#type' => 'textfield',
    '#title' => t('Address 1'),
    '#default_value' => $defaults['address']['street'],
    '#required' => TRUE,
  );
  $form['tabs']['defaults']['author_wrapper']['address']['additional'] = array(
    '#type' => 'textfield',
    '#title' => t('Address 2'),
    '#default_value' => $defaults['address']['additional'],
  );
  $form['tabs']['defaults']['author_wrapper']['address']['city'] = array(
    '#type' => 'textfield',
    '#title' => t('City'),
    '#default_value' => $defaults['address']['city'],
    '#required' => TRUE,
  );
  $form['tabs']['defaults']['author_wrapper']['address']['state'] = array(
    '#type' => 'select',
    '#options' => campaign_monitor_get_administrative_areas($defaults['address']['country']),
    '#empty_option' => t(' - Select - '),
    '#title' => $defaults['address']['country'] == 'US' ? t('State') : t('Province'),
    '#default_value' => $defaults['address']['state'],
    '#required' => TRUE,
    '#prefix' => '<div id="states-wrapper">',
    '#suffix' => '</div>',
  );
  $form['tabs']['defaults']['author_wrapper']['address']['postal_code'] = array(
    '#type' => 'textfield',
    '#title' => t('Postal code'),
    '#default_value' => $defaults['address']['postal_code'],
    '#required' => TRUE,
  );
  $form['tabs']['defaults']['author_wrapper']['address']['website'] = array(
    '#type' => 'textfield',
    '#title' => t('Website'),
    '#default_value' => $defaults['address']['website'],
  );
  $form['tabs']['defaults']['author_wrapper']['address']['phone_number'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone Number'),
    '#default_value' => $defaults['address']['phone_number'],
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
      '#description' => t('This field allows you to customize the background color of the email body.'),
      '#default_value' => array(
        'colorfield_picker' => !empty($list->background_color) ? $list->background_color : '#E4E4E4',
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
      '#default_value' => $list->logo_region_status,
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
        'colorfield_picker' => !empty($list->logo_background_color) ? $list->logo_background_color : '#FFFFFF',
      ),
      '#element_validate' => array('campaign_monitor_color_validate'),
      '#weight' => 1,
    );
    $form['tabs']['design']['logo_region']['logo_wrapper']['logo_link'] = array(
      '#type' => 'textfield',
      '#title' => t('Logo Link'),
      '#description' => t('Enter a valid url to link the logo to a page on the web.'),
      '#default_value' => isset($list->logo_link) ? $list->logo_link : '',
      '#weight' => 2,
      '#maxlength' => 128,
      '#attributes' => array(
        'placeholder' => t('http://www.mysite.com'),
      ),
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
      '#default_value' => $list->banner_region_status,
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
      '#default_value' => isset($list->banner_link) ? $list->banner_link : '',
      '#weight' => 1,
      '#maxlength' => 128,
      '#attributes' => array(
        'placeholder' => t('http://www.mysite.com'),
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
    // Content Region
    $form['tabs']['design']['content_region'] = array(
      '#type' => 'fieldset',
      '#title' => t('Content region'),
    );
    $form['tabs']['design']['content_region']['disclaimer_text'] = array(
      '#type' => 'text_format',
      '#title' => t('Disclaimers'),
      '#default_value' => isset($list->disclaimer_text) ? $list->disclaimer_text : '',
      '#format' => 'epic',
      '#rows' => 10,
      '#after_build' => array('campaign_monitor_hide_format_info'),
    );
    $form['tabs']['design']['content_region']['promotional_text'] = array(
      '#type' => 'text_format',
      '#title' => t('Promotional Text'),
      '#default_value' => isset($list->promotional_text) ? $list->promotional_text : '',
      '#format' => 'epic',
      '#rows' => 10,
      '#after_build' => array('campaign_monitor_hide_format_info'),
    );
    // Footer Region
    $form['tabs']['design']['footer_region'] = array(
      '#type' => 'fieldset',
      '#title' => t('Footer region'),
      '#tree' => TRUE,
    );
    $form['tabs']['design']['footer_region']['share_widgets'] = array(
      '#type' => 'item',
      '#title' => t('Share this email'),
    );
    // Facebook
    $form['tabs']['design']['footer_region']['share_widgets']['facebook'] = array(
      '#type' => 'checkbox',
      '#title' => t('Facebook'),
      '#default_value' => $list->footer_region['share_widgets']['facebook'],
    );
    $form['tabs']['design']['footer_region']['share_widgets']['facebook_type'] = array(
      '#type' => 'select',
      '#title' => t('Facebook like preference'),
      '#title_display' => 'invisible',
      '#default_value' => $list->footer_region['share_widgets']['facebook_type'],
      '#options' => array(
        'email' => t('Like this email'),
        'url' => t('Like a URL'),
      ),
      '#states' => array(
        'visible' => array(
          ':input[name="footer_region[share_widgets][facebook]"]' => array('checked' => TRUE),
        ),
      ),
    );
    $form['tabs']['design']['footer_region']['share_widgets']['facebook_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Facebook Like URL'),
      '#default_value' => $list->footer_region['share_widgets']['facebook_url'],
      '#attributes' => array(
        'placeholder' => t('https://www.facebook.com/BEIexitplanning'),
      ),
      '#states' => array(
        'visible' => array(
          ':input[name="footer_region[share_widgets][facebook]"]' => array('checked' => TRUE),
          ':input[name="footer_region[share_widgets][facebook_type]"]' => array('value' => 'url'),
        ),
      ),
    );
    // LinkedIn
    $form['tabs']['design']['footer_region']['share_widgets']['linkedin'] = array(
      '#type' => 'checkbox',
      '#title' => t('LinkedIn'),
      '#default_value' => $list->footer_region['share_widgets']['linkedin'],
    );
    // Twitter
    $form['tabs']['design']['footer_region']['share_widgets']['twitter'] = array(
      '#type' => 'checkbox',
      '#title' => t('Twitter'),
      '#default_value' => $list->footer_region['share_widgets']['twitter'],
    );
    $form['tabs']['design']['footer_region']['share_widgets']['twitter_handle'] = array(
      '#type' => 'textfield',
      '#title' => t('Twitter handle (optional)'),
      '#default_value' => $list->footer_region['share_widgets']['twitter_handle'],
      '#description' => t('Enter your twitter handle without the @ symbol'),
      '#states' => array(
        'visible' => array(
          ':input[name="footer_region[share_widgets][twitter]"]' => array('checked' => TRUE),
        ),
      ),
    );
    // Forward
    $form['tabs']['design']['footer_region']['share_widgets']['forward'] = array(
      '#type' => 'checkbox',
      '#title' => t('Forward'),
      '#default_value' => $list->footer_region['share_widgets']['forward'],
    );
    // Other settings
    $form['tabs']['design']['footer_region']['other_settings'] = array(
      '#type' => 'item',
      '#title' => t('Other settings'),
    );
    $form['tabs']['design']['footer_region']['other_settings']['explanation'] = array(
      '#type' => 'checkbox',
      '#title' => t('Explanation text (recommended)'),
      '#description' => t('Remind people how they signed up to your list.'),
      '#default_value' => $list->footer_region['other_settings']['explanation'],
    );
    $explanation_description = t('Sample reminders: "You are receiving this email because you opted in
    at our website ..." or "We send special offers to customers who opted in at ..."');
    $form['tabs']['design']['footer_region']['other_settings']['explanation_text'] = array(
      '#type' => 'textarea',
      '#title' => t('Explanation'),
      '#title_display' => 'invisible',
      '#description' => $explanation_description,
      '#default_value' => $list->footer_region['other_settings']['explanation_text'],
      '#rows' => 3,
      '#resizable' => FALSE,
      '#states' => array(
        'visible' => array(
          ':input[name="footer_region[other_settings][explanation]"]' => array('checked' => TRUE),
        ),
      ),
    );
    $form['tabs']['design']['footer_region']['other_settings']['edit_subscription'] = array(
      '#type' => 'checkbox',
      '#title' => t('Edit subscription'),
      '#description' => t('Provide a link for subscribers to modify their subscription settings.'),
      '#default_value' => $list->footer_region['other_settings']['edit_subscription'],
    );
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
 * AJAX callback for author form element.
 */
function cm_list_form_refresh_author($form, $form_state) {
  return $form['tabs']['defaults']['author_wrapper'];
}
/**
 * Ajax callback for address form element.
 */
function cm_list_form_refresh_address($form, $form_state) {
  return $form['tabs']['defaults']['author_wrapper']['address'];
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
    $account = user_load_by_name($values['author']);
    if (!$account) {
      form_set_error('author', t('The username %name does not exist.', array('%name' => $values['author'])));
    }
    elseif ($form_state['triggering_element']['#name'] == 'author') {
      $form_state['author'] = $account;
    }
  }
  // Enforce valid url for logo_link
  if (!empty($values['logo_link'])) {
    if (!valid_url($values['logo_link'], TRUE)) {
      form_set_error('logo_link', t('Invalid url entered for %url. Be sure to prefix the url with a valid protocol ie; http:// or https://', array('%url' => $values['logo_link'])));
    }
    
  }
  // Enforce valid url for banner_link
  if (!empty($values['banner_link'])) {
    if (!valid_url($values['banner_link'], TRUE)) {
      form_set_error('banner_link', t('Invalid url entered for %url. Be sure to prefix the url with a valid protocol ie; http:// or https://', array('%url' => $values['banner_link'])));
    }
  }
}
function cm_list_form_submit(&$form, &$form_state) {
  $values = $form_state['values'];
  $client = $form_state['cm_client'];
  $list = $form_state['cm_list'];
  $author = $form_state['author'];
  if (!empty($values['author'])) {
    if ($account = user_load_by_name($values['author'])) {
      $list->uid = $account->uid;
    }
  }
  if (isset($list->is_new)) {
    $wrap = campaign_monitor_get_api_object('CS_REST_Lists', NULL);
    if ($wrap) {
      $result = $wrap->create($client->client_id, array(
        'Title' => $values['title'],
        'UnsubscribeSetting' => $values['unsubscribe_setting'],
        'UnsubscribePage' => $values['unsubscribe_page'],
        'ConfirmationSuccessPage' => '', // Change to submitted value later if using. @see form element comment.
        'ConfirmedOptIn' => $values['confirmed_opt_in'],
      ));
      if ($result->was_successful()) {
        $id = $result->response;
        $list_wrap = campaign_monitor_get_api_object('CS_REST_Lists', $id);
        if ($list_wrap) {
          $list->manage_campaigns = $values['manage_campaigns'];
          $list->list_id = $id;
          $list->title = $values['title'];
          $list->confirmed_opt_in = $values['confirmed_opt_in'];
          $list->unsubscribe_page = $values['unsubscribe_page'];
          $list->unsubscribe_setting = $values['unsubscribe_setting'];
          $list->confirmation_success_page = '';
          //field_attach_submit('cm_list', $list, $form, $form_state);
          $list->save();
          // Now create the webhook.
          $webhook_settings = array(
            'Events' => array(CS_REST_LIST_WEBHOOK_SUBSCRIBE, CS_REST_LIST_WEBHOOK_DEACTIVATE, CS_REST_LIST_WEBHOOK_UPDATE),
            'Url' => campaign_monitor_webhook_url(),
            'PayLoadFormat' => CS_REST_WEBHOOK_FORMAT_JSON,
          );
          $webhook_create = $list_wrap->create_webhook($webhook_settings);
          if ($webhook_create->was_successful()) {
            $webhook_entity = entity_create('cm_webhook', array(
              'lid' => entity_id('cm_list', $list),
              'webhook_id' => $webhook_create->response,
              'url' => campaign_monitor_webhook_url(),
              'status' => 'Active',
              'events' => $webhook_settings['Events'],
              'payload_format' => CS_REST_WEBHOOK_FORMAT_JSON,
            ));
            $webhook_entity->save();
          }
          $form_state['redirect'] = 'cm-list/' . entity_id('cm_list', $list) . '/edit';
          $message = t('Added new list %title to Campaign Monitor', array('%title' => $values['title']));
          drupal_set_message($message);
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
        $list->title = $values['title'];
        $list->from_name = $values['from_name'];
        $list->from_email = $values['from_email'];
        $list->reply_to = $values['reply_to'];
        $list->manage_campaigns = $values['manage_campaigns'];
        $list->background_color = $values['background_color']['colorfield_picker'];
        $list->logo_background_color = $values['logo_background_color']['colorfield_picker'];
        $list->logo_region_status = $values['logo_region_status'];
        $list->logo_link = $values['logo_link'];
        $list->banner_region_status = $values['banner_region_status'];
        $list->banner_link = $values['banner_link'];
        $list->profile_region_status = $values['profile_region_status'];
        $list->address = $values['address'];
        $list->footer_region = $values['footer_region'];
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
/**
 * Menu callback to migrate an mailchimp list fields to campaign monitor list.
 * REMOVE THIS WHEN DONE WITH MAILCHIMP.
 */
function campaign_monitor_lists_migrate_form($form, &$form_state, $list) {
  $options = array();
  $lists = db_query('SELECT * FROM {node} n WHERE n.uid = :uid AND n.type = :type', array(':uid' => $list->uid, ':type' => 'subscriber_list'))->fetchAll();
  foreach ($lists as $node) {
    $options[$node->nid] = $node->title . ' [' . $node->nid . ']';
  }
  $form_state['cm_list'] = $list;
  $form['mailchimp_list'] = array(
    '#type' => 'select',
    '#title' => t('Mailchimp Lists'),
    '#options' => $options,
    '#empty_option' => '- Choose list -',
    '#required' => TRUE,
  );
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );
  return $form;
}
function campaign_monitor_lists_migrate_form_submit($form, &$form_state) {
  $list = $form_state['cm_list'];
  $node = node_load($form_state['values']['mailchimp_list']);
  $author = user_load($list->uid);
  $node_manage_campaigns = field_get_items('node', $node, 'field_campaign_management');
  $node_email_bg_color = field_get_items('node', $node, 'field_mc_color_email_bg');
  $node_logo_bg_color = field_get_items('node', $node, 'field_mc_color_primary');
  $user_disclaimer = field_get_items('user', $author, 'field_mc_disclaimer');
  $user_promo_text = field_get_items('user', $author, 'field_mc_profile_bio');
  $list->from_name = $node->from_name;
  $list->from_email = $node->from_email;
  $list->reply_to = $node->from_email;
  if ($node_manage_campaigns) {
    $list->manage_campaigns = $node_manage_campaigns[0]['value'];
  }
  if ($node_email_bg_color) {
    $list->background_color = $node_email_bg_color[0]['rgb'];
  }
  else {
    $fallback_email_bg_color = field_get_items('user', $author, 'field_mc_color_email_bg');
    if ($fallback_email_bg_color) {
      $list->background_color = $fallback_email_bg_color[0]['rgb'];
    }
  }
  if ($node_logo_bg_color) {
    $list->logo_background_color = $node_logo_bg_color[0]['rgb'];
  }
  else {
    $fallback_logo_bg_color = field_get_items('user', $author, 'field_mc_color_primary');
    if ($fallback_logo_bg_color) {
      $list->logo_background_color = $fallback_logo_bg_color[0]['rgb'];
    }
  }
  // User disclaimer.
  if ($user_disclaimer) {
    $list->disclaimer_text = $user_disclaimer[0]['value'];
  }
  // Promotional text.
  if ($user_promo_text) {
    $list->promotional_text = $user_promo_text[0]['value'];
  }
  // Now populate the field api fields if they exist.
  if (module_exists('campaign_monitor_fields')) {
    $node_logo = field_get_items('node', $node, 'field_mc_logo');
    $node_banner = field_get_items('node', $node, 'field_mc_banner');
    $node_profile_pic = field_get_items('node', $node, 'field_mc_profile_pic');
    // Logo
    if ($node_logo) {
      $logo_file = file_load($node_logo[0]['fid']);
      $list->field_mc_logo[LANGUAGE_NONE][0] = (array) $logo_file;
    }
    else {
      $fallback_logo = field_get_items('user', $author,'field_company_logo');
      if ($fallback_logo) {
        $logo_file = file_load($fallback_logo[0]['fid']);
        $list->field_mc_logo[LANGUAGE_NONE][0] = (array) $logo_file;
      }
    }
    // Banner
    if ($node_banner) {
      $banner_file = file_load($node_banner[0]['fid']);
      $list->field_mc_banner[LANGUAGE_NONE][0] = (array) $banner_file;
    }
    // Profile
    if ($node_profile_pic) {
      $profile_pic_file = file_load($node_profile_pic[0]['fid']);
      $list->field_mc_profile_pic[LANGUAGE_NONE][0] = (array) $profile_pic_file;
    }
    else {
      $fallback_profile_pic = field_get_items('user', $author, 'field_user_photo');
      if ($fallback_profile_pic) {
        $profile_pic_file = file_load($fallback_profile_pic[0]['fid']);
        $list->field_mc_profile_pic[LANGUAGE_NONE][0] = (array) $profile_pic_file;
      }
    }
  }
  $list->save();
  $form_state['redirect'] = 'cm-client/' . $list->cid . '/lists';
}
