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
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/bootstrap.min.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    drupal_add_css(drupal_get_path('module', 'miniorange_saml') . '/css/style_settings.css', array('group' => CSS_DEFAULT, 'every_page' => TRUE));
    $b_url = Utilities::miniorange_get_baseURL();
    $issuer_id = Utilities::getIssuer();

    $module_path = drupal_get_path('module', 'miniorange_saml');

    if (substr($b_url, -1) == '/') {
        $acs_url = $b_url . '?q=samlassertion';
        $logout_url = $b_url . 'user/logout';
    } else {
        $acs_url = $b_url . '/?q=samlassertion';
        $logout_url = $b_url . '/user/logout';
    }

    $form['markup_top'] = array(
        '#markup' => '<div class="mo_saml_table_layout_1"><div class="mo_saml_table_layout mo_saml_container">
                <h3>CONFIGURE IDENTITY PROVIDER</h3><hr>',
    );

    $disabled = Utilities::isCustomerRegistered($form, $form_state);

    $form['mo_saml_endpoints_div'] = array(
        '#markup' => '<br><h5>SERVICE PROVIDER ENDPOINTS:</h5>
                       <div class="mo_saml_highlight_background_note" style="width: 700px;"><b>Note:</b> If you have already shared the below URLs or Metadata with your IdP, do NOT change SP EntityID. It might break your existing login flow.</div> ',
    );
    $form['miniorange_saml_base_url'] = array(
        '#type' => 'textfield',
        '#title' => t('SP Base URL:'),
        '#default_value' => $b_url,
        '#attributes' => array('style' => 'width:700px'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_entity_id'] = array(
        '#type' => 'textfield',
        '#title' => t('SP Entity ID/Issuer:'),
        '#default_value' => $issuer_id,
        '#attributes' => array('style' => 'width:700px'),
        '#disabled' => $disabled,
    );

    $form['miniorange_saml_config_submit'] = array(
        '#type' => 'submit',
        '#value' => t('Save'),
        '#submit' => array('miniorange_saml_save_config'),
        '#disabled' => $disabled,
        '#suffix' => '<br><hr>',
    );

    $form['markup_note_sp'] = array(
        '#markup' => '<br><b><span style="color: red;">Provide this plugin information to your Identity Provider team. You can choose any one of the below options:</span> </b><br>
                        <br><b>a) You can provide this metadata URL to your Identity Provider:</b><br />',
    );

    $form['markupsp_sp_md_2'] = array(
        '#markup' => '<div><div class="mo_saml_highlight_background_url_note" "><code id="mo_saml_idp_vt_metadata"><b>'
            . '<span id="idp_metadata_url"><a target="_blank" href="' .  $b_url . '?q=mosp_metadata">' . $b_url . '?q=mosp_metadata' . '</a></span></b></code></div>
            <img class ="fa fa-fw fa-lg fa-copy mo_copy" style="margin-left: 10px;" onclick="copyToClipboard(\'#idp_metadata_url\');" src="' . $base_url . '/' . $module_path . '/includes/images/copy-regular.svg"><br></div>',
    );

    $form['mo_saml_download_btn_title'] = array(
     '#markup' => '<br><div><b>b) Download the Module XML metadata and upload it on your Identity Provider : </b>
                        <span><a href="'.$b_url.'/?q=mosp_metadata_download" class="mo_saml_btn mo_saml_btn-primary  mo_saml_btn" style="padding: 4px 10px;">Download XML Metadata</a></span></div>',
  );

    $form['header'] = array(
        '#markup' => '<br><br>
            <b>c) You will need the following information to configure your IdP. Copy it and keep it handy.</b>',
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
                                       <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#issuer_id\');" src="' . $base_url . '/' . $module_path . '/includes/images/copy-regular.svg">			
						            </td>                                    
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;padding: 15px;">ACS URL</td>
                                    <td>						               
						               <span id="acs_url">' . $acs_url . '</span>
						               <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#acs_url\');" src="' . $base_url . '/' . $module_path . '/includes/images/copy-regular.svg">       
						            </td>                                    
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;padding: 15px;">Audience URI</td>
                                    <td>						               
						               <span id="base_url">' . $issuer_id . '</span>
						               <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#base_url\');" src="' . $base_url . '/' . $module_path . '/includes/images/copy-regular.svg">        
						            </td>                                  
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;padding: 15px;">Recipient URL</td>
                                     <td>						               
						               <span id="bacs_url">' . $acs_url . '</span>
						               <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#bacs_url\');" src="' . $base_url . '/' . $module_path . '/includes/images/copy-regular.svg">       
						            </td>                                    
                                </tr><tr>
                                    <td style="font-weight:bold;padding: 15px;">Destination URL</td>
                                    <td>						               
						               <span id="destination">' . $acs_url . '</span>
						               <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#destination\');" src="' . $base_url . '/' . $module_path . '/includes/images/copy-regular.svg">       
						            </td>   
                                </tr>
                                <tr>
                                    <td style="font-weight:bold;padding: 15px;">Single Logout URL</td>
                                    <td>
                                        <span id="slout">' . $logout_url . '</span>
						                <img class ="fa fa-fw fa-pull-right fa-lg fa-copy mo_copy" onclick="copyToClipboard(\'#slout\');" src="' . $base_url . '/' . $module_path . '/includes/images/copy-regular.svg">						            
                                    </td>
                                 </tr>',
    );


    $custom_cert = variable_get('miniorange_saml_publ_certificate','');
  
    $download_cert ='<tr>
                              <td style="font-weight:bold;padding: 15px;">Certificate (Optional)</td>
                              <td><a href="' .Utilities::getCertificatePath(true).'" download="'.Utilities::getCertficateName().'" target="_blank">Click here</a> to download the certificate.</td>                                    
                    </tr>';
    $form['miniorange_saml_sp_metadata_script'] = array(
        '#markup' => '<tr>' . $download_cert . '</tr>                               
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

    Utilities::AddsupportTab($form, $form_state);

    return $form;
}

function miniorange_saml_save_config($form, &$form_state) {
    $b_url = $form['miniorange_saml_base_url']['#value'];
    $issuer_id = $form['miniorange_saml_entity_id'] ['#value'];
    variable_set('miniorange_saml_base_url', $b_url);
    variable_set('miniorange_saml_entity_id', $issuer_id);
    drupal_set_message(t('Service Provider Endpoints updated successfully.'));
}
