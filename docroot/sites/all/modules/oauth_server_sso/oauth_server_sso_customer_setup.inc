<?php

require_once 'includes/customer_setup.php';
include_once 'includes/miniorange_support.php';

/**
 * @file
 * Contains form for customer setup.
 */

/**
 * Customer setup form().
 */
function oauth_server_sso_customer_setup($form, &$form_state) {
drupal_add_css( drupal_get_path('module', 'oauth_server_sso'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));
    drupal_add_css( drupal_get_path('module', 'oauth_server_sso'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));


  $current_status = variable_get('oauth_server_sso_status', '');
  if ($current_status == 'VALIDATE_OTP') {
    $form['oauth_server_sso_customer_otp_token'] = array(
      '#type' => 'textfield',
      '#id' => 'text_field',
      '#title' => t('OTP'),
    );

    $form['oauth_server_sso_customer_validate_otp_button'] = array(
      '#type' => 'submit',
      '#value' => t('Validate OTP'),
      '#submit' => array('oauth_server_sso_validate_otp_submit'),
    );

    $form['oauth_server_sso_customer_setup_resendotp'] = array(
      '#type' => 'submit',
      '#value' => t('Resend OTP'),
      '#submit' => array('oauth_server_sso_resend_otp'),
    );

    $form['oauth_server_sso_customer_setup_back'] = array(
      '#type' => 'submit',
      '#value' => t('Back'),
      '#submit' => array('oauth_server_sso_back'),
    );

    return $form;
  }
  elseif ($current_status == 'PLUGIN_CONFIGURATION') {
    // Show customer configuration here.
    $form['markup_top'] = array(
      '#markup' => '<div class="mo_oauth_server_table_layout_1"><div class="mo_oauth_server_table_layout container1">Thank you for registering with miniOrange'
      . '<h4>Your Profile: </h4>',
    );

    $header = array(
      'email' => array('data' => t('Customer Email')),
      'customerid' => array('data' => t('Customer ID')),
      'token' => array('data' => t('Token Key')),
      'apikey' => array('data' => t('API Key')),
    );

    $options = array();

    $options[0] = array(
      'email' => variable_get('oauth_server_sso_customer_admin_email', ''),
      'customerid' => variable_get('oauth_server_sso_customer_id', ''),
      'token' => variable_get('oauth_server_sso_customer_admin_token', ''),
      'apikey' => variable_get('oauth_server_sso_customer_api_key', ''),
    );

    $form['fieldset']['customerinfo'] = array(
      '#id' => 'mo_text_edit',
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $options,
    );

  $form['markup_idp_attr_header_top_support'] = array('#markup' => '</div><div class="mo_oauth_server_table_layout_support_1">',
      );

      $form['markup_support_1'] = array(
          '#markup' => '<h3>Support</h3></h3><div>Need any help? Just send us a query so we can help you.<br /><br /></div>',
      );

      $form['oauth_server_sso_email_address_support'] = array(
          '#type' => 'textfield',
          '#attributes' => array('placeholder' => 'Enter your Email'),
      );

      $form['oauth_server_sso_phone_number_support'] = array(
          '#type' => 'textfield',
          '#attributes' => array('placeholder' => 'Enter your Phone Number'),
      );

      $form['oauth_server_sso_support_query_support'] = array(
          '#type' => 'textarea',
          '#clos' => '10',
          '#rows' => '5',
          '#attributes' => array('placeholder' => 'Write your query here'),
      );

      $form['oauth_server_sso_support_submit_click'] = array(
          '#type' => 'submit',
          '#value' => t('Submit Query'),
          '#submit' => array('saved_support'),
      );

      $form['oauth_server_sso_support_note'] = array(
          '#markup' => '<div><br/>If you want custom features in the plugin, just drop an email to <a href="mailto:info@miniorange.com">info@miniorange.com</a></div>'
      );

      $form['oauth_server_sso_support_div_cust'] = array(

          '#markup' => '</div></div>'
      );
    return $form;
  }

  $form['markup_14'] = array(
    '#prefix' =>'<div style="float:left">',
    '#markup' => '<br><br><div class="mo_oauth_server_table_layout_1"><div class="mo_oauth_server_table_layout container1"><h1>Register with miniOrange</h1><br>',
  );

  $form['markup_15'] = array(
    '#markup' => '<div id="lemp">Just complete the short registration below to configure'
    . ' the OAuth Server Plugin. Please enter a valid email id <br>that you have'
    . ' access to. You will be able to move forward after verifying an OTP'
    . ' that we will send to this email.',
  );

  $form['oauth_server_sso_customer_setup_username'] = array(
    '#type' => 'textfield',

    '#title' => t('Email'),
  );

  $form['oauth_server_sso_customer_setup_phone'] = array(
    '#type' => 'textfield',

    '#title' => t('Phone'),
  );

  $form['markup_16'] = array(
    '#markup' => '<b>NOTE:</b> We will only call if you need support.',
  );

  $form['oauth_server_sso_customer_setup_password'] = array(
    '#type' => 'password_confirm',
  );

  $form['oauth_server_sso_customer_setup_button'] = array(
    '#type' => 'submit',
    '#value' => t('Register'),
    '#suffix' =>'</div>',
    '#submit' => array('oauth_server_sso_customer_setup_submit'),
  );
$form['markup_divEnd'] = array(
          '#markup' => '</div>'
      );
      $form['markup_idp_attr_header_top_support'] = array('#markup' => '<div class="mo_oauth_server_table_layout_support_1">',
      );

      $form['markup_support_1'] = array(
          '#markup' => '<h3>Support</h3></h3><div>Need any help? Just send us a query so we can help you.<br /><br />',
      );

      $form['oauth_server_sso_email_address_support'] = array(
          '#type' => 'textfield',
          '#attributes' => array('style' => 'width:100%','placeholder' => 'Enter your Email'),
      );

      $form['oauth_server_sso_phone_number_support'] = array(
          '#type' => 'textfield',
          '#attributes' => array('style' => 'width:100%','placeholder' => 'Enter your Phone Number'),
      );

      $form['oauth_server_sso_support_query_support'] = array(
          '#type' => 'textarea',
          '#clos' => '10',
          '#rows' => '5',
          '#attributes' => array('style' => 'width:100%','placeholder' => 'Write your query here'),
      );

      $form['oauth_server_sso_support_submit_click'] = array(
          '#type' => 'submit',
          '#value' => t('Submit Query'),
          '#submit' => array('saved_support'),
      );

      $form['oauth_server_sso_support_note'] = array(
          '#markup' => '<div><br/>If you want custom features in the plugin, just drop an email to <a href="mailto:info@miniorange.com">info@miniorange.com</a></div>'
      );

      $form['oauth_server_sso_support_div_cust'] = array(

          '#markup' => '</div></div>'
      );
  return $form;
}
/**
 * Validate OTP.
 */
function oauth_server_sso_validate_otp_submit(&$form, $form_state) {

  $otp_token = $form['oauth_server_sso_customer_otp_token']['#value'];
  $username = variable_get('oauth_server_sso_customer_admin_email', NULL);
  $phone = variable_get('oauth_server_sso_customer_admin_phone', NULL);
  $tx_id = variable_get('oauth_server_sso_tx_id', NULL);
  $customer_config = new MiniorangeOAuthServerCustomer($username, $phone, NULL, $otp_token);

  // Validate OTP.
  $validate_otp_response = json_decode($customer_config->validateOtp($tx_id));
  if ($validate_otp_response->status == 'SUCCESS') {
    // OTP Validated. Show Configuration page.
    $current_status = 'PLUGIN_CONFIGURATION';
    variable_set('oauth_server_sso_status', $current_status);
    variable_del('oauth_server_sso_tx_id');

    // OTP Validated. Create customer.
    $password = variable_get('oauth_server_sso_customer_admin_password', '');
    $customer_config = new MiniorangeOAuthServerCustomer($username, $phone, $password, NULL);
    $create_customer_response = json_decode($customer_config->createCustomer());
    if ($create_customer_response->status == 'SUCCESS') {
      // Customer created.
      $current_status = 'PLUGIN_CONFIGURATION';
      variable_set('oauth_server_sso_status', $current_status);
      variable_set('oauth_server_sso_customer_admin_email', $username);
      variable_set('oauth_server_sso_customer_admin_phone', $phone);
      variable_set('oauth_server_sso_customer_admin_token', $create_customer_response->token);
      variable_set('oauth_server_sso_customer_id', $create_customer_response->id);
      variable_set('oauth_server_sso_customer_api_key', $create_customer_response->apiKey);

      drupal_set_message(t('Customer account created. Please read the instructions to setup your OAuth Server Plugin in the next section'));
      drupal_goto('admin/config/people/oauth_server_sso/configure_client');
    }
    else {
      drupal_set_message(t('Error creating customer'), 'error');
    }
  }
  else {
    drupal_set_message(t('Error validating OTP'), 'error');
  }

}

/**
 * Resend OTP.
 */
function oauth_server_sso_resend_otp(&$form, $form_state) {

  variable_del('oauth_server_sso_tx_id');
  $username = variable_get('oauth_server_sso_customer_admin_email', NULL);
  $phone = variable_get('oauth_server_sso_customer_admin_phone', NULL);
  $customer_config = new MiniorangeOAuthServerCustomer($username, $phone, NULL, NULL);
  $send_otp_response = json_decode($customer_config->sendOtp());
  if ($send_otp_response->status == 'SUCCESS') {
    // Store txID.
    variable_set('oauth_server_sso_tx_id', $send_otp_response->txId);
    $current_status = 'VALIDATE_OTP';
    variable_set('oauth_server_sso_status', $current_status);
    drupal_set_message(t('Verify email address by entering the passcode sent to @username', array('@username' => $username)));
  }
}

/**
 * Handle submit for customer setup.
 */
function oauth_server_sso_customer_setup_submit(&$form, $form_state) {

  $username = $form['oauth_server_sso_customer_setup_username']['#value'];
  $phone = $form['oauth_server_sso_customer_setup_phone']['#value'];
  $password = $form['oauth_server_sso_customer_setup_password']['#value']['pass1'];
if(empty($username)||empty($password)){
      drupal_set_message(t('The <b><u>Email </u></b> and <b><u>Password</u></b> fields are mandatory.'), 'error');
      return;
  }
if (!valid_email_address($username)) {
        drupal_set_message(t('The email address <i>' . $username . '</i> is not valid.'), 'error');
        return;
}
  $customer_config = new MiniorangeOAuthServerCustomer($username, $phone, $password, NULL);
  $check_customer_response = json_decode($customer_config->checkCustomer());
  if ($check_customer_response->status == 'CUSTOMER_NOT_FOUND') {
    // Create customer.
    // Store email and phone.
    variable_set('oauth_server_sso_customer_admin_email', $username);
    variable_set('oauth_server_sso_customer_admin_phone', $phone);
    variable_set('oauth_server_sso_customer_admin_password', $password);

    $send_otp_response = json_decode($customer_config->sendOtp());
    if ($send_otp_response->status == 'SUCCESS') {
      // Store txID.
      variable_set('oauth_server_sso_tx_id', $send_otp_response->txId);
      $current_status = 'VALIDATE_OTP';
      variable_set('oauth_server_sso_status', $current_status);
      drupal_set_message(t('Verify email address by entering the passcode sent to @username', array('@username' => $username)));
    }
  }
  elseif ($check_customer_response->status == 'CURL_ERROR') {
    drupal_set_message(t('cURL is not enabled. Please enable cURL'), 'error');
  }
  else {
    // Customer exists. Retrieve keys.
    $customer_keys_response = json_decode($customer_config->getCustomerKeys());
    if (json_last_error() == JSON_ERROR_NONE) {
      variable_set('oauth_server_sso_customer_id', $customer_keys_response->id);
      variable_set('oauth_server_sso_customer_admin_token', $customer_keys_response->token);
      variable_set('oauth_server_sso_customer_admin_email', $username);
      variable_set('oauth_server_sso_customer_admin_phone', $phone);
      variable_set('oauth_server_sso_customer_api_key', $customer_keys_response->apiKey);
      $current_status = 'PLUGIN_CONFIGURATION';
      variable_set('oauth_server_sso_status', $current_status);
      drupal_set_message(t('Successfully retrieved your account.'));
      drupal_goto('admin/config/people/oauth_server_sso/configure_client');
    }
    else {
      drupal_set_message(t('Invalid credentials'), 'error');
    }
  }
}

/**
 * Handle back button submit for customer setup.
 */
function oauth_server_sso_back(&$form, $form_state) {
  $current_status = 'CUSTOMER_SETUP';
  variable_set('oauth_server_sso_status', $current_status);
  variable_del('oauth_server_sso_customer_admin_email');
  variable_del('oauth_server_sso_customer_admin_phone');
  variable_del('oauth_server_sso_tx_id');
  drupal_set_message(t('Register/Login with your miniOrange Account'));
}
function saved_support($form, &$form_state)
  {
      $email = $form['oauth_server_sso_email_address_support']['#value'];
      $phone = $form['oauth_server_sso_phone_number_support']['#value'];
      $query = $form['oauth_server_sso_support_query_support']['#value'];
      if(empty($email)||empty($query)){
        drupal_set_message(t('The <b><u>Email Address</u></b> and <b><u>Query</u></b> fields are mandatory.'), 'error');
        return;
    }
  if (!valid_email_address($email)) {
          drupal_set_message(t('The email address <i>' . $email . '</i> is not valid.'), 'error');
          return;
  }
      $support = new MiniorangeOAuthServerSupport($email, $phone, $query);
      $support_response = $support->sendSupportQuery();
      if ($support_response) {
          drupal_set_message(t('Support query successfully sent'));
      } else {
          drupal_set_message(t('Error sending support query'), 'error');
      }
  }