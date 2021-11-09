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
      global $base_url;
      drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));
      drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));

      $base_site_url = Utilities::miniorange_get_baseURL();

      $disabled = Utilities::isCustomerRegistered($form, $form_state);

      $form['header_top_style_1'] = array('#markup' => '<div class="mo_saml_table_layout_1">');

      $form['markup_1'] = array(
           '#markup' => '<div class="mo_saml_table_layout mo_saml_container"><h3>SINGLE SIGN-ON LINK</h3><hr><br>',
      );

      
      // if(variable_get('miniorange_saml_license_key', NULL) == NULL && variable_get('miniorange_saml_customer_admin_email', NULL) != NULL)
      // {
      //     return $form;
      // }

	    $header = array(
          'idpname' => array('data' => t('Identity Provider Name')),
	        'link' => array('data' => t('SP Initiated SSO Link')),
      );

      $options = array();
	    $sql = db_query("SELECT * FROM {miniorange_saml_idp_list}");
	    $data = $sql->fetchAll();

	    foreach($data as $idp){
			    $options[$idp->id] = array(
			        'idpname' => $idp->mo_idp_name,
			        'link' => $base_url . '/?q=samllogin&idpname=' . $idp->mo_idp_name,
			    );

			    $form['fieldset']['customerinfo'] = array(
			        '#theme' => 'table',
			        '#header' => $header,
			        '#rows' => $options,
			    );
	    }

	    $form['miniorange-saml-signin-settings-tab'] = array(
	        '#markup' => '<br><h3>AUTO-REDIRECTION from SITE</h3><hr><br>'
      );

	    $idps = Utilities::show_idp_list();
	    $idp_val = array_search(variable_get('miniorange_saml_default_idp_name',''),$idps);

	    $form['miniorange_saml_select_idp_name'] = array(
          '#type' => 'select',
          '#title' => t('Select IDP as the Default Identity Provider'),
          '#options' => $idps,
          '#default_value' => $idp_val,
          '#attributes' => array('style' => 'width:65%'),
          '#disabled' => $disabled,
          '#description' => t('<b>NOTE: </b>Selecting this IDP as default will enable all the users to redirect to this IDP\'s login page if the Auto-redirect feature is on.'),
      );

      $form['miniorange_saml_auto_redirect'] = array(
          '#type' => 'checkbox',
          '#title' => t('Check this option if you want to <b>auto redirect the user to IdP</b>'),
          '#default_value' => variable_get('miniorange_saml_auto_redirect_to_idp'),
          '#disabled' => $disabled,
          '#description' => t('<b>Note: </b>Users will be redirected to your IdP for login when the login page is accessed.<br><br>'),
      );

      $form['miniorange_saml_force_auth'] = array(
          '#type' => 'checkbox',
          '#title' => t('Protect website against anonymous access'),
          '#default_value' => variable_get('miniorange_saml_force_auth', ''),
          '#disabled' => $disabled,
          '#description' => t('<b>Note: </b>Users will be redirected to your IdP for login in case user is not logged in and tries to access website.<br><br>'),
      );

      $form['miniorange_saml_enable_backdoor'] = array(
          '#type' => 'checkbox',
          '#title' => t('Check this option if you want to enable <b>backdoor login</b>'),
          '#default_value' => variable_get('miniorange_saml_enable_backdoor', ''),
          '#disabled' => $disabled,
          '#description' => t('<b>Note: </b>Checking this option <b>creates a backdoor to login to your Website using Drupal credentials</b><br>'
            . ' incase you get locked out of your IdP. Note down this URL: <b><a>' . $base_site_url . '/?saml_login=false</b></a><br><br>'),
      );

      $form['miniorange_saml_default_relaystate'] = array(
          '#type' => 'textfield',
          '#title' => t('Default Redirect URL after login'),
          '#default_value' => variable_get('miniorange_saml_default_relaystate', ''),
          '#attributes' => array('style' => 'width:65%','placeholder' => 'Enter Default Redirect URL After Login'),
          '#disabled' => $disabled,
      );

       $form['miniorange_saml_default_redirect_url_logout'] = array(
          '#type' => 'textfield',
          '#title' => t('Default Redirect URL after logout'),
          '#default_value' => variable_get('miniorange_saml_default_redirect_url_logout', ''),
          '#attributes' => array('style' => 'width:65%','placeholder' => 'Enter Default Redirect URL After Logout'),
          '#disabled' => $disabled,
      );

      $form['miniorange_saml_br'] = array(
        '#markup' => '<br>',
      );

      $form['miniorange_saml_gateway_config_submit'] = array(
          '#type' => 'submit',
          '#value' => t('Save Configuration'),
          '#submit' => array('miniorange_saml_save_signin_settings'),
          '#disabled' => $disabled,
          '#attributes' => array('style' => 'display:block;margin-left:auto;margin-right:auto;border-radius: 2px;background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;'),
      );

      $form['miniorange_saml_support_div_end'] = array(
          '#markup' => '</div>',
      );

      Utilities::AddsupportTab( $form, $form_state);

      return $form;

 }

 function miniorange_saml_save_signin_settings($form, &$form_state) {
      $default_relaystate = $form['miniorange_saml_default_relaystate']['#value'];
      $default_redirect_url_logout = $form['miniorange_saml_default_redirect_url_logout']['#value'];
      $auto_redirect = $form['miniorange_saml_auto_redirect']['#value'];
      $default_idp_name = $form['miniorange_saml_select_idp_name']['#value'];
      $force_authentication = $form['miniorange_saml_force_auth']['#value'];
      $enable_backdoor = $form['miniorange_saml_enable_backdoor']['#value'];

      $idps = Utilities::show_idp_list();

      if ($auto_redirect == 1) {
          $auto_redirect = TRUE;
      }
      else {
          $auto_redirect = FALSE;
      }

      if ($force_authentication == 1) {
          $force_authentication = TRUE;
      }
      else {
          $force_authentication = FALSE;
      }

      if ($enable_backdoor == 1) {
         $enable_backdoor = TRUE;
      }
      else {
         $enable_backdoor = FALSE;
      }

      variable_set('miniorange_saml_default_relaystate', $default_relaystate);
      variable_set('miniorange_saml_default_redirect_url_logout',$default_redirect_url_logout);
      variable_set('miniorange_saml_force_auth', $force_authentication);
      variable_set('miniorange_saml_auto_redirect_to_idp', $auto_redirect);
      variable_set('miniorange_saml_default_idp_name', $idps[$default_idp_name]);
      variable_set('miniorange_saml_enable_backdoor', $enable_backdoor);
      drupal_set_message(t('Signin Settings successfully saved'));
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
