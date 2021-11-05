<?php
/**
 * @file
 * Contains Login Settings for miniOrange SAML Login Module.
 */

/**
 * Showing Settings form.
 */
function miniorange_saml_login_options($form, &$form_state)
{
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/bootstrap.min.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/style_settings.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    $base_site_url = Utilities::miniorange_get_baseURL();

    $form['markup_1'] = array(
        '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_saml_container">
                <h2>Signin Settings</h2><hr><br>',
    );

    $disabled = Utilities::isCustomerRegistered($form, $form_state);
    $form['miniorange_saml_disable_autocreate_users'] = array(
        '#type' => 'checkbox',
        '#title' => t('Check this option if you want to disable <b>auto creation</b> of users if user does not exist.'),
        '#description' => t('<b>Note:</b> If you enable this feature new user wont be created, only existing users can login using SSO.'),
        '#default_value' => variable_get('miniorange_saml_disable_autocreate_users', ''),
        '#disabled' => $disabled,
    );
    $form['miniorange_saml_force_auth'] = array(
        '#type' => 'checkbox',
        '#title' => t('Protect website against anonymous access'),
        '#default_value' => variable_get('miniorange_saml_force_auth', ''),
        '#disabled' => $disabled,
        '#description' => t('<b>Note: </b>Users will be redirected to your IdP for login in case user is not logged in and tries to access website.<br><br>'),
    );

    $form['miniorange_saml_auto_redirect'] = array(
        '#type' => 'checkbox',
        '#title' => t('Check this option if you want to <b>auto redirect the user to IdP</b>'),
        '#default_value' => variable_get('miniorange_saml_auto_redirect_to_idp'),
        '#disabled' => $disabled,
        '#description' => t('<b>Note: </b>Users will be redirected to your IdP for login when the login page is accessed.<br><br>'),
    );

    
  $backdoor_query  = variable_get('miniorange_backdoor_query','false');
  $mo_backdoor_URL = $disabled == 1 || $disabled == TRUE ? '<span class="mo_color_red">Please login into module to see backdoor URL.</span>' : $base_site_url . '/user/login?saml_login='.$backdoor_query.'<a  id="mo_saml_edit_backdoor" class="mo_saml_btn mo_saml_btn-primary mo_saml_btn-sm">Edit</a>';

   $form['miniorange_saml_enable_backdoor'] = array(
     '#type' => 'checkbox',
     '#title' => t('Check this option if you want to enable <b>backdoor login</b>'),
     '#default_value' => variable_get('miniorange_saml_enable_backdoor', ''),
     '#disabled' => $disabled,
     '#description' => t('<b>Note: </b>Checking this option <b>creates a backdoor to login to your Website using Drupal credentials</b><br>'
         . ' incase you get locked out of your IdP.<br> Note down this URL: <b><code><a id="mo_saml_backdoor_url">'.$mo_backdoor_URL.'</a></code></b>' ),
   );

   $form['miniorange_saml_backdoor_textbox1']=array(
        '#prefix'=>'<table style="width:100%;" id="miniorange_saml_backdoor_table" hidden><tr><td><div class="backdoor" id="backdoor"><code><a><strong id="miniorange_saml_backdoor_base_url_to_append">'.$base_site_url.'/user/login?saml_login=</strong></a></code>',
        '#type'=>'textfield',
        '#id'=>'miniorange_saml_backdoor_textbox1',
        '#default_value'=>variable_get('miniorange_backdoor_query','false'),
        '#suffix'=>'</div></td></tr></table>',
  );

    $form['miniorange_saml_default_relaystate'] = array(
        '#type' => 'textfield',
        '#title' => t('Default Redirect URL after login'),
        '#description' => '<b>Note: </b>Enter the path excluding the base path of the website.',
        '#default_value' => variable_get('miniorange_saml_default_relaystate', ''),
        '#attributes' => array('style' => 'width:65%', 'placeholder' => 'Enter Default Redirect URL'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_domain_restriction_checkbox'] = array(
        '#type' => 'checkbox',
        '#title' => t('Check this option if you want  <b>Domain Restriction</b>'),
        '#disabled' => $disabled,
        '#default_value'=>variable_get('miniorange_saml_enable_domain_restriction'),
      );
    $form['miniorange_saml_set_of_radiobuttons'] = array(
        '#type' => 'fieldset',
          '#states' => array(
            // Only show this field when the checkbox is enabled.
            'visible' => array(
              ':input[name="miniorange_saml_domain_restriction_checkbox"]' => array('checked' => TRUE),
            ),
          ),
    );
  $form['miniorange_saml_set_of_radiobuttons']['miniorange_saml_allow_or_block_domains']=array(
          '#type'=>'radios',
          '#maxlength' => 5,
          '#options' => array(  'white' => 'I want to allow only some of the domains','black' => 'I want to block some of the domains'),
          '#default_value'=>variable_get('miniorange_saml_domains_are_white_or_black','white'),
          '#disabled' => $disabled,


  );

  $form['miniorange_saml_set_of_radiobuttons']['miniorange_saml_domains'] = array(
        '#type' => 'textarea',
        '#title' => t('Enter list of domains'),
        '#attributes' => array('style' => 'width:700px;height:50px; background-color: hsla(0,0%,0%,0.08) !important',
          'placeholder' => 'Enter semicolon(;) separated domains (Eg. xxxx.com; xxxx.com)'),
        '#disabled' => $disabled,
        '#default_value'=>variable_get('miniorange_saml_domains',''),
        '#suffix' => '<br>',
        
  );


    $form['miniorange_saml_gateway_config_submit'] = array(
        '#type' => 'submit',
        '#value' => t('Save Configuration'),
        '#id'=>'mo_saml_save_config_btn',
        '#submit' => array('miniorange_saml_save_signin_settings'),
        '#disabled' => $disabled,
        '#prefix' => '<br>',
        '#suffix' => '<br><br><br><br></div>'
    );

    Utilities::AddsupportTab($form, $form_state);

    return $form;

}

function miniorange_saml_save_signin_settings($form, &$form_state) {
    $auto_redirect_value        = $form['miniorange_saml_auto_redirect']['#value'];
    $force_authentication_value = $form['miniorange_saml_force_auth']['#value'];
    $enable_backdoor_value      = $form['miniorange_saml_enable_backdoor']['#value'];
    $default_relaystate         = $form['miniorange_saml_default_relaystate']['#value'];
    $enable_domain_restriction=$form['miniorange_saml_domain_restriction_checkbox']['#value'];
    $white_or_black=$form['miniorange_saml_set_of_radiobuttons']['miniorange_saml_allow_or_block_domains']['#value'];
    $domains=$form['miniorange_saml_set_of_radiobuttons']['miniorange_saml_domains']['#value'];
    $backdoor_url_query=$form['miniorange_saml_backdoor_textbox1']['#value'];
    $enable_autocreate_users_value = $form['miniorange_saml_disable_autocreate_users']['#value'];
         
    $enable_domain_restriction_value=FALSE;
    if($enable_domain_restriction==1){
          $enable_domain_restriction_value=TRUE;
    }

    $auto_redirect        = $auto_redirect_value == 1 ? TRUE : FALSE;
    $force_authentication = $force_authentication_value == 1 ? TRUE : FALSE;
    $enable_backdoor      = $enable_backdoor_value == 1 ? TRUE : FALSE;
    $enable_autocreate_users = $enable_autocreate_users_value == 1 ? TRUE : FALSE;
    variable_set('miniorange_saml_auto_redirect_to_idp', $auto_redirect);
    variable_set('miniorange_saml_force_auth', $force_authentication);
    variable_set('miniorange_saml_default_relaystate', $default_relaystate);
    variable_set('miniorange_saml_enable_backdoor', $enable_backdoor);
    variable_set('miniorange_saml_enable_domain_restriction',$enable_domain_restriction_value);
    variable_set('miniorange_saml_domains_are_white_or_black',$white_or_black);
    variable_set('miniorange_saml_domains',$domains);
    variable_set('miniorange_backdoor_query',$backdoor_url_query);
    variable_set('miniorange_saml_disable_autocreate_users', $enable_autocreate_users);

    drupal_set_message(t('Signin Settings successfully saved'));
}
