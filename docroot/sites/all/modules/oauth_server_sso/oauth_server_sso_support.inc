<?php
//@author: miniOrange
include_once 'includes/miniorange_support.php';
/**
 * @file
 * Contains support form for miniOrange OAuth Server Login Module.
 */

 /**
 * Showing Support form info.
 */
 function oauth_server_sso_support($form, &$form_state) {
 $form['#prefix'] = '<div style="background-color: rgb(241,241,241) ; padding: 20px">';
 $form['#suffix'] = '</div>';

  $form['markup_1'] = array(
    '#markup' => '<h3>Support</h3><div>Need any help? Just send us a query so we can help you.<br /><br /></div>',
  );

  $form['oauth_server_sso_email_address'] = array(
    '#type' => 'textfield',
    '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
    '#suffix' => "</div>",
    '#id' =>'text_field',
    '#title' => t('Email Address'),
    '#attributes' => array('placeholder' => 'Enter your email'),
     '#required' => TRUE
  );

  $form['oauth_server_sso_phone_number'] = array(
    '#type' => 'textfield',
    '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
    '#suffix' => "</div>",
    '#id' =>'text_field',
    '#title' => t('Phone number'),
    '#attributes' => array('placeholder' => 'Enter your phone number'),
  );

  $form['oauth_server_sso_support_query'] = array(
    '#type' => 'textarea',
    '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
    '#suffix' => "</div>",
    '#id' =>'text_field',
    '#title' => t('Query'),
    '#cols' => '10',
    '#rows' => '5',
    '#attributes' => array('placeholder' => 'Write your query here'),
    '#required' => TRUE,
  );

  $form['oauth_server_sso_support_submit'] = array(
    '#type' => 'submit',
     '#prefix' => "<div  style='background-color: white; padding: 10px ;margin-left: 20px; width: 70%'>",
    '#suffix' => "</div>",
    '#id' => 'button_config',
    '#value' => t('Submit Query'),
    '#submit' => array('oauth_server_sso_send_query'),
  );
  return $form;
 }

 /**
  * Send support query.
  */
 function oauth_server_sso_send_query($form, &$form_state) {
    $email = $form['oauth_server_sso_email_address']['#value'];
    $phone = $form['oauth_server_sso_phone_number']['#value'];
    $query = $form['oauth_server_sso_support_query']['#value'];
    $support = new MiniorangeOAuthServerSupport($email, $phone, $query);
    $support_response = $support->sendSupportQuery();
    if($support_response) {
      drupal_set_message(t('Support query successfully sent'));
    }
    else {
    	drupal_set_message(t('Error sending support query'), 'error');
    }
 }