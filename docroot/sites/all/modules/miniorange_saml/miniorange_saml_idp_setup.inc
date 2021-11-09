<?php
/**
 * @file
 * Contains Service Provider information for miniOrange SAML Login Module.
 */

/**
 * Showing IdP Setup form info.
 */
function miniorange_saml_idp_setup($form, &$form_state) {
    global $base_url;
    $mo_admin_email = variable_get('miniorange_saml_customer_admin_email',NULL);
    $sml_lk = variable_get('miniorange_saml_license_key', NULL);

    drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    $disabled = Utilities::isCustomerRegistered($form, $form_state);

    //Delete SP Configuration Flow
    if(isset($_GET['delete']) && ($_GET['delete'] != ""))
	      $delete_idpid = $_GET['delete'];

    if(isset($delete_idpid) && $delete_idpid != ""){
	      Utilities::delete_sp_parameters($delete_idpid);
	      drupal_set_message(t('IDP Configuration Successfully Deleted.'));
	      drupal_goto($base_url . '/?q=admin/config/people/miniorange_saml/sp_setup/');
	  }

    //Show SP Configuration Flow
    if(isset($_GET['id']) && ($_GET['id'] != ""))
	      $idpid = $_GET['id'];

    if(isset($idpid) && $idpid != ""){
	      Utilities::set_idp_parameters($idpid);
	      ?>
	      <script>
	        window.onload = function() {
		          show_idp_config_form();
	        };
	      </script>
        <?php
    }

    $result = db_select('miniorange_saml_idp_list','id')->fields('id')->execute();
    $idpcount = $result->rowCount();
    $customer = new MiniorangeSAMLCustomer(NULL, NULL, NULL, NULL);
    $content = json_decode($customer->ccl(), true);
    $noOfSP= (isset($content['noOfSP']) && $content['noOfSP'] != '0')? $content['noOfSP'] : 1;
    $remaining_idps = $noOfSP - $idpcount;

   
    if($idpcount != '0'){
        if($noOfSP != $idpcount){
            $form['miniorange_saml_sp_config_tab'] = array(
                '#markup' => '<div id="idpconfigdata"><h5> LIST OF IDENTITY PROVIDERS<a class="btn btn-primary btn-sm" style="padding:6px 12px; float:right" href="'.$base_url.'/admin/config/people/miniorange_saml/sp_setup?id=new">' . 'Add New</a></h5><br>
                                <hr><br><div>Number of IDPs remaining: '.$remaining_idps.'</div><br>',
            );
	      }
	      else{
	          $form['markup_note'] = array(
		            '#markup' =>  '<div class="mo_saml_table_layout_1">
	                              <div class="mo_saml_table_layout mo_saml_container_center"><div class=""><table class="mo_saml_local_pricing_table">
	                              <h5> LIST OF IDENTITY PROVIDERS</h5><hr>
                                <p>You have reached the limit of <b>'  .$idpcount. '  Identity Providers(IDPs)</b>. Contact us at info@xecurify.com if you want to increase the limit.</p>',
	          );
	      }

	      $header = array(
          'idpname' => array('data' => t('IDP Name')),
          'issuer' => array('data' => t('IDP Entity-ID/Issuer')),
	        'action' => array('data' => t('Actions')),
        );

        $options = array();
	      $sql = db_query("SELECT * FROM {miniorange_saml_idp_list}");
	      $data = $sql->fetchAll();
	      foreach($data as $idp){
			      $options[$idp->id] = array(
			          'idpname' => $idp->mo_idp_name,
			          'issuer' => $idp->mo_idp_issuer,
			          'action' => '<a style="padding:6px 12px;" href="'.$base_url.'/?q=testConfig&testid='.$idp->id.'" target="_blank">'.'Test</a>'.' | '.'<a href="'.$base_url.'/admin/config/people/miniorange_saml/sp_setup?id='.$idp->id.'" style="padding:6px 12px;">' . 'Edit</a>'.' | '.'<a href="'.$base_url.'/admin/config/people/miniorange_saml/sp_setup?delete='.$idp->id.'" style="padding:6px 12px;">' . 'Delete</a>',
			      );

			      $form['fieldset']['customerinfo'] = array(
			          '#theme' => 'table',
			          '#header' => $header,
			          '#rows' => $options,
			      );
	      }

	      $form['markup_idpdisplay'] = array(
            '#markup' => '</div></div></div></div><div id="idpdisplay" style="display:none;">');
        }

        $form['header_top_style_1'] = array(
            '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_saml_container">',
        );

        $form['markup_sp_header'] = array(
            '#markup' => '<h3>CONFIGURE SERVICE PROVIDER</h3><hr>');

        $form['miniorange_saml_IDP_tab'] = array(
            '#markup' => '<div id="tabhead"><h5> Enter the information gathered from your Identity Provider &nbsp; OR &nbsp;<a class="btn btn-primary btn-large" style="padding:4px 8px;" onclick="show_metadata_form()">'
            . 'Upload IDP Metadata </a><br><br> </h5></div>',
        );

        $form['metadata_1'] = array(
            '#markup' =>'<div border="1" id="upload_metadata_form" style="background-color:#FFFFFF; border:2px solid #CCCCCC; padding:1px 1px 1px 10px; display:none;" >'
            . '		<table style="width:100%;">'
            .'		<tr> <td colspan="3">'
            .'				<h3>UPLOAD IDP METADATA'
            .'					<span style="float:right;margin-right:25px;">'
            .'						<input type="button" class="btn btn-sm btn-danger" value="Cancel" onclick = "hide_metadata_form()"/></a><br>'
            .'					</span>',
        );

        $form['metadata_idp_name'] = array(
            '#markup' =>'</td></td>'
            .'	</tr>'
            .'				<tr><td colspan="3" ></td></tr>'
            .'		    <tr>'
            .'			<td width="20%"><h4>Identity Provider name:</h4></td><td width="10%">',
        );

        $form['miniorange_saml_idp_name_3'] = array(
            '#type' => 'textfield',
            '#attributes' => array('placeholder' => 'Enter Identity Provider name.'),
        );

        $form['metadata_2'] = array(
            '#markup' => '</span>'
            .'					<br><br>'
            .'				</h1>'
            .'			</td>'
            .'		</tr>'
            .'				<tr><td><h4>Upload Metadata  :</h4>'
            .'				<td colspan="1">',
        );

        $form['metadata_file'] = array(
            '#type' => 'file',
        );

        $form['metadata_upload'] = array(
            '#type' => 'submit',
            '#value' => t('Upload'),
            '#submit' => array('miniorange_saml_upload_file'),
            '#disabled' => $disabled,
            '#attributes' => array('style' => 'border-radius:4px;background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;'),
        );

        $form['metadata_3'] = array(
            '#markup' =>'</td></td>' .'</tr> '.' <tr><td colspan="3" ><p style="font-size:13pt;text-align:center;"><b>OR<hr><hr></b></p></td> </tr>'
            .'<tr>  '.'	<td width="20%"><h4>Enter metadata URL:</h4></td><td width="10%">',
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
            '#attributes' => array('style' => 'border-radius:4px;background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;'),
        );

        $form['metadata_4'] = array(
            '#markup' =>'</td></tr><tr><td></td><td>',
        );

        //$var = variable_get('miniorange_saml_fetch_metadata_time_intervals', FALSE);
        //print_r($var);exit;

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
              .'	</table>'
              .'</div>'
              .'<div id="idpdata">',
        );

        $form['miniorange_saml_identity_provider_guide'] = array(
            '#type' => 'select',
            '#title' => t('Select your Identity Provider for guideline :'),
            '#options' => array(
                'select-idp'=>t('Select your Identity Provider'),
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
            '#default_value' => variable_get('miniorange_nameid_format'),
            '#attributes' => array('style' => 'width:82%','onchange'=>'idp_guide(value);'),
            '#description' => t('<b>Note : </b>Select your Identity Provider from the list above, and you can find the link to the guide for setting up SAML.<br> Please contact us if you don\'t find your IDP in the list.'),
        );
        ?>
        <script>
            function idp_guide(value) {
            if(value!="other" && value!="select-idp") {
                window.open("https://plugins.miniorange.com/drupal-single-sign-sso-using-" + value + "-idp/", '_blank');
            }
        }
        </script>
        <?php

        $form['miniorange_saml_idp_name'] = array(
          '#type' => 'textfield',
          '#maxlength' => 255,
          '#title' => t('Identity Provider Name'),
          '#default_value' => variable_get('miniorange_saml_idp_name', ''),
          '#attributes' => array('style' => 'width:82%','placeholder' => 'Identity Provider Name'),
          '#disabled' => $disabled,
        );

        $form['miniorange_saml_idp_issuer'] = array(
          '#type' => 'textfield',
          '#maxlength' => 255,
          '#title' => t('IdP Entity ID or Issuer'),
          '#description' => t('<b>Note :</b> You can find the EntityID in Your IdP-Metadata XML file enclosed in <code>EntityDescriptor</code> tag having attribute as <code>entityID</code>'),
          '#default_value' => variable_get('miniorange_saml_idp_issuer', ''),
          '#attributes' => array('style' => 'width:82%','placeholder' => 'IdP Entity ID or Issuer'),
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
          '#attributes' => array('style' => 'width:82%'),
          '#disabled' => $disabled,
        );

        $form['miniorange_saml_idp_binding'] = array(
          '#type' => 'radios',
          '#title' => t('HTTP Binding for SSO'),
          '#default_value' => (variable_get('miniorange_saml_http_binding')== 'HTTP-POST')? 1 : 0,
          '#options' => array(
            t('HTTP-Redirect'),
            t('HTTP-POST')),
          '#disabled' => $disabled,
        );

        $form['miniorange_saml_idp_login_url'] = array(
          '#type' => 'textfield',
          '#title' => t('SAML Login URL'),
          '#maxlength' => 255,
          '#description' => t('<b>Note :</b> You can find the SAML Login URL in Your IdP-Metadata XML file enclosed in <code>SingleSignOnService</code> tag'),
          '#default_value' => variable_get('miniorange_saml_idp_login_url', ''),
          '#attributes' => array('style' => 'width:82%','placeholder' => 'SAML Login URL'),
          '#disabled' => $disabled,
        );

        $form['miniorange_saml_idp_binding_slo'] = array(
          '#type' => 'radios',
          '#title' => t('HTTP Binding for SLO'),
          '#default_value' => (variable_get('miniorange_saml_http_binding_slo')== 'HTTP-POST')? 1 : 0,
          '#options' => array(
            t('HTTP-Redirect'),
            t('HTTP-POST')),
          '#disabled' => $disabled,
        );

        $form['miniorange_saml_idp_logout_url'] = array(
          '#type' => 'textfield',
          '#maxlength' => 255,
          '#title' => t('SAML Logout URL'),
          '#description' => t('<b>Note :</b> You can find the SAML Login URL in Your IdP-Metadata XML file enclosed in <code>SingleLogoutService</code> tag'),
          '#default_value' => variable_get('miniorange_saml_idp_logout_url', ''),
          '#attributes' => array('style' => 'width:82%','placeholder' => 'SAML Logout URL'),
          '#disabled' => $disabled,
        );

        $certificate = variable_get('miniorange_saml_idp_x509_certificate', '');
        $size = 1;
        if(is_array($certificate)) {
            $size = sizeof($certificate);
        }
        if(empty($certificate)) {
            $certificate = array();
        		$certificate[0] = '';
        }

        if($size == '' || $size == NULL) {
            $size = 1;
        }

        $ceti = array("miniorange_saml_idp_x509_certificate_1", "miniorange_saml_idp_x509_certificate_2", "miniorange_saml_idp_x509_certificate_3", "miniorange_saml_idp_x509_certificate_4");

        for($i = 0; $i < $size; $i++) {
            $form[$ceti[$i]] = array(
                '#type' => 'textarea',
                '#title' => t('x.509 Certificate Value'),
                '#rows' => 5,
                '#default_value' => $certificate,
                '#attributes' => array(
                  'style' => 'width:82%', 'placeholder' => 'Enter x509 Certificate Value'
                ),
                '#resizable' => False,
                '#disabled' => $disabled,
            );
            if($i == 0) {
                $form['markup_1'] = array(
                    '#markup' => '<b>NOTE:</b> Format of the certificate:<br><b>-----BEGIN CERTIFICATE-----<br>'
                      . 'XXXXXXXXXXXXXXXXXXXXXXXXXXX<br>-----END CERTIFICATE-----</b><br><br>'
                );
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
          '#description' => t('Algorithm used in the signing process.'),
          '#default_valu
          e' => variable_get('security_signature_algorithm'),
          '#attributes' => array('style' => 'width:44%'),
        );

        $form['miniorange_saml_sign_request'] = array(
          '#type' => 'checkbox',
          '#title' => t('Check this option to send Signed SSO and SLO requests.'),
          '#default_value' => variable_get('miniorange_saml_request_signed', FALSE),
          '#disabled' => $disabled,
        );

        $disable_true="";
        if($disabled == TRUE){
            $disable_true = 'disabled="True"';
        }

        $form['miniorange_saml_enable_login'] = array(
          '#type' => 'checkbox',
          '#title' => t('Enable login with SAML'),
          '#default_value' => variable_get('miniorange_saml_enable_login', FALSE),
          '#disabled' => $disabled,
        );

        $form['miniorange_saml_new_line'] = array('#markup'=>'<br/><br/>');

        $form['miniorange_saml_idp_config_submit'] = array(
          '#type' => 'submit',
          '#value' => t('Save Configuration'),
          '#submit' => array('miniorange_saml_save_idp_config'),
          '#disabled' => $disabled,
          '#attributes' => array('style' => 'padding:6px 12px; border-radius:4px;background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;'),
        );

	      $idpid = variable_get('miniorange_saml_idp_id');

        $form['miniorange_saml_test_config_button'] = array(
          '#markup' => '<a '.$disable_true.' class="btn btn-primary btn-large" style="padding:6px 12px;" 
                    onclick="testConfig(\'' . getTestUrl($idpid) . '\');">' . 'Test Configuration</a><br><br></div></div>'
        );

	      Utilities::AddsupportTab( $form, $form_state);
        Utilities::faq($form, $form_state);

	      $form['metadata_12'] = array(
          '#markup' => '	</div>',
        );

        return $form;
}

function getTestUrl($idpid) {
    $base_site_url = Utilities::miniorange_get_baseURL();
    $testUrl = $base_site_url . '/?q=testConfig&testid=' . $idpid;
    return $testUrl;
}

function getSAMLrequest() {
    global $base_url;
    $SAMLrequestUrl = $base_url . '/?q=showSAMLrequest';
    return $SAMLrequestUrl;
}

function getSAMLresponse() {
    global $base_url;
    $SAMLresponseUrl = $base_url . '/?q=showSAMLresponse';
    return $SAMLresponseUrl;
}

/**
 * Configure IdP.
 */
function miniorange_saml_save_idp_config($form, &$form_state) {

    global $base_url;
    $enable_login = $form['miniorange_saml_enable_login']['#value'];
    $issuer = $form['miniorange_saml_idp_issuer']['#value'];
    $idp_name = $form['miniorange_saml_idp_name']['#value'];
    $request_signed_value = $form['miniorange_saml_sign_request']['#value'];
    $http_binding_value = $form['miniorange_saml_idp_binding']['#value'];
    $login_url = $form['miniorange_saml_idp_login_url']['#value'];
    $logout_url = $form['miniorange_saml_idp_logout_url']['#value'];
    $sign_algo = $form['security_signature_algorithm']['#value'];

    if(empty($issuer) || empty($login_url) || empty($idp_name)){
        drupal_set_message(t('The <b><u>Identity Provider Name, </u><u>IdP Entity ID or Issuer</u></b> and <b><u>SAML Login URL</u></b> fields are mandatory.'), 'error');
        return;
    }

    $cert_value_1 = isset($form['miniorange_saml_idp_x509_certificate_1']['#value'])? $form['miniorange_saml_idp_x509_certificate_1']['#value'] : '';
    $cert_value_2 = isset($form['miniorange_saml_idp_x509_certificate_2']['#value'])? $form['miniorange_saml_idp_x509_certificate_2']['#value'] : '';
    $cert_value_3 = isset($form['miniorange_saml_idp_x509_certificate_3']['#value'])? $form['miniorange_saml_idp_x509_certificate_3']['#value'] : '';
    $cert_value_4 = isset($form['miniorange_saml_idp_x509_certificate_4']['#value'])? $form['miniorange_saml_idp_x509_certificate_4']['#value'] : '';

    $x509_cert_value_array = [$cert_value_1, $cert_value_2, $cert_value_3, $cert_value_4];
    $x509_cert_value_withoutEmptyValue = array_filter($x509_cert_value_array);
    $x509_cert_value = array_values($x509_cert_value_withoutEmptyValue);
    foreach ($x509_cert_value as $key => $value) {
        $x509_cert_value[$key] = Utilities::sanitize_certificate($value);
    }

    if(empty($x509_cert_value) || is_null($x509_cert_value)){
      $x509_cert_value = NULL;
    }

    $http_binding_value_slo = $form['miniorange_saml_idp_binding_slo']['#value'];
    $nameid_format = $form['miniorange_nameid_format']['#value'];

    if($http_binding_value == 1) {
        $http_binding = 'HTTP-POST';
    }else {
        $http_binding = 'HTTP-Redirect';
    }

    if($http_binding_value_slo == 1) {
        $http_binding_slo = 'HTTP-POST';
    }else {
        $http_binding_slo = 'HTTP-Redirect';
    }

    if ($request_signed_value == 1) {
        $request_signed = TRUE;
    }else {
        $request_signed = FALSE;
    }

    if ($enable_login == 1) {
        $enable_login = TRUE;
    }else {
        $enable_login = FALSE;
    }

    variable_set('miniorange_saml_enable_login', $enable_login);

    $sp_issuer = $base_url . '/?q=samlassertion';
    variable_set('miniorange_saml_sp_issuer', $sp_issuer);

    $sql = db_query("SELECT * FROM {miniorange_saml_idp_list}");
    $data = $sql->fetchAll();
    $idpid = -1;
    $MetaDataAfterSpecificTime = '';
    $url = '';
    foreach($data as $idpdata)
    {   
        if(($idpdata->mo_idp_issuer == $issuer) || ($idpdata->mo_idp_sso_url == $login_url)){
            $idpid = $idpdata->id;
            $MetaDataAfterSpecificTime = $idpdata->miniorange_saml_fetch_metadata_time_intervals;
            $url = $idpdata->miniorange_saml_meta_data_url;
        }
    }

    if($idpid == -1)
    {
        Utilities::Database_insert($idp_name, $issuer, $login_url, $x509_cert_value, $nameid_format, $request_signed, $http_binding,
        $http_binding_slo, $logout_url, $MetaDataAfterSpecificTime, $url, $sign_algo);
    }
    else {
        Utilities::Database_update($idp_name, $issuer, $login_url, $x509_cert_value, $nameid_format, $request_signed, $http_binding,
        $http_binding_slo, $logout_url, $MetaDataAfterSpecificTime, $url, $idpid, $sign_algo);
    }

    drupal_set_message(t('Identity Provider Configuration successfully saved'));
    header('Location:' . $base_url .'/admin/config/people/miniorange_saml/sp_setup');
    exit;
}

function miniorange_saml_upload_file($form, &$form_state) {
    global $base_url;
    $idp_name = $form['miniorange_saml_idp_name_3']['#value'];
    if(empty($idp_name))
    {
        drupal_set_message(t('The <b>Identity Provider Name</b> field is required.'), 'error');
        return;
    }
    $file_name = $_FILES['files']['tmp_name']['metadata_file'];
    if (empty($file_name)) {
        drupal_set_message(t('The <b>Metadata file</b> field is required.'), 'error');
        return;
    }else{
      $file = file_get_contents($file_name);
      $idpid = -1;
      Utilities::upload_metadata($file, true, $idp_name, false, false, $idpid);
    }
    header('Location:' . $base_url .'/admin/config/people/miniorange_saml/sp_setup');
    exit();
}

function miniorange_saml_fetch_metadata($form, &$form_state) {
    global $base_url;
    $idp_name = $form['miniorange_saml_idp_name_3']['#value'];
    if(empty($idp_name))
    {
        drupal_set_message(t('The <b>Identity Provider Name</b> field is required.'), 'error');
        return;
    }
    $MetaDataAfterSpecificTime= $form['miniorange_saml_fetch_metadata_after_specific_time']['#value'];
    //variable_set('miniorange_saml_fetch_metadata_time_intervals', $MetaDataAfterSpecificTime);

    $url=filter_var($form['metadata_URL']['#value'],FILTER_SANITIZE_URL);
    /*if($MetaDataAfterSpecificTime == 1) {
        variable_set('miniorange_saml_meta_data_url', $url);
    }else {
        variable_del('miniorange_saml_meta_data_url');
    }*/
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $idpid = -1;
    if(empty($url)){
      drupal_set_message(t('The <b>Metadata URL</b> field is required.'), 'error');
      return;
    }
    else{
      $file = file_get_contents($url, false, stream_context_create($arrContextOptions));
      Utilities::upload_metadata($file, true,$idp_name, $MetaDataAfterSpecificTime, $url, $idpid);
    }
    header('Location:' . $base_url .'/admin/config/people/miniorange_saml/sp_setup');
    exit();
}

/**
 * Send support query.
 */
function miniorange_saml_idp_send_query(&$form, $form_state)
{
    $email = $form['miniorange_saml_email_address']['#value'];
    $phone = $form['miniorange_saml_phone_number']['#value'];
    $query = $form['miniorange_saml_support_query']['#value'];
    Utilities::send_query($email, $phone, $query);
}
echo '
        <script>
              function redirect_to_attribute_mapping(){
                  var baseurl = window.location.href.replace("sp_setup","mapping_config");
                  window.location.href= baseurl;
              }
        </script>';
