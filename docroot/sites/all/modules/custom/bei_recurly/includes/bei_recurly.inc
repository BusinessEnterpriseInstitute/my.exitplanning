<?php

function bei_recurly_menu_alter(&$items) {
  $entity_type = variable_get('recurly_entity_type', 'user');
  if ($entity_type && variable_get('recurly_pages', '1')) {
    $entity_path = $entity_type . '/%' . $entity_type;
    unset($items[$entity_path . '/subscription']);
    unset($items[$entity_path . '/subscription/list']);
    unset($items[$entity_path . '/subscription/signup']);
    unset($items[$entity_path . '/subscription/change']);
    unset($items[$entity_path . '/subscription/cancel']);
    unset($items[$entity_path . '/subscription/reactivate']);
    unset($items[$entity_path . '/subscription/id/%']);
    unset($items[$entity_path . '/subscription/id/%/change/%']);
    unset($items[$entity_path . '/subscription/id/%/cancel']);
    unset($items[$entity_path . '/subscription/id/%/reactivate']);
    unset($items[$entity_path . '/subscription/invoices']);
    unset($items[$entity_path . '/subscription/invoices/%']);
    unset($items[$entity_path . '/subscription/invoices/%/pdf']);
    unset($items[$entity_path . '/subscription/billing']);
    if (variable_get('recurly_coupon_page', '1')) {
      unset($items[$entity_path . '/subscription/redeem-coupon']);
    }
  }
}

function bei_recurly_block_info() {
  $blocks = array();
  $blocks['recurly_membership'] = array(
    'info' => t('Recurly Membership'),
    'cache' => DRUPAL_NO_CACHE,
  );
  return $blocks;
}

function bei_recurly_block_view($delta) {
  bei_recurly_load_recurly_library();
  global $user;
  
  $blocks = array();
  switch ($delta) {
    case 'recurly_membership':
      try {
        $account = Recurly_Account::get($user->uid);
        if ($account) {
          try {
            $subscriptions = Recurly_SubscriptionList::getForAccount($account->account_code, array('state' => 'active'));
            if ($subscriptions) {
              $plan_array = array();
              foreach ($subscriptions as $subscription) {
                $plan_array['plan_name'] = isset($subscription->plan->name) ? $subscription->plan->name : '';
                $plan_array['end_date'] = isset($subscription->current_period_ends_at) ? $subscription->current_period_ends_at->getTimestamp() : '';
              }
              $block['membership-details'] = array(
                '#type' => 'container',
                '#prefix' => '<div id="membership-details-dashboard"><h2 id="greeting">Welcome, ' . $account->first_name . ' ' . $account->last_name . '!</h2>',
                '#suffix' => '</div>',
              );
              if (!empty($plan_array)) {
                $block['membership-details']['account_type'] = array(
                  '#markup' => '<strong>Membership Type:</strong> ' . $plan_array['plan_name'],
                  '#prefix' => '<div id="membership-type">',
                  '#suffix' => '</div>',
                );
                $block['membership-details']['renewal_date'] = array(
                  '#markup' => '<strong>Last Day of Billing Period:</strong> ' . date('m/d/Y', $plan_array['end_date']),
                  '#prefix' => '<div id="renewal-date">',
                  '#suffix' => '</div>',
                );
              }
              $block['membership-details']['manage_preferences'] = array(
                '#markup' => l('Manage Preferences', '/user/' . $user->uid . '/edit', array('attributes' => array('class' => array('button alert')))),
              );
              $blocks['content'] = $block;
            }
          }
          catch (Recurly_NotFoundError $e) {
            $blocks['content'] = '';
          }
        }
      }
      catch (Recurly_NotFoundError $e) {
        $blocks['content'] = '';
      }
      break;
  }
  return $blocks;
}

function bei_recurly_form_user_profile_form_alter(&$form, &$form_state, $form_id) {
  bei_recurly_load_recurly_library();
  // Get current subscription
  $uid = arg(1);
  try {
    $account = Recurly_Account::get($uid);
    if ($account) {
      $balance = Recurly_AccountBalance::get($account->account_code);
      try {
        $subscriptions = Recurly_SubscriptionList::getForAccount($account->account_code, array('state' => 'active'));
        $plan_array = array();
        foreach ($subscriptions as $subscription) {
          $plan_array['uuid'] = $subscription->uuid;
          $plan_array['plan_name'] = $subscription->plan->name;
          $plan_array['plan_code'] = preg_split('~-(?=[^-]*$)~', $subscription->plan->plan_code);
          $plan_array['end_date'] = $subscription->current_period_ends_at->getTimestamp();
        }
        if (!empty($plan_array)) {
          // Remove upgrade option if they have the full plan
          $plans = Recurly_PlanList::get();
          $full_plan = FALSE;
          $upgrade_plan_array = array();
          $enabled_plans_array = array_values(variable_get('recurly_subscription_plans', array()));
          foreach ($enabled_plans_array as $plan) {
            $plan_code = str_replace('-yearly', '', $plan);
            $plan_code = str_replace('-monthly', '', $plan_code);
            $upgrade_plan_array[] = $plan_code;
          }
          $upgrade_plan_array = array_values(array_unique($upgrade_plan_array));
          end($upgrade_plan_array);
          $last_plan_key = key($upgrade_plan_array);
          foreach ($plans as $plan) {
            $current_plan_key = array_search($plan_array['plan_code'][0], $upgrade_plan_array);
            if ($last_plan_key == $current_plan_key && $plan_array['plan_code'][1] == 'yearly') {
              $full_plan = TRUE;
            }
          }
          
          // Get current billing info
          try {
            $billing_info = Recurly_BillingInfo::get($uid);
          }
          catch (Recurly_ValidationError $e) {
            form_set_error('membership', $e->getMessage());
          }
          catch (Recurly_NotFoundError $e) {
            form_set_error('membership', $e->getMessage());
          }
          $first_name = '';
          $last_name = '';
          if (isset($billing_info->first_name) && isset($billing_info->last_name)) {
            $first_name = $billing_info->first_name;
            $last_name = $billing_info->last_name;
          }
          elseif (isset($billing_info->name_on_account)) {
            $first_name = strtok($billing_info->name_on_account, ' ');
            $last_name = substr($billing_info->name_on_account, strrpos($billing_info->name_on_account, ' ') + 1);
          }
    
          // Show current membership plan if it exists, otherwise show CTA to purchase plan
          ctools_include('ajax');
          ctools_include('modal');
          ctools_modal_add_js();
          $form['membership-details'] = array(
            '#type' => 'container',
            '#prefix' => '<div id="membership-details"><h2>Membership Details</h2>',
            '#suffix' => '</div>',
          );
          $form['membership-details']['account_type'] = array(
            '#markup' => '<strong>Account Type:</strong> ' . $plan_array['plan_name'],
            '#prefix' => '<div id="account-type">',
            '#suffix' => '</div>',
          );
          $form['membership-details']['renewal_date'] = array(
            '#markup' => '<strong>Last Day of Billing Period:</strong> ' . date('m/d/Y', $plan_array['end_date']),
            '#prefix' => '<div id="renewal-date">',
            '#suffix' => '</div>',
          );
          if ($balance->past_due) {
            $form['membership-details']['past_due'] = array(
              '#markup' => '<strong>Past Due:</strong> You have an existing unpaid invoice. Please verify your billing information to prevent your membership from expiring.',
              '#prefix' => '<div id="past-due">',
              '#suffix' => '</div>',
            );
          }
          if ($full_plan == FALSE) {
            $form['membership-details']['upgrade'] = array(
              '#markup' => l('Upgrade Membership', "/user/$uid/edit/membership/nojs", array('attributes' => array('class' => 'ctools-use-modal'))),
              '#prefix' => '<div id="upgrade-link">',
              '#suffix' => '</div>',
            );
          }
          $form['membership-details']['cancel'] = array(
            '#markup' => l('Cancel Membership', "/user/$uid/edit/membership/cancel/nojs", array('attributes' => array('class' => 'ctools-use-modal'))),
            '#prefix' => '<div id="cancel-link">',
            '#suffix' => '</div>',
          );
          $form['account_details'] = array(
            '#markup' => '<h2 style="margin-top: 50px">Account Details</h2>'
          );
          $form['#group_children']['membership-details'] = 'group_account_info';
          $form['#group_children']['account_details'] = 'group_account_info';
          
          // Show billing information fields
          if (!empty($billing_info)) {
            $form['billing'] = array(
              '#type' => 'container',
              '#prefix' => '<div id="billing">',
              '#suffix' => '</div>',
            );
            $form['billing']['billing-address'] = array(
              '#type' => 'container',
              '#prefix' => '<h2>'.t('Billing Address').'</h2><table id="billing-address"><tbody id="billing-address-body">',
              '#suffix' => '</tbody></table>',
            );
            $form['billing']['billing-address']['first_name'] = array(
              '#markup' =>'<tr id="billing-first-name"><td class="billing-label">'.t('First Name').'</td>'.
              '<td class="billing-value">'.t($first_name).'</td></tr>'
            );
            $form['billing']['billing-address']['last_name'] = array(
              '#markup' =>'<tr id="billing-last-name"><td class="billing-label">'.t('Last Name').'</td>'.
              '<td class="billing-value">'.t($last_name).'</td></tr>'
            );
            $form['billing']['billing-address']['address'] = array(
              '#markup' =>'<tr id="billing-address-address"><td class="billing-label">'.t('Address').'</td>'.
              '<td class="billing-value">'.t($billing_info->address1).'</td></tr>'
            );
            $form['billing']['billing-address']['city'] = array(
              '#markup' =>'<tr id="billing-city"><td class="billing-label">'.t('City').'</td>'.
              '<td class="billing-value">'.t($billing_info->city).'</td></tr>'
            );
            $form['billing']['billing-address']['state'] = array(
              '#markup' =>'<tr id="billing-state"><td class="billing-label">'.t('State').'</td>'.
              '<td class="billing-value">'.t($billing_info->state).'</td></tr>'
            );
            $form['billing']['billing-address']['zip'] = array(
              '#markup' =>'<tr id="billing-zip"><td class="billing-label">' . t('Zip') . '</td>'.
              '<td class="billing-value">' . t($billing_info->zip) . '</td></tr>'
            );
            $form['billing']['payment-info'] = array(
              '#type' => 'container',
              '#prefix' => '<h2>'.t('Payment Method').'</h2><table id="payment-info-table"><tbody id="payment-info-body">',
              '#suffix' => '</tbody></table>',
            );
            if (isset($billing_info->name_on_account) && isset($billing_info->routing_number) && isset($billing_info->last_four)) {
                $form['billing']['payment-info']['name_on_account'] = array(
                '#markup' =>'<tr id="payment-name-on-account"><td class="payment-label">'.t('Name on Account').'</td>'.
                '<td class="payment-value">'.t($billing_info->name_on_account).'</td></tr>'
              );
                $form['billing']['payment-info']['routing_number'] = array(
                '#markup' =>'<tr id="payment-routing-number"><td class="payment-label">'.t('Routing Number').'</td>'.
                '<td class="payment-value">'.t($billing_info->routing_number).'</td></tr>'
              );
                $form['billing']['payment-info']['checking_account_number'] = array(
                '#markup' =>'<tr id="payment-checking-account-number"><td class="payment-label">'.t('Checking Account Number').'</td>'.
                '<td class="payment-value">'.t('ending in ' . $billing_info->last_four).'</td></tr>'
              );
            } elseif (isset($billing_info->card_type) && isset($billing_info->last_four) && isset($billing_info->first_name) && isset($billing_info->last_name) && isset($billing_info->month) && isset($billing_info->year)) {
                $form['billing']['payment-info']['name_on_card'] = array(
                '#markup' =>'<tr id="payment-name-on-card"><td class="payment-label">'.t('Name on Card').'</td>'.
                '<td class="payment-value">'.t($billing_info->first_name . ' ' . $billing_info->last_name).'</td></tr>'
              );
                $form['billing']['payment-info']['card_type'] = array(
                '#markup' =>'<tr id="payment-card-type"><td class="payment-label">'.t('Card Type').'</td>'.
                '<td class="payment-value">'.t($billing_info->card_type . ' ending in ' . $billing_info->last_four).'</td></tr>'
              );
                $form['billing']['payment-info']['expires'] = array(
                '#markup' =>'<tr id="payment-expires"><td class="payment-label">'.t('Expires').'</td>'.
                '<td class="payment-value">'.t($billing_info->month . '/' . $billing_info->year).'</td></tr>'
              );
            }
            $form['billing_edit'] = array(
              '#markup' => l('Edit Billing Info', "/user/$uid/edit/membership/billing/nojs", array('attributes' => array('class' => 'ctools-use-modal'))),
              '#prefix' => '<div id="edit-billing-link">',
              '#suffix' => '</div>',
            );
            $form['#group_children']['billing'] = 'group_billing_info';
            $form['#group_children']['billing_edit'] = 'group_billing_info';
          }
        }
      }
      catch (Recurly_NotFoundError $e) {
        $subscriptions = NULL;
      }
    }
  }
  catch (Recurly_NotFoundError $e) {
  }
}

function bei_recurly_preprocess_html(&$variables) {
  drupal_add_js(array(
    'CToolsModal' => array(
      'closeText' => t('X'), 
      'closeImage' => array(),
      'throbber' => array(),
  )), 'setting');
}

function bei_recurly_modal_callback($uid, $ajax = FALSE) {
  // Callback to render subscription form in modal
  if ($ajax) {
    ctools_include('modal');
    ctools_include('ajax');
    $form_state = array(
      'ajax' => TRUE,
      're_render' => TRUE,
      'build_info' => array(
        'args' => array(
          0 => $uid
        )
      )
    );
    $output = ctools_modal_form_wrapper('bei_recurly_upgrade_form', $form_state);
    if (!empty($form_state['ajax_commands'])) {
      $output = $form_state['ajax_commands'];
    }
    print ajax_render($output);
    drupal_exit();
  }
  else {
    return drupal_get_form('bei_recurly_upgrade_form');
  }
}

function bei_recurly_cancel_callback($uid, $ajax = FALSE) {
  // Callback to render cancellation form in modal
  if ($ajax) {
    ctools_include('modal');
    ctools_include('ajax');
    $form_state = array(
      'ajax' => TRUE,
      're_render' => TRUE,
      'build_info' => array(
        'args' => array(
          0 => $uid
        )
      )
    );
    $output = ctools_modal_form_wrapper('bei_recurly_cancel_form', $form_state);
    if (!empty($form_state['ajax_commands'])) {
      $output = $form_state['ajax_commands'];
    }
    print ajax_render($output);
    drupal_exit();
  }
  else {
    return drupal_get_form('bei_recurly_cancel_form');
  }
}

function bei_recurly_billing_callback($uid, $ajax = FALSE) {
  // Callback to render billing info edit form in modal
  if ($ajax) {
    ctools_include('modal');
    ctools_include('ajax');
    $form_state = array(
      'ajax' => TRUE,
      're_render' => TRUE,
      'build_info' => array(
        'args' => array(
          0 => $uid
        )
      )
    );
    $output = ctools_modal_form_wrapper('bei_recurly_billing_form', $form_state);
    if (!empty($form_state['ajax_commands'])) {
      $output = $form_state['ajax_commands'];
    }
    print ajax_render($output);
    drupal_exit();
  }
  else {
    return drupal_get_form('bei_recurly_billing_form');
  }
}

function bei_recurly_modal_access_callback($uid, $ajax = FALSE) {
  // Check if user is allowed to access form
  bei_recurly_load_recurly_library();
  global $user;
  if ($uid !== $user->uid && !user_access('administer users')) {
    return FALSE;
  }
  else {
    try {
      $subscriptions = Recurly_SubscriptionList::getForAccount($uid, array('state' => 'active'));
      return TRUE;
    }
    catch (Recurly_NotFoundError $e) {
      return FALSE;
    }
  }
}

function bei_recurly_billing_form($form, $form_state) {
  bei_recurly_load_recurly_library();
  $uid = $form_state['build_info']['args'][0];
  $form_state['rebuild'] = true;
    
  // Get current billing info
  try {
    $billing_info = Recurly_BillingInfo::get($uid);
  }
  catch (Recurly_ValidationError $e) {
    form_set_error('membership', $e->getMessage());
  }
  catch (Recurly_NotFoundError $e) {
    form_set_error('membership', $e->getMessage());
  }
  $first_name = '';
  $last_name = '';
  if (isset($billing_info->first_name) && isset($billing_info->last_name)) {
    $first_name = $billing_info->first_name;
    $last_name = $billing_info->last_name;
  }
  elseif (isset($billing_info->name_on_account)) {
    $first_name = strtok($billing_info->name_on_account, ' ');
    $last_name = substr($billing_info->name_on_account, strrpos($billing_info->name_on_account, ' ') + 1);
  }
  // Get default payment method
  $default_payment_method = '';
  if (isset($billing_info->name_on_account) && isset($billing_info->routing_number) && isset($billing_info->last_four)) {
    $default_payment_method = 'checking_account';
  }
  elseif (isset($billing_info->card_type) && isset($billing_info->last_four) && isset($billing_info->first_name) && isset($billing_info->last_name) && isset($billing_info->month) && isset($billing_info->year)) {
    $default_payment_method = 'credit_card';
  }
  
  // Build modal form for payment info
  $form['billing-edit'] = array(
    '#type' => 'container',
    '#prefix' => '<div id="billing-edit">',
    '#suffix' => '</div>',
  );
  $form['billing-edit']['address-info'] = array(
    '#type' => 'container',
    '#prefix' => '<div id="address-info"><h2>Billing Address</h2>',
    '#suffix' => '</div>',
  );
  $form['billing-edit']['address-info']['first_name'] = array(
    '#type' => 'textfield',
    '#title' => t('First Name'),
    '#default_value' => $first_name,
    '#required' => TRUE,
  );
  $form['billing-edit']['address-info']['last_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Last Name'),
    '#default_value' => $last_name,
    '#required' => TRUE,
  );
  $form['billing-edit']['address-info']['address'] = array(
    '#type' => 'textfield',
    '#title' => t('Address'),
    '#default_value' => isset($billing_info->address1) ? $billing_info->address1 : '',
    '#required' => TRUE,
  );   
  $form['billing-edit']['address-info']['city'] = array(
    '#type' => 'textfield',
    '#title' => t('City'),
    '#size' => 15,
    '#default_value' => isset($billing_info->city) ? $billing_info->city : '',
    '#required' => TRUE,
  );
  $form['billing-edit']['address-info']['state'] = array(
    '#type' => 'select',
    '#title' => t('State'),
    '#options' => bei_recurly_state_list(),
    '#default_value' => isset($billing_info->state) ? $billing_info->state : '',
    '#required' => TRUE,
  );
  $form['billing-edit']['address-info']['zip'] = array(
    '#type' => 'textfield',
    '#title' => t('Zip Code'),
    '#size' => 5,
    '#default_value' => isset($billing_info->zip) ? $billing_info->zip : '',
    '#required' => TRUE,
  );
  $form['billing-edit']['payment-info'] = array(
    '#type' => 'container',
    '#prefix' => '<div id="payment-info"><h2>Payment Method</h2>',
    '#suffix' => '</div>',
  );
  $form['billing-edit']['payment-info']['payment_method'] = array(
    '#type' => 'radios',
    '#options' => array('credit_card' => 'Credit Card', 'checking_account' => 'Checking Account'),
    '#default_value' => $default_payment_method,
    '#required' => TRUE,
    '#ajax' => array(
      'callback' => 'bei_recurly_form_payment_fields_refresh',
      'wrapper' => 'payment-fields',
      'method' => 'html',
    ),
  );
  $form['billing-edit']['payment-info']['fields'] = array(
    '#type' => 'container',
    '#prefix' => '<div id="payment-fields">',
    '#suffix' => '</div>',
  );
  if (isset($billing_info->name_on_account) && isset($billing_info->routing_number) && isset($billing_info->last_four)) {
    $form['billing-edit']['payment-info']['fields']['bank_routing_number'] = array(
      '#type' => 'textfield',
      '#title' => t('Bank Routing Number'),
      '#default_value' => isset($billing_info->routing_number) ? $billing_info->routing_number : '',
      '#prefix' => '<img src="/' . drupal_get_path('module', 'bei_recurly') . '/images/Check.png" class="check-image" style="width: 400px; margin: 10px 0;">',
      '#required' => TRUE,
    );
    $form['billing-edit']['payment-info']['fields']['checking_account_number'] = array(
      '#type' => 'textfield',
      '#title' => t('Checking Account Number'),
      '#required' => TRUE,
    );
  } elseif (isset($billing_info->card_type) && isset($billing_info->last_four) && isset($billing_info->first_name) && isset($billing_info->last_name) && isset($billing_info->month) && isset($billing_info->year)) {
    $form['billing-edit']['payment-info']['fields']['card_number'] = array(
      '#type' => 'creditfield_cardnumber',
      '#title' => t('Card Number'),
      '#maxlength' => 16,
      '#required' => TRUE,
    );
    $form['billing-edit']['payment-info']['fields']['expires'] = array(
      '#type' => 'creditfield_date',
      '#title' => t('Expires'),
      '#default_value' => isset($billing_info->month) && isset($billing_info->year) ? array('month' => $billing_info->month, 'year' => $billing_info->year) : '',
      '#required' => TRUE,
    );
    $form['billing-edit']['payment-info']['fields']['cvv_code'] = array(
      '#type' => 'creditfield_cvv',
      '#title' => t('CVV Code'),
      '#maxlength' => 4,
      '#required' => TRUE,
    );
  }
  if (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'checking_account') {
    unset($form['billing-edit']['payment-info']['fields']);
    $form['billing-edit']['payment-info']['fields']['bank_routing_number'] = array(
      '#type' => 'textfield',
      '#title' => t('Bank Routing Number'),
      '#default_value' => isset($billing_info->routing_number) ? $billing_info->routing_number : '',
      '#prefix' => '<img src="/' . drupal_get_path('module', 'bei_recurly') . '/images/Check.png" class="check-image" style="width: 400px; margin: 10px 0;">',
      '#required' => TRUE,
    );
    $form['billing-edit']['payment-info']['fields']['checking_account_number'] = array(
      '#type' => 'textfield',
      '#title' => t('Checking Account Number'),
      '#required' => TRUE,
    );
  }
  elseif (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'credit_card') {
    unset($form['billing-edit']['payment-info']['fields']);
    $form['billing-edit']['payment-info']['fields']['card_number'] = array(
      '#type' => 'creditfield_cardnumber',
      '#title' => t('Card Number'),
      '#maxlength' => 16,
      '#required' => TRUE,
    );
    $form['billing-edit']['payment-info']['fields']['expires'] = array(
      '#type' => 'creditfield_date',
      '#title' => t('Expires'),
      '#default_value' => isset($billing_info->month) && isset($billing_info->year) ? array('month' => $billing_info->month, 'year' => $billing_info->year) : '',
      '#required' => TRUE,
    );
    $form['billing-edit']['payment-info']['fields']['cvv_code'] = array(
      '#type' => 'creditfield_cvv',
      '#title' => t('CVV Code'),
      '#maxlength' => 4,
      '#required' => TRUE,
    );
  }
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Update'),
    '#attributes' => array('id' => 'billing-submit')
  );
  $form['cancel'] = array(
    '#markup' => l(t('Cancel'), '#',
      array(
       'attributes' => array(
         'class' => 'ctools-close-modal'
        ),
       'external' => TRUE
      )
     )
  );
  return $form;
}

function bei_recurly_form_payment_fields_refresh($form, &$form_state) {
  return $form['billing-edit']['payment-info']['fields'];
}

function bei_recurly_billing_form_validate($form, &$form_state) {
  bei_recurly_load_recurly_library();
  $uid = $form_state['build_info']['args'][0];
  
  // Check for billing info and update as necessary
  if (isset($form_state['values']['op']) && $form_state['values']['op'] == $form_state['values']['submit']) {
    try {
      $billing_info = Recurly_BillingInfo::get($uid);
      $billing_info->address1 = $form_state['values']['address'];
      $billing_info->city = $form_state['values']['city'];
      $billing_info->state = $form_state['values']['state'];
      $billing_info->country = 'US';
      $billing_info->zip = $form_state['values']['zip'];
      if (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'credit_card') {
        if (!empty($form_state['values']['first_name']) && !empty($form_state['values']['last_name']) && !empty($form_state['values']['card_number']) && !empty($form_state['values']['expires']) && !empty($form_state['values']['cvv_code'])) {
          $billing_info->first_name = $form_state['values']['first_name'];
          $billing_info->last_name = $form_state['values']['last_name'];
          $billing_info->number = $form_state['values']['card_number'];
          $billing_info->verification_value = $form_state['values']['cvv_code'];
          $billing_info->month = $form_state['values']['expires']['month'];
          $billing_info->year = $form_state['values']['expires']['year'];
          $billing_info->update();
        }
        else {
          return FALSE;
        }
      }
      elseif (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'checking_account') {
        if (!empty($form_state['values']['first_name']) && !empty($form_state['values']['last_name']) && !empty($form_state['values']['bank_routing_number']) && !empty($form_state['values']['checking_account_number'])) {
          $billing_info->name_on_account = $form_state['values']['first_name'] . ' ' . $form_state['values']['last_name'];
          $billing_info->routing_number = $form_state['values']['bank_routing_number'];
          $billing_info->account_number = $form_state['values']['checking_account_number'];
          $billing_info->account_type = 'checking';
          $billing_info->update();
        }
        else {
          return FALSE;
        }
      }
    }
    catch (Recurly_ValidationError $e) {
      form_set_error('billing-edit', $e->getMessage());
      if (isset($e->errors[0]->field)) { 
        $error_fields = $e->errors; 
        foreach($error_fields as $error) {
          if ($error->symbol == 'expired') {
            form_set_error('year', '');	
          }
          else {
            form_set_error($error->field, '');	
          }
        }
      }
      return FALSE;
    }
    catch (Recurly_NotFoundError $e) {
      form_set_error('billing-edit', $e->getMessage());
      return FALSE;
    }
  }

  return TRUE;
}

function bei_recurly_billing_form_submit($form, &$form_state) {
  bei_recurly_load_recurly_library();
  $uid = $form_state['build_info']['args'][0];
  $form_state['rebuild'] = true;
  
  // Get saved billing info
  try {
    $billing_info = Recurly_BillingInfo::get($uid);
  }
  catch (Recurly_ValidationError $e) {
    form_set_error('membership', $e->getMessage());
  }
  catch (Recurly_NotFoundError $e) {
    form_set_error('membership', $e->getMessage());
  }
  $first_name = '';
  $last_name = '';
  if (isset($billing_info->first_name) && isset($billing_info->last_name)) {
    $first_name = $billing_info->first_name;
    $last_name = $billing_info->last_name;
  }
  elseif (isset($billing_info->name_on_account)) {
    $first_name = strtok($billing_info->name_on_account, ' ');
    $last_name = substr($billing_info->name_on_account, strrpos($billing_info->name_on_account, ' ') + 1);
  }
  // Update billing pane with saved billing info
  if (!empty($billing_info)) {
    $form['billing']['billing-address']['first_name'] = array(
      '#markup' =>'<tr id="billing-first-name"><td class="billing-label">'.t('First Name').'</td>'.
      '<td class="billing-value">'.t($first_name).'</td></tr>'
    );
    $form['billing']['billing-address']['last_name'] = array(
      '#markup' =>'<tr id="billing-last-name"><td class="billing-label">'.t('Last Name').'</td>'.
      '<td class="billing-value">'.t($last_name).'</td></tr>'
    );
    $form['billing']['billing-address']['address'] = array(
      '#markup' =>'<tr id="billing-address-address"><td class="billing-label">'.t('Address').'</td>'.
      '<td class="billing-value">'.t($billing_info->address1).'</td></tr>'
    );
    $form['billing']['billing-address']['city'] = array(
      '#markup' =>'<tr id="billing-city"><td class="billing-label">'.t('City').'</td>'.
      '<td class="billing-value">'.t($billing_info->city).'</td></tr>'
    );
    $form['billing']['billing-address']['state'] = array(
      '#markup' =>'<tr id="billing-state"><td class="billing-label">'.t('State').'</td>'.
      '<td class="billing-value">'.t($billing_info->state).'</td></tr>'
    );
    $form['billing']['billing-address']['zip'] = array(
      '#markup' =>'<tr id="billing-zip"><td class="billing-label">'.t('Zip').'</td>'.
      '<td class="billing-value">'.t($billing_info->zip).'</td></tr>'
    );
    $form_state['ajax_commands'][] = ajax_command_replace('#billing-first-name', render($form['billing']['billing-address']['first_name']));
    $form_state['ajax_commands'][] = ajax_command_replace('#billing-last-name', render($form['billing']['billing-address']['last_name']));
    $form_state['ajax_commands'][] = ajax_command_replace('#billing-address-address', render($form['billing']['billing-address']['address']));
    $form_state['ajax_commands'][] = ajax_command_replace('#billing-city', render($form['billing']['billing-address']['city']));
    $form_state['ajax_commands'][] = ajax_command_replace('#billing-state', render($form['billing']['billing-address']['state']));
    $form_state['ajax_commands'][] = ajax_command_replace('#billing-zip', render($form['billing']['billing-address']['zip']));
    $form_state['ajax_commands'][] = ajax_command_remove('#payment-name-on-account');
    $form_state['ajax_commands'][] = ajax_command_remove('#payment-routing-number');
    $form_state['ajax_commands'][] = ajax_command_remove('#payment-checking-account-number');
    $form_state['ajax_commands'][] = ajax_command_remove('#payment-name-on-card');
    $form_state['ajax_commands'][] = ajax_command_remove('#payment-card-type');
    $form_state['ajax_commands'][] = ajax_command_remove('#payment-expires');
    if (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'checking_account') {
      $form['billing']['payment-info']['name_on_account'] = array(
        '#markup' =>'<tr id="payment-name-on-account"><td class="payment-label">'.t('Name on Account').'</td>'.
        '<td class="payment-value">'.t($billing_info->name_on_account).'</td></tr>'
      );
      $form['billing']['payment-info']['routing_number'] = array(
        '#markup' =>'<tr id="payment-routing-number"><td class="payment-label">'.t('Routing Number').'</td>'.
        '<td class="payment-value">'.t($billing_info->routing_number).'</td></tr>'
      );
      $form['billing']['payment-info']['checking_account_number'] = array(
        '#markup' =>'<tr id="payment-checking-account-number"><td class="payment-label">'.t('Checking Account Number').'</td>'.
        '<td class="payment-value">'.t('ending in ' . $billing_info->last_four).'</td></tr>'
      );
      $form_state['ajax_commands'][] = ajax_command_append('#payment-info-body', render($form['billing']['payment-info']['name_on_account']));
      $form_state['ajax_commands'][] = ajax_command_append('#payment-info-body', render($form['billing']['payment-info']['routing_number']));
      $form_state['ajax_commands'][] = ajax_command_append('#payment-info-body', render($form['billing']['payment-info']['checking_account_number']));
    }
    elseif (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'credit_card') {
      $form['billing']['payment-info']['name_on_card'] = array(
        '#markup' =>'<tr id="payment-name-on-card"><td class="payment-label">'.t('Name on Card').'</td>'.
        '<td class="payment-value">'.t($billing_info->first_name . ' ' . $billing_info->last_name).'</td></tr>'
      );
      $form['billing']['payment-info']['card_type'] = array(
        '#markup' =>'<tr id="payment-card-type"><td class="payment-label">'.t('Card Type').'</td>'.
        '<td class="payment-value">'.t($billing_info->card_type . ' ending in ' . $billing_info->last_four).'</td></tr>'
      );
      $form['billing']['payment-info']['expires'] = array(
        '#markup' =>'<tr id="payment-expires"><td class="payment-label">'.t('Expires').'</td>'.
        '<td class="payment-value">'.t($billing_info->month . '/' . $billing_info->year).'</td></tr>'
      );
      $form_state['ajax_commands'][] = ajax_command_append('#payment-info-body', render($form['billing']['payment-info']['name_on_card']));
      $form_state['ajax_commands'][] = ajax_command_append('#payment-info-body', render($form['billing']['payment-info']['card_type']));
      $form_state['ajax_commands'][] = ajax_command_append('#payment-info-body', render($form['billing']['payment-info']['expires']));
    }
  }
  
  $form_state['ajax_commands'][] = ajax_command_prepend('#billing', '<div class="messages status"><button class="dismiss"><span class="element-invisible">Close this message.</span></button>Billing info has been updated.</div>');
  $form_state['ajax_commands'][] = ctools_modal_command_dismiss();
}

function bei_recurly_cancel_form($form, $form_state) {
  $form['membership']['billing_info']['checking_account_number'] = array(
    '#markup' => '<p>To cancel or downgrade your Membership, please contact the
    BEI Support Team at (888) 206-3009 or by email <a href="mailto:membership@exitplanning.com">membership@exitplanning.com</a>.</p>',
    '#prefix' => '<div id="cancel-membership">',
    '#suffix' => '</div>',
  );
  return $form;
}

function bei_recurly_upgrade_form($form, $form_state) {
  bei_recurly_load_recurly_library();
  $uid = $form_state['build_info']['args'][0];
  $form_state['rebuild'] = true;
    
  // Get current plan and add default values to form
  try {
    $subscriptions = Recurly_SubscriptionList::getForAccount($uid, array('state' => 'active'));
    $subscription_array = array();
    foreach ($subscriptions as $subscription) {
      $subscription_array['uuid'] = $subscription->uuid;
      $subscription_array['plan_code_full'] = $subscription->plan->plan_code;
      $subscription_array['plan_code'] = preg_split('~-(?=[^-]*$)~', $subscription->plan->plan_code);
      $subscription_array['plan_cost'] = number_format($subscription->unit_amount_in_cents / 100, 2);
    }
  }
  catch (Recurly_NotFoundError $e) {
    drupal_set_message($e->getMessage(), 'error');
  }
  
  // Get all plans and split them by code
  $plan_checkbox_array = array();
  $plan_type_array = array();
  $upgrade_plan_array = array();
  $enabled_plans_array = array_values(variable_get('recurly_subscription_plans', array()));
  $enabled_plans_array = array_diff($enabled_plans_array, array(0));
  foreach ($enabled_plans_array as $plan) {
    $plan_code = str_replace('-yearly', '', $plan);
    $plan_code = str_replace('-monthly', '', $plan_code);
    $upgrade_plan_array[] = $plan_code;
  }
  $upgrade_plan_array = array_values(array_unique($upgrade_plan_array));
  foreach ($enabled_plans_array as $enabled_plan) {
    try {
      $plan = Recurly_Plan::get($enabled_plan);
      $plan_code = str_replace('-yearly', '', $plan->plan_code);
      $plan_code = str_replace('-monthly', '', $plan_code);
      $plan_name = str_replace(' Yearly', '', $plan->name);
      $plan_name = str_replace(' Monthly', '', $plan_name);
      $current_plan_key = array_search($subscription_array['plan_code'][0], $upgrade_plan_array);
      $new_plan_key = array_search($plan_code, $upgrade_plan_array);
      if ($new_plan_key > $current_plan_key || ($new_plan_key == $current_plan_key && $subscription_array['plan_code'][1] == 'monthly')) {
        $plan_checkbox_array[$plan_code] = $plan_name;
        if ($subscription_array['plan_code_full'] != $plan->plan_code) {
          if (strpos($plan->plan_code, 'yearly')) {
            $plan_type_array[$plan_code]['yearly'] = '$' . number_format($plan->unit_amount_in_cents->USD->amount_in_cents / 100, 2) . '/year';
          } elseif (strpos($plan->plan_code, 'monthly') && $subscription_array['plan_code'][1] != 'yearly') {
            $plan_type_array[$plan_code]['monthly'] = '$' . number_format($plan->unit_amount_in_cents->USD->amount_in_cents / 100, 2) . '/month for 12 months';
          }
        }
      }
    }
    catch (Recurly_NotFoundError $e) {
      drupal_set_message($e->getMessage(), 'error');
    }
  }
      
  // Get account billing info
  $name_on_card = '';
  $card_type_raw = '';
  $card_type = '';
  $month = '';
  $year = '';
  $name_on_account = '';
  $bank_routing_number = '';
  $checking_account_number = '';
  try {
    $billing_info = Recurly_BillingInfo::get($uid);
    $name_on_card = $billing_info->first_name . ' ' . $billing_info->last_name;
    $card_type_raw = $billing_info->card_type;
    $card_type = $card_type_raw . ' ending in ' . $billing_info->last_four;
    $month = $billing_info->month;
    $year = $billing_info->year;
    $checking_account_number = 'ending in ' . $billing_info->last_four;
    $name_on_account = $billing_info->name_on_account;
    $bank_routing_number = $billing_info->routing_number;
  }
  catch (Recurly_NotFoundError $e) {
    $billing_info = '';
  }
  $first_name = '';
  $last_name = '';
  if (isset($billing_info->first_name) && isset($billing_info->last_name)) {
    $first_name = $billing_info->first_name;
    $last_name = $billing_info->last_name;
  }
  elseif (isset($billing_info->name_on_account)) {
    $first_name = strtok($billing_info->name_on_account, ' ');
    $last_name = substr($billing_info->name_on_account, strrpos($billing_info->name_on_account, ' ') + 1);
  }
  $default_payment_method = '';
  if (!empty($billing_info) && !empty($name_on_account) && !empty($bank_routing_number) && !empty($checking_account_number)) {
    $default_payment_method = 'checking_account';
  }
  elseif (!empty($billing_info) && !empty($billing_info->first_name) && !empty($billing_info->last_name) && !empty($card_type_raw)) {
    $default_payment_method = 'credit_card';
  }
  
  // Build modal subscription form
  $form = array();
  if (!empty($plan_type_array)) {
    $form['membership'] = array(
      '#type' => 'container',
      '#prefix' => '<div id="membership">',
      '#suffix' => '</div>',
    );
    $form['membership']['plans'] = array(
      '#type' => 'radios',
      '#title' => t('Choose Membership Type:'),
      '#options' => $plan_checkbox_array,
      '#default_value' => key($plan_checkbox_array),
      '#prefix' => '<div id="plans">',
      '#suffix' => '</div>',
      '#required' => TRUE,
      '#ajax' => array(
        'callback' => 'bei_recurly_form_full_form_refresh',
        'wrapper' => 'membership',
        'method' => 'replace',
      ),
    );
    if (isset($form_state['values']['plans']) && isset($form_state['values']['plan_types'])) {
      if (array_key_exists($form_state['values']['plan_types'], $plan_type_array[$form_state['values']['plans']])) {
        $plan_type_key_radio = $form_state['values']['plan_types'];
      }
      else {
        $plan_type_key_radio = key($plan_type_array[key($plan_checkbox_array)]);
      }
      $form['membership']['plan_types'] = array(
        '#type' => 'radios',
        '#options' => isset($plan_type_array[$form_state['values']['plans']]) ? $plan_type_array[$form_state['values']['plans']] : array(),
        '#default_value' => $plan_type_key_radio,
        '#prefix' => '<div id="plan-types">',
        '#suffix' => '</div>',
        '#required' => TRUE,
        '#ajax' => array(
          'callback' => 'bei_recurly_form_full_form_refresh',
          'wrapper' => 'membership',
          'method' => 'replace',
        ),
      );
    }
    elseif (isset($form_state['input']['plans']) && isset($form_state['input']['plan_types']) && isset($form_state['input']['_triggering_element_name']) && $form_state['input']['_triggering_element_name'] == 'cancel_billing') {
      if (array_key_exists($form_state['input']['plan_types'], $plan_type_array[$form_state['input']['plans']])) {
        $plan_type_key_radio = $form_state['input']['plan_types'];
      }
      else {
        $plan_type_key_radio = key($plan_type_array[key($plan_checkbox_array)]);
      }
      $form['membership']['plan_types'] = array(
        '#type' => 'radios',
        '#options' => isset($plan_type_array[$form_state['input']['plans']]) ? $plan_type_array[$form_state['input']['plans']] : array(),
        '#default_value' => $plan_type_key_radio,
        '#prefix' => '<div id="plan-types">',
        '#suffix' => '</div>',
        '#required' => TRUE,
        '#ajax' => array(
          'callback' => 'bei_recurly_form_full_form_refresh',
          'wrapper' => 'membership',
          'method' => 'replace',
        ),
      );
    }
    else {
      $form['membership']['plan_types'] = array(
        '#type' => 'radios',
        '#options' => isset($plan_type_array[key($plan_checkbox_array)]) ? $plan_type_array[key($plan_checkbox_array)] : array(),
        '#default_value' => key($plan_type_array[key($plan_checkbox_array)]),
        '#prefix' => '<div id="plan-types">',
        '#suffix' => '</div>',
        '#required' => TRUE,
        '#ajax' => array(
          'callback' => 'bei_recurly_form_full_form_refresh',
          'wrapper' => 'membership',
          'method' => 'replace',
        ),
      );
    }
    $form['membership']['payment_method'] = array(
      '#type' => 'radios',
      '#title' => t('Confirm Payment Method:'),
      '#options' => array('credit_card' => 'Credit Card', 'checking_account' => 'Checking Account'),
      '#default_value' => $default_payment_method,
      '#prefix' => '<div id="payment-method">',
      '#suffix' => '</div>',
      '#required' => TRUE,
      '#ajax' => array(
        'callback' => 'bei_recurly_form_billing_info_refresh',
        'wrapper' => 'billing-info',
        'method' => 'replace',
      ),
    );
    $form['membership']['billing_info'] = array(
      '#type' => 'container',
      '#prefix' => '<div id="billing-info">',
      '#suffix' => '</div>',
    );
    $form['membership']['billing_info']['fields'] = array(
      '#type' => 'container',
      '#prefix' => '<table id="billing-info-fields"><tbody id="billing-info-body">',
      '#suffix' => '</tbody></table>',
    );
    if (!empty($billing_info) && !empty($name_on_account) && !empty($bank_routing_number) && !empty($checking_account_number)) {
      $form['membership']['billing_info']['fields']['name_on_account'] = array(
        '#markup' =>'<tr id="billing-name-on-account"><td class="billing-label">'.t('Name on Account').'</td>'.
        '<td class="billing-value">'.t($name_on_account).'</td></tr>'
      );
      $form['membership']['billing_info']['fields']['routing_number'] = array(
        '#markup' =>'<tr id="billing-routing-number"><td class="billing-label">'.t('Routing Number').'</td>'.
        '<td class="billing-value">'.t($bank_routing_number).'</td></tr>'
      );
      $form['membership']['billing_info']['fields']['checking_account_number'] = array(
        '#markup' =>'<tr id="billing-checking-account-number"><td class="billing-label">'.t('Checking Account Number').'</td>'.
        '<td class="billing-value">'.t($checking_account_number).'</td></tr>'
      );
      $form['membership']['billing_info']['edit'] = array(
        '#type' => 'button',
        '#default_value' => t('Edit Payment Info'),
        '#name' => 'edit_billing',
        '#prefix' => '<div id="billing-info-edit">',
        '#suffix' => '</div>',
        '#ajax' => array(
          'callback' => 'bei_recurly_form_billing_info_refresh',
          'wrapper' => 'billing-info',
          'method' => 'replace',
        ),
      );
    }
    elseif (!empty($billing_info) && !empty($billing_info->first_name) && !empty($billing_info->last_name) && !empty($card_type_raw) && !empty($month) && !empty($year)) {
      $form['membership']['billing_info']['fields']['name_on_card'] = array(
        '#markup' =>'<tr id="billing-name-on-card"><td class="billing-label">'.t('Name on Card').'</td>'.
        '<td class="billing-value">'.t($name_on_card).'</td></tr>'
      );
      $form['membership']['billing_info']['fields']['card_type'] = array(
        '#markup' =>'<tr id="billing-card-type"><td class="billing-label">'.t('Card Type').'</td>'.
        '<td class="billing-value">'.t($card_type).'</td></tr>'
      );
      $form['membership']['billing_info']['fields']['expires'] = array(
        '#markup' =>'<tr id="billing-expires"><td class="billing-label">'.t('Expires').'</td>'.
        '<td class="billing-value">'.t($month . '/' . $year).'</td></tr>'
      );
      $form['membership']['billing_info']['edit'] = array(
        '#type' => 'button',
        '#default_value' => t('Edit Payment Info'),
        '#name' => 'edit_billing',
        '#prefix' => '<div id="billing-info-edit">',
        '#suffix' => '</div>',
        '#ajax' => array(
          'callback' => 'bei_recurly_form_billing_info_refresh',
          'wrapper' => 'billing-info',
          'method' => 'replace',
        ),
      );
    }
    if (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'checking_account') {
      // Everything for checking account payment
      unset($form['membership']['billing_info']);
      $form['membership']['billing_info'] = array(
        '#type' => 'container',
        '#prefix' => '<div id="billing-info">',
        '#suffix' => '</div>',
      );
      if (!empty($billing_info) && !empty($name_on_account) && !empty($bank_routing_number) && !empty($checking_account_number) && $form_state['input']['_triggering_element_name'] != 'edit_billing') {
        $form['membership']['billing_info']['fields'] = array(
          '#type' => 'container',
          '#prefix' => '<table id="billing-info-fields"><tbody id="billing-info-body">',
          '#suffix' => '</tbody></table>',
        );
        $form['membership']['billing_info']['fields']['name_on_account'] = array(
          '#markup' =>'<tr id="billing-name-on-account"><td class="billing-label">'.t('Name on Account').'</td>'.
          '<td class="billing-value">'.t($name_on_account).'</td></tr>'
        );
        $form['membership']['billing_info']['fields']['routing_number'] = array(
          '#markup' =>'<tr id="billing-routing-number"><td class="billing-label">'.t('Routing Number').'</td>'.
          '<td class="billing-value">'.t($bank_routing_number).'</td></tr>'
        );
        $form['membership']['billing_info']['fields']['checking_account_number'] = array(
          '#markup' =>'<tr id="billing-checking-account-number"><td class="billing-label">'.t('Checking Account Number').'</td>'.
          '<td class="billing-value">'.t($checking_account_number).'</td></tr>'
        );
        $form['membership']['billing_info']['edit'] = array(
          '#type' => 'button',
          '#default_value' => t('Edit Payment Info'),
          '#name' => 'edit_billing',
          '#prefix' => '<div id="billing-info-edit">',
          '#suffix' => '</div>',
          '#ajax' => array(
            'callback' => 'bei_recurly_form_billing_info_refresh',
            'wrapper' => 'billing-info',
            'method' => 'replace',
          ),
        );
      }
      elseif ((empty($name_on_account) && empty($bank_routing_number)) || $form_state['input']['_triggering_element_name'] == 'edit_billing') {
        $form['membership']['billing_info']['fields'] = array(
          '#type' => 'container',
          '#prefix' => '<div id="billing-info-fields">',
          '#suffix' => '</div>',
        );
        $form['membership']['billing_info']['fields']['first_name'] = array(
          '#type' => 'textfield',
          '#title' => t('First Name'),
          '#default_value' => $first_name,
          '#prefix' => '<div id="first-name">',
          '#suffix' => '</div>',
         '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['last_name'] = array(
          '#type' => 'textfield',
          '#title' => t('Last Name'),
          '#default_value' => $last_name,
          '#prefix' => '<div id="last-name">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['address'] = array(
          '#type' => 'textfield',
          '#title' => t('Address'),
          '#default_value' => isset($billing_info->address1) ? $billing_info->address1 : '',
          '#prefix' => '<div id="address">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );   
        $form['membership']['billing_info']['fields']['city'] = array(
          '#type' => 'textfield',
          '#title' => t('City'),
          '#size' => 15,
          '#default_value' => isset($billing_info->city) ? $billing_info->city : '',
          '#prefix' => '<div id="city">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['state'] = array(
          '#type' => 'select',
          '#title' => t('State'),
          '#options' => bei_recurly_state_list(),
          '#default_value' => isset($billing_info->state) ? $billing_info->state : '',
          '#prefix' => '<div id="state">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['zip'] = array(
          '#type' => 'textfield',
          '#title' => t('Zip Code'),
          '#size' => 5,
          '#default_value' => isset($billing_info->zip) ? $billing_info->zip : '',
          '#prefix' => '<div id="zip">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['bank_routing_number'] = array(
          '#type' => 'textfield',
          '#title' => t('Bank Routing Number'),
          '#default_value' => isset($billing_info->routing_number) ? $billing_info->routing_number : '',
          '#prefix' => '<img src="/' . drupal_get_path('module', 'bei_recurly') . '/images/Check.png" class="check-image" style="width: 400px; margin: 10px 0;"><div id="bank-routing-number">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['checking_account_number'] = array(
          '#type' => 'textfield',
          '#title' => t('Checking Account Number'),
          '#prefix' => '<div id="checking-account-number">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        if ($form_state['input']['_triggering_element_name'] == 'edit_billing') {
          $form['membership']['billing_info']['cancel'] = array(
            '#type' => 'button',
            '#default_value' => t('Cancel Payment Edit'),
            '#name' => 'cancel_billing',
            '#prefix' => '<div id="billing-info-cancel">',
            '#suffix' => '</div>',
            '#limit_validation_errors' => array(),
            '#ajax' => array(
              'callback' => 'bei_recurly_form_billing_info_refresh',
              'wrapper' => 'billing-info',
              'method' => 'replace',
            ),
          );
        }
      }
    }
    elseif (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'credit_card') {
      // Everything for credit card payment
      unset($form['membership']['billing_info']);
      $form['membership']['billing_info'] = array(
        '#type' => 'container',
        '#prefix' => '<div id="billing-info">',
        '#suffix' => '</div>',
      );
      if (!empty($billing_info) && !empty($billing_info->first_name) && !empty($billing_info->last_name) && !empty($card_type_raw) && isset($form_state['input']['_triggering_element_name']) && $form_state['input']['_triggering_element_name'] != 'edit_billing') {
        $form['membership']['billing_info']['fields'] = array(
          '#type' => 'container',
          '#prefix' => '<table id="billing-info-fields"><tbody id="billing-info-body">',
          '#suffix' => '</tbody></table>',
        );
        $form['membership']['billing_info']['fields']['name_on_card'] = array(
          '#markup' =>'<tr id="billing-name-on-card"><td class="billing-label">'.t('Name on Card').'</td>'.
          '<td class="billing-value">'.t($name_on_card).'</td></tr>'
        );
        $form['membership']['billing_info']['fields']['card_type'] = array(
          '#markup' =>'<tr id="billing-card-type"><td class="billing-label">'.t('Card Type').'</td>'.
          '<td class="billing-value">'.t($card_type).'</td></tr>'
        );
        $form['membership']['billing_info']['fields']['expires'] = array(
          '#markup' =>'<tr id="billing-expires"><td class="billing-label">'.t('Expires').'</td>'.
          '<td class="billing-value">'.t($month . '/' . $year).'</td></tr>'
        );
        $form['membership']['billing_info']['edit'] = array(
          '#type' => 'button',
          '#default_value' => t('Edit Payment Info'),
          '#name' => 'edit_billing',
          '#prefix' => '<div id="billing-info-edit">',
          '#suffix' => '</div>',
          '#ajax' => array(
            'callback' => 'bei_recurly_form_billing_info_refresh',
            'wrapper' => 'billing-info',
            'method' => 'replace',
          ),
        );
      }
      elseif ((empty($billing_info->first_name) && empty($billing_info->last_name) && empty($card_type_raw)) || (isset($form_state['input']['_triggering_element_name']) && $form_state['input']['_triggering_element_name'] == 'edit_billing')) {
        $form['membership']['billing_info']['fields'] = array(
          '#type' => 'container',
          '#prefix' => '<div id="billing-info-fields">',
          '#suffix' => '</div>',
        );
        $form['membership']['billing_info']['fields']['first_name'] = array(
          '#type' => 'textfield',
          '#title' => t('First Name'),
          '#default_value' => $first_name,
          '#prefix' => '<div id="first-name">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['last_name'] = array(
          '#type' => 'textfield',
          '#title' => t('Last Name'),
          '#default_value' => $last_name,
          '#prefix' => '<div id="last-name">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['address'] = array(
          '#type' => 'textfield',
          '#title' => t('Address'),
          '#default_value' => isset($billing_info->address1) ? $billing_info->address1 : '',
          '#prefix' => '<div id="address">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );   
        $form['membership']['billing_info']['fields']['city'] = array(
          '#type' => 'textfield',
          '#title' => t('City'),
          '#size' => 15,
          '#default_value' => isset($billing_info->city) ? $billing_info->city : '',
          '#prefix' => '<div id="city">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['state'] = array(
          '#type' => 'select',
          '#title' => t('State'),
          '#options' => bei_recurly_state_list(),
          '#default_value' => isset($billing_info->state) ? $billing_info->state : '',
          '#prefix' => '<div id="state">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['zip'] = array(
          '#type' => 'textfield',
          '#title' => t('Zip Code'),
          '#size' => 5,
          '#default_value' => isset($billing_info->zip) ? $billing_info->zip : '',
          '#prefix' => '<div id="zip">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['card_number'] = array(
          '#type' => 'creditfield_cardnumber',
          '#title' => t('Card Number'),
          '#maxlength' => 16,
          '#prefix' => '<div id="card-number">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['expires'] = array(
          '#type' => 'creditfield_date',
          '#title' => t('Expires'),
          '#default_value' => isset($billing_info->month) && isset($billing_info->year) ? array('month' => $billing_info->month, 'year' => $billing_info->year) : '',
          '#prefix' => '<div id="expires">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        $form['membership']['billing_info']['fields']['cvv_code'] = array(
          '#type' => 'creditfield_cvv',
          '#title' => t('CVV Code'),
          '#maxlength' => 4,
          '#prefix' => '<div id="cvv-code">',
          '#suffix' => '</div>',
          '#required' => TRUE,
        );
        if ($form_state['input']['_triggering_element_name'] == 'edit_billing') {
          $form['membership']['billing_info']['cancel'] = array(
            '#type' => 'button',
            '#default_value' => t('Cancel Payment Edit'),
            '#name' => 'cancel_billing',
            '#prefix' => '<div id="billing-info-cancel">',
            '#suffix' => '</div>',
            '#limit_validation_errors' => array(),
            '#ajax' => array(
              'callback' => 'bei_recurly_form_billing_info_refresh',
              'wrapper' => 'billing-info',
              'method' => 'replace',
            ),
          );
        }
      }
    }
    $form['membership']['review'] = array(
      '#type' => 'container',
      '#prefix' => '<div id="review">',
      '#suffix' => '</div>',
    );
    $form['membership']['review']['discount'] = array(
      '#type' => 'container',
      '#prefix' => '<div id="discount">',
      '#suffix' => '</div>',
    );
    $form['membership']['review']['discount']['discount_code'] = array(
      '#type' => 'textfield',
      '#title' => t('Discount Code'),
      '#prefix' => '<div id="discount-code">',
      '#suffix' => '</div>',
      '#size' => 25,
    );
    $form['membership']['review']['discount']['discount_apply'] = array(
      '#type' => 'button',
      '#value' => t('Apply'),
      '#name' => 'discount_apply',
      '#prefix' => '<div id="discount-apply">',
      '#suffix' => '</div>',
      '#element_validate' => array('bei_recurly_coupon_validate'),
      '#ajax' => array(
        'callback' => 'bei_recurly_form_review_refresh',
        'wrapper' => 'review',
        'method' => 'replace',
      ),
    );
    $form['membership']['review']['membership_cost'] = array(
      '#type' => 'container',
      '#prefix' => '<table id="membership-cost">',
      '#suffix' => '</table>',
    );
    // Get all the membership line items
    if (isset($form_state['values']['plans']) && isset($form_state['values']['plan_types'])) {
      try {
        $subscription_preview = Recurly_Subscription::get($subscription_array['uuid']);
        $subscription_preview->plan_code = $form_state['values']['plans'] . '-' . $form_state['values']['plan_types'];
        if (isset($form_state['values']['discount_code']) && !empty($form_state['values']['discount_code'])) {
          try {
            $coupon = Recurly_Coupon::get($form_state['values']['discount_code']);
          }
          catch (Recurly_NotFoundError $e) {
            $coupon = '';
          }
          $subscription_preview->coupon_code = $form_state['values']['discount_code'];
        }
        $subscription_preview->preview();
      } catch (Recurly_NotFoundError $e) {
        form_set_error('membership', $e->getMessage());
      }
      if (isset($subscription_preview->invoice->line_items)) {
        foreach ($subscription_preview->invoice->line_items as $key => $adjustment) {
          $output = '';
          if ($adjustment->discount_in_cents != 0) {
            if (isset($coupon->description)) {
              $output = '<tr class="discount"><td class="invoice-label">'. t($coupon->description) . '</td><td class="value">$' . number_format(abs($adjustment->discount_in_cents) / 100, 2) . '</td></tr>';
            }
            else {
              $output = '<tr class="discount"><td class="invoice-label">'. t($adjustment->description . ' Discount').'</td><td class="value">$' . number_format(abs($adjustment->discount_in_cents) / 100, 2) . '</td></tr>';
            }
          }
          $form['membership']['review']['membership_cost']['membership_line_items'][$key] = array(
            '#markup' => '<tr class="line-item"><td class="invoice-label">'. t($adjustment->description) . '</td><td class="value">$' . number_format(abs($adjustment->unit_amount_in_cents) / 100, 2) . '</td></tr>' . $output,
          );
        }
      }
      if (isset($subscription_preview->invoice->total_in_cents)) {
        $form['membership']['review']['membership_cost']['membership_total'] = array(
          '#markup' => '<tr class="total"><td class="invoice-label">' . t('Total') . '</td><td class="value">$' . number_format(abs($subscription_preview->invoice->total_in_cents) / 100, 2) . '</td></tr>',
        );
      }
      else {
        $form['membership']['review']['membership_cost']['membership_total'] = array(
          '#markup' => '<tr class="total"><td class="invoice-label">' . t('Total') . '</td><td class="value">$0.00</td></tr>',
        );
      }
    }
    else {
      $subscription_preview = Recurly_Subscription::get($subscription_array['uuid']);
      $subscription_preview->plan_code = key($plan_checkbox_array) . '-' . key($plan_type_array[key($plan_checkbox_array)]);
      $subscription_preview->preview();
      foreach ($subscription_preview->invoice->line_items as $key => $adjustment) {
        $output = '';
        if ($adjustment->discount_in_cents != 0) {
          $output = '<tr class="discount"><td class="invoice-label">' . t($adjustment->description . ' Discount').'</td><td class="value">$' . number_format(abs($adjustment->discount_in_cents) / 100, 2) . '</td></tr>';
        }
        $form['membership']['review']['membership_cost']['membership_line_items'][$key] = array(
          '#markup' => '<tr class="line-item"><td class="invoice-label">' . t($adjustment->description) . '</td><td class="value">$' . number_format(abs($adjustment->unit_amount_in_cents) / 100, 2) . '</td></tr>' . $output,
        );
      }
      $form['membership']['review']['membership_cost']['membership_total'] = array(
        '#markup' => '<tr class="total"><td class="invoice-label">' . t('Total') . '</td><td class="value">$' . number_format(abs($subscription_preview->invoice->total_in_cents) / 100, 2) . '</td></tr>',
      );
    }
    $form['space'] = array(
      '#markup' => '<div id="spacer"></div>'
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Upgrade'),
      '#attributes' => array('id' => 'upgrade-submit')
    );
    $form['cancel'] = array(
      '#markup' => l(t('Cancel'), '#',
         array(
           'attributes' => array(
             'class' => 'ctools-close-modal',
             'id' => 'upgrade-cancel'
            ),
           'external' => TRUE
         )
       )
    );
  }
  return $form;
}

function bei_recurly_form_full_form_refresh($form, &$form_state) {
  return $form['membership'];
}

function bei_recurly_form_billing_info_refresh($form, &$form_state) {
  return $form['membership']['billing_info'];
}

function bei_recurly_form_review_refresh($form, &$form_state) {
  return $form['membership']['review'];
}

function bei_recurly_coupon_validate($element, &$form_state) {
  bei_recurly_load_recurly_library();
  $uid = $form_state['build_info']['args'][0];
    
  // Validate discount code
  if ($form_state['triggering_element']['#name'] == 'discount_apply') {
    if (!empty($form_state['values']['discount_code'])) {
      try {
        $coupon = Recurly_Coupon::get($form_state['values']['discount_code']);
        try {
          $subscriptions = Recurly_SubscriptionList::getForAccount($uid, array('state' => 'active'));
          $subscription_uuid = '';
          foreach ($subscriptions as $subscription) {
            $subscription_uuid = $subscription->uuid;
          }
          try {
            $subscription = Recurly_Subscription::get($subscription_uuid);
            $subscription->plan_code = $form_state['values']['plans'] . '-' . $form_state['values']['plan_types'];
            $subscription->coupon_code = $form_state['values']['discount_code'];
            $subscription->preview();
            return TRUE;
          }
          catch (Recurly_ValidationError $e) {
            form_set_error('membership][review][discount][discount_code', $e->getMessage());
            return FALSE;
          }
          catch (Recurly_NotFoundError $e) {
            form_set_error('membership][review][discount][discount_code', $e->getMessage());
            return FALSE;
          }
        }
        catch (Recurly_NotFoundError $e) {
          form_set_error('membership', $e->getMessage());
          return FALSE;
        }
      }
      catch (Recurly_NotFoundError $e) {
        form_set_error('membership][review][discount][discount_code', $e->getMessage());
        return FALSE;
      }
    }
    else {
      form_set_error('membership][review][discount][discount_code', t('No discount code entered.'));
      return FALSE;
    }
  }
  return TRUE;
}

function bei_recurly_upgrade_form_validate($form, &$form_state) {
  bei_recurly_load_recurly_library();
  $uid = $form_state['build_info']['args'][0];
  
  // Check for billing info and update as necessary
  if (isset($form_state['values']['op']) && $form_state['values']['op'] == $form_state['values']['submit']) {
    try {
      $billing_info = Recurly_BillingInfo::get($uid);
      if (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'credit_card') {
        if (!empty($form_state['values']['first_name']) && !empty($form_state['values']['last_name']) && !empty($form_state['values']['card_number']) && !empty($form_state['values']['expires']) && !empty($form_state['values']['cvv_code'])) {
          $billing_info->address1 = $form_state['values']['address'];
          $billing_info->city = $form_state['values']['city'];
          $billing_info->state = $form_state['values']['state'];
          $billing_info->country = 'US';
          $billing_info->zip = $form_state['values']['zip'];
          $billing_info->first_name = $form_state['values']['first_name'];
          $billing_info->last_name = $form_state['values']['last_name'];
          $billing_info->number = $form_state['values']['card_number'];
          $billing_info->verification_value = $form_state['values']['cvv_code'];
          $billing_info->month = $form_state['values']['expires']['month'];
          $billing_info->year = $form_state['values']['expires']['year'];
          $billing_info->update();
        }
      }
      elseif (isset($form_state['values']['payment_method']) && $form_state['values']['payment_method'] == 'checking_account') {
        if (!empty($form_state['values']['first_name']) && !empty($form_state['values']['last_name']) && !empty($form_state['values']['bank_routing_number']) && !empty($form_state['values']['checking_account_number'])) {
          $billing_info->address1 = $form_state['values']['address'];
          $billing_info->city = $form_state['values']['city'];
          $billing_info->state = $form_state['values']['state'];
          $billing_info->country = 'US';
          $billing_info->zip = $form_state['values']['zip'];
          $billing_info->name_on_account = $form_state['values']['first_name'] . ' ' . $form_state['values']['last_name'];
          $billing_info->routing_number = $form_state['values']['bank_routing_number'];
          $billing_info->account_number = $form_state['values']['checking_account_number'];
          $billing_info->account_type = 'checking';
          $billing_info->update();
        }
      }
      // Check for an active subscription
      try {
        $subscriptions = Recurly_SubscriptionList::getForAccount($uid, array('state' => 'active'));
        $subscription_uuid = '';
        foreach ($subscriptions as $subscription_single) {
          $subscription_uuid = $subscription_single->uuid;
        }
        
        // Load and update subscription as necessary
        try {
          $subscription = Recurly_Subscription::get($subscription_uuid);
          $subscription->plan_code = $form_state['values']['plans'] . '-' . $form_state['values']['plan_types'];
          if (!empty($form_state['values']['discount_code'])) {
            $subscription->coupon_code = $form_state['values']['discount_code'];
          }
          $subscription->updateImmediately();
          return TRUE;
        }
        catch (Recurly_ValidationError $e) {
          form_set_error('membership', $e->getMessage());
          return FALSE;
        }
        catch (Recurly_NotFoundError $e) {
          form_set_error('membership', $e->getMessage());
          return FALSE;
        }
      }
      catch (Recurly_NotFoundError $e) {
        form_set_error('membership', $e->getMessage());
        return FALSE;
      }
    }
    catch (Recurly_ValidationError $e) {
      form_set_error('membership', $e->getMessage());
      if (isset($e->errors[0]->field)) { 
        $error_fields = $e->errors; 
        foreach($error_fields as $error) {
          if ($error->symbol == 'expired') {
            form_set_error('year', '');	
          }
          else {
            form_set_error($error->field, '');	
          }
        }
      }
      return FALSE;
    }
    catch (Recurly_NotFoundError $e) {
      form_set_error('membership', $e->getMessage());
      return FALSE;
    }
  }
  
  return TRUE;
}

function bei_recurly_upgrade_form_submit($form, &$form_state) {
  bei_recurly_load_recurly_library();
  $uid = $form_state['build_info']['args'][0];
  $form_state['rebuild'] = true;
  
  // Close modal and refresh membership details
  try {
    $subscriptions = Recurly_SubscriptionList::getForAccount($uid, array('state' => 'active'));
    $plan_array = array();
    foreach ($subscriptions as $subscription) {
      $plan_array['uuid'] = $subscription->uuid;
      $plan_array['plan_name'] = $subscription->plan->name;
      $plan_array['plan_code'] = preg_split('~-(?=[^-]*$)~', $subscription->plan->plan_code);
      $plan_array['end_date'] = $subscription->current_period_ends_at->getTimestamp();
    }
    
    // Remove upgrade option if they have the full plan
    $plans = Recurly_PlanList::get();
    $upgrade_plan_array = array();
    $enabled_plans_array = array_values(variable_get('recurly_subscription_plans', array()));
    foreach ($enabled_plans_array as $plan) {
      $plan_code = str_replace('-yearly', '', $plan);
      $plan_code = str_replace('-monthly', '', $plan_code);
      $upgrade_plan_array[] = $plan_code;
    }
    $upgrade_plan_array = array_values(array_unique($upgrade_plan_array));
    end($upgrade_plan_array);
    $last_plan_key = key($upgrade_plan_array);
    foreach ($plans as $plan) {
      $current_plan_key = array_search($plan_array['plan_code'][0], $upgrade_plan_array);
      if ($last_plan_key == $current_plan_key && $plan_array['plan_code'][1] == 'yearly') {
        $form_state['ajax_commands'][] = ajax_command_remove('#upgrade-link');
      }
    }
  }
  catch (Recurly_NotFoundError $e) {
    drupal_set_message($e->getMessage(), 'error');
  }
  
  if (!empty($plan_array)) {
    $form['membership-details']['account_type'] = array(
      '#markup' => '<strong>Account Type:</strong> ' . $plan_array['plan_name'],
      '#prefix' => '<div id="account-type">',
      '#suffix' => '</div>',
    );
    $form['membership-details']['renewal_date'] = array(
      '#markup' => '<strong>Last Day of Billing Period:</strong> ' . date('m/d/Y', $plan_array['end_date']),
      '#prefix' => '<div id="renewal-date">',
      '#suffix' => '</div>',
    );
    $form_state['ajax_commands'][] = ajax_command_replace('#account-type', render($form['membership-details']['account_type']));
    $form_state['ajax_commands'][] = ajax_command_replace('#renewal-date', render($form['membership-details']['renewal_date']));
  }
  
  $form_state['ajax_commands'][] = ajax_command_prepend('#membership-details', '<div class="messages status"><button class="dismiss"><span class="element-invisible">Close this message.</span></button>Your membership has been upgraded.</div>');
  $form_state['ajax_commands'][] = ctools_modal_command_dismiss();
}