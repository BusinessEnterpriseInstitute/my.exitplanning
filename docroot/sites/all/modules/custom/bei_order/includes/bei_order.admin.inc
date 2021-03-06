<?php

/**
 * Menu callback form.
 *
 * @see bei_order_menu()
 */
function bei_order_form($form, &$form_state, $order) {
  global $user;
  $user_entity = isset($order->uid) ? user_load($order->uid) : $user->uid !== 0 ? user_load($user->uid) : NULL;
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $breadcrumb[] = l(t('My Material Orders'), 'user/' . $user->uid . '/orders');
  drupal_set_breadcrumb($breadcrumb);
  $existing_order = isset($order->oid) ? TRUE : FALSE;
  $is_administrator = user_access('administer bei orders') ? TRUE : FALSE;
  $is_author = $existing_order && $user->uid == $order->uid ? TRUE : FALSE;
  $revision_mode = $is_author && $order->status == 2 ? TRUE : FALSE;
  $label = $existing_order ? entity_label('bei_order', $order) : 'Create Material Order';
  if ($revision_mode) {
    $label = 'Request Changes';
  }
  drupal_set_title($label);
  $draft_mode = !$existing_order || ($is_author && $order->status == 0) ? TRUE : FALSE;
  $defaults = array(
    'name' => '',
    'company' => '',
    'address' => array(
      'country' => 'US',
      'street' => '',
      'additional' => '',
      'city' => '',
      'state' => NULL,
      'postal_code' => '',
    ),
    'phone' => '',
    'email' => check_plain($user_entity->mail),
    'website' => '',
    'branding' => array(
      'background' => '',
      'primary' => '',
      'secondary' => '',
    ),
    'disclaimer' => array(
      'value' => '',
      'format' => NULL,
    ),
    'mission' => array(
      'value' => '',
      'format' => NULL,
    ),
    'shipping_address' => array(
      'country' => 'US',
      'street' => '',
      'additional' => '',
      'city' => '',
      'state' => NULL,
      'postal_code' => '',
    ),
  );
  $country_options = array(
    'CA' => t('Canada'),
    'US' => t('United States')
  );
  if ($user_entity && !$existing_order) {
    // Set default values for new orders.
    $display_name = field_get_items('user', $user_entity, 'field_display_name');
    $company = field_get_items('user', $user_entity, 'field_company_name');
    $address_field = field_get_items('user', $user_entity, 'field_address');
    $phone = field_get_items('user', $user_entity, 'field_phone');
    $website = field_get_items('user', $user_entity, 'field_website');
    $background_color = field_get_items('user', $user_entity, 'field_mc_color_email_bg');
    $primary_color = field_get_items('user', $user_entity, 'field_mc_color_primary');
    $secondary_color = field_get_items('user', $user_entity, 'field_secondary_color');
    $disclaimer_field = field_get_items('user', $user_entity, 'field_mc_disclaimer');
    $mission_field = field_get_items('user', $user_entity, 'field_mission');
    if ($display_name) {
      $defaults['name'] = $display_name[0]['safe_value'];
    }
    if ($company) {
      $defaults['company'] = $company[0]['safe_value'];
    }
    if ($address_field) {
      $default_country = strtoupper($address_field[0]['country']);
      if (array_key_exists($default_country, $country_options)) {
        $defaults['address']['country'] = check_plain($default_country);
        $defaults['address']['state'] = $address_field[0]['province'];
      }
      $defaults['address']['street'] = check_plain($address_field[0]['street']);
      $defaults['address']['additional'] = check_plain($address_field[0]['additional']);
      $defaults['address']['city'] = check_plain($address_field[0]['city']);
      $defaults['address']['postal_code'] = $address_field[0]['postal_code'];
    }
    if ($phone) {
      $defaults['phone'] = $phone[0]['safe_value'];
    }
    if ($website) {
      $defaults['website'] = $website[0]['url'];
    }
    if ($background_color) {
      $defaults['branding']['background'] = $background_color[0]['rgb'];
    }
    if ($primary_color) {
      $defaults['branding']['primary'] = $primary_color[0]['rgb'];
    }
    if ($secondary_color) {
      $defaults['branding']['secondary'] = $secondary_color[0]['rgb'];
    }
    if ($disclaimer_field) {
      $defaults['disclaimer']['value'] = $disclaimer_field[0]['safe_value'];
      $defaults['disclaimer']['format'] = $disclaimer_field[0]['format'];
    }
    if ($mission_field) {
      $defaults['mission']['value'] = $mission_field[0]['safe_value'];
      $defaults['mission']['format'] = $mission_field[0]['format'];
    }
  }
  $form_state['bei_order'] = $order;
  $form_state['bei_order_data'] = $existing_order ? $order->data : array();
  $data = $form_state['bei_order_data'];
  $values = !empty($form_state['values']) ? $form_state['values'] : NULL;
  // If the form has been submitted through ajax request, account for those values.
  if ($values) {
    if (isset($values['address'])) {
      $defaults['address'] = $values['address'];
    }
    if (isset($values['shipping_address'])) {
      $defaults['shipping_address'] = $values['shipping_address'];
    }
  }
  else {
    if (isset($data['address'])) {
      $defaults['address'] = array_replace($defaults['address'], $data['address']);
    }
    if (isset($data['shipping_address'])) {
      $defaults['shipping_address'] = array_replace($defaults['shipping_address'], $data['shipping_address']);
    }
  }
  $default_adjustments = isset($data['materials']['adjustments']) ? $data['materials']['adjustments'] : array();
  $adjustments = !empty($form_state['values']['materials']['adjustments']) ? $form_state['values']['materials']['adjustments'] : $default_adjustments;
  
  // Act on form_state values to modify adjustments.
  if (!empty($form_state['add_adjustment'])) {
    unset($form_state['add_adjustment']);
    array_push($adjustments, array('adjustment' => '', 'adjustment_cost' => ''));
  }
  if (isset($form_state['remove_adjustment'])) {
    $remove = $form_state['remove_adjustment'];
    unset($form_state['remove_adjustment']);
    unset($adjustments[$remove]);
  }
  
  // Show this section for users with 'administer orders' permission.
  if ($existing_order && $is_administrator) {
    $form['administration'] = array(
      '#type' => 'fieldset',
      '#title' => t('Administration'),
    );
    $form['administration']['status'] = array(
      '#type' => 'select',
      '#title' => t('Order Status'),
      '#options' => bei_order_status_options(NULL),
      '#default_value' => $order->status,
    );
    $form['administration']['tracking_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Tracking URL'),
      '#description' => t('Enter the tracking URL provided from shipping company.'),
      '#default_value' => isset($order->tracking_url) ? $order->tracking_url : '',
      '#states' => array(
        'visible' => array(
          // Only show tracking url if status is set to shipped.
          ':input[name="status"]' => array('value' => '6'),
        ),
      ),
    );
  }
  $form['wrapper'] = array(
    '#type' => 'container',
    '#prefix' => '<div id="order-wrapper">',
    '#suffix' => '</div>',
  );
  $form['wrapper']['contact_info'] = array(
    '#type' => 'fieldset',
    '#title' => t('Contact Information'),
    '#description' => t('This information will appear on your custom materials.'),
    '#prefix' => '<div id="contact-info-wrapper">',
    '#suffix' => '</div>',
  );
  $form['wrapper']['contact_info']['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Your Name'),
    '#default_value' => isset($order->name) ? $order->name : $defaults['name'],
  );
  $form['wrapper']['contact_info']['company_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Company Name'),
    '#default_value' => isset($order->company_name) ? $order->company_name : $defaults['company'],
  );
  // Address
  $form['wrapper']['contact_info']['address'] = array(
    '#type' => 'container',
    '#tree' => TRUE,
    '#prefix' => '<div id="contact-address-wrapper">',
    '#suffix' => '</div>',
  );
  $form['wrapper']['contact_info']['address']['country'] = array(
    '#type' => 'select',
    '#title' => t('Country'),
    '#options' => $country_options,
    '#required' => TRUE,
    '#default_value' => $defaults['address']['country'],
    '#ajax' => array(
      'wrapper' => 'contact-address-wrapper',
      'callback' => 'bei_order_address1_refresh',
    ),
  );
  $form['wrapper']['contact_info']['address']['street'] = array(
    '#type' => 'textfield',
    '#title' => t('Address 1'),
    '#default_value' => $defaults['address']['street'],
    '#required' => TRUE,
  );
  $form['wrapper']['contact_info']['address']['additional'] = array(
    '#type' => 'textfield',
    '#title' => t('Address 2'),
    '#default_value' => $defaults['address']['additional'],
  );
  $form['wrapper']['contact_info']['address']['city'] = array(
    '#type' => 'textfield',
    '#title' => t('City'),
    '#default_value' => $defaults['address']['city'],
    '#required' => TRUE,
  );
  $form['wrapper']['contact_info']['address']['state'] = array(
    '#type' => 'select',
    '#options' => bei_order_get_administrative_areas($defaults['address']['country']),
    '#empty_option' => t(' - Select - '),
    '#title' => $defaults['address']['country'] == 'US' ? t('State') : t('Province'),
    '#default_value' => $defaults['address']['state'],
    '#required' => TRUE,
  );
  $form['wrapper']['contact_info']['address']['postal_code'] = array(
    '#type' => 'textfield',
    '#title' => t('Postal code'),
    '#default_value' => $defaults['address']['postal_code'],
    '#required' => TRUE,
  );
  $form['wrapper']['contact_info']['phone'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone Number'),
    '#default_value' => isset($order->phone) ? $order->phone : $defaults['phone'],
  );
  $form['wrapper']['contact_info']['email'] = array(
    '#type' => 'textfield',
    '#title' => t('E-mail Address'),
    '#default_value' => isset($order->email) ? $order->email : $defaults['email'],
    '#element_validate' => array('bei_order_email_validate'),
  );
  $form['wrapper']['contact_info']['website'] = array(
    '#type' => 'textfield',
    '#title' => t('Website'),
    '#default_value' => isset($order->website) ? $order->website : $defaults['website'],
    '#attributes' => array(
      'placeholder' => t('http://www.mysite.com'),
    ),
  );
  // Branding
  $form['wrapper']['branding_wrapper'] = array(
    '#type' => 'fieldset',
    '#title' => t('Branding'),
  );
  $form['wrapper']['branding_wrapper']['branding'] = array(
    '#type' => 'container',
    '#tree' => TRUE,
  );
  $form['wrapper']['branding_wrapper']['branding']['color_chooser'] = array(
    '#type' => 'radios',
    '#title' => t('Color Scheme'),
    '#options' => array(
      1 => t('Custom theme'),
      0 => t('Default theme'),
    ),
    '#default_value' => isset($data['branding']['color_chooser']) ? $data['branding']['color_chooser'] : 1,
  );
  $preview_style = 'display:block; border:1px solid; padding:10px;';
  $preview_markup = '
  <ul class="block-grid-3">
  <li><span style="background-color:#242424; color:#fff; ' . $preview_style . '">Background Color</span></li>
  <li><span style="background-color:#d39c29; ' . $preview_style . '">Primary Color</span></li>
  <li><span style="background-color:#fff; ' . $preview_style . '">Secondary Color</span></li>
  </ul>
  ';
  $form['wrapper']['branding_wrapper']['branding']['default_preview'] = array(
    '#type' => 'item',
    '#markup' => $preview_markup,
    '#states' => array(
      'visible' => array(
        ':input[name="branding[color_chooser]"]' => array('value' => '0'),
      ),
    ),
  );
  $form['wrapper']['branding_wrapper']['branding']['colors'] = array(
    '#type' => 'container',
    '#states' => array(
      'visible' => array(
        ':input[name="branding[color_chooser]"]' => array('value' => '1'),
      ),
    ),
  );
  $form['wrapper']['branding_wrapper']['branding']['colors']['background_color'] = array(
    '#type' => 'colorfield_picker',
    '#title' => t('Background Color'),
    '#description' => t('The background color should be your firm\'s primary
                        branding color. Use a color that will contrast with the
                        Primary and Secondary colors you choose below.'),
    '#default_value' => array(
      'colorfield_picker' => isset($data['branding']['background_color']['colorfield_picker']) ? $data['branding']['background_color']['colorfield_picker'] : $defaults['branding']['background'],
    ),
    '#element_validate' => array('bei_order_color_validate'),
  );
  $form['wrapper']['branding_wrapper']['branding']['colors']['primary_color'] = array(
    '#type' => 'colorfield_picker',
    '#title' => t('Primary Color'),
    '#description' => t('This color should contrast with the background color.
                        It will be used for the heading/title on each item of
                        print material.'),
    '#default_value' => array(
      'colorfield_picker' => isset($data['branding']['primary_color']['colorfield_picker']) ? $data['branding']['primary_color']['colorfield_picker'] : $defaults['branding']['primary'],
    ),
    '#element_validate' => array('bei_order_color_validate'),
  );
  $form['wrapper']['branding_wrapper']['branding']['colors']['secondary_color'] = array(
    '#type' => 'colorfield_picker',
    '#title' => t('Secondary Color'),
    '#description' => t('This color should contrast with the background color
                        and compliment the primary color. It will be used for
                        secondary headings/titles on all print materials.'),
    '#default_value' => array(
      'colorfield_picker' => isset($data['branding']['secondary_color']['colorfield_picker']) ? $data['branding']['secondary_color']['colorfield_picker'] : $defaults['branding']['secondary'],
    ),
    '#element_validate' => array('bei_order_color_validate'),
  );
  $form['wrapper']['branding_wrapper']['branding']['comments'] = array(
    '#type' => 'textarea',
    '#title' => t('Comments'),
    '#description' => t('Enter any additional instructions regarding colors that may deem helpful to the designer.'),
    '#default_value' => isset($data['branding']['comments']) ? $data['branding']['comments'] : '',
  );
  // Materials
  $form['wrapper']['materials'] = array(
    '#type' => 'fieldset',
    '#title' => t('Materials'),
    '#tree' => TRUE,
    '#prefix' => '<div id="materials-wrapper">',
    '#suffix' => '</div>',
    '#theme' => 'materials_form',
  );
  $material_options = array(
    50, 100, 150, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650, 700, 750, 800, 850, 900, 950, 1000
  );
  $materials = bei_order_material_list();
  $materials_ajax = array(
    'callback' => 'bei_order_update_pricing',
    'wrapper' => 'materials-wrapper',
    'progress' => array('type' => 'none'),
  );
  foreach($materials as $key => $material) {
    $form['wrapper']['materials'][$key]['quantity'] = array(
      '#type' => 'select',
      '#title' => $material['title'],
      '#title_display' => 'invisible',
      '#default_value' => isset($data['materials'][$key]['quantity']) ? $data['materials'][$key]['quantity'] : NULL,
      '#options' => drupal_map_assoc($material_options),
      '#empty_option' => t('- None -'),
      '#ajax' => $materials_ajax,
    );
    $form['wrapper']['materials'][$key]['unit_cost'] = array(
      '#type' => 'textfield',
      '#title' => t('Unit Cost'),
      '#title_display' => 'invisible',
      '#default_value' => isset($data['materials'][$key]['unit_cost']) ? $data['materials'][$key]['unit_cost'] : NULL,
      '#field_prefix' => t('$'),
      '#size' => 10,
      '#attributes' => array('disabled' => 'disabled'),
    );
    $form['wrapper']['materials'][$key]['cost'] = array(
      '#type' => 'textfield',
      '#title' => t('Cost'),
      '#title_display' => 'invisible',
      '#default_value' => isset($data['materials'][$key]['cost']) ? $data['materials'][$key]['cost'] : NULL,
      '#field_prefix' => t('$'),
      '#size' => 10,
      '#attributes' => array('disabled' => 'disabled'),
    );
  }
  if (($existing_order && !empty($adjustments)) || $is_administrator) {
    $locked_field = $is_administrator ? FALSE : TRUE;
    $form['wrapper']['materials']['adjustments'] = array(
      '#type' => 'container',
    );
    foreach ($adjustments as $key => $adjustment) {
      if ($is_administrator) {
        $form['wrapper']['materials']['adjustments'][$key]['remove'] = array(
          '#type' => 'submit',
          '#value' => t('X'),
          '#name' => 'remove_' . $key,
          '#submit' => array('bei_order_remove_adjustment_submit'),
          '#attributes' => array(
            'class' => array('alert tiny'),
          ),
          '#ajax' => $materials_ajax,
        );
      }
      $form['wrapper']['materials']['adjustments'][$key]['adjustment'] = array(
        '#type' => 'textfield',
        '#title' => t('Adjustment'),
        '#title_display' => 'invisible',
        '#default_value' => isset($adjustment['adjustment']) ? check_plain($adjustment['adjustment']) : '',
        '#required' => TRUE,
        '#disabled' => $locked_field,
      );
      $form['wrapper']['materials']['adjustments'][$key]['adjustment_cost'] = array(
        '#type' => 'textfield',
        '#title' => t('Adjustment cost'),
        '#title_display' => 'invisible',
        '#default_value' => isset($adjustment['adjustment_cost']) ? $adjustment['adjustment_cost'] : '',
        '#field_prefix' => t('$'),
        '#size' => 10,
        '#element_validate' => array('bei_order_numeric_validate'),
        '#required' => TRUE,
        '#ajax' => array(
          'event' => 'blur',
          'callback' => 'bei_order_update_pricing',
          'wrapper' => 'materials-wrapper',
          'progress' => array('type' => 'none'),
        ),
        '#disabled' => $locked_field,
      );
    }
    if (!$draft_mode && $is_administrator) {
      $form['wrapper']['materials']['more_adjustments'] = array(
        '#type' => 'submit',
        '#value' => t('Add adjustment'),
        '#name' => 'more_adjustments',
        '#weight' => 1,
        '#submit' => array('bei_order_more_adjustments_submit'),
        '#ajax' => $materials_ajax,
      );
    }
  }
  $form['wrapper']['materials']['total_cost'] = array(
    '#type' => 'textfield',
    '#title' => t('TOTAL COST'),
    '#title_display' => 'invisible',
    '#default_value' => isset($data['materials']['total_cost']) ? $data['materials']['total_cost'] : NULL,
    '#field_prefix' => t('$'),
    '#size' => 10,
    '#attributes' => array('disabled' => 'disabled'),
  );
  if (!empty($form_state['values']['materials'])) {
    $pricing = array();
    foreach ($form_state['values']['materials'] as $key => $value) {
      if (!empty($value['quantity'])) {
        $price_per = $value['quantity'] >= 100 ? $materials[$key]['pricing'][100] : $materials[$key]['pricing'][50];
        $form['wrapper']['materials'][$key]['unit_cost']['#value'] = number_format($price_per, 2);
        $form['wrapper']['materials'][$key]['cost']['#value'] = number_format($value['quantity'] * $price_per, 2);
        $pricing[] = $value['quantity'] * $price_per;
      }
      // If they changed the quantity to none.
      else {
        $form['wrapper']['materials'][$key]['unit_cost']['#value'] = '';
        $form['wrapper']['materials'][$key]['cost']['#value'] = '';
      }
    }
    // account for pricing adjustments now
    if (!empty($form_state['values']['materials']['adjustments'])) {
      foreach ($form_state['values']['materials']['adjustments'] as $key => $adjustment) {
        $pricing[] = round($adjustment['adjustment_cost'], 2);
      }
    }
    if (!empty($pricing)) {
      $form['wrapper']['materials']['total_cost']['#value'] = number_format(array_sum($pricing), 2);
    }
  }
  $form['wrapper']['shipping_address'] = array(
    '#type' => 'fieldset',
    '#title' => t('Shipping Address'),
    '#tree' => TRUE,
    '#prefix' => '<div id="shipping-address-wrapper">',
    '#suffix' => '</div>',
  );
  $form['wrapper']['shipping_address']['copy'] = array(
    '#type' => 'checkbox',
    '#title' => t('Copy from contact information'),
    '#ajax' => array(
      'callback' => 'bei_order_address2_refresh',
      'wrapper' => 'shipping-address-wrapper',
      'progress' => array('type' => 'none'),
    ),
  );
  $form['wrapper']['shipping_address']['country'] = array(
    '#type' => 'select',
    '#title' => t('Country'),
    '#options' => $country_options,
    '#required' => TRUE,
    '#default_value' => $defaults['shipping_address']['country'],
    '#ajax' => array(
      'wrapper' => 'shipping-address-wrapper',
      'callback' => 'bei_order_address2_refresh',
    ),
  );
  $form['wrapper']['shipping_address']['street'] = array(
    '#type' => 'textfield',
    '#title' => t('Address 1'),
    '#default_value' => $defaults['shipping_address']['street'],
    '#required' => TRUE,
  );
  $form['wrapper']['shipping_address']['additional'] = array(
    '#type' => 'textfield',
    '#title' => t('Address 2'),
    '#default_value' => $defaults['shipping_address']['additional'],
  );
  $form['wrapper']['shipping_address']['city'] = array(
    '#type' => 'textfield',
    '#title' => t('City'),
    '#default_value' => $defaults['shipping_address']['city'],
    '#required' => TRUE,
  );
  $form['wrapper']['shipping_address']['state'] = array(
    '#type' => 'select',
    '#options' => bei_order_get_administrative_areas($defaults['shipping_address']['country']),
    '#empty_option' => t(' - Select - '),
    '#title' => $defaults['shipping_address']['country'] == 'US' ? t('State') : t('Province'),
    '#default_value' => $defaults['shipping_address']['state'],
    '#required' => TRUE,
  );
  $form['wrapper']['shipping_address']['postal_code'] = array(
    '#type' => 'textfield',
    '#title' => t('Postal code'),
    '#default_value' => $defaults['shipping_address']['postal_code'],
    '#required' => TRUE,
  );
  field_attach_form('bei_order', $order, $form, $form_state);
  // Set a default value on field api fields for new orders.
  if (!$existing_order) {
    $form['field_disclaimers']['und'][0]['#default_value'] = $defaults['disclaimer']['value'];
    $form['field_disclaimers']['und'][0]['#format'] = $defaults['disclaimer']['format'];
    $form['field_mission']['und'][0]['#default_value'] = $defaults['mission']['value'];
    $form['field_mission']['und'][0]['#format'] = $defaults['mission']['format'];
  }
  $form['wrapper']['branding_wrapper']['field_order_file'] = $form['field_order_file'];
  $form['wrapper']['branding_wrapper']['field_order_file']['#weight'] = -10;
  $form['wrapper']['branding_wrapper']['field_mission'] = $form['field_mission'];
  $form['wrapper']['branding_wrapper']['field_disclaimers'] = $form['field_disclaimers'];
  if ($existing_order) {
    $form['administration']['field_order_proofs'] = $form['field_order_proofs'];
  }
  unset($form['field_order_file']);
  unset($form['field_mission']);
  unset($form['field_disclaimers']);
  unset($form['field_order_proofs']);
  $form['wrapper']['actions'] = array(
    '#type' => 'actions',
  );
  // Create a button to save as draft.
  if ($draft_mode || ($is_administrator && !$revision_mode)) {
    $form['wrapper']['actions']['save_draft'] = array(
      '#type' => 'submit',
      '#value' => t('Save & Close'),
      '#name' => 'save_draft',
    );
  }
  // Create a button to save as revision.
  if ($revision_mode) {
    $form['wrapper']['actions']['save_revision'] = array(
      '#type' => 'submit',
      '#value' => t('Save Revision'),
      '#name' => 'save_revision',
    );
  }
  // Create a button to submit the order.
  if ($draft_mode) {
    $form['wrapper']['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit Order'),
      '#name' => 'submit_order',
    );
  }
  return $form;
}
/**
 * Returns the predefined administrative areas.
 *
 * @param $country_code
 *   The country code for which administrative areas should be returned.
 *
 * @return
 *   An array of predefined administrative areas for the given country code, or
 *   NULL if not found.
 */
function bei_order_get_administrative_areas($country_code) {
  // Maintain a static cache to avoid passing the administrative areas through
  // t() more than once per request.
  $administrative_areas = &drupal_static(__FUNCTION__, array());
  if (empty($administrative_areas)) {
    // Get the default administrative areas.
    $administrative_areas = _bei_order_get_administrative_areas_defaults();
  }

  return isset($administrative_areas[$country_code]) ? $administrative_areas[$country_code] : NULL;
}

/**
 * Provides the default administrative areas.
 */
function _bei_order_get_administrative_areas_defaults() {
  // To avoid needless pollution of the strings list we only pass to t()
  // those administrative areas that are in English (or a latin transcription),
  // and belong to a country that either has multiple official languages (CA)
  // or uses a non-latin script (AE, CN, JP, KR, UA, RU, etc).
  // No translation is expected in other cases.
  $administrative_areas = array();
  $administrative_areas['CA'] = array(
    'AB' => t('Alberta'),
    'BC' => t('British Columbia'),
    'MB' => t('Manitoba'),
    'NB' => t('New Brunswick'),
    'NL' => t('Newfoundland and Labrador'),
    'NT' => t('Northwest Territories'),
    'NS' => t('Nova Scotia'),
    'NU' => t('Nunavut'),
    'ON' => t('Ontario'),
    'PE' => t('Prince Edward Island'),
    'QC' => t('Quebec'),
    'SK' => t('Saskatchewan'),
    'YT' => t('Yukon Territory'),
  );
  $administrative_areas['US'] = array(
    'AL' => t('Alabama'),
    'AK' => t('Alaska'),
    'AZ' => t('Arizona'),
    'AR' => t('Arkansas'),
    'CA' => t('California'),
    'CO' => t('Colorado'),
    'CT' => t('Connecticut'),
    'DE' => t('Delaware'),
    'DC' => t('District of Columbia'),
    'FL' => t('Florida'),
    'GA' => t('Georgia'),
    'HI' => t('Hawaii'),
    'ID' => t('Idaho'),
    'IL' => t('Illinois'),
    'IN' => t('Indiana'),
    'IA' => t('Iowa'),
    'KS' => t('Kansas'),
    'KY' => t('Kentucky'),
    'LA' => t('Louisiana'),
    'ME' => t('Maine'),
    'MD' => t('Maryland'),
    'MA' => t('Massachusetts'),
    'MI' => t('Michigan'),
    'MN' => t('Minnesota'),
    'MS' => t('Mississippi'),
    'MO' => t('Missouri'),
    'MT' => t('Montana'),
    'NE' => t('Nebraska'),
    'NV' => t('Nevada'),
    'NH' => t('New Hampshire'),
    'NJ' => t('New Jersey'),
    'NM' => t('New Mexico'),
    'NY' => t('New York'),
    'NC' => t('North Carolina'),
    'ND' => t('North Dakota'),
    'OH' => t('Ohio'),
    'OK' => t('Oklahoma'),
    'OR' => t('Oregon'),
    'PA' => t('Pennsylvania'),
    'RI' => t('Rhode Island'),
    'SC' => t('South Carolina'),
    'SD' => t('South Dakota'),
    'TN' => t('Tennessee'),
    'TX' => t('Texas'),
    'UT' => t('Utah'),
    'VT' => t('Vermont'),
    'VA' => t('Virginia'),
    'WA' => t('Washington'),
    'WV' => t('West Virginia'),
    'WI' => t('Wisconsin'),
    'WY' => t('Wyoming'),
    ' ' => t('--'),
    'AA' => t('Armed Forces (Americas)'),
    'AE' => t('Armed Forces (Europe, Canada, Middle East, Africa)'),
    'AP' => t('Armed Forces (Pacific)'),
    'AS' => t('American Samoa'),
    'FM' => t('Federated States of Micronesia'),
    'GU' => t('Guam'),
    'MH' => t('Marshall Islands'),
    'MP' => t('Northern Mariana Islands'),
    'PW' => t('Palau'),
    'PR' => t('Puerto Rico'),
    'VI' => t('Virgin Islands'),
  );
  return $administrative_areas;
}

function bei_order_form_submit($form, &$form_state) {
  global $user;
  $order = entity_ui_form_submit_build_entity($form, $form_state);
  // Store a variable to identify this as a new order.
  $is_new = !isset($order->oid) ? TRUE : FALSE;
  $is_author = !$is_new ? $user->uid == $order->uid : FALSE;
  $values = $form_state['values'];
  $data['address'] = $values['address'];
  $data['shipping_address'] = $values['shipping_address'];
  // Remove the colors container from the saved values to work with existing data.
  // Needed container for visibility rules.
  if (isset($values['branding']['colors'])) {
    foreach($values['branding']['colors'] as $key => $color) {
      $values['branding'][$key] = $color;
    }
    unset($values['branding']['colors']);
  }
  $data['branding'] = $values['branding'];
  $data['materials'] = $values['materials'];
  $order->data = $data;
  $message = 'Your changes have been saved.';
  $submitted = FALSE;
  $revised = FALSE;
  // Create a revision record if this is a new order or if specifying revision.
  if ($is_new || !empty($values['revision'])) {
    $order->is_new_revision = TRUE;
  }
  if ($form_state['clicked_button']['#name'] == 'save_draft' && $is_new) {
    $message = 'Your order has been created!';
  }
  // If a revision is being made by the original author, update the status.
  if ($form_state['clicked_button']['#name'] == 'save_revision' && $is_author) {
    $order->status = 3;
    $message = 'Your requested changes have been submitted.';
    $revised = TRUE;
  }
  // If a user clicked the submit order button, update the status.
  if ($form_state['clicked_button']['#name'] == 'submit_order') {
    $order->status = 1;
    $message = 'Your order was submitted!';
    $submitted = TRUE;
  }
  // Save the order.
  bei_order_save($order);
  
  
  if ($is_new || $submitted || $revised) {
    $order_uri = entity_uri('bei_order', $order);
    unset($_GET['destination']);
    $form_state['redirect'] = $order_uri['path'] . '/done';
  }
  drupal_set_message(t($message));
}

/**
 * Form submission handler for the 'Add ajustments' button.
 */
function bei_order_more_adjustments_submit($form, &$form_state) {
  $form_state['add_adjustment'] = 1;
  $form_state['rebuild'] = TRUE;
}
/**
 * Form submission handler for the 'Remove adjustment' button.
 */
function bei_order_remove_adjustment_submit($form, &$form_state) {
  $key = $form_state['triggering_element']['#parents'][2];
  $form_state['remove_adjustment'] = $key;
  $form_state['rebuild'] = TRUE;
}

/**
 * Implementation of hook_validate().
 *
 * Errors should be signaled with form_error().
 */
function bei_order_form_validate($form, &$form_state) {
  $values = $form_state['values'];
  $trigger = $form_state['triggering_element'];
  if (empty($values['materials']['total_cost'])) {
    form_set_error('materials', 'You must select a quantity for at least 1 material.');
  }
  if ($trigger['#name'] == 'address[country]') {
    $form_state['values']['address']['country'] = $trigger['#value'];
    $form_state['values']['address']['state'] = '';
    unset($form_state['input']['address']['state']);
    $form_state['rebuild'] = TRUE;
  }
  elseif ($trigger['#name'] == 'shipping_address[country]') {
    $form_state['values']['shipping_address']['country'] = $trigger['#value'];
    $form_state['values']['shipping_address']['state'] = '';
    $form_state['rebuild'] = TRUE;
  }
  elseif ($trigger['#name'] == 'shipping_address[copy]') {
    unset($form_state['input']['shipping_address']);
    $form_state['values']['shipping_address'] = array(
      'country' => $values['address']['country'],
      'street' => $values['address']['street'],
      'additional' => $values['address']['additional'],
      'city' => $values['address']['city'],
      'state' => $values['address']['state'],
      'postal_code' => $values['address']['postal_code'],
    );
    $form_state['rebuild'] = TRUE;
  }
}
function bei_order_numeric_validate($element, &$form_state, $form) {
  if (!empty($element['#value'])) {
    if (!is_numeric($element['#value']) || $element['#value'] < 0) {
      form_error($element, t($element['#title'] . '  must be a positive integer.'));
    }
  }
}
function bei_order_email_validate($element, &$form_state, $form) {
  if (!empty($element['#value']) && !valid_email_address($element['#value'])) {
    form_error($element, t($element['#value'] . '  is not a valid E-mail address.'));
  }
}
function bei_order_color_validate($element, &$form_state, $form) {
  $value = $element['#value']['colorfield_picker'];
  if (!empty($value) && !preg_match('@^#[0-9a-f]{6}$@i', $value)) {
    form_error($element, t($element['#title'] . ' must be a hexadecimal value (eg: #84CCAF).'));
  }
}
/*
 * Ajax callback to return provinces for address1.
 */
function bei_order_address1_refresh($form, $form_state) {
  return $form['wrapper']['contact_info']['address'];
}
/*
 * Ajax callback to return provinces for address2.
 */
function bei_order_address2_refresh($form, $form_state) {
  return $form['wrapper']['shipping_address'];
}

/*
 * Ajax callback to update pricing.
 */
function bei_order_update_pricing($form, $form_state) {
  return $form['wrapper']['materials'];
}

/*
 * Submit callback for Delete button.
 */
function bei_order_form_submit_delete($form, &$form_state) {
  $order = $form_state['bei_order'];
  $order_uri = entity_uri('bei_order', $order);
  unset($_GET['destination']);
  $form_state['redirect'] = $order_uri['path'] . '/delete';
}
/**
 * Delete confirmation form.
 */
function bei_order_delete_form($form, &$form_state, $order) {
  $form_state['bei_order'] = $order;
  // Always provide entity id in the same form key as in the entity edit form.
  $form['order_id'] = array('#type' => 'value', '#value' => entity_id('bei_order', $order));
  $order_uri = entity_uri('bei_order', $order);
  return confirm_form($form,
    t('Are you sure you want to delete order %name?', array('%name' => entity_label('bei_order', $order))),
    $order_uri['path'],
    t('This action cannot be undone.'),
    t('Delete'),
    t('Cancel')
  );
}
/**
 * Delete form submit handler.
 */
function bei_order_delete_form_submit($form, &$form_state) {
  $order = $form_state['bei_order'];
  bei_order_delete($order);

  drupal_set_message(t('Order %id deleted.', array('%id' => $order->oid)));
}
