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
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/bootstrap.min.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/style_settings.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    $current_status = variable_get('miniorange_saml_status', '');

    if ($current_status == 'PLUGIN_CONFIGURATION' && variable_get('miniorange_saml_license_key', NULL) == NULL) {

        $form['header_top_style_2'] = array(
            '#markup' => '<div class="mo_saml_table_layout_1">
	  					<div class="mo_saml_table_layout mo_saml_container">'
        );

        $form['miniorange_saml_license_key'] = array(
            '#type' => 'textfield',
            '#title' => t('License Key<span class="mo_saml_color_red">*</span>'),
            '#attributes' => array('style' => 'width:55%', 'placeholder' => 'Enter your license key to activate the plugin'),
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
            '#markup' => '<br><br><br><br><br><br><br><br><br><br><br>
                          <br><br><br><br><br><br><br><br><br></div>',
        );

        Utilities::AddsupportTab($form, $form_state);

        return $form;

    } elseif ($current_status == 'PLUGIN_CONFIGURATION') {

        $form['markup_top'] = array(
            '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_saml_container">
                  <div class="mo_saml_welcome_message">Thank you for registering with miniOrange</div><br/>
                <h4>Your Profile: </h4>',
        );

        $header = array(
            'email' => array('data' => t('Customer Email')),
            'customerid' => array('data' => t('Customer ID')),
            'token' => array('data' => t('Token Key')),
            'apikey' => array('data' => t('API Key')),
        );

        $options = array();

        $options[0] = array(
            'email' => variable_get('miniorange_saml_customer_admin_email', ''),
            'customerid' => variable_get('miniorange_saml_customer_id', ''),
            'token' => variable_get('miniorange_saml_customer_admin_token', ''),
            'apikey' => variable_get('miniorange_saml_customer_api_key', ''),
        );

        $form['fieldset']['customerinfo'] = array(
            '#theme' => 'table',
            '#header' => $header,
            '#rows' => $options,
        );

        $form['miniorange_saml_customer_Remove_Account_info'] = array(
                '#markup' => '<br><br><br>
                        <h3>Remove Your License Key</h3><hr style="margin-bottom: 5px">
						<b>Note:</b> By clicking the button, you can re-use the license key and  all the configurations saved for this site wont be deleted.<br><br>
						<input type="button" value="Remove License Key"  class="mo_saml_btn mo_saml_btn-medium mo_saml_btn-danger" data-toggle="modal" data-target="#keyModal" id="mo_saml_remove_lk_btn" style="width: 11em;"  onclick="removeLicenseKey(\'' . miniorange_saml_remove_account() . '\');"/>
                    </div>');

        
        Utilities::AddsupportTab($form, $form_state);

        return $form;
    }

    $form['markup_15'] = array(
        '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_saml_container"><h3>Login with miniOrange account</h3><hr><br/>
                <div class="mo_saml_highlight_background_note_1">Please login with your miniOrange account for which you have purchased the license. After successful login you need to enter the license key. You can find license key under <b>miniOrange dashboard -> License menu -> View License Key.</b></div>',
    );

    $form['miniorange_saml_customer_setup_username'] = array(
        '#type' => 'textfield',
        '#title' => t('Email<span class="mo_saml_color_red">*</span>'),
        '#attributes' => array(
            'style' => 'width:400px'
        ),
    );

    $form['miniorange_saml_customer_setup_password'] = array(
        '#type' => 'password',
        '#title' => t('Password'),
        '#attributes' => array(
            'style' => 'width:400px'
        ),
    );

    $form['miniorange_saml_customer_setup_button'] = array(
        '#type' => 'submit',
        '#value' => t('Login'),
        '#prefix' => '<br>',
        '#suffix' => '<br><br><br><br><br><br>
                        <br><br><br><br></div>'
    );

    Utilities::AddsupportTab($form, $form_state);

    return $form;

}

/**
 * Handle submit for customer setup.
 */
function miniorange_saml_customer_setup_submit(&$form, $form_state) {

    $username = $form['miniorange_saml_customer_setup_username']['#value'];
    $password = $form['miniorange_saml_customer_setup_password']['#value'];

    if ( empty( $username ) || empty( $password ) ) {
        drupal_set_message(t('The <b><u>Email</u></b> and <b><u>Password</u></b> fields are required.'), 'error');
        return;
    } elseif ( !valid_email_address( $username ) ) {
        drupal_set_message(t('The email address <b><i>' . $username . '</i></b> is not valid.'), 'error');
        return;
    }

    $customer_config = new MiniorangeSAMLCustomer($username, $password);
    $check_customer_response = json_decode( $customer_config->checkCustomer() );

    if ($check_customer_response->status == 'CUSTOMER_NOT_FOUND') {
        drupal_set_message(t('It seems you are not registered with us. Please register and try again.'),'error');
        return;
    } else if ($check_customer_response->status == 'CURL_ERROR') {
        drupal_set_message(t('cURL is not enabled. Please enable cURL'), 'error');
        return;
    } else {
        // Customer exists. Retrieve keys.
        $customer_keys_response = json_decode($customer_config->getCustomerKeys());
        if (json_last_error() == JSON_ERROR_NONE) {
            variable_set('miniorange_saml_customer_id', $customer_keys_response->id);
            variable_set('miniorange_saml_customer_admin_token', $customer_keys_response->token);
            variable_set('miniorange_saml_customer_admin_email', $username);
            variable_set('miniorange_saml_customer_admin_phone', $customer_keys_response->phone);
            variable_set('miniorange_saml_customer_api_key', $customer_keys_response->apiKey);
            variable_set('miniorange_saml_status', 'PLUGIN_CONFIGURATION');
            drupal_set_message(t('Successfully retrieved your account.'));

        } else {
            drupal_set_message(t('Invalid credentials'), 'error');
            return;
        }

        if (variable_get('miniorange_saml_license_key')) {

            $key = variable_get('miniorange_saml_customer_admin_token');
            $code = AESEncryption::decrypt_data(variable_get('miniorange_saml_license_key'), $key);
            $username = variable_get('miniorange_saml_customer_admin_email', NULL);
            $customer = new MiniorangeSAMLCustomer($username, NULL);
            $content = json_decode($customer->verifyLicense($code), true);

            if (strcasecmp($content['status'], 'SUCCESS') == 0) {
                drupal_set_message(t('Your license is verified. You can now setup the plugin.'));
            } else {
                drupal_set_message(t('License key for this instance is incorrect. Make sure you have not tampered with it at all. Please enter a valid license key.'), 'error');
                variable_del('miniorange_saml_license_key');
                return;
            }
        } else {
            variable_set('miniorange_saml_status', 'PLUGIN_CONFIGURATION');
        }
    }
}

/**
 * Handle back button submit for customer setup.
 */
function miniorange_saml_back(&$form, $form_state)
{
    variable_set('miniorange_saml_status', 'CUSTOMER_SETUP');
    variable_del('miniorange_saml_customer_admin_email');
    variable_del('miniorange_saml_customer_admin_phone');
    variable_del('miniorange_saml_customer_id');
    variable_del('miniorange_saml_customer_admin_token');
    variable_del('miniorange_saml_customer_api_key');
    drupal_set_message(t('Login with your miniOrange Account'));
}

/**
 * Handle submit for license submit.
 */
function miniorange_saml_validate_license_submit(&$form, $form_state)
{
    $code = trim($form['miniorange_saml_license_key']['#value']);
    $username = variable_get('miniorange_saml_customer_admin_email', NULL);
    $customer = new MiniorangeSAMLCustomer($username, NULL);

   

    $content = json_decode($customer->verifyLicense($code), true);
    if (strcasecmp($content['status'], 'SUCCESS') == 0) {

        $key = variable_get('miniorange_saml_customer_admin_token');
        variable_set('miniorange_saml_license_key', AESEncryption::encrypt_data($code, $key));
        variable_set('t_site_status', AESEncryption::encrypt_data("false", $key));
        variable_set('site_ck_l', AESEncryption::encrypt_data("true", $key));
        drupal_set_message(t('Your license is verified. You can now setup the plugin.'));
        $apiKey     =  variable_get('miniorange_saml_customer_api_key');
        $customerId = variable_get('miniorange_saml_customer_id');
        $upgradeUrl = Utilities::createUpdateUrl($code, 'drupal_miniorange_saml_enterprise_plan', 'DRUPAL_SAML_SP_ENTERPRISE_MODULE',$apiKey,$customerId,MiniorangeSAMLConstants::BASE_URL);
        variable_set('miniorange_saml_sp_upgrade_url',$upgradeUrl);

        /**
         *    Encrypting domain and install paths and storing in database
         */

        global $base_url, $base_path;
        $inst_path = $_SERVER['DOCUMENT_ROOT'] . $base_path;
        $home_url = trim($base_url, '/');
        if (!preg_match('#^http(s)?://#', $home_url)) {
            $home_url = 'http://' . $home_url;
        }
        $urlParts = parse_url($home_url);
        $urlPartsPath = isset( $urlParts['path'] ) ? $urlParts['path'] : '';
		$domain = preg_replace('/^www\./', '', $urlParts['host'] . $urlPartsPath);
        $fraud_check = $inst_path . $domain;
        variable_set('minorange_saml_customer_admin_fraud_check', AESEncryption::encrypt_data($fraud_check, $key));
    } else if (strcasecmp($content['status'], 'FAILED') == 0) {
        if (strcasecmp($content['message'], 'Code has Expired') == 0) {
            drupal_set_message(t('License key you have entered has already been used. Please enter a key which has not been used before on any other instance or if you have exhausted all your keys then buy more licenses.'), 'error');
            return;
        } else {
            drupal_set_message(t('You have entered an invalid license key. Please enter a valid license key.'), 'error');
            return;
        }
    } else {
        drupal_set_message(t('An error occurred while processing your request. Please Try again.'), 'error');
        return;
    }
}

/**
 * Send remove license key.
 */
function miniorange_saml_remove_account()
{
    global $base_url;
    $SAMLrequestUrl = $base_url . '/?q=removeLicense';
    return $SAMLrequestUrl;
}