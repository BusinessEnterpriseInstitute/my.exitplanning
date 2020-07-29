<?php
    drupal_add_css( drupal_get_path('module', 'oauth_server_sso'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));
    drupal_add_css( drupal_get_path('module', 'oauth_server_sso'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => FALSE));

    function oauth_server_sso_settings($form, $form_state)
    {
        global $base_url;
           if (variable_get('oauth_server_sso_customer_admin_email', NULL) == NULL|| variable_get('oauth_server_sso_customer_id', NULL) == NULL
        || variable_get('oauth_server_sso_customer_admin_token', NULL) == NULL || variable_get('oauth_server_sso_customer_api_key', NULL) == NULL) {
        $form['header'] = array(
            '#markup' => "<center><h3>You need to <a style='color: red' href= $base_url/admin/config/people/oauth_server_sso/>Register/Login</a> with miniOrange before using this module.</h3></center>",
        );

        return $form;
    }
        $form['#prefix'] = '<div style="background-color: rgb(241,241,241) ; padding: 20px">';
        $form['#suffix'] = '</div>';
        $form['oauth_server_sso_msg_1'] = array(
                    '#markup' => "
                        <div style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%' id='enable_ldap'>
                            <h1><b>General Settings</b></h1><br>
                        </div>",
        );
        $form['oauth_server_sso_accesstoken_expiry'] = array(
                    '#type' => 'textfield',
                    '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'><h4>Access Token Expiry Time: </h4>",
                    '#placeholder' => 'in seconds',
                    '#description' =>'<b>[premium feature]</b>',
                    '#suffix' => "</div>",
                    '#id' => 'firstname',
                    '#disabled' =>'true',
                    '#required' => 'true',
                    '#default_value' => variable_get('oauth_server_sso_accesstoken_expiry', ''),
                    '#attributes' => array('placeholder' => 'in seconds'),
        );
        $form['oauth_server_sso_refreshtoken_expiry'] = array(
                    '#type' => 'textfield',
                    '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'><h4>Refresh Token Expiry Time: </h4>",
                    '#suffix' => "</div>",
                    '#description' => '<b>[premium feature]</b>',
                    '#id' => 'firstname',
                    '#disabled' =>'true',
                    '#required' => 'true',
                    '#default_value' => variable_get('oauth_server_sso_refreshtoken_expiry', ''),
                    '#attributes' => array('placeholder' => 'in seconds'),
        );
        $form['next_step_1'] = array(
                '#type' => 'submit',
                '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
                '#suffix' => "</div>",
                '#id' => 'button_config',
                '#value' => t('Save Settings'),
                '#submit' => array('oauth_server_sso_save_general_settings'),
                '#attributes' => array('class'=>array('my-form-class')),
        );
        return $form;
}

function oauth_server_sso_save_general_settings($form, $form_state)
{
    if($form['oauth_server_sso_refreshtoken_expiry']['#value'] != '')
    {
            $refresh__token_expiry = $form['oauth_server_sso_refreshtoken_expiry']['#value'];
            variable_set('oauth_server_sso_refresh_token_expiry',$refresh__token_expiry);
    }
    if($form['oauth_server_sso_accesstoken_expiry']['#value'] != '')
    {
            $access__token_expiry = $form['oauth_server_sso_accesstoken_expiry']['#value'];
            variable_set('oauth_server_sso_access_token_expiry',$access__token_expiry);
    }
    //drupal_set_message(t('Configurations saved successfully.'));
}
?>