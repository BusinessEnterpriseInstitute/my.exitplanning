<?php function mo_saml_add_custom_certificate($form, &$form_state)
{   

    global $base_url;
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/bootstrap.min.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/style_settings.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    $form['header_top_style_1'] = array('#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_saml_container">');

    $form['miniorange_saml_generate_metadata'] = array(
        '#markup' => '<div id="mo_gen_tab"></div>',
    );
    $disabled = Utilities::isCustomerRegistered($form, $form_state);

    $form['mo_saml_metadata'] = array(
        '#markup' => '<div border="1" id="generate_certificate_form" style="background-color:#FFFFFF; border:0px solid #CCCCCC; padding:1px 1px 1px 10px; display:none;" >
                    <table style="width:100%;">
                        <h4>GENERATE CUSTOM CERTIFICATE<span style="float:right;margin-right:25px;">
            				<input type="button" class="mo_saml_btn mo_saml_btn-sm mo_saml_btn-danger" value="Back" onclick = "hide_gen_cert_form()"/></a><br>
           				    </span><br><br><b><hr></b><br>',
    );

    $form['mo_saml_certificate_country_code'] = array(
        '#markup' => '<tr>
                        <td width="20%"><h4 style="margin-left: 44px;">Country code :</h4></td><td width="10%">',
    );

    $form['mo_saml_country_code_text'] = array(
        '#type' => 'textfield',
        '#attributes' => array('style' => 'width:80%', 'placeholder' => 'Enter Country code:'),
        '#description' => t('<b>NOTE: </b>Check your country code <a href="https://www.digicert.com/ssl-certificate-country-codes.htm" target="_blank">here.</a>'),
        '#default_value' => variable_get('mo_saml_country_code_text', ''),
        '#disabled'=>$disabled
    );
    $form['mo_saml_certificate_state'] = array(
        '#markup' => '<tr>
                        <td width="20%"><h4 style="margin-left: 44px;">State :</h4></td>
                        <td width="30%">',
    );

    $form['mo_saml_certificate_state_name'] = array(
        '#type' => 'textfield',
        '#attributes' => array('style' => 'width:80%', 'placeholder' => 'State Name:'),
        '#default_value' => variable_get('mo_saml_certificate_state_name', ''),
        '#disabled'=>$disabled
    );

    $form['mo_saml_certificate_company'] = array(
        '#markup' => '<tr>
                        <td width="20%"><h4 style="margin-left: 44px;">Company :</h4></td><td width="10%">',
    );

    $form['mo_saml_certificate_company_name'] = array(
        '#type' => 'textfield',
        '#attributes' => array('style' => 'width:80%', 'placeholder' => 'Company Name:'),
        '#default_value' => variable_get('mo_saml_certificate_company_name', ''),
        '#disabled'=>$disabled
    );

    $form['metadata_unit'] = array(
        '#markup' => '<tr>
                        <td width="20%"><b style="margin-left: 44px;font-size: 14px;">Unit :</b></td><td width="10%">',
    );

    $form['miniorange_saml_unit_name'] = array(
        '#type' => 'textfield',
        '#attributes' => array('style' => 'width:80%', 'placeholder' => 'Unit name'),
        '#default_value' => variable_get('miniorange_saml_unit_name', ''),
        '#disabled'=>$disabled
    );

    $form['mo_saml_certificate_common'] = array(
        '#markup' => '<tr>
                        <td width="20%"><b style="margin-left: 44px;font-size: 14px;">Common :</b></td>
                        <td width="10%">',
    );

    $form['mo_saml_certificate_common_name'] = array(
        '#type' => 'textfield',
        '#attributes' => array('style' => 'width:80%', 'placeholder' => 'Common Name:'),
        '#default_value' => variable_get('mo_saml_certificate_common_name', ''),
        '#disabled'=>$disabled
    );

    $form['mo_saml_digest_algo'] = array(
        '#markup' => '<tr>
                        <td width="20%"><h4 style="margin-left: 44px;">Digest Algorithm :</h4></td>
                        <td width="10%">',
    );

    $form['mo_saml_select_digest_algo'] = array(
        '#type' => 'select',
        '#options' => array(
            'sha512' => t('SHA512'),
            'sha384' => t('SHA384'),
            'sha256' => t('SHA256'),
            'sha1' => t('SHA1'),
        ),
        '#attributes' => array('style' => 'width:55%'),
        '#default_value' => variable_get('mo_saml_select_digest_algo', ''),
        '#disabled' => FALSE,
    );

    $form['mo_saml_private_key_bits'] = array(
        '#markup' => '<tr>
                        <td width="20%"><h4 style="margin-left: 44px;">Bits to generate the private key :</h4></td>
                        <td width="10%">',
    );

    $form['mo_saml_select_private_key_bit'] = array(
        '#type' => 'select',
        '#options' => array(
            '2048' => t('2048 bits'),
            '1024' => t('1024 bits'),
        ),
        '#attributes' => array('style' => 'width:55%'),
        '#default_value' => variable_get('mo_saml_select_private_key_bit', ''),
        '#disabled' => FALSE,
    );

    $form['mo_saml_valid_days'] = array(
        '#markup' => '<tr>
                        <td width="20%"><h4 style="margin-left: 44px;">Valid Days :</h4></td>
                        <td width="10%">',
    );

    $form['mo_saml_select_valid_days'] = array(
        '#type' => 'select',
        '#options' => array(
            '365' => t('365 days'),
            '180' => t('180 days'),
            '90' => t('90 days'),
            '45' => t('45 days'),
            '30' => t('30 days'),
            '15' => t('45 days'),
            '7' => t('7 days'),
        ),
        '#attributes' => array('style' => 'width:55%'),
        '#default_value' => variable_get('mo_saml_select_valid_days', ''),
        '#disabled' => FALSE,
    );

    $form['metadata_5'] = array(
        '#markup' => '</td></tr></table>',
    );

    $form['generate_config_elements'] = array(
        '#type' => 'submit',
        '#value' => t('Generate Self-Signed Certs'),
        '#prefix' => '<td>',
        '#suffix' => '</td>',
        '#submit' => array('miniorange_saml_generate_custom_certificate'),
        '#disabled'=>$disabled
    );


    $form['metadata_i'] = array(
        '#markup' => '</div><div id="mo_gen_cert">',
    );


    $form['markup_1'] = array(
        '#markup' => '<h3>ADD CUSTOM CERTIFICATE </h3><hr><br/>',
    );
   
    if (variable_get('miniorange_saml_license_key', NULL) == NULL &&
        variable_get('miniorange_saml_customer_admin_email', NULL) != NULL) {
        return $form;
    }

    $form['miniorange_saml_private_certificate'] = array(
        '#type' => 'textarea',
        '#title' => t('X.509 Private Certificate'),
        '#cols' => 5,
        '#rows' => 5,
        '#default_value' => variable_get('miniorange_saml_private_certificate', ''),
        '#attributes' => array('style' => 'width:77%', 'placeholder' => "Copy and Paste the content from the downloaded certificate or copy the content enclosed in X509Certificate tag (has parent tag KeyDescriptor use=signing) in IdP-Metadata XML file."),
        '#resizable' => False,
        '#description' => '<strong>NOTE :</strong> Format of the certificate:<br /><strong>-----BEGIN PRIVATE KEY-----<br />'
            . 'XXXXXXXXXXXXXXXXXXXXXXXXXXX<br />-----END PRIVATE KEY-----</strong><br /><br /><br />',
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_publ_certificate'] = array(
        '#type' => 'textarea',
        '#title' => t('X.509 Public Certificate '),
        '#cols' => 5,
        '#rows' => 5,
        '#default_value' => variable_get('miniorange_saml_publ_certificate', ''),
        '#attributes' => array('style' => 'width:77%', 'placeholder' => "Copy and Paste the content from the downloaded certificate or copy the content enclosed in X509Certificate tag (has parent tag KeyDescriptor use=signing) in IdP-Metadata XML file."),
        '#resizable' => False,
        '#description' => '<strong>NOTE :</strong> Format of the certificate:<br /><strong>-----BEGIN PRIVATE KEY-----<br />'
            . 'XXXXXXXXXXXXXXXXXXXXXXXXXXX<br />-----END PRIVATE KEY-----</strong><br /><br /><br />',
        '#disabled' => $disabled,
    );

    $form['save_config_elements'] = array(
        '#type' => 'submit',
        '#name' => 'submit',
        '#value' => t('Upload'),
        '#prefix' => '<td>',
        '#suffix' => '</td>',
        '#submit' => array('miniorange_saml_upload_custom_certificate'),
        '#disabled' => $disabled,
       
    );

    $form['save_config_elements1'] = array(
        '#type' => 'submit',
        '#value' => t('Reset'),
        '#prefix' => '<td>',
        '#suffix' => '</td>',
        '#submit' => array('miniorange_saml_reset_custom_certificate'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_generate_metadata_button'] = array(
        '#markup' => '<a class="mo_saml_btn mo_saml_btn-success mo_saml_btn-large" id="mosaml_upload" style="padding:3px 7px;" onclick="show_gen_cert_form()">'
            . 'Generate</a><br><br></div></div>',
    );

    Utilities::AddsupportTab($form, $form_state);

    return $form;
}

function miniorange_saml_upload_custom_certificate($form, &$form_state)
{
    $public_cert = $form['miniorange_saml_publ_certificate']['#value'];
    if ( !empty( $public_cert ) ) {
        $public_cert = Utilities::sanitize_certificate($form['miniorange_saml_publ_certificate']['#value']);
    }

    $private_cert = $form['miniorange_saml_private_certificate']['#value'];
    if ( !empty($private_cert ) ) {
        $private_cert = Utilities::sanitize_private_key($form['miniorange_saml_private_certificate']['#value']);
    }

    if ( empty( $public_cert ) || empty( $private_cert ) ) {
        drupal_set_message(t('The <b><u>X.509 Private Certificate</u></b> and <b><u>X.509 Public Certificate</u></b> fields are mandatory.'), 'error');
        return;
    }

    variable_set('miniorange_saml_publ_certificate', $public_cert);
    variable_set('miniorange_saml_private_certificate', $private_cert);

    //write certificate data in Custom_Public_Certificate.crt file.
    $pblc_filename = drupal_get_path('module', 'miniorange_saml') . '/resources/Custom_Public_Certificate.crt';
    file_put_contents($pblc_filename, $public_cert);

    //write certificate data in Custom_Private_Certificate.key file.
    $prvt_filename = drupal_get_path('module', 'miniorange_saml') . '/resources/Custom_Private_Certificate.key';
    file_put_contents($prvt_filename, $private_cert);

    drupal_set_message(t('Custom Certificate updated successfully.'));
}

function miniorange_saml_reset_custom_certificate($form, &$form_state)
{
    variable_del('miniorange_saml_publ_certificate');
    variable_del('miniorange_saml_private_certificate');

    variable_set('mo_saml_country_code_text', '');
    variable_set('mo_saml_certificate_state_name', '');
    variable_set('mo_saml_certificate_company_name', '');
    variable_set('miniorange_saml_unit_name', '');
    variable_set('mo_saml_certificate_common_name', '');
    variable_set('mo_saml_select_digest_algo', '');
    variable_set('mo_saml_select_private_key_bit', '');
    variable_set('mo_saml_select_valid_days', '');
    drupal_set_message(t('Reset Certificate successfully.'));
}

function miniorange_saml_generate_custom_certificate($form, &$form_state)
{
    $country_code = $form['mo_saml_country_code_text']['#value'];
    $state_name = $form['mo_saml_certificate_state_name']['#value'];
    $company_name = $form['mo_saml_certificate_company_name']['#value'];
    $unit_name = $form['miniorange_saml_unit_name']['#value'];
    $common_name = $form['mo_saml_certificate_common_name']['#value'];
    $digest_algo = $form['mo_saml_select_digest_algo']['#value'];
    $private_key_bits = $form['mo_saml_select_private_key_bit']['#value'];
    $valid_days = $form['mo_saml_select_valid_days']['#value'];

    if (empty($country_code) || empty($state_name) || empty($company_name) || empty($unit_name) || empty($common_name)) {
        drupal_set_message(t('The <b><u>Country code </u></b>, <b><u>State name</u></b> , <u><b>Company name</b></u> , <u><b> Unit name</b></u> and <u><b>Common name</b></u> fields are mandatory.'), 'error');
        return;
    }

    variable_set('mo_saml_country_code_text', $country_code);
    variable_set('mo_saml_certificate_state_name', $state_name);
    variable_set('mo_saml_certificate_company_name', $company_name);
    variable_set('miniorange_saml_unit_name', $unit_name);
    variable_set('mo_saml_certificate_common_name', $common_name);
    variable_set('mo_saml_select_digest_algo', $digest_algo);
    variable_set('mo_saml_select_private_key_bit', $private_key_bits);
    variable_set('mo_saml_select_valid_days', $valid_days);

    $Registered_email = variable_get('miniorange_saml_customer_admin_email', '');
    $RegisteredEmail = isset($Registered_email) ? $Registered_email : '';

    $dn = array(
        "countryName" => $country_code,
        "stateOrProvinceName" => $state_name,
        "organizationName" => $company_name,
        "organizationalUnitName" => $unit_name,
        "commonName" => $common_name,
        "emailAddress" => $RegisteredEmail,
    );

    if(Utilities::generateCertificate($dn, $digest_algo, $private_key_bits, $valid_days))
    {
        drupal_set_message(t('Successfully genertated new certificates. Please update your service provider configuration with new metadata file.'));
    }
    
}

