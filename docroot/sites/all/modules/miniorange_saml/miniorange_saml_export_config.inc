<?php
/**
 * @file
 * Contains support form for miniOrange SAML Login Module.
 */


/**
 * Showing Support form info.
 */
function miniorange_saml_export_config($form, &$form_state)
{
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/bootstrap.min.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/style_settings.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    $form['header_top_style_2'] = array(
        '#markup' => '<div class="mo_saml_table_layout_1">
	                   <div class="mo_saml_table_layout mo_saml_container">
	                   <h2>Export Configuration</h2><hr/>'
    );

    $disabled = Utilities::isCustomerRegistered($form, $form_state);

    $form['markup_top_head'] = array(
        '#markup' => '<p>This tab will help you to transfer your plugin configurations when you change your Drupal instance.</p>'
            . '<p>Download plugin configuration file by clicking on the button given below and send us this file along with your support query. </p>'
    );

    $b_url = Utilities::miniorange_get_baseURL();

    if (!miniorange_saml_is_sp_configured()) {
        $form['miniorange_saml_idp_msg_export'] = array(
            '#markup' => '<div class="mo_saml_register_message">
	                            Please <a href="' . $b_url . '/admin/config/people/miniorange_saml/sp_setup">configure the plugin</a> first to export the configurations.
                          </div><br>',
        );
    }

    $form['miniorange_saml_idp_export'] = array(
        '#type' => 'submit',
        '#value' => t('Download Plugin Configuration'),
        '#prefix' => '<td>',
        '#suffix' => '</td>',
        '#submit' => array('miniorange_export'),
        '#disabled' => $disabled || !miniorange_saml_is_sp_configured(),
    );

    $form['markup_import'] = array(
        '#markup' => '<br/><br/><h2>Import Configuration</h2><hr/>'
            . '<p>This tab will help you to<span style="font-weight: bold"> Import your plugin configurations</span> when you change your Drupal instance.</p>'
            . '<p>choose <b>"json"</b> Extened plugin configuration file and upload by clicking on the button given below. </p>'
    );

    $form['import_Config_file'] = array(
        '#type' => 'file',
    );

    $form['miniorange_saml_idp_import'] = array(
        '#type' => 'submit',
        '#value' => t('Upload'),
        '#submit' => array('miniorange_import_Config'),
        '#disabled' => $disabled,
        '#suffix' => '<br><br><br><br></div>',
    );

    Utilities::AddsupportTab($form, $form_state);

    return $form;
}

function miniorange_export()
{
    $tab_class_name = Utilities::getTabNames();
    $configuration_array = array();
    if (isset($tab_class_name) && !empty($tab_class_name)) {
        foreach ($tab_class_name as $key => $value) {
            $configuration_array[$key] = mo_get_configuration_array($value);
        }
    }
    $configuration_array["Version_dependencies"] = mo_get_version_informations();
    header("Content-Disposition: attachment; filename=miniorange-saml-config.json");
    echo(json_encode($configuration_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    exit;
}

function mo_get_configuration_array($class_name)
{
    $class_object = Utilities::getVariableNames($class_name);
    $mo_array = array();
    if (isset($class_object) && !empty($class_object)) {
        foreach ($class_object as $key => $value) {
            $mo_option_exists = variable_get($value);
            $mo_array[$key] = $mo_option_exists;
        }
    }
    return $mo_array;
}

function miniorange_import_Config()
{
    if (!empty($_FILES['files']['tmp_name']['import_Config_file'])) {
        $file = $_FILES['files']['name']['import_Config_file'];
        list($name_without_extention, $extention) = explode('.', $file);
        if ($extention == 'json') {
            $file = @file_get_contents($_FILES['files']['tmp_name']['import_Config_file']);  //Array -> Sub-Array -> Field
            $configuration_array = json_decode($file, true);
            if(is_null($configuration_array) || $configuration_array===TRUE || $configuration_array===FALSE ){
                drupal_set_message(t('<b style="color: red">Error while importing configuration</b> Please check if you are importing correct file.'), 'error');
                return;
            }
            mo_update_configuration_array($configuration_array);
        } else {
            drupal_set_message(t('<b style="color: red">File type is not compatible</b> <br> Please Select <b style="color: red">".json"</b> extended file to upload Configuration!'), 'error');
        }
    } else {
        drupal_set_message(t('<b style="color: red">Please select file first to upload Configuration!</b>'), 'error');
    }
}

function mo_update_configuration_array($configuration_array)
{
    $tab_class_name = Utilities::getTabNames();
    if (isset($tab_class_name) && !empty($tab_class_name)) {
        foreach ($tab_class_name as $tab_name => $class_name) {
            foreach ($configuration_array[$tab_name] as $key => $value) {
                $option_string = Utilities::getVariableNames($class_name);
                $option_string = $option_string[$key];
                if (!empty($option_string) && !empty($value)) {
                    variable_set($option_string, $value);
                }
            }
        }
    }
    $config_status = 'CONFIGURATION_SAVED';
    variable_set('miniorange_config_status', $config_status);
    $b_url = Utilities::miniorange_get_baseURL();
    drupal_goto($b_url . '/admin/config/people/miniorange_saml/sp_setup');
}

function miniorange_saml_is_sp_configured()
{
    $saml_login_url = variable_get('miniorange_saml_idp_login_url');
    $saml_idp_issuer = variable_get('miniorange_saml_idp_issuer');
    $saml_x509_certificate = variable_get('miniorange_saml_idp_x509_certificate');
    if (!empty($saml_login_url) && !empty($saml_x509_certificate) && !empty($saml_idp_issuer)) {
        return 1;
    } else {
        return 0;
    }
}

function mo_get_version_informations()
{
    $array_version = array();
    $array_version["PHP_version"] = phpversion();
    $array_version["Drupal_version"] = VERSION;
    $array_version["OPEN_SSL"] = mo_saml_is_openssl_installed();
    $array_version["CURL"] = mo_saml_is_curl_installed();
    $array_version["ICONV"] = mo_saml_is_iconv_installed();
    $array_version["DOM"] = mo_saml_is_dom_installed();

    return $array_version;
}

function mo_saml_is_openssl_installed()
{
    if (in_array('openssl', get_loaded_extensions())) {
        return 1;
    } else {
        return 0;
    }
}

function mo_saml_is_curl_installed()
{
    if (in_array('curl', get_loaded_extensions())) {
        return 1;
    } else {
        return 0;
    }
}

function mo_saml_is_iconv_installed()
{
    if (in_array('iconv', get_loaded_extensions())) {
        return 1;
    } else {
        return 0;
    }
}

function mo_saml_is_dom_installed()
{
    if (in_array('dom', get_loaded_extensions())) {
        return 1;
    } else {
        return 0;
    }
}






