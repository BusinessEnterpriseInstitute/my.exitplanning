<?php
/**
 * @file
 * Contains Service Provider information for miniOrange SAML Login Module.
 */

 /**
 * Showing Service Provider information.
 */
 function miniorange_sp_information($form, &$form_state)
 {
    global $base_url;
    drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));

    $issuer = variable_get('miniorange_saml_entity_id','');
    $b_url = Utilities::miniorange_get_baseURL();
    $issuer_id = isset($issuer) && !empty($issuer)? $issuer:$base_url;

    $module_path = drupal_get_path('module', 'miniorange_saml');

    if(substr($b_url, -1) == '/'){
    	$acs_url = $b_url . '?q=samlassertion';
    	$logout_url = $b_url . 'user/logout';
    }else{
	    $acs_url = $b_url . '/?q=samlassertion';
	    $logout_url = $b_url . '/user/logout';
    }
    $disabled = Utilities::isCustomerRegistered($form, $form_state);
    $form['header_top_style_1'] = array('#markup' => '<div class="mo_saml_table_layout_1">');

    $form['markup_top'] = array(
        '#markup' => '<div class="mo_saml_table_layout mo_saml_container"><h3>CONFIGURE IDENTITY PROVIDER</h3><hr><br>',
    );


    // if(variable_get('miniorange_saml_license_key', NULL) == NULL &&
    //     variable_get('miniorange_saml_customer_admin_email', NULL) != NULL)
    // {
    //     return $form;
    // }


   $form['mo_saml_metadata_options'] = array(
     '#markup' => '<br><div style="color: #5cb85c;"><b>Provide this module information to your Identity Provider team. You can choose any one of the below options:</b></div>',
   );

   $form['mo_saml_metadata_urls'] = array(
     '#markup' => '<br><b>a) Provide this metadata URL to your Identity Provider:</b><br>',
   );

     $form['markupsp_sp_md_2'] = array(
         '#markup' => '<div><div class="mo_saml_highlight_background_url_note" "><code id="mo_saml_idp_vt_metadata"><b>'
             . '<span id="idp_metadata_url"><a target="_blank" href="' .  $base_url . '/?q=mosp_metadata">' .  $base_url . '/includes/metadata/?q=mosp_metadata' . '</a></span></b></code></div>
            <img class ="fa fa-fw fa-lg fa-copy mo_copy" style="margin-left: 10px;" onclick="copyToClipboard(\'#idp_metadata_url\');" src="'. $base_url.'/'.$module_path . '/includes/images/copy-regular.svg"><br></div>',
     );

   $form['mo_saml_download_btn_title'] = array(
     '#markup' => '<br><br><div><b>b) Download the Module XML metadata and upload it on your Identity Provider : </b>
                        <span><a href="'.$base_url.'/?q=mosp_download_metadata" class="btn btn-primary btn-large mo_saml_btn" style="padding: 4px 10px;">Download XML Metadata</a></span></div>',
   );


   $form['mo_saml_copy_endpoints'] = array(
     '#markup' => '<br><br><div><b>c) Provide the following information to your Identity Provider. Copy it and keep it handy.</b></div><br>',
   );

     $form['mo_saml_attrs_list_idp'] = array(
         '#markup' => '<div class="table-responsive" style="font-family: sans-serif;font-size: 12px;">
                <table class="mo_guide_table mo_guide_table-striped mo_guide_table-bordered" style="border: 1px solid #ddd;max-width: 100%;border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th class="mo_guide_text-center mo_td_values">ATTRIBUTE</th>
                            <th class="mo_guide_text-center mo_td_values">VALUE</th>
                            <tbody style="font-size: 12px;color:gray;">
                                <tr>
                                    <td style="font-weight:bold;padding: 15px;">Issuer</td>
                                    <td>
						               <span id="issuer_id">' . $issuer_id . '</span>
                                       <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#issuer_id\');" src="'. $base_url.'/'.$module_path . '/includes/images/copy-regular.svg">
						            </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;padding: 15px;">ACS URL</td>
                                    <td>
						               <span id="acs_url">' . $acs_url . '</span>
						               <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#acs_url\');" src="'. $base_url.'/'.$module_path . '/includes/images/copy-regular.svg">
						            </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;padding: 15px;">Audience URI</td>
                                    <td>
						               <span id="base_url">' . $issuer_id . '</span>
						               <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#base_url\');" src="'. $base_url.'/'.$module_path . '/includes/images/copy-regular.svg">
						            </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;padding: 15px;">Recipient URL</td>
                                     <td>
						               <span id="bacs_url">' . $acs_url . '</span>
						               <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#bacs_url\');" src="'. $base_url.'/'.$module_path . '/includes/images/copy-regular.svg">
						            </td>
                                </tr><tr>
                                    <td style="font-weight:bold;padding: 15px;">Destination URL</td>
                                    <td>
						               <span id="destination">' . $acs_url . '</span>
						               <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#destination\');" src="'. $base_url.'/'.$module_path . '/includes/images/copy-regular.svg">
						            </td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;padding: 15px;">Single Logout URL</td>
                                    <td>
                                        <span id="slout">' . $logout_url . '</span>
						                <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#slout\');" src="'. $base_url.'/'.$module_path . '/includes/images/copy-regular.svg">
                                    </td>
                                 </tr>',
     );

     $custom_cert = "";
     $custom_cert = variable_get( 'miniorange_saml_publ_certificate' );
     $download_cert = '';
     if( $custom_cert != "")
     {
         $download_cert .= '<tr>
                              <td style="font-weight:bold;padding: 15px;">Certificate (Optional)</td>
                              <td><a href="' . $b_url . '/' . $module_path . '/resources/Custom_Public_Certificate.crt" target="_blank">Click here</a> to download the certificate.</td>
                           </tr>';
     }
     else{
         $download_cert .= '<tr>
                              <td style="font-weight:bold;padding: 15px;">Certificate (Optional)</td>
                              <td><a href="' . $b_url . '/' . $module_path . '/resources/sp-certificate.crt" target="_blank">Click here</a> to download the certificate.</td>
                           </tr>';
     }

     $form['miniorange_saml_sp_metadata_script'] = array(
         '#markup' => '<tr>'.$download_cert.'</tr>
                       <tr>
                          <td style="font-weight:bold;padding: 15px;">NameID Format</td>
                          <td style="padding: 15px;">urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress</td>
                       </tr>
                     </tbody>
                   </tr>
                 </thead>
              </table>
          <script>
              function copyToClipboard(element) {
                jQuery(".selected-text").removeClass("selected-text");
                var temp = jQuery("<input>");
                jQuery("body").append(temp);
                jQuery(element).addClass("selected-text");
                temp.val(jQuery(element).text()).select();
                document.execCommand("copy");
                temp.remove();
            }
              jQuery(window).click(function(e) {
                  console.log(e.target.className);
                  if( e.target.className == undefined || e.target.className.indexOf("mo_copy") == -1)
                   jQuery(".selected-text").removeClass("selected-text");
              });
          </script>'
     );

     $form['mo_saml_div_sep_end'] = array(
         '#markup' => '</div></div>',
     );

     Utilities::AddsupportTab( $form, $form_state);
     Utilities::faq($form, $form_state);

     $form['mo_saml_endpoints_div'] = array(
         '#markup' => '<div class="mo_saml_table_layout mo_saml_container"><h4>SERVICE PROVIDER ENDPOINTS:</h4><hr><br>',
     );
     $form['miniorange_saml_base_url'] = array(
         '#type' => 'textfield',
         '#title' => t('SP Base URL:'),
         '#default_value' => $b_url,
         '#attributes' => array('style' => 'width:73%'),
         '#disabled' => $disabled,
     );

     $form['miniorange_saml_entity_id'] = array(
         '#type' => 'textfield',
         '#title' => t('SP Entity ID/Issuer:'),
         '#default_value' => $issuer_id,
         '#attributes' => array('style' => 'width:73%'),
         '#description' => t('<b>Note:</b> If you have already shared the above URLs or Metadata with your IdP, do NOT change SP EntityID.<br> It might break your existing login flow.'),
         '#disabled' => $disabled,
     );

     $form['miniorange_saml_config_submit'] = array(
         '#type' => 'submit',
         '#value' => t('Update'),
         '#submit' => array('miniorange_saml_save_config'),
         '#disabled' => $disabled,
         '#attributes' => array('style' => 'border-radius:4px;background: #337ab7;color: #ffffff;text-shadow: 0 -1px 1px #337ab7, 1px 0 1px #337ab7, 0 1px 1px #337ab7, -1px 0 1px #337ab7;
          box-shadow: 0 2px 0 #006799;border-color: #337ab7 #337ab7 #337ab7;display: block;margin-left: auto;margin-right: auto;'),
     );


     return $form;

}

 function miniorange_saml_save_config($form, &$form_state) {
 $b_url = $form['miniorange_saml_base_url']['#value'];
 $issuer_id = $form['miniorange_saml_entity_id'] ['#value'];
 variable_set('miniorange_saml_base_url', $b_url);
 variable_set('miniorange_saml_entity_id', $issuer_id);
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
