<?php
/**
 * @file
 * Contains support form for miniOrange SAML Login Module.
 */

 /**
 * Showing Support form info.
 */
 function miniorange_saml_support($form, &$form_state)
 {
     drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/bootstrap.min.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));
     drupal_add_css( drupal_get_path('module', 'miniorange_saml'). '/css/style_settings.css' , array('group' => CSS_DEFAULT, 'every_page' => TRUE));

     $form['header_top_style_2'] = array(
         '#markup' => '<div class="mo_saml_table_layout_1">
                       <div class="mo_saml_table_layout mo_saml_container">'
     );

     $form['markup_1'] = array(
         '#markup' => '<h3>Support</h3><hr><div><br/>Need any help? Just send us a query so we can help you.<br /><br /></div>',
  );

  $form['miniorange_saml_email_address'] = array(
    '#type' => 'textfield',
    '#title' => t('Email Address'),
    '#attributes' => array('style' => 'width:65%','placeholder' => 'Enter your email'),
    '#required' => TRUE,
  );

  $form['miniorange_saml_phone_number'] = array(
    '#type' => 'textfield',
    '#title' => t('Phone number'),
    '#attributes' => array('style' => 'width:65%','placeholder' => 'Enter your phone number'),
  );

  $form['miniorange_saml_support_query'] = array(
    '#type' => 'textarea',
    '#title' => t('Query'),
    '#cols' => '10',
    '#rows' => '5',
    '#attributes' => array(
        'style' => 'width:65%',
        'placeholder' => 'Write your query here'
    ),
    '#required' => TRUE,
    '#resizable' => False,
  );

  $form['miniorange_saml_support_submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit Query'),
    '#submit' => array('miniorange_saml_send_query'),
  );

     $form['miniorange_saml_support_note'] = array(
         '#markup' => '<div>If you want custom features in the module, just drop an email to <a href="mailto:info@xecurify.com">info@xecurify.com</a></div></div></div>'
     );

  return $form;

 }

 /* Send support query.*/

 function miniorange_saml_send_query($form, &$form_state) {
    $email = $form['miniorange_saml_email_address']['#value'];
    $phone = $form['miniorange_saml_phone_number']['#value'];
    $query = $form['miniorange_saml_support_query']['#value'];
    $support = new MiniOrangeSamlSupport($email, $phone, $query);
    $support_response = $support->sendSupportQuery();
    if($support_response) {
      drupal_set_message(t('Support query successfully sent'));
    }else {
    	drupal_set_message(t('Error sending support query'), 'error');
    }
 }
