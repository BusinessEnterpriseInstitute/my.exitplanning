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
     drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));
     drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));

     drupal_add_js(drupal_get_path('module', 'miniorange_saml') . '/js/addAttribute.js', 'file');

     $disabled = Utilities::isCustomerRegistered($form, $form_state); 

     $form['header_top_style_1'] = array('#markup' => '<div class="mo_saml_table_layout_1">');

     $form['markup_1'] = array(
           '#markup' => '<div class="mo_saml_table_layout mo_saml_container"><h3>ATTRIBUTE MAPPING</h3><hr><br/>',
     );

    $form['miniorange_saml_account_username_by'] = array(
        '#type' => 'select',
        '#title' => t('Login/Create Drupal account by'),
        '#options' => array(
            1 => t('Username'),
            2 => t('Email'),
        ),
        '#default_value' => variable_get('miniorange_saml_login_by'),
        '#attributes' => array('style' => 'width:73%'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_username_attribute'] = array(
        '#type' => 'textfield',
        '#title' => t('Username Attribute'),
        '#default_value' => variable_get('miniorange_saml_username_attribute', 'NameID'),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter Username attribute'),
        '#required' => TRUE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_email_attribute'] = array(
        '#type' => 'textfield',
        '#title' => t('Email Attribute'),
        '#default_value' => variable_get('miniorange_saml_email_attribute', 'NameID'),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter Email attribute'),
        '#required' => TRUE,
    );

    $form['miniorange_saml_idp_attr1_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Role'),
        '#default_value' => variable_get('miniorange_saml_idp_attr1_name', ''),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter Role Attribute'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['markup_cam_top_head'] = array(
         '#markup' => '<br><h3>CUSTOM ATTRIBUTE MAPPING</h3><hr><br>',
    );

    $form['markup_cam'] = array(
        '#markup' => '<div class="mo_saml_highlight_background_note_1"><p>Add the Drupal field attributes in the Attribute Name textfield 
           and add the IdP attibutes that you need to map with the drupal attributes in the 
           IdP Attribute Name textfield. Drupal Field Attributes will be of type text. 
           Add the machine name of the attribute in the Drupal Attribute textfield.</p>
           <p>For example: If the attribute name in the drupal is name then its machine name will be field_name.</p></div><br>',
    );

    $form['miniorange_saml_attr5_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Attribute Name 1'),
        '#default_value' => variable_get('miniorange_saml_attr5_name', ''),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_attr5_name'] = array(
        '#type' => 'textfield',
        '#title' => t('IdP Attribute Name 1'),
        '#default_value' => variable_get('miniorange_saml_idp_attr5_name', ''),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter IdP Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_attr2_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Attribute Name 2'),
        '#default_value' => variable_get('miniorange_saml_attr2_name', ''),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_attr2_name'] = array(
        '#type' => 'textfield',
        '#title' => t('IdP Attribute Name 2'),
        '#default_value' => variable_get('miniorange_saml_idp_attr2_name', ''),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter IdP Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_attr3_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Attribute Name 3'),
        '#default_value' => variable_get('miniorange_saml_attr3_name', ''),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_attr3_name'] = array(
        '#type' => 'textfield',
        '#title' => t('IdP Attribute Name 3'),
        '#default_value' => variable_get('miniorange_saml_idp_attr3_name', ''),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter IdP Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_attr4_name'] = array(
        '#type' => 'textfield',
        '#title' => t('Attribute Name 4'),
        '#default_value' => variable_get('miniorange_saml_attr4_name', ''),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_idp_attr4_name'] = array(
        '#type' => 'textfield',
        '#title' => t('IdP Attribute Name 4'),
        '#default_value' => variable_get('miniorange_saml_idp_attr4_name', ''),
        '#attributes' => array('style' => 'width:73%','placeholder' => 'Enter IdP Attribute Name'),
        '#required' => FALSE,
        '#disabled' => $disabled,
    );

    $form['markup_idp_user_attr_header'] = array(
        '#markup' => '<br /><h3> Additional User Attributes(Optional)<input type="button" id="add_user" class="btn btn-primary" style="width:3%;margin-left:2%;margin-right:2%;" value="+" onclick="add_user_attribute();"/> <input type="button" class="btn btn-danger" style="width:3%;" onclick="remove_user_attribute();" value="-" /></h3>',
    );

    $form['markup_idp_user_attr_note'] = array(
        '#markup' => '<div class="messages status">Attribute Name: It is the user attribute (machine name) whose value you want to set in site.<br />
            IdP Attribute Name: It is the name which you want to get from your IDP. It should be unique.</div>',
    );

    $form['markup_idp_user_attr_header1'] = array(
        '#markup' => '<div id="userProfileAttrDiv"><div class="row" id="before_attr_list_upa">'
        . ' <div style="width:20%;display:inline-block;"><b>Attribute Name</b></div><div style="width:30%;display:inline-block;">'
        . ' <b>IdP Attribute Name</b></div></div>'
    );

    $counter = 0;
    $userProfileAttribues = variable_get('miniorange_saml_sp_user_attributes', '');
    if(isset($userProfileAttribues) && !empty($userProfileAttribues)){
        $userProfileAttribues = json_decode($userProfileAttribues, true);
        
        foreach($userProfileAttribues as $attr_name => $attr_value){
            $form['markup_idp_user_attr_list_' . $counter] = array(
                '#markup' => '<div class="row userAttr" style="padding-bottom:1%;" id="uparow_' . $counter . '" >
                       <div style="width:20%;display:inline-block;">
                             <input type="text" name="user_profile_attr_name[' . $counter . ']" value="' . $attr_name .'" class="form-text" />
                       </div>
                       <div style="width:30%;display:inline-block;">
                           <input type="text" name="user_profile_attr_value[' . $counter . ']" value="' . $attr_value .'" class="form-text" />
                       </div>
                     </div>'
                );
            $counter+=1;
        }
    }

    $form['markup_idp_user_attr_header2'] = array(
      '#markup' => '<br />',
    );

    $form['markup_role_1'] = array(
        '#markup' => '<h3>Custom Role Mapping</h3>',
    );

    $form['miniorange_saml_enable_rolemapping'] = array(
        '#type' => 'checkbox',
        '#title' => t('Check this option if you want to <b>enable Role Mapping</b>'),
        '#default_value' => variable_get('miniorange_saml_enable_rolemapping'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_disable_role_update'] = array(
        '#type' => 'checkbox',
        '#title' => t('Check this option if you do not want to update user role if roles not mapped'),
        '#default_value' => variable_get('miniorange_saml_disable_role_update'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_disable_autocreate_users'] = array(
        '#type' => 'checkbox',
        '#title' => t('Check this option if you want to disable <b>auto creation</b> of users if user does not exist.'),
        '#default_value' => variable_get('miniorange_saml_disable_autocreate_users', ''),
        '#disabled' => $disabled,
    );

    $mrole= user_roles($membersonly = TRUE);
    $drole = array_search(variable_get('miniorange_saml_default_role',''),$mrole);
    $str = '';
   
    foreach ($mrole as $value) {
      $str .= '<option value='.$value.'>'.$value.'</option>';                                            
    }

    $form['miniorange_saml_default_mapping'] = array(
       '#type' => 'select',
       '#title' => t('Select default group for the new users'),
       '#options' => $mrole,
       '#default_value' => $drole,
       '#attributes' => array('style' => 'width:73%'),
       '#disabled' => $disabled,
    );

    $form['role_option_string'] = array(
      '#markup' => '<p  id="role_string" hidden>'.$str.'</p>'
    );
    
    $form['markup_idp_user_role_header'] = array(
        '#markup' => '</br><h3> Role Attributes<input type="button" class="btn btn-primary" style="width:3%;margin-left:2%;margin-right:2%;" value="+" onclick="add_role();" /> </h3>',
    );

    $form['markup_idp_user_role_header1'] = array(
        '#markup' => '<div id="userSpRoleDiv"><div class="row" id="before_role_list_upa">'
        . ' <div style="width:25%;display:inline-block;"><b>SP Role</b></div><div style="width:30%;display:inline-block;">'
        . ' <b>&nbsp;IdP Role</b></div></div>'
    );

    $role_counter = 0;
    $userSpRoles = variable_get('miniorange_saml_sp_role_names', '');
    if(isset($userSpRoles) && !empty($userSpRoles)){
        $userSpRoles = json_decode($userSpRoles, true); 
        foreach($userSpRoles as $sp_role){
            $selected_string = '';
            foreach ($mrole as $value) {
            
              if($sp_role == $value)
                $selected_string .= '<option value='.$value.' selected>'.$value.'</option>';
              else
                $selected_string .= '<option value='.$value.'>'.$value.'</option>';                                            
            }
            $rolelabel = str_replace(' ','',$sp_role);
            $idp_roles = variable_get('miniorange_saml_role_' . $rolelabel,'');

            $form['markup_idp_user_role_list_' . $role_counter] = array(
                '#markup' => '<div class="row userRole" style="padding-bottom:1%;" id="role_' . $role_counter . '" >
                       <div style="width:25%;display:inline-block;">
                             <select name="user_sp_role_name[' . $role_counter . ']" class="form-control sp_role_class">'.$selected_string.'</select>
                       </div>
                       <div style="width:45%;display:inline-block;">
                           <input type="text" name="user_idp_role_name[' . $role_counter . ']" value="' . $idp_roles .'" class="form-text" placeholder="semi-colon(;) separated"/>
                       </div>
                       <div style="width:25%;display:inline-block;">
                           <input type="button" id="'.$role_counter.'" class="btn btn-danger" style="width:10%;" value="-" onclick="remove_role(this.id);" />
                       </div>
                     </div>'
                );
            $role_counter+=1;
        }
    }

    $form['markup_idp_user_role_header2'] = array(
      '#markup' => '<br />',
    );

    $form['markup_idp_user_attr_header2'] = array(
      '#markup' => '<br />',
    );

     $form['markup_idp_log_url_header'] = array(
        '#markup' => '<div id="logUrlDiv"><div class="row" id="before_log_url_upa"><h3>Custom Login/Logout (Optional)<input type="button" class="btn btn-primary" style="width:3%;margin-left:2%;margin-right:2%;" value="+" onclick="add_url();" /> </h3></div>',
    );

    $log_url_counter = 0;
    $logUrlClass = variable_get('miniorange_saml_log_url_class','');
  
    if(isset($logUrlClass) && !empty($logUrlClass)){
        $logUrlClass = json_decode($logUrlClass, true); 
        foreach($logUrlClass as $sp_role){
            $selected_string = '';
            foreach ($mrole as $value) {
            
              if($value == $sp_role){
                $selected_string .= '<option value='.$value.' selected>'.$value.'</option>';
              }
              else
                $selected_string .= '<option value='.$value.'>'.$value.'</option>';                                            
            }
            
            $login_url = variable_get(str_replace(' ','',$sp_role . '_sin'),'');
            $logout_url = variable_get(str_replace(' ','',$sp_role . '_sout'),'');

            $form['markup_idp_log_url_list_' . $log_url_counter] = array(
                '#markup' => '<div class="row logUrl" style="padding-bottom:1%;" id="url_' . $log_url_counter . '" >
                       <div style="width:68%;display:inline-block;">
                          <select name="role_class[' . $log_url_counter . ']" class="form-control sp_role_class">'.$selected_string.'</select>
                       </div>
                       <div style="width:25%;display:inline-block;margin-left:22px;">
                           <input type="button" id="'.$log_url_counter.'" class="btn btn-danger" style="width:10%;" value="-" onclick="remove_url(this.id);" />
                       </div></br></br>
                       <div style="width:76%;display:inline-block;">
                           <input type="text" name="login_url[' . $log_url_counter . ']" value="' . $login_url .'" class="form-text" placeholder="Enter Custom Login Url"/>
                       </div></br></br>
                       <div style="width:76%;display:inline-block;">
                           <input type="text" name="logout_url[' . $log_url_counter . ']" value="' . $logout_url .'" class="form-text" placeholder="Enter Custom Logout Url"/>
                       </div>
                     </div>'
                );
            $log_url_counter+=1;
        }
    }

    $form['miniorange_saml_div_end'] = array(
        '#markup' => '<br>',
    );

    $form['miniorange_saml_gateway_config_submit'] = array(
        '#type' => 'submit',
        '#value' => t('Save Configuration'),
        '#submit' => array('miniorange_saml_save_mapping_settings'),
        '#disabled' => $disabled,
        '#attributes' => array('style' => 'display:block;margin-left:auto;margin-right:auto;border-radius: 4px;background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;box-shadow: 0 1px 0 #337ab7;border-color: #337ab7 #337ab7 #337ab7;'),
    );

    $form['miniorange_saml_support_srart'] = array(
        '#markup' => '</div></div></div></div>'
    );

     Utilities::show_attr_list_from_idp($form, $form_state);

    return $form;

 }

  function miniorange_saml_save_mapping_settings($form, &$form_state) {

      $enable_rolemapping = $form['miniorange_saml_enable_rolemapping']['#value'];
      $idp_attribute1_name = $form['miniorange_saml_idp_attr1_name']['#value'];
      $sp_attribute2_name = $form['miniorange_saml_attr2_name']['#value'];
      $idp_attribute2_name = $form['miniorange_saml_idp_attr2_name']['#value'];
      $sp_attribute3_name = $form['miniorange_saml_attr3_name']['#value'];
      $idp_attribute3_name = $form['miniorange_saml_idp_attr3_name']['#value'];
      $sp_attribute4_name = $form['miniorange_saml_attr4_name']['#value'];
      $idp_attribute4_name = $form['miniorange_saml_idp_attr4_name']['#value'];
      $sp_attribute5_name = $form['miniorange_saml_attr5_name']['#value'];
      $idp_attribute5_name = $form['miniorange_saml_idp_attr5_name']['#value'];
      $mrole= user_roles($membersonly = TRUE);
      
      $login_by = $form['miniorange_saml_account_username_by']['#value'];
      $username_attribute = $form['miniorange_saml_username_attribute']['#value'];
      $email_attribute = $form['miniorange_saml_email_attribute']['#value'];
      $disable_role_update = $form['miniorange_saml_disable_role_update']['#value'];
      $enable_autocreate_users = $form['miniorange_saml_disable_autocreate_users']['#value'];
      $default_mapping= $form['miniorange_saml_default_mapping']['#value'];

     /* Updated User Profile Attributes*/
      $user_profile_attr_names = array_key_exists('user_profile_attr_name', $_POST) ? $_POST['user_profile_attr_name'] : array();
      $user_profile_attr_values   = array_key_exists('user_profile_attr_value', $_POST) ? $_POST['user_profile_attr_value'] : array();
      $attribute_mapping = array();
      foreach($user_profile_attr_names as $key => $value){
          if(!empty(trim($value)) && !empty(trim($user_profile_attr_values[$key]))){
                  $attr_name = trim($value);;
                  $attr_value = trim($user_profile_attr_values[$key]);
                  $attribute_mapping[$attr_name] = $attr_value;
          }
      }
      $attribute_mapping = json_encode($attribute_mapping);

      if($enable_rolemapping == 1) {
        $enable_rolemapping = TRUE;
      }
      else {
        $enable_rolemapping = FALSE;
      }

      if ($enable_autocreate_users == 1) {
        $enable_autocreate_users = TRUE;
      }
      else {
        $enable_autocreate_users = FALSE;
      }

      if ($disable_role_update == 1) {
        $disable_role_update = TRUE;
      }
      else {
        $disable_role_update = FALSE;
      }

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

      if($enable_rolemapping) {
        $rolemap = array();
        //array to store data entered by user and to show after saving 
        $user_sp_role_names = array_key_exists('user_sp_role_name', $_POST) ? $_POST['user_sp_role_name'] : array();
        $user_idp_role_names = array_key_exists('user_idp_role_name', $_POST) ? $_POST['user_idp_role_name'] : array();
      
        foreach($user_sp_role_names as $key => $value){
            $rolelabel = str_replace(' ','',$value);
            $temp = $user_idp_role_names[$key];
            variable_set('miniorange_saml_role_' . $rolelabel,$temp);
            $arr= explode(";",$temp);
            foreach($arr as $val)
              $rolemap[$val] = $value;
        }
            
            $user_sp_role_names = json_encode($user_sp_role_names);
            variable_set('miniorange_saml_sp_role_names',$user_sp_role_names);

            variable_set('rolemap',$rolemap);

            variable_set('miniorange_saml_default_role', $mrole[$default_mapping]);
      }
      else
      {
          foreach($mrole as $key => $value)
          {
              $rolelabel = str_replace(' ','',$value);
              variable_set('miniorange_saml_role_' . $rolelabel,'');
          }
          variable_set('rolemap','');
          variable_set('miniorange_saml_default_role', $mrole[2]);
      }

      //Custom Login/Logout Url
        $url_array = array();
        $role_class = array_key_exists('role_class', $_POST) ? $_POST['role_class'] : array();
        $login_url = array_key_exists('login_url', $_POST) ? $_POST['login_url'] : array();
        $logout_url = array_key_exists('logout_url', $_POST) ? $_POST['logout_url'] : array();

        foreach($login_url as $key => $value){
          variable_set(str_replace(' ','',$role_class[$key] . '_sin'),$value);
          variable_set(str_replace(' ','',$role_class[$key] . '_sout') ,$logout_url[$key]);
        }
          $role_class = json_encode($role_class);
          variable_set('miniorange_saml_log_url_class',$role_class);

          variable_set('miniorange_saml_login_by', $login_by);
          variable_set('miniorange_saml_username_attribute', $username_attribute);
          variable_set('miniorange_saml_email_attribute', $email_attribute);
          variable_set('miniorange_saml_disable_autocreate_users', $enable_autocreate_users);
          variable_set('miniorange_saml_disable_role_update',$disable_role_update);

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
function clear_attr_list(&$form,$form_state){
    variable_del('miniorange_saml_attrs_list');
    variable_del('miniorange_saml_email_id_value');
    Utilities::show_attr_list_from_idp($form, $form_state);
}
