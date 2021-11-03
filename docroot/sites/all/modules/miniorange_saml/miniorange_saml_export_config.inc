
<?php
/**
 * @file
 * Contains support form for miniOrange SAML Login Module.
 */
include "includes\miniorange_saml_enum.php";
define( "Tab_Class_Names", serialize( array(
   // "Identity_Provider" => 'mo_options_enum_identity_provider',
    "Service_Providers"  => 'mo_options_enum_service_provider',
    "Mapping" => 'mo_options_enum_mapping',
    "Sign_In_Settings" => 'mo_options_enum_sign_in_settings',
    "Custom_Certificate" => 'mo_options_enum_custom_certificate',
    //"Proxy_Setup"       => 'mo_options_enum_proxy_setup'
) ) );

/**
 * Showing Support form info.
 */
function miniorange_saml_export_config($form, &$form_state)
{
    global $base_url;
    drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    $disabled = Utilities::isCustomerRegistered($form, $form_state);

    $form['header_top_style_2'] = array(
	     '#markup' => '<div class="mo_saml_table_layout_1">
	                   <div class="mo_saml_table_layout mo_saml_container">'
	);


    $form['markup_top'] = array(
        '#markup' => '<h3>Export Configuration</h3>' .'<hr/>',
    );

    
    // if(variable_get('miniorange_saml_license_key', NULL) == NULL &&
    //     variable_get('miniorange_saml_customer_admin_email', NULL) != NULL)
    // {
    //     return $form;
    // }

    $form['markup_top_head'] = array(
        '#markup' => '<p>This tab will help you to transfer your module configurations when you change your Drupal instance.</p>'
            . '<p>Download module configuration file by clicking on the button given below and send us this file along with your support query. </p>'
    );

    $b_url = Utilities::miniorange_get_baseURL();

    if(Utilities::show_idp_list()) {
        $form['miniorange_saml_idp_export'] = array(
            '#type' => 'submit',
            '#value' => t('Download Configuration'),
            '#prefix' => '<td>',
            '#suffix' => '</td>',
            '#submit' => array('miniorange_export'),
            '#attributes' => array('style' => 'background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;'),
        );
    }
    else{
        $form['miniorange_saml_idp_export'] = array(
            '#markup' => '<div style="display:block; margin-top:10px; color:red; background-color:rgba(251, 232, 0, 0.15); font-size: medium;padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
	                            Please <a href="' . $b_url . '/admin/config/people/miniorange_saml/sp_setup">configure the module</a> first to export the configurations.
                          </div>',
        );
	}

    $form['markup_import'] = array(
        '#markup' => '<br/><br/>'.'<h3>Import Configuration</h3>' .'<hr/>'
            . '<p>This tab will help you to<span style="font-weight: bold"> Import your module configurations</span> when you change your Drupal instance.</p>'
            . '<p>choose <b>"json"</b> Extened module configuration file and upload by clicking on the button given below. </p>'
    );

    $form['import_Config_file'] = array(
        '#type' => 'file',
    );

    $form['miniorange_saml_idp_import'] = array(
        '#type' => 'submit',
        '#value' => t('Upload'),
        '#submit' => array('miniorange_import_Config'),
        '#disabled' => $disabled,
        '#attributes' => array('style' => 'background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;'),
    );

    $form['miniorange_saml_support_div_end'] = array(
        '#markup' => '</div>',
    );

    Utilities::AddsupportTab( $form, $form_state);

    return $form;
}

function miniorange_export() {

    $tab_class_name      = unserialize( Tab_Class_Names );
    $configuration_array = array();
    /*foreach ( $tab_class_name as $key => $value ) {
        $configuration_array[ $key ] = mo_get_configuration_array( $value );
    }*/
    $configuration_array["Version_dependencies"]=mo_get_version_informations();
    $configuration_array["Service_Providers"] = getSPList();
    $configuration_array[ "Mapping" ] = mo_get_configuration_array( "mo_options_enum_mapping" );
    $configuration_array[ "Sign_In_Settings" ] = mo_get_configuration_array( "mo_options_enum_sign_in_settings" );
    $configuration_array[ "Custom_Certificate" ] = mo_get_configuration_array( "mo_options_enum_custom_certificate" );
    header( "Content-Disposition: attachment; filename=miniorange-saml-config.json" );
    echo( json_encode( $configuration_array, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) );
    exit;
}

function getSPList(){
  $sql = db_query("SELECT * FROM {miniorange_saml_idp_list}");
  $data = $sql->fetchAll();
  return $data;
}

function mo_get_configuration_array( $class_name ) {
    $mo_array = array();
    if ($class_name == "mo_options_enum_mapping") {
        $my_array = mo_get_role_mapping();
        foreach ($my_array as $key => $value) {
            if (!empty(variable_get($value,NULL))) 
                $mo_array[ $key ] = variable_get($value,NULL);            
        }
    }else{
        $class_object = call_user_func( $class_name . '::getConstants' );
        foreach ( $class_object as $key => $value ) {
            $mo_option_exists=variable_get($value);
            if($mo_option_exists){
                if(@unserialize($mo_option_exists)!==false){
                    $mo_option_exists = unserialize($mo_option_exists);
                }
                $mo_array[ $key ] = $mo_option_exists;
            }
        }
    }
    return $mo_array;
}

function miniorange_import_Config() {
    if(! empty( $_FILES['files']['tmp_name']['import_Config_file'] )) {
        $file = $_FILES['files']['name']['import_Config_file'];
        list($name_without_extention, $extention) = explode('.', $file);
        if($extention == 'json') {
            $file = @file_get_contents($_FILES['files']['tmp_name']['import_Config_file']);  //Array -> Sub-Array -> Field
            $configuration_array = json_decode($file, true);
            mo_update_configuration_array($configuration_array);
        }
        else{
            drupal_set_message(t('<b style="color: red">File type is not compatible</b> <br> Please Select <b style="color: red">".json"</b> extended file to upload Configuration!'),'error');
        }
    }
    else{
        drupal_set_message(t('<b style="color: red">Please select file first to upload Configuration!</b>'),'error');
    }
}


function mo_update_configuration_array( $configuration_array ) {
    $tab_class_name = unserialize( Tab_Class_Names );
    foreach ( $tab_class_name as $tab_name => $class_name ) {
        if ($tab_name == "Service_Providers") {
            $idp_count = count($configuration_array[ $tab_name ]);//print_r($count);exit();
            $customer = new MiniorangeSAMLCustomer(NULL, NULL, NULL, NULL);
            $content = json_decode($customer->ccl(), true);
            $noOfSP = (isset($content['noOfSP']) && $content['noOfSP'] != '0')? $content['noOfSP'] : 1;
            $idp_count = ( $noOfSP < $idp_count ) ? $noOfSP : $idp_count;
            for ($idp_no=0; $idp_no < $idp_count; $idp_no++) { 

                $Identity_name = '';
                $Issuer = '';
                $Enable_Signed_SSO_and_SLO = '';
                $Name_ID_format = '';
                $Binding_SSO = '';
                $Login_URL = '';
                $Binding_SLO = '';
                $Fetch_Metadata_Time_Intervals = '';
                $Logout_URL = '';
                $X509_certificate = '';
                $Fetch_Metadata_URL = '';
                $Secrity_Signature_Algo = '';

                foreach ($configuration_array[ $tab_name ][ $idp_no ] as $key => $value) {
                    if($key == "mo_idp_name")
                        $Identity_name = $value;
                    elseif ($key == "mo_idp_issuer") 
                        $Issuer = $value;
                    elseif ($key == "mo_idp_request_signed") 
                        $Enable_Signed_SSO_and_SLO = $value;
                    elseif ($key == "mo_idp_nameid_format") 
                        $Name_ID_format = $value;
                    elseif ($key == "mo_idp_http_binding_sso") 
                        $Binding_SSO = $value;
                    elseif ($key == "mo_idp_sso_url") 
                        $Login_URL = $value;
                    elseif ($key == "mo_idp_http_binding_slo") 
                        $Binding_SLO = $value;
                    elseif ($key == "miniorange_saml_fetch_metadata_time_intervals") 
                        $Fetch_Metadata_Time_Intervals = $value;
                    elseif ($key == "mo_idp_slo_url") 
                        $Logout_URL = $value;
                    elseif ($key == "mo_idp_cert") 
                        $X509_certificate = $value;
                    elseif ($key == "miniorange_saml_meta_data_url") 
                        $Fetch_Metadata_URL = $value;
                    elseif ($key = "security_signature_algorithm") 
                        $Secrity_Signature_Algo = $value;
                }

                $sql = db_query("SELECT * FROM {miniorange_saml_idp_list}");
                $data = $sql->fetchAll();
                $idpid = -1;

                foreach ($data as $idpdata) {
                  if (($idpdata->mo_idp_issuer == $Issuer) || ($idpdata->mo_idp_sso_url == $Login_URL))
                  $idpid = $idpdata->id;
                }

                if ($idpid == -1) {
                    Utilities::Database_insert($Identity_name, $Issuer, $Login_URL, $X509_certificate, $Name_ID_format, $Enable_Signed_SSO_and_SLO, $Binding_SSO,
                    $Binding_SLO, $Logout_URL, $Fetch_Metadata_Time_Intervals, $Fetch_Metadata_URL,$Secrity_Signature_Algo);
                }else{
                    Utilities::Database_update($Identity_name, $Issuer, $Login_URL, $X509_certificate, $Name_ID_format, $Enable_Signed_SSO_and_SLO, $Binding_SSO,
                    $Binding_SLO, $Logout_URL, $Fetch_Metadata_Time_Intervals, $Fetch_Metadata_URL, $idpid,  $Secrity_Signature_Algo);
                }
            }
        }
        elseif ($tab_name == "Mapping") {
            $my_array = mo_get_role_mapping();
            foreach ( $configuration_array[ $tab_name ] as $key => $value ){
                variable_set( $my_array[ $key ] , $value);
            }
        }
        else
            foreach ( $configuration_array[ $tab_name ] as $key => $value ) {
                $option_string = constant( "$class_name::$key" );
                if($option_string) {
                    variable_set( $option_string, $value );
                }
            }
        }
        $config_status = 'CONFIGURATION_SAVED';
        variable_set('miniorange_config_status', $config_status);
        $b_url = Utilities::miniorange_get_baseURL();
        drupal_goto($b_url . '/admin/config/people/miniorange_saml/sp_setup');
}

function mo_get_version_informations(){
    $array_version = array();
    $array_version["PHP_version"] = phpversion();
    $array_version["Drupal_version"] = VERSION;
    $array_version["OPEN_SSL"] = mo_saml_is_openssl_installed();
    $array_version["CURL"] = mo_saml_is_curl_installed();
    $array_version["ICONV"] = mo_saml_is_iconv_installed();
    $array_version["DOM"] = mo_saml_is_dom_installed();

    return $array_version;
}

function mo_get_role_mapping(){
    $mo_array = array();
    $mo_array["Login_by"] = 'miniorange_saml_login_by';
    $mo_array["Username_attr"] = 'miniorange_saml_username_attribute';
    $mo_array["Email_attr"] = 'miniorange_saml_email_attribute';
    $mo_array["Attribute_Name_1"] = 'miniorange_saml_attr5_name';
    $mo_array["Idp_Attribute_Name_1"] = 'miniorange_saml_idp_attr5_name';
    $mo_array["Attribute_Name_2"] = 'miniorange_saml_attr2_name';
    $mo_array["Idp_Attribute_Name_2"] = 'miniorange_saml_idp_attr2_name';
    $mo_array["Attribute_Name_3"] = 'miniorange_saml_attr3_name';
    $mo_array["Idp_Attribute_Name_3"] = 'miniorange_saml_idp_attr3_name';
    $mo_array["Attribute_Name_4"] = 'miniorange_saml_attr4_name';
    $mo_array["Idp_Attribute_Name_4"] = 'miniorange_saml_idp_attr4_name';
    $mo_array["Role"] = 'miniorange_saml_idp_attr1_name';
    $mo_array["Role_mapping"] = 'miniorange_saml_enable_rolemapping';
    $mo_array["Do_not_update_user_roles"] = 'miniorange_saml_disable_role_update';
    $mo_array["Disable_auto_create_user"] = 'miniorange_saml_disable_autocreate_users';
    $mo_array["Default_role"] = 'miniorange_saml_default_role';
    $mo_array["SP_Roles_For_Mapping"] = 'miniorange_saml_sp_role_names';
    $mo_array["Custom_Login_Logout_Roles"] = 'miniorange_saml_log_url_class';

    $mrole= user_roles($membersonly = TRUE);
    foreach($mrole as $roles) {
        $rolelabel = str_replace(' ','',$roles);
        $mo_array['Role_'.$rolelabel] = 'miniorange_saml_role_'.$rolelabel;
    }

    foreach($mrole as $drupalKey=>$drupalRoles) {
        $lbl = str_replace(' ','',$drupalRoles . '_sin');
        $l = str_replace(' ','',$drupalRoles . '_sout');
        $mo_array['Login_URL_'.$drupalRoles] = $lbl;
        $mo_array['Logout_URL_'.$drupalRoles] = $l;
    }

    return $mo_array;
}

function mo_saml_is_openssl_installed() {
    if ( in_array( 'openssl', get_loaded_extensions() ) ) {
        return 1;
    } else {
        return 0;
    }
}

function mo_saml_is_curl_installed() {
    if ( in_array( 'curl', get_loaded_extensions() ) ) {
        return 1;
    } else {
        return 0;
    }
}

function mo_saml_is_iconv_installed(){
    if ( in_array( 'iconv', get_loaded_extensions() ) ) {
        return 1;
    } else {
        return 0;
    }
}

function mo_saml_is_dom_installed(){
    if ( in_array( 'dom', get_loaded_extensions() ) ) {
        return 1;
    }
    else {
        return 0;
    }
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





