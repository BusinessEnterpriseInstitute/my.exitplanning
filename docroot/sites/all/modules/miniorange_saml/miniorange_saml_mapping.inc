<?php
/**
 * @file
 * Contains Attribute and Role Mapping for miniOrange SAML Login Module.
 */

/**
 * Showing Settings form.
 */
function miniorange_saml_mapping($form, &$form_state)
{
    global $base_url;
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/bootstrap.min.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/style_settings.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    $form['header_top_style_1'] = array('#markup' => '');

    $form['markup_1'] = array(
        '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_saml_container">
      <h3>ATTRIBUTE MAPPING</h3><hr><br/>',
    );

    $disabled = Utilities::isCustomerRegistered($form, $form_state);

    

    $form['miniorange_saml_username_attribute'] = array(
        '#type' => 'textfield',
        '#title' => t('Username Attribute'),
        '#default_value' => variable_get('miniorange_saml_username_attribute', 'NameID'),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'NameID'),
        '#required' => TRUE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_email_attribute'] = array(
        '#type' => 'textfield',
        '#title' => t('Email Attribute'),
        '#default_value' => variable_get('miniorange_saml_email_attribute', 'NameID'),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'NameID'),
        '#required' => TRUE,
        '#disabled' => $disabled,
    );

    $form['markup_cam_top_head'] = array(
        '#markup' => '<br><h3>CUSTOM ATTRIBUTE MAPPING</h3><hr><br>',
    );

    $form['markup_cam'] = array(
        '#markup' => '<div class="mo_saml_highlight_background_note_1" style="width: 700px"><p><b>NOTE: </b> Add the Drupal field attributes in the Attribute Name textfield and add the IdP attibutes that you need to map with the drupal attributes in the IdP Attribute Name textfield. 
         <br> <b>Attribute Name:</b> It is the user attribute (machine name) whose value you want to set in site.
         <br> <b>IdP Attribute Name:</b> It is the name which you want to get from your IDP. It should be unique.</p>
         <p>To add a new Drupal field go to Configuration->Account Settings->Manage fields and then click on <b>Add field.</b></p></div>
         <p><b>For example: If the attribute name in the drupal is name then its machine name will be field_name.</b></p><br>',
    );

    $form['miniorange_saml_attr5_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Machine Name of Attribute 1'),
        '#default_value' => variable_get('miniorange_saml_attr5_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_attr5_name'] = array(
        '#type' => 'textfield',
        '#title' => t('IdP Attribute Name 1'),
        '#default_value' => variable_get('miniorange_saml_idp_attr5_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter IdP Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_attr2_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Machine Name of Attribute 2'),
        '#default_value' => variable_get('miniorange_saml_attr2_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_attr2_name'] = array(
        '#type' => 'textfield',
        '#title' => t('IdP Attribute Name 2'),
        '#default_value' => variable_get('miniorange_saml_idp_attr2_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter IdP Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_attr3_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Machine Name of Attribute 3'),
        '#default_value' => variable_get('miniorange_saml_attr3_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_attr3_name'] = array(
        '#type' => 'textfield',
        '#title' => t('IdP Attribute Name 3'),
        '#default_value' => variable_get('miniorange_saml_idp_attr3_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter IdP Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_attr4_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Machine Name of Attribute 4'),
        '#default_value' => variable_get('miniorange_saml_attr4_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_attr4_name'] = array(
        '#type' => 'textfield',
        '#title' => t('IdP Attribute Name 4'),
        '#default_value' => variable_get('miniorange_saml_idp_attr4_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter IdP Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['markup_idp_user_attr_header'] = array(
        '#markup' => '<br /><h3> Additional User Attributes(Optional)<input type="button" class="mo_saml_btn mo_saml_btn-primary" style="width:3%;margin-left:2%;margin-right:2%;" value="+" onclick="add_user_attibute();" /> <input type="button" class="mo_saml_btn mo_saml_btn-danger" style="width:3%;" value="-" onclick="remove_user_attibute();" /></h3>',
    );

    $form['markup_idp_user_attr_note'] = array(
        '#markup' => '<div class="mo_saml_highlight_background_note_1" style="width: 700px"><b>Attribute Name:</b> It is the user attribute (machine name) whose value you want to set in site.<br />
            <b>IdP Attribute Name:</b> It is the name which you want to get from your IDP. It should be unique.</div><br>',
    );

    $form['markup_idp_user_attr_header1'] = array(
        '#markup' => '<div id="userProfileAttrDiv"><div class="row" id="before_attr_list_upa">'
            . ' <div style="width:20%;display:inline-block;"><b>Attribute Name</b></div><div style="width:40%;display:inline-block;">'
            . ' <b>IdP Attribute Name</b></div></div><br/><br/>'
    );

    $counter = 0;
    $userProfileAttribues = variable_get('miniorange_saml_sp_user_attributes', '');
    if (isset($userProfileAttribues) && !empty($userProfileAttribues)) {
        $userProfileAttribues = json_decode($userProfileAttribues, true);
        foreach ($userProfileAttribues as $profileAttribute) {
            $form['markup_idp_user_attr_list_' . $counter] = array(
                '#markup' => '<div class="row userAttr" style="padding-bottom:1%;" id="uparow_' . $counter . '" >
                       <div style="width:25%;display:inline-block;">
                             <input type="text" name="user_profile_attr_name[' . $counter . ']" value="' . $profileAttribute["attr_name"] . '" class="form-text" />
                       </div>
                       <div style="width:50%;display:inline-block;">
                           <input type="text" name="user_profile_attr_value[' . $counter . ']" value="' . $profileAttribute["attr_value"] . '" class="form-text" />
                       </div>
                     </div>'
            );
            $counter += 1;
        }
    }

    $form['markup_idp_user_attr_header2'] = array(
        '#markup' => '<br />',
    );

    echo '<script>
        

       
        function add_user_attibute(){   
            var sel = "<div class=\'row userAttr\' style=\'padding-bottom:1%;\' id=\'uparow_" + countUserAttributes + "\'><div style=\'width:25%;display:inline-block;\'><input type=\'text\' name=\'user_profile_attr_name[" + countUserAttributes + "]\' value=\'\' class=\'form-text\' /></div>&nbsp;<div style=\'width:50%;display:inline-block;\'><input type=\'text\' name=\'user_profile_attr_value[" + countUserAttributes + "]\' value=\'\' class=\'form-text\' /></div></div>";
            if(countUserAttributes!=0){ 
                jQuery(sel).insertAfter(jQuery("#uparow_" +(countUserAttributes-1)));
                countUserAttributes += 1;
            }
            else{
                jQuery(sel).insertAfter(jQuery(\'#before_attr_list_upa\'));
                countUserAttributes += 1;
            }
        }
        function remove_user_attibute(){
            if(countUserAttributes != 0){
                countUserAttributes -= 1;
                jQuery("#userProfileAttrDiv .userAttr:last").remove();
            }
        }  
        window.onload = function() {
            var numOfAttr=document.getElementsByClassName("userAttr").length;
            countUserAttributes = ' . $counter . '; 
            if(numOfAttr==0){
            add_user_attibute();
        }
        };   
    </script>';

    $form['markup_role_1'] = array(
        '#markup' => '<h3>CUSTOM ROLE MAPPING</h3><hr><br>',
    );

    $form['miniorange_saml_enable_rolemapping'] = array(
        '#type' => 'checkbox',
        '#title' => t('Check this option if you want to <b>enable Role Mapping</b>'),
        '#description' => t('<span style="color: red;"><b>Note:</b></span> Enable this first if you want to use any of the feature below.'),
        '#default_value' => variable_get('miniorange_saml_enable_rolemapping'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_disable_role_update'] = array(
        '#type' => 'checkbox',
        '#title' => t('Check this option if you do not want to update user role if roles not mapped'),
        '#default_value' => variable_get('miniorange_saml_disable_role_update'),
        '#disabled' => $disabled,
    );

    

    $mrole = user_roles($membersonly = TRUE);
    $drole = array_search(variable_get('miniorange_saml_default_role', ''), $mrole);

    $form['miniorange_saml_default_mapping'] = array(
        '#type' => 'select',
        '#title' => t('Select default group for the new users'),
        '#options' => $mrole,
        '#default_value' => $drole,
        '#attributes' => array('style' => 'width:700px'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_attr1_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Role Key'),
        '#default_value' => variable_get('miniorange_saml_idp_attr1_name', ''),
        '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter Role Attribute'),
        '#required' => FALSE,
        '#disabled' => $disabled,
        '#description' => '<b>Note:</b> You will find role key value in the test configuration window.',
    );

    foreach ($mrole as $roles) {
        $rolelabel = str_replace(' ', '', $roles);
        $form['miniorange_saml_role_' . $rolelabel] = array(
            '#type' => 'textfield',
            '#title' => t($roles),
            '#maxlength' => 255,
            '#default_value' => variable_get('miniorange_saml_role_' . $rolelabel, ''),
            '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Semi-colon(;) separated Group/Role value for ' . $roles),
            '#required' => FALSE,
            '#disabled' => $disabled,
        );
    }

    $form['markup_role_signin'] = array(
        '#markup' => '<br><h3>CUSTOM LOGIN/LOGOUT (Optional)</h3><hr><br>'
    );

    foreach ($mrole as $drupalKey => $drupalRoles) {
        $lbl = str_replace(' ', '', $drupalRoles . '_sin');
        $l = str_replace(' ', '', $drupalRoles . '_sout');
        $form[$lbl] = array(
            '#type' => 'textfield',
            '#title' => $drupalRoles,
            '#default_value' => variable_get($lbl, ''),
            '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter Login URL'),
            '#required' => FALSE,
            '#disabled' => $disabled,
        );

        $form[$l] = array(
            '#type' => 'textfield',
            '#default_value' => variable_get($l, ''),
            '#attributes' => array('style' => 'width:700px', 'placeholder' => 'Enter Logout URL'),
            '#required' => FALSE,
            '#disabled' => $disabled,
        );
    }

    $form['miniorange_saml_div_end'] = array(
        '#markup' => '<br>'
    );

    $form['miniorange_saml_gateway_config_submit'] = array(
        '#type' => 'submit',
        '#value' => t('Save Configuration'),
        '#submit' => array('miniorange_saml_save_mapping_settings'),
        '#disabled' => $disabled,
       
    );

    $form['miniorange_saml_support_srart'] = array(
        '#markup' => '</div></div>'
    );

     Utilities::AddsupportTab($form, $form_state);

    return $form;

}

function miniorange_saml_save_mapping_settings($form, &$form_state)
{
    $idp_attribute1_name = $form['miniorange_saml_idp_attr1_name']['#value'];
    $sp_attribute2_name = $form['miniorange_saml_attr2_name']['#value'];
    $idp_attribute2_name = $form['miniorange_saml_idp_attr2_name']['#value'];
    $sp_attribute3_name = $form['miniorange_saml_attr3_name']['#value'];
    $idp_attribute3_name = $form['miniorange_saml_idp_attr3_name']['#value'];
    $sp_attribute4_name = $form['miniorange_saml_attr4_name']['#value'];
    $idp_attribute4_name = $form['miniorange_saml_idp_attr4_name']['#value'];
    $sp_attribute5_name = $form['miniorange_saml_attr5_name']['#value'];
    $idp_attribute5_name = $form['miniorange_saml_idp_attr5_name']['#value'];
    $mrole = user_roles($membersonly = TRUE);
    $username_attribute = $form['miniorange_saml_username_attribute']['#value'];
    $email_attribute = $form['miniorange_saml_email_attribute']['#value'];
    $enable_rolemapping_value = $form['miniorange_saml_enable_rolemapping']['#value'];
    $disable_role_update_value = $form['miniorange_saml_disable_role_update']['#value'];
   
    $default_mapping = $form['miniorange_saml_default_mapping']['#value'];

    foreach ($mrole as $drupalKey => $drupalRoles) {
        if (!is_null($drupalRoles)) {
            ${str_replace(' ', '', $drupalRoles . '_sin')} = $form[str_replace(' ', '', $drupalRoles . '_sin')]['#value'];
            ${str_replace(' ', '', $drupalRoles . '_sout')} = $form[str_replace(' ', '', $drupalRoles . '_sout')]['#value'];
        }
    }

    /* Updated User Profile Attributes*/
    $user_profile_attr_names = array_key_exists('user_profile_attr_name', $_POST) ? $_POST['user_profile_attr_name'] : array();
    $user_profile_attr_values = array_key_exists('user_profile_attr_value', $_POST) ? $_POST['user_profile_attr_value'] : array();
    $attribute_mapping = array();
    foreach ($user_profile_attr_names as $key => $value) {
        if (!empty(trim($value))) {
            if (!empty(trim($user_profile_attr_values[$key]))) {
                $anArray = array();
                $anArray['attr_name'] = trim($value);
                $anArray['attr_value'] = trim($user_profile_attr_values[$key]);
                array_push($attribute_mapping, $anArray);
            }
        }
    }
    $attribute_mapping = json_encode($attribute_mapping);

    $enable_rolemapping      = $enable_rolemapping_value == 1 ? TRUE : FALSE;
   
    $disable_role_update     = $disable_role_update_value == 1 ? TRUE : FALSE;

    variable_set('miniorange_saml_enable_rolemapping', $enable_rolemapping);
    variable_set('miniorange_saml_idp_attr1_name', $idp_attribute1_name);
    variable_set('miniorange_saml_attr2_name', $sp_attribute2_name);
    variable_set('miniorange_saml_idp_attr2_name', $idp_attribute2_name);
    variable_set('miniorange_saml_attr3_name', $sp_attribute3_name);
    variable_set('miniorange_saml_idp_attr3_name', $idp_attribute3_name);
    variable_set('miniorange_saml_attr4_name', $sp_attribute4_name);
    variable_set('miniorange_saml_idp_attr4_name', $idp_attribute4_name);
    variable_set('miniorange_saml_attr5_name', $sp_attribute5_name);
    variable_set('miniorange_saml_idp_attr5_name', $idp_attribute5_name);
    variable_set('miniorange_saml_sp_user_attributes', $attribute_mapping);

    if ($enable_rolemapping) {
        $rolemap = array();
        foreach ($mrole as $key => $value) {
            $rolelabel = str_replace(' ', '', $value);
            if (!empty($form['miniorange_saml_role_' . $rolelabel]['#value'])) {
                $temp = $form['miniorange_saml_role_' . $rolelabel]['#value'];
                variable_set('miniorange_saml_role_' . $rolelabel, $temp);
                $arr = explode(";", $temp);
                foreach ($arr as $val) {
                    $rolemap[$val] = $value;
                }
            } else {
                variable_set('miniorange_saml_role_' . $rolelabel, '');
            }
        }
        variable_set('rolemap', $rolemap);
        variable_set('miniorange_saml_default_role', $mrole[$default_mapping]);
    } else {
        foreach ($mrole as $key => $value) {
            $rolelabel = str_replace(' ', '', $value);
            variable_set('miniorange_saml_role_' . $rolelabel, '');
        }
        variable_set('rolemap', '');
        variable_set('miniorange_saml_default_role', $mrole[2]);
    }
    variable_set('miniorange_saml_username_attribute', $username_attribute);
    variable_set('miniorange_saml_email_attribute', $email_attribute);
   
    variable_set('miniorange_saml_disable_role_update', $disable_role_update);

    $mrole = user_roles($membersonly = TRUE);
    foreach ($mrole as $drupalKey => $drupalRoles) {
        if (!is_null($drupalRoles)) {
            variable_set(str_replace(' ', '', $drupalRoles . '_sin'), ${str_replace(' ', '', $drupalRoles . '_sin')});
            variable_set(str_replace(' ', '', $drupalRoles . '_sout'), ${str_replace(' ', '', $drupalRoles . '_sout')});
        }
    }
    drupal_set_message(t('Signin Settings successfully saved'));
}