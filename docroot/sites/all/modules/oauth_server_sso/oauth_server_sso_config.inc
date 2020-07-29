<?php
require_once 'includes/handler.php';
    drupal_add_css( drupal_get_path('module', 'oauth_server_sso'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));
    drupal_add_css( drupal_get_path('module', 'oauth_server_sso'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));

    function oauth_server_sso_config($form, $form_state)
    {
        global $base_url;
        if (variable_get('oauth_server_sso_customer_admin_email', NULL) == NULL|| variable_get('oauth_server_sso_customer_id', NULL) == NULL
            || variable_get('oauth_server_sso_customer_admin_token', NULL) == NULL || variable_get('oauth_server_sso_customer_api_key', NULL) == NULL) {
            $form['header'] = array(
                '#markup' => "<center><h3>You need to <a style='color: red' href= $base_url/admin/config/people/oauth_server_sso/>Register/Login</a> with miniOrange before using this module.</h3></center>",
        );
            return $form;
        }
        $stat = '';
        $module_path = drupal_get_path('module', 'oauth_server_sso');
        $finalpath = $base_url;
        $stat = variable_get('oauth_server_sso_add_client_status','');
        $form['#prefix'] = '<div style="background-color: rgb(241,241,241) ; padding: 20px">';
        $form['#suffix'] = '</div>';

        if($stat == '')
        {
            $form['oauth_server_sso_msg_1'] = array(
                '#markup' => "
                    <div style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%' id='enable_ldap'>
                        <h1><b>Add OAuth Client</b></h1><br>
                    </div>",
            );
            $form['oauth_server_sso_client_name'] = array(
	            '#type' => 'textfield',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'><h4>Client Name: </h4>",
                '#suffix' => "</div>",
                '#id' => 'firstname',
                '#required' => 'true',
	            '#default_value' => variable_get('oauth_server_sso_client_name', ''),
            );
            $form['oauth_server_sso_redirect_url'] = array(
	            '#type' => 'textfield',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'><h4>Authorized Redirect URL: </h4>",
                '#suffix' => "</div>",
                '#id' => 'firstname',
                '#required' => 'true',
	            '#default_value' => variable_get('oauth_server_sso_redirect_url', ''),
            );
            $form['next_step_1'] = array(
                '#type' => 'submit',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
                '#suffix' => "</div>",
                '#id' => 'button_config',
                '#value' => t('NEXT'),
                '#submit' => array('oauth_server_sso_next_1'),
                '#attributes' => array('class'=>array('my-form-class')),
            );
        }
        else
        {
            $form['oauth_server_sso_msg_1'] = array(
                '#markup' => "
                    <div style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%' id='enable_ldap'>
                        <h1><b>Add OAuth Client</b></h1><br>
                    </div>",
            );
            $form['oauth_server_sso_client_name'] = array(
	            '#type' => 'textfield',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'><h4>Client Name: </h4>",
                '#suffix' => "</div>",
                '#id' => 'firstname',
                '#disabled' => true,
                '#required' => 'true',
	            '#default_value' => variable_get('oauth_server_sso_client_name', ''),
            );
            $form['oauth_server_sso_redirect_url'] = array(
	            '#type' => 'textfield',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'><h4>Authorized Redirect URL: </h4>",
                '#suffix' => "</div>",
                '#id' => 'firstname',
                '#required' => 'true',
	            '#default_value' => variable_get('oauth_server_sso_redirect_url', ''),
            );
            $form['oauth_server_sso_client_id'] = array(
	            '#type' => 'textfield',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'><h4>Client ID: </h4>",
                '#suffix' => "</div>",
                '#id' => 'firstname',
                '#disabled' => true,
	            '#default_value' => variable_get('oauth_server_sso_client_id', ''),
            );
            $form['oauth_server_sso_client_secret'] = array(
	            '#type' => 'textfield',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'><h4>Client Secret: </h4>",
                '#suffix' => "</div>",
                '#id' => 'firstname',
                '#disabled' => 'true',
	            '#default_value' => variable_get('oauth_server_sso_client_secret', ''),
            );
            $form['oauth_server_sso_delete_client'] = array(
                '#type' => 'submit',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
                '#suffix' => "</div>",
                '#id' => 'button_config',
                '#value' => t('Delete Client'),
                '#submit' => array('oauth_server_sso_delete_client'),
                '#attributes' => array('class'=>array('my-form-class')),
            );
            $form['next_step_1'] = array(
                '#type' => 'submit',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
                '#suffix' => "</div><br><br>",
                '#id' => 'button_config',
                '#value' => t('Update'),
                '#submit' => array('oauth_server_sso_next_2'),
                '#attributes' => array('class'=>array('my-form-class')),
            );

            $form['oauth_server_sso_markup1']= array(
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
                '#suffix' => "</div>",
                '#markup' => "<h2>Endpoint Urls</h2>
	                            <p>You can configure below endpoints in your OAuth client.<p>",
            );
            $form['oauth_server_sso_endpoints'] = array(
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
                '#suffix' => "</div><br><br>",
                '#markup' =>
                "<table>
	                <tr><td><b>Authorize Endpoint </b> : </td><td>$finalpath/?q=authorize</td></tr>
	                <tr><td><b>Access Token Endpoint </b> : </td><td>$finalpath/?q=access_token</td></tr>
	                <tr><td><b>Get User Info Endpoint </b> : </td><td>$finalpath/?q=user_info</td></tr>
	                <tr><td><b>Scope </b> : </td><td>profile</td></tr>
	            </table>",
            );
        }
        return $form;
    }
    function oauth_server_sso_next_1($form, $form_state)
    {
        if($form['oauth_server_sso_client_name']['#value'] != '')
        {
            $client_name = $form['oauth_server_sso_client_name']['#value'];
            variable_set('oauth_server_sso_client_name',$client_name);
        }
        if($form['oauth_server_sso_redirect_url']['#value'] != '')
        {
            $redirect_url = $form['oauth_server_sso_redirect_url']['#value'];
            variable_set('oauth_server_sso_redirect_url',$redirect_url);
        }
        $client_id = handler::generateRandom(30);
        $client_secret = handler::generateRandom(30);

        variable_set('oauth_server_sso_client_id',$client_id);
        variable_set('oauth_server_sso_client_secret',$client_secret);
        variable_set('oauth_server_sso_add_client_status','review');
        drupal_set_message(t('Configurations saved successfully.'));
    }
    function oauth_server_sso_next_2($form, $form_state)
    {
        if($form['oauth_server_sso_client_name']['#value'] != '')
        {
            $client_name = $form['oauth_server_sso_client_name']['#value'];
            variable_set('oauth_server_sso_client_name',$client_name);
        }
        if($form['oauth_server_sso_redirect_url']['#value'] != '')
        {
            $redirect_url = $form['oauth_server_sso_redirect_url']['#value'];
            variable_set('oauth_server_sso_redirect_url',$redirect_url);
        }
        if($form['oauth_server_sso_client_id']['#value'] != '')
        {
            $client_id = $form['oauth_server_sso_client_id']['#value'];
            variable_set('oauth_server_sso_client_id',$client_id);
        }
        if($form['oauth_server_sso_client_secret']['#value'] != '')
        {
            $client_secret = $form['oauth_server_sso_client_secret']['#value'];
            variable_set('oauth_server_sso_client_secret',$client_secret);
        }
        variable_set('oauth_server_sso_status','review');
        drupal_set_message(t('Configurations saved successfully.'));
    }
    function oauth_server_sso_delete_client($form, $form_state)
    {
        variable_del('oauth_server_sso_client_name');
        variable_del('oauth_server_sso_client_id');
        variable_del('oauth_server_sso_client_secret');
        variable_del('oauth_server_sso_redirect_url');
        variable_del('oauth_server_sso_add_client_status');
    }
?>