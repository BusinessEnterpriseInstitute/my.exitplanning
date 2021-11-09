<?php
/**
 * @file
 * Contains form for customer setup.
 */
/**
 * Customer setup form().
 */
function miniorange_saml_customer_setup($form, &$form_state)
{
    global $base_url;
    drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    $current_status = variable_get('miniorange_saml_status', '');

  if ($current_status == 'PLUGIN_CONFIGURATION' && variable_get('miniorange_saml_license_key',NULL) == NULL)
  {

      $form['header_top_style_2'] = array(
	  	'#markup' => '<div class="mo_saml_table_layout_1">
	  					<div class="mo_saml_table_layout mo_saml_container">'
	  );

    $form['miniorange_saml_license_key'] = array(
      '#type' => 'textfield',
      '#title' => t('License Key'),
        '#attributes' => array('style' => 'width:55%','placeholder' => 'Enter your license key to activate the module'),
    );

    $form['miniorange_saml_customer_validate_license_button'] = array(
      '#type' => 'submit',
      '#value' => t('Activate License'),
      '#submit' => array('miniorange_saml_validate_license_submit'),
    );

	$form['miniorange_saml_customer_setup_back'] = array(
      '#type' => 'submit',
      '#value' => t('Back'),
      '#submit' => array('miniorange_saml_back'),
    );

      $form['miniorange_saml_support_div_end'] = array(
          '#markup' => '</div>',
      );

      Utilities::AddsupportTab( $form, $form_state);

    return $form;
  }
  else if ($current_status == 'VALIDATE_OTP')
  {
    $form['header_top_style_1'] = array('#markup' => '<div class="mo_saml_table_layout_1">');

    $form['header_top_style_2'] = array('#markup' => '<div class="mo_saml_table_layout mo_saml_container">');

    $form['miniorange_saml_customer_otp_token'] = array(
      '#type' => 'textfield',
      '#title' => t('OTP'),
      '#attributes' => array(
	  	  'style' => 'width:55%'
	   ),
    );

    $form['miniorange_saml_customer_validate_otp_button'] = array(
      '#type' => 'submit',
      '#value' => t('Validate OTP'),
      '#submit' => array('miniorange_saml_validate_otp_submit'),
    );

    $form['miniorange_saml_customer_setup_resendotp'] = array(
      '#type' => 'submit',
      '#value' => t('Resend OTP'),
      '#submit' => array('miniorange_saml_resend_otp'),
    );

    $form['miniorange_saml_customer_setup_back'] = array(
      '#type' => 'submit',
      '#value' => t('Back'),
      '#submit' => array('miniorange_saml_back'),
    );

      $form['miniorange_saml_support_div_end'] = array(
          '#markup' => '</div>',
      );

      Utilities::AddsupportTab( $form, $form_state);

    return $form;
  }
  elseif ($current_status == 'PLUGIN_CONFIGURATION')
  {
      global $base_url;
      $form['header_top_style_2'] = array(
	  	  '#markup' => '<div class="mo_saml_table_layout_1">
		  				<div class="mo_saml_table_layout mo_saml_container">'
	  );

    // Show customer configuration here.
    $mo_saml_days_remaining = abs( floor((strtotime( variable_get('miniorange_saml_licenseExpiry','')) - time()) / (3600*24)) );
    if ( strtotime( variable_get('miniorange_saml_licenseExpiry','')) < time() ){
      $form['markup_top'] = array(
        '#markup' => '<div class="mo_saml_license_expiry">Your maintenance support has expired '. $mo_saml_days_remaining .' days earlier, click on the Renew Maintenance link below to upgrade.</div><br/>'
          . '<h4>Your Profile: </h4>',
      );
    }
    elseif ( ( strtotime( variable_get('miniorange_saml_licenseExpiry','')) - 30*24*60*60) < time()   ){
      $form['markup_top'] = array(
        '#markup' => '<div class="mo_saml_license_expiry">Your maintenance support is going to expire in '. $mo_saml_days_remaining .' days, click on the Renew Maintenance link below to upgrade.</div><br/>'
          . '<h4>Your Profile: </h4>',
      );
    }
    else {
      $form['markup_top'] = array(
        '#markup' => '<div class="mo_saml_welcome_message">Thank you for login with miniOrange</div><br/>'
          . '<h4>Your Profile: </h4>',
      );
    }

    $header = array( t('ATTRIBUTE NAME'), t('ATTRIBUTE VALUE'), );

    $options = array();

    $mo_saml_customer_admin_email = variable_get('miniorange_saml_customer_admin_email', '');
    $options[0] = array(
      'Customer Email' => 'Customer Email',
      'email'          => $mo_saml_customer_admin_email,
    );

    $options[1] = array(
      'Customer ID' => 'Customer ID',
      'customerid'  => variable_get('miniorange_saml_customer_id', ''),
    );

    $module_path = drupal_get_path('module', 'miniorange_saml');
    if ( strtotime( variable_get('miniorange_saml_licenseExpiry','')) < time() ) {
      $options[2] = array(
        'Maintenance Expiry' => 'Maintenance Expiry',
        'maintenance_expiry' => '<div style="color: red"><u style="cursor: pointer">'. date("F j, Y, g:i a", strtotime( variable_get('miniorange_saml_licenseExpiry',''))). '</u><sub><img style="width:15px; height:15px; padding:5px; margin-left:10px;color:red;" src="'. $base_url.'/'.$module_path . '/includes/images/warning.svg"></sub></div>',
      );
    }
    else{
      $options[2] = array(
        'Maintenance Expiry' => 'Maintenance Expiry',
        'maintenance_expiry' =>  date("F j, Y, g:i a", strtotime( variable_get('miniorange_saml_licenseExpiry',''))),
      );
    }

    $options[3] = array(
      'Support Expiry' => 'Support Expiry',
      'support_expiry' =>  date("F j, Y, g:i a", strtotime( variable_get('miniorange_saml_supportExpiry',''))),
    );

    $refetchOrUpdate = '<a href="'.$base_url.'?q=moLicenseFetch">Fetch</a>';
    $options[4] = array(
      'Refetch License Details' => 'Refetch License Details',
      'refetch_license_details' => $refetchOrUpdate
    );

    if ( ( strtotime( variable_get('miniorange_saml_licenseExpiry','')) - 30*24*60*60) < time() ){
      $options[5] = array(
        'Renew Maintenance' => 'Renew Maintenance',
        'renew_maintenance' => '<a target="_blank" href="'. MiniorangeSAMLConstants::BASE_URL . '/moas/login?username=' . $mo_saml_customer_admin_email . '&redirectUrl=' . MiniorangeSAMLConstants::BASE_URL .'/moas/admin/customer/licenserenewals?renewalrequest='. MiniorangeSAMLConstants::LICENSE_TYPE .'">Renew Maintenance</a>'
      );
    }

    $form['fieldset']['customerinfo'] = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $options,
    );

    $form['miniorange_saml_customer_Remove_Account_info'] = array('#markup' => '<br/><br/><br/><br/><br/>'.'<h4>Remove Account:</h4>'.'<p>This section will help you to remove your current logged in account without losing your current configurations.</p>');

    $form['miniorange_saml_remove_account_button'] = array(
        '#type' => 'submit',
        '#value' => t('Remove Account'),
        '#submit' => array('miniorange_saml_remove_account'),
        '#attributes' => array('style' => 'display:block;margin-left:auto;margin-right:auto;background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;'),
    );

      $form['miniorange_saml_support_div_end'] = array(
          '#markup' => '</div>',
      );

      Utilities::AddsupportTab( $form, $form_state);

    return $form;
  }

    $form['header_top_style_1'] = array('#markup' => '<div class="mo_saml_table_layout_1">');

  $form['markup_14'] = array(
    '#markup' => '<div class="mo_saml_table_layout mo_saml_container"><h3>Register/Login with miniOrange</h3><hr><br/>',
  );

  $form['markup_15'] = array(
    '#markup' => '<div class="mo_saml_highlight_background_note_1">Just complete the short registration below to configure the SAML Module. Please enter a valid email id that you have access to. You will be able to move forward after verifying an OTP that we will send to this email.</div>',
  );

  $form['miniorange_saml_customer_setup_username'] = array(
    '#type' => 'textfield',
    '#title' => t('Email<span class = "red_color_star">*</span>'),
    '#attributes' => array(
	    'style' => 'width:61%'
	 ),
    '#required' => FALSE,
  );

  $form['miniorange_saml_customer_setup_phone'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone'),
    '#attributes' => array(
	   'style' => 'width:61%'
	 ),
  );

  $form['markup_16'] = array(
    '#markup' => '<b>NOTE:</b> We will only call if you need support.',
  );

  $form['miniorange_saml_customer_setup_password'] = array(
    '#type' => 'password_confirm',
    '#required' => FALSE,
  );

  $form['miniorange_saml_customer_setup_button'] = array(
    '#type' => 'submit',
    '#value' => t('Register'),
    '#submit' => array('miniorange_saml_customer_setup_submit'),
    '#attributes' => array('style' => 'background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;'),  );

    $form['miniorange_saml_support_div_end'] = array(
        '#markup' => '</div>',
    );

    Utilities::AddsupportTab( $form, $form_state);

  return $form;

}

/**
 * Validate OTP.
 */
function miniorange_saml_validate_otp_submit(&$form, $form_state) {

  $otp_token = $form['miniorange_saml_customer_otp_token']['#value'];
  $username = variable_get('miniorange_saml_customer_admin_email', NULL);
  $phone = variable_get('miniorange_saml_customer_admin_phone', NULL);
  $tx_id = variable_get('miniorange_saml_tx_id', NULL);
  $customer_config = new MiniorangeSAMLCustomer($username, $phone, NULL, $otp_token);

  // Validate OTP.
  $validate_otp_response = json_decode($customer_config->validateOtp($tx_id));
  if ($validate_otp_response->status == 'SUCCESS') {
    // OTP Validated. Show Configuration page.
    $current_status = 'PLUGIN_CONFIGURATION';
    variable_set('miniorange_saml_status', $current_status);
    variable_del('miniorange_saml_tx_id');

    // OTP Validated. Create customer.
    $password = variable_get('miniorange_saml_customer_admin_password', '');
    $customer_config = new MiniorangeSAMLCustomer($username, $phone, $password, NULL);
    $create_customer_response = json_decode($customer_config->createCustomer());

    if ($create_customer_response->status == 'SUCCESS') {
      // Customer created.
       $current_status = 'PLUGIN_CONFIGURATION';
      variable_set('miniorange_saml_status', $current_status);
      variable_set('miniorange_saml_customer_admin_email', $username);
      variable_set('miniorange_saml_customer_admin_phone', $phone);
      variable_set('miniorange_saml_customer_admin_token', $create_customer_response->token);
      variable_set('miniorange_saml_customer_id', $create_customer_response->id);
      variable_set('miniorange_saml_customer_api_key', $create_customer_response->apiKey);

      drupal_set_message(t('Customer account created. Please verify your license key to activate module'));
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
function miniorange_saml_resend_otp(&$form, $form_state) {

  variable_del('miniorange_saml_tx_id');
  $username = variable_get('miniorange_saml_customer_admin_email', NULL);
  $phone = variable_get('miniorange_saml_customer_admin_phone', NULL);
  $customer_config = new MiniorangeSAMLCustomer($username, $phone, NULL, NULL);
  $send_otp_response = json_decode($customer_config->sendOtp());
  if ($send_otp_response->status == 'SUCCESS') {
    // Store txID.
    variable_set('miniorange_saml_tx_id', $send_otp_response->txId);
    $current_status = 'VALIDATE_OTP';
    variable_set('miniorange_saml_status', $current_status);
    drupal_set_message(t('Verify email address by entering the passcode sent to @username', array('@username' => $username)));
  }
}

/**
 * Handle submit for customer setup.
 */
function miniorange_saml_customer_setup_submit(&$form, $form_state) {

    $username = $form['miniorange_saml_customer_setup_username']['#value'];
    $phone = $form['miniorange_saml_customer_setup_phone']['#value'];
    $password = $form['miniorange_saml_customer_setup_password']['#value']['pass1'];

    if(empty($username)||empty($password)){
        drupal_set_message(t('The <b><u>Email</u></b> and <b><u>Password</u></b> fields are required.'), 'error');
        return;
    } elseif(!valid_email_address($username)) {
        drupal_set_message(t('The email address <b><i>' . $username . '</i></b> is not valid.'), 'error');
        return;
    }

    $customer_config = new MiniorangeSAMLCustomer($username, $phone, $password, NULL);
    $check_customer_response = json_decode($customer_config->checkCustomer());
    if ($check_customer_response->status == 'CUSTOMER_NOT_FOUND') {
        // Create customer.
        // Store email and phone.
        variable_set('miniorange_saml_customer_admin_email', $username);
        //variable_set('miniorange_saml_customer_admin_email', $fname);
        variable_set('miniorange_saml_customer_admin_phone', $phone);
        variable_set('miniorange_saml_customer_admin_password', $password);

        $send_otp_response = json_decode($customer_config->sendOtp());
        if ($send_otp_response->status == 'SUCCESS') {
            // Store txID.
            variable_set('miniorange_saml_tx_id', $send_otp_response->txId);
            $current_status = 'VALIDATE_OTP';
            variable_set('miniorange_saml_status', $current_status);
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
          variable_set('miniorange_saml_customer_id', $customer_keys_response->id);
          variable_set('miniorange_saml_customer_admin_token', $customer_keys_response->token);
          variable_set('miniorange_saml_customer_admin_email', $username);
          variable_set('miniorange_saml_customer_admin_phone', $phone);
          variable_set('miniorange_saml_customer_api_key', $customer_keys_response->apiKey);
          $current_status = 'PLUGIN_CONFIGURATION';
          variable_set('miniorange_saml_status', $current_status);
          drupal_set_message(t('Successfully retrieved your account.'));

    }
    else {
      drupal_set_message(t('Invalid credentials'), 'error');
    }
  }
}

/**
 * Handle back button submit for customer setup.
 */
function miniorange_saml_back(&$form, $form_state) {
  $current_status = 'CUSTOMER_SETUP';
  variable_set('miniorange_saml_status', $current_status);
  variable_del('miniorange_saml_customer_admin_email');
  variable_del('miniorange_saml_customer_admin_phone');
  variable_del('miniorange_saml_tx_id');
  drupal_set_message(t('Register/Login with your miniOrange Account'));
}

/**
* Handle submit for license submit.
*/
function miniorange_saml_validate_license_submit(&$form, $form_state)
{
    $code = trim($form['miniorange_saml_license_key']['#value']);
    $username = variable_get('miniorange_saml_customer_admin_email', NULL);
    $phone = variable_get('miniorange_saml_customer_admin_phone', NULL);
    $customer = new MiniorangeSAMLCustomer($username, $phone,NULL,NULL);

    $license_status = json_decode( $customer->ccl(), true );

    if( !isset( $license_status['status'] ) || $license_status['status'] != 'SUCCESS' || $license_status['licensePlan'] != MiniorangeSAMLConstants::PLAN_NAME ) {
      drupal_set_message(t('Invalid license! Please use a valid license to activate the module.'),'error');
      return;
    }


    $content = json_decode($customer->verifyLicense($code),true);
    if(strcasecmp($content['status'], 'SUCCESS') == 0) {
        variable_set('miniorange_saml_licenseExpiry',$license_status['licenseExpiry']);
        variable_set('miniorange_saml_supportExpiry',$license_status['supportExpiry']);
        $key = variable_get('miniorange_saml_customer_admin_token');
        variable_set('miniorange_saml_license_key',AESEncryption::encrypt_data($code,$key));
        variable_set('t_site_status',AESEncryption::encrypt_data("false",$key));
        variable_set('site_ck_l',AESEncryption::encrypt_data("true",$key));
        drupal_set_message(t('Your license is verified. You can now setup the module.'));

        /**
		*	Encrypting domain and install paths and storing in database
		*/

		global $base_url;
		global $base_path;
		$inst_path= $_SERVER['DOCUMENT_ROOT'].$base_path;
		$home_url = trim($base_url, '/');
		if (!preg_match('#^http(s)?://#', $home_url)) {
			$home_url = 'http://' . $home_url;
			}
		$urlParts = parse_url($home_url);
		$domain = preg_replace('/^www\./', '', $urlParts['host'].$urlParts['path']);
        $fraud_check = $inst_path . $domain;
		variable_set('minorange_saml_customer_admin_fraud_check',AESEncryption::encrypt_data($fraud_check,$key));
	}else if(strcasecmp($content['status'], 'FAILED') == 0)
	{
		if(strcasecmp($content['message'], 'Code has Expired') == 0) {
				drupal_set_message(t('License key you have entered has already been used. Please enter a key which has not been used before on any other instance or if you have exausted all your keys then buy more license from Licensing'), 'error');
		}else {
				drupal_set_message(t('You have entered an invalid license key. Please enter a valid license key.'), 'error');
		}
	}else {
		drupal_set_message(t('An error occured while processing your request. Please Try again.'), 'error');
	}
}


/**
 * Send support query.
 */
function miniorange_saml_idp_send_query(&$form, $form_state)
{
    $email = $form['miniorange_saml_email_address_support']['#value'];
    $phone = $form['miniorange_saml_phone_number_support']['#value'];
    $query = $form['miniorange_saml_support_query_support']['#value'];
    Utilities::send_query($email, $phone, $query);
}

function miniorange_saml_remove_account(&$form, $form_state)
{
    if (isset($_POST['value_check']) && $_POST['value_check'] == 'True')
    {
        if(variable_get('miniorange_saml_license_key',NULL) != NULL) {

            $username = variable_get('miniorange_saml_customer_admin_email', NULL);
            $phone = variable_get('miniorange_saml_customer_admin_phone', NULL);
            $customer = new MiniorangeSAMLCustomer($username,$phone,NULL,NULL);
            $response = json_decode($customer->updateStatus());

            if($response->status == 'SUCCESS') {

                variable_del('miniorange_saml_license_key');
                variable_del('miniorange_saml_customer_admin_email');
                variable_del('miniorange_saml_customer_admin_phone');
                variable_del('miniorange_saml_customer_api_key');
                variable_del('miniorange_saml_customer_admin_token');
                variable_del('miniorange_saml_customer_setup_password[pass1]');
                variable_del('miniorange_saml_customer_setup_password[pass2]');

                variable_set('miniorange_saml_status', 'CUSTOMER_SETUP');
                drupal_set_message(t('Your Account Has Been Removed Successfully!'),'status');
                $_POST['value_check'] = 'False';
            }
        }
    }
    else
    {
        $myArray = array();
        $myArray = $_POST;
        $form_id = $_POST['form_id'];
        $form_token = $_POST['form_token'];
        $op = $_POST['op'];
        $build_id = $_POST['form_build_id'];
        ?>

        <html>
        <head>
            <title>Confirmation</title>
            <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
        </head>

        <body style="font-family: 'PT Serif', serif;">
        <div style="margin: 15% auto; height:35%; width: 40%; background-color: #eaebed; text-align: center; box-shadow: 10px 5px 5px darkgray; border-radius: 2%;">
            <div style="color: #a94442; background-color:#f2dede; padding: 15px; margin-bottom: 20px; text-align:center; border:1px solid #E6B3B2; font-size:16pt; border-radius: 2%;">
                <strong>Are you sure you want to remove account..!!</strong>
            </div>
            <p style="font-size:14px; margin-left: 8%; margin-right: 8%"><strong>Warning </strong>: If you remove your account, you will have to enter licence Key Again after login/sign in with the new account.</p>
                <br/>
                <form name="f" method="post" action="" id="mo_remove_account">
                    <div>
                            <input type="hidden" name="op" value=<?php echo $op;?>>
                            <input type="hidden" name="form_build_id" value= <?php echo $build_id;?>>
                            <input type="hidden" name="form_token" value=<?php echo $form_token;?>>
                            <input type="hidden" name="form_id" value= <?php echo $form_id;?>>
                            <input type="hidden" name="value_check" value= 'True'>
                    </div>
                    <div  style="margin: auto; text-align: center;"   class="mo2f_modal-footer">
                        <input type="submit" style=" padding:1%; width:100px; background: #0091CD none repeat scroll 0% 0%; cursor: pointer; font-size:15px; border-width: 1px; border-style: solid; border-radius: 3px; white-space: nowrap; box-sizing: border-box;border-color: #0073AA; box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.6) inset; color: #FFF;" name="miniorange_confirm_submit" class="button button-danger button-large" value="Confirm"/>
                    </div>
                </form>
        </div>
        </body>
        </html>
        <?php
        exit;
    }
}
