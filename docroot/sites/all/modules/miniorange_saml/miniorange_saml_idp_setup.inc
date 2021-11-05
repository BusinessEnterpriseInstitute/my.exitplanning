<?php
/**
 * @file
 * Contains Service Provider information for miniOrange SAML Login Module.
 */

/**
 * Showing IdP Setup form info.
 */
function miniorange_saml_idp_setup($form, &$form_state)
{
    global $base_url;
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/bootstrap.min.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/style_settings.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    /**
     * Success Message for Import Configuration.
     */
    $config_status = variable_get('miniorange_config_status', '');

    if ($config_status == 'CONFIGURATION_SAVED') {
        variable_set('miniorange_config_status', '');
        drupal_set_message(t('Plugin Configuration Imported successfully.'));
    }

    $form['markup_header'] = array(
        '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_saml_container">
                '
    );


    $disabled = Utilities::isCustomerRegistered($form, $form_state);

    $form['miniorange_saml_IDP_tab'] = array(
        '#markup' => '<div id="tabhead"><h2>Configure Service Provider</h2><hr><h5> Enter the information gathered from your Identity Provider &nbsp; OR &nbsp;<a class="mo_saml_btn mo_saml_btn-primary mo_saml_btn-large" style="padding:4px 8px;" onclick="show_metadata_form()">'
            . 'Upload IDP Metadata </a><br><br> </h5></div>',
    );

    $form['metadata_1'] = array(
        '#markup' => '<div border="1" id="upload_metadata_form" style="background-color:#FFFFFF; border:2px solid #CCCCCC; padding:1px 1px 1px 10px; display:none;" >'
            . '		<table style="width:100%; border: none;">'
            . '		<tr> <td colspan="3">'
            . '				<h2>Upload IDP Metadata'
            . '					<span style="float:right;margin-right:25px;">'
            . '						<input type="button" class="mo_saml_btn mo_saml_btn-sm mo_saml_btn-danger" value="Cancel" onclick = "hide_metadata_form()"/></a><br>'
            . '					</span>',
    );

    $form['metadata_idp_name'] = array(
        '#markup' => '</td></td>'
            . '	</tr>'
            . '				<tr><td colspan="3" ></td></tr>'
            . '		    <tr>'
    );

    $form['metadata_2'] = array(
        '#markup' => '</tr>'
            . '				<td><h4>Upload Metadata  :</h4>'
            . '				<td colspan="1">',
    );


    $form['metadata_file'] = array(
        '#type' => 'file',
    );

    $form['metadata_upload'] = array(
        '#type' => 'submit',
        '#value' => t('Upload'),
        '#submit' => array('miniorange_saml_upload_file'),
        '#disabled' => $disabled,
        
    );

    $form['metadata_3'] = array(
        '#markup' => '</td></td>'
            . '</tr> ' . ' <tr><td colspan="3" ><p style="font-size:13pt;text-align:center;"><b>OR<hr><hr></b></p></td> </tr>'
            . '<tr>  ' . '	<td width="20%"><h4>Enter metadata URL:</h4></td><td width="10%">',
    );

    $form['metadata_URL'] = array(
        '#type' => 'textfield',
        '#attributes' => array('placeholder' => 'Enter metadata URL of your IdP.'),
        '#default_value' => variable_get('miniorange_saml_meta_data_url', ''),
    );

    $form['metadata_fetch'] = array(
        '#type' => 'submit',
        '#value' => t('Fetch Metadata'),
        '#submit' => array('miniorange_saml_fetch_metadata'),
        '#disabled' => $disabled,
        
        '#suffix' => '</td></tr><tr><td></td><td>'
    );

    $form['miniorange_saml_fetch_metadata_after_specific_time'] = array(
        '#type' => 'checkbox',
        '#title' => t('Update IdP settings by pinging metadata URL ( We will store the metadata URL )'),
        '#default_value' => variable_get('miniorange_saml_fetch_metadata_time_intervals', FALSE),
        '#disabled' => $disabled,
    );

    $base_site_url = Utilities::miniorange_get_baseURL();

    $form['note_for metadata_fetch'] = array(
        '#markup' => '<b>Note: </b>You can set how often you want to ping the IdP from <b><a style="font-size: small;" href="' . $base_site_url . '/admin/config/system/cron">Here</a> OR</b> you can goto <b>Configuration=>Cron=>Run Cron Every</b> section of your drupal site',
    );

    $form['metadata_5'] = array(
        '#markup' => '	</td></tr>'
            . '	</table>'
            . '</div>'
            . '<div id="idpdata">',
    );

    $form['miniorange_saml_identity_provider_guide'] = array(
        '#type' => 'select',
        '#title' => t('Select your Identity Provider for guideline :'),
        '#options' => array(
            'select-idp' => t('Select your Identity Provider'),
            'adfs' => t('ADFS'),
            'okta' => t('Okta'),
            'salesforce' => t('SalesForce'),
            'google-apps' => t('Google Apps'),
            'azure-ad' => t('Azure Ad'),
            'onelogin' => t('OneLogin'),
            'centrify' => t('Centrify'),
            'miniorange' => t('MiniOrange'),
            'bitium' => t('Bitium'),
            'other' => t('Other'),
        ),
        '#disabled' => $disabled,
        '#default_value' => variable_get('miniorange_nameid_format', ''),
        '#attributes' => array('style' => 'width:700px', 'onchange' => 'idp_guide(value);'),
        '#description' => t('<b>Note : </b>Select your Identity Provider from the list above, and you can find the link to the guide for setting up SAML.<br> Please contact us if you don\'t find your IDP in the list.'),
    );
    ?>
    <script>
        function idp_guide(value) {
            if (value != "other" && value != "select-idp") {
                window.open("https://plugins.miniorange.com/drupal-single-sign-sso-using-" + value + "-idp/", '_blank');
            }
        }
    </script>
    <?php

    $form['miniorange_saml_idp_name'] = array(
        '#type' => 'textfield',
        '#maxlength' => 255,
        '#title' => t('Identity Provider Name<span class="mo_saml_color_red" >*</span>'),
        '#default_value' => variable_get('miniorange_saml_idp_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Identity Provider Name'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_issuer'] = array(
        '#type' => 'textfield',
        '#maxlength' => 255,
        '#title' => t('IdP Entity ID or Issuer<span class="mo_saml_color_red" >*</span>'),
        '#description' => t('<b>Note :</b> You can find the EntityID in Your IdP-Metadata XML file enclosed in <code>EntityDescriptor</code> tag having attribute<br> as <code>entityID</code>'),
        '#default_value' => variable_get('miniorange_saml_idp_issuer', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'IdP Entity ID or Issuer'),
        '#disabled' => $disabled,
    );

    $form['miniorange_nameid_format'] = array(
        '#type' => 'select',
        '#title' => t('NameID Format'),
        '#options' => array(
            'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress' => t('urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress'),
            'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified' => t('urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified'),
            'urn:oasis:names:tc:SAML:1.1:nameid-format:transient' => t('urn:oasis:names:tc:SAML:1.1:nameid-format:transient'),
            'urn:oasis:names:tc:SAML:1.1:nameid-format:persistent' => t('urn:oasis:names:tc:SAML:1.1:nameid-format:persistent'),
        ),
        '#default_value' => variable_get('miniorange_nameid_format'),
        '#attributes' => array('style' => 'width:700px'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_binding'] = array(
        '#type' => 'radios',
        '#title' => t('HTTP Binding for SSO'),
        '#default_value' => (variable_get('miniorange_saml_http_binding') == 'HTTP-POST') ? 1 : 0,
        '#options' => array(
            t('HTTP-Redirect'),
            t('HTTP-POST')),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_login_url'] = array(
        '#type' => 'textfield',
        '#title' => t('SAML Login URL<span class="mo_saml_color_red" >*</span>'),
        '#maxlength' => 255,
        '#description' => t('<b>Note :</b> You can find the SAML Login URL in Your IdP-Metadata XML file enclosed in <code>SingleSignOnService</code> tag'),
        '#default_value' => variable_get('miniorange_saml_idp_login_url', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'SAML Login URL'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_binding_slo'] = array(
        '#type' => 'radios',
        '#title' => t('HTTP Binding for SLO'),
        '#default_value' => (variable_get('miniorange_saml_http_binding_slo') == 'HTTP-POST') ? 1 : 0,
        '#options' => array(
            t('HTTP-Redirect'),
            t('HTTP-POST')),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_enable_logout'] = array(
        '#type' => 'checkbox',
        '#title' => t('<b>Check this option for logout if you do not want to wait for response.</b>'),
        '#default_value' => variable_get('miniorange_saml_enable_logout', FALSE),
        '#description' => t('<b>Note: </b>Checking this option Users will be logout from Service Provider and Identity Provider without waiting<br> for response from IdP.'),
        '#disabled' => $disabled,
    );


    $form['miniorange_saml_idp_logout_url'] = array(
        '#type' => 'textfield',
        '#maxlength' => 255,
        '#title' => t('SAML Logout URL'),
        '#description' => t('<b>Note :</b> You can find the SAML Login URL in Your IdP-Metadata XML file enclosed in <code>SingleLogoutService</code> tag'),
        '#default_value' => variable_get('miniorange_saml_idp_logout_url', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'SAML Logout URL'),
        '#disabled' => $disabled,
    );

    $certificate = variable_get('miniorange_saml_idp_x509_certificate', '');
    $size = 1;
    if ( is_array( $certificate ) ) {
        $size = sizeof($certificate);
    }
    if ( empty( $certificate ) ) {
        $certificate = array();
        $certificate[0] = '';
    }

    $ceti = array("miniorange_saml_idp_x509_certificate_1", "miniorange_saml_idp_x509_certificate_2", "miniorange_saml_idp_x509_certificate_3", "miniorange_saml_idp_x509_certificate_4");

    for ($i = 0; $i < $size; $i++) {
        $form[$ceti[$i]] = array(
            '#type' => 'textarea',
            '#title' => t('x.509 Certificate Value'),
            '#rows' => 5,
            '#default_value' => $certificate[$i],
            '#attributes' => array(
                'style' => 'width:700px', 'placeholder' => 'Enter x509 Certificate Value'
            ),
            '#resizable' => False,
            '#disabled' => $disabled,
        );
        if ( $i == 0 ) {
            $form[$ceti[$i]]['#description'] = '<b>NOTE:</b> Format of the certificate:<br><b>-----BEGIN CERTIFICATE-----<br>'
                    . 'XXXXXXXXXXXXXXXXXXXXXXXXXXX<br>-----END CERTIFICATE-----</b><br><br>';
        }
    }

    $form['security_signature_algorithm'] = array(
        '#type' => 'select',
        '#title' => t('Signature algorithm'),
        '#options' => [
            'RSA_SHA256' => 'sha256',
            'RSA_SHA384' => 'sha384',
            'RSA_SHA512' => 'sha512',
            'RSA_SHA1' => 'sha1',
        ],
        '#description' => t('<b>Note:</b> Algorithm used in the signing process.'),
        '#default_value' => variable_get('security_signature_algorithm'),
        '#attributes' => array('style' => 'width:700px'),
    );

    $form['miniorange_saml_sign_request'] = array(
        '#type' => 'checkbox',
        '#title' => t('Check this option to send Signed SSO and SLO requests.'),
        '#default_value' => variable_get('miniorange_saml_request_signed', FALSE),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_enable_login'] = array(
        '#type' => 'checkbox',
        '#title' => t('Enable login with SAML'),
        '#default_value' => variable_get('miniorange_saml_enable_login', FALSE),
        '#disabled' => $disabled,
    );

    $disable_true = $disabled == TRUE ? 'disabled="True"' : "";

    $form['miniorange_saml_new_line'] = array('#markup' => '<br/><br/>');

    $form['miniorange_saml_idp_config_submit'] = array(
        '#type' => 'submit',
        '#value' => t('Save Configuration'),
        '#submit' => array('miniorange_saml_save_idp_config'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_test_config_button'] = array(
        '#markup' => '<a ' . $disable_true . ' class="mo_saml_btn mo_saml_btn-success mo_saml_btn-medium" style="height: 26px; width: 10em; line-height: 25px;"
                    onclick="testConfig(\'' . getTestUrl() . '\');">' . 'Test Configuration</a><br><br>'
    );

    $form['miniorange_saml_test_show_SAML_request_button'] = array(
        '#markup' => '<a ' . $disable_true . ' class="mo_saml_btn mo_saml_btn-primary mo_saml_btn-large" style="height: 26px; width: 11em; line-height: 25px; margin-right: 10px;" onclick="showSAMLrequest(\'' . getSAMLrequest() . '\');">'
            . 'Show SAML Request</a>&nbsp',
    );

    $form['miniorange_saml_test_show_SAML_response_button'] = array(
        '#markup' => '<a ' . $disable_true . ' class="mo_saml_btn mo_saml_btn-primary mo_saml_btn-large" style="height: 26px; width: 11em; line-height: 25px;" onclick="showSAMLresponse(\'' . getSAMLresponse() . '\');">'
            . 'Show SAML Response</a><br><br></div></div>'

    );

    Utilities::AddsupportTab($form, $form_state);

    return $form;
}

function getTestUrl()
{
    $base_site_url = Utilities::miniorange_get_baseURL();
    $host_name = MiniorangeSAMLConstants::BASE_URL;
    $customer_key = variable_get('miniorange_saml_customer_id', '');
    $customer_token = variable_get('miniorange_saml_customer_admin_token', '');
    $url = $host_name . '/moas/idptest/?id=' . $customer_key . '&key=' . $customer_token;

    $testUrl = $base_site_url . '/?q=testConfig';
    return $testUrl;
}

function getSAMLrequest()
{
    global $base_url;
    $SAMLrequestUrl = $base_url . '/?q=showSAMLrequest';
    return $SAMLrequestUrl;
}

function getSAMLresponse()
{
    global $base_url;
    $SAMLresponseUrl = $base_url . '/?q=showSAMLresponse';
    return $SAMLresponseUrl;
}

/**
 * Configure IdP.
 */
function miniorange_saml_save_idp_config($form, &$form_state)
{

    global $base_url;
    $issuer = $form['miniorange_saml_idp_issuer']['#value'];
    $idp_name = $form['miniorange_saml_idp_name']['#value'];
    $request_signed_value = $form['miniorange_saml_sign_request']['#value'];
    $http_binding_value = $form['miniorange_saml_idp_binding']['#value'];
    $login_url = $form['miniorange_saml_idp_login_url']['#value'];
    $enable_logout_value = $form['miniorange_saml_enable_logout']['#value'];
    $sign_algo = $form['security_signature_algorithm']['#value'];
    $logout_url = $form['miniorange_saml_idp_logout_url']['#value'];
   

    if (empty($issuer) || empty($login_url) || empty($idp_name)) {
        drupal_set_message(t('The <b><u>Identity Provider Name, </u><u>IdP Entity ID or Issuer</u></b> and <b><u>SAML Login URL</u></b> fields are mandatory.'), 'error');
        return;
    }

    $cert_value_1 = isset($form['miniorange_saml_idp_x509_certificate_1']['#value']) ? $form['miniorange_saml_idp_x509_certificate_1']['#value'] : '';
    $cert_value_2 = isset($form['miniorange_saml_idp_x509_certificate_2']['#value']) ? $form['miniorange_saml_idp_x509_certificate_2']['#value'] : '';
    $cert_value_3 = isset($form['miniorange_saml_idp_x509_certificate_3']['#value']) ? $form['miniorange_saml_idp_x509_certificate_3']['#value'] : '';
    $cert_value_4 = isset($form['miniorange_saml_idp_x509_certificate_4']['#value']) ? $form['miniorange_saml_idp_x509_certificate_4']['#value'] : '';

    $x509_cert_value_array = [$cert_value_1, $cert_value_2, $cert_value_3, $cert_value_4];
    $x509_cert_value_withoutEmptyValue = array_filter($x509_cert_value_array);
    $x509_cert_value = array_values($x509_cert_value_withoutEmptyValue);
    foreach ($x509_cert_value as $key => $value) {
        $x509_cert_value[$key] = Utilities::sanitize_certificate($value);
    }
    $enable_login_value = $form['miniorange_saml_enable_login']['#value'];
    $http_binding_value_slo = $form['miniorange_saml_idp_binding_slo']['#value'];
    $nameid_format = $form['miniorange_nameid_format']['#value'];

    $http_binding = $http_binding_value == 1 ? 'HTTP-POST' : 'HTTP-Redirect';
    $http_binding_slo = $http_binding_value_slo == 1 ? 'HTTP-POST' : 'HTTP-Redirect';

    $enable_logout = $enable_logout_value == 1 ? TRUE : FALSE;
    $request_signed = $request_signed_value == 1 ? TRUE : FALSE;
    $enable_login = $enable_login_value == 1 ? TRUE : FALSE;
    variable_set('miniorange_saml_idp_name', $idp_name);
    variable_set('miniorange_saml_idp_issuer', $issuer);
    variable_set('miniorange_nameid_format', $nameid_format);
    variable_set('miniorange_saml_request_signed', $request_signed);
    variable_set('miniorange_saml_http_binding', $http_binding);
    variable_set('miniorange_saml_http_binding_slo', $http_binding_slo);
    variable_set('miniorange_saml_idp_login_url', $login_url);
    variable_set('miniorange_saml_idp_logout_url', $logout_url);
    variable_set('miniorange_saml_idp_x509_certificate', $x509_cert_value);
    variable_set('miniorange_saml_enable_logout', $enable_logout);
    variable_set('miniorange_saml_enable_login', $enable_login);
    variable_set('security_signature_algorithm', $sign_algo);

    drupal_set_message(t('Identity Provider Configuration successfully saved'));
}

function miniorange_saml_upload_file($form, &$form_state) {
    $file_name = $_FILES['files']['tmp_name']['metadata_file'];
    $file = file_get_contents($file_name);
    Utilities::upload_metadata($file, true);
}

function miniorange_saml_fetch_metadata($form, &$form_state) {
    $MetaDataAfterSpecificTime = $form['miniorange_saml_fetch_metadata_after_specific_time']['#value'];
    variable_set('miniorange_saml_fetch_metadata_time_intervals', $MetaDataAfterSpecificTime);
    $url = filter_var($form['metadata_URL']['#value'], FILTER_SANITIZE_URL);
    $MetaDataAfterSpecificTime == 1 ? variable_set('miniorange_saml_meta_data_url', $url) : variable_del('miniorange_saml_meta_data_url');

    $arrContextOptions = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );

    $file = file_get_contents($url, false, stream_context_create($arrContextOptions));
    Utilities::upload_metadata($file, true);
}

echo '
        <script>
              function redirect_to_attribute_mapping(){
                  var baseurl = window.location.href.replace("sp_setup","mapping_config");
                  window.location.href= baseurl;
              }
          </script>';
