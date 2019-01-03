<?php

/**
 * @file
 * Campaign Monitor subscribers module admin settings.
 */

/*
 * Subscriber add form.
 */
function cm_subscriber_form($form, &$form_state, $list = NULL) {
  $breadcrumb = array();
  drupal_set_breadcrumb($breadcrumb);
  global $user;
  $title = 'Create subscriber';
  drupal_set_title($title);
  $form_state['cm_list'] = $list;
  $form['email'] = array(
    '#type' => 'textfield',
    '#title' => t('E-mail Address'),
    '#required' => TRUE,
    '#element_validate' => array('campaign_monitor_subscribers_email_validate'),
  );
  $form['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Name'),
  );
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
    '#attributes' => array(
      'class' => array('button small'),
    ),
  );
  $form['actions']['cancel'] = array(
    '#type' => 'markup',
    '#markup' => l(t('Cancel'), 'cm-list/' . entity_id('cm_list', $list) . '/subscribers', array('attributes' => array('id' => 'edit-cancel'))),
  );
  return $form;
}
/**
 * Implementation of hook_validate().
 *
 * Errors should be signaled with form_set_error().
 */
function campaign_monitor_subscribers_email_validate($element, &$form_state, $form) {
  if (!valid_email_address($element['#value'])) {
    form_error($element, t($element['#title'] . ' is not a valid email address.'));
  }
}
function cm_subscriber_form_submit(&$form, &$form_state) {
  $values = $form_state['values'];
  $list = $form_state['cm_list'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Subscribers', $list->list_id);
  if ($wrap) {
    $result = $wrap->add(array(
      'EmailAddress' => $values['email'],
      'Name' => $values['name'],
      'ConsentToTrack' => 'Unchanged',
    ));
    if ($result->was_successful()) {
      $form_state['redirect'] = 'cm-list/' . $list->id . '/subscribers';
      $message = t('Added new E-mail address %email to List %list', array('%email' => $values['email'], '%list' => entity_label('cm_list', $list)));
      drupal_set_message($message);
    }
    else {
      $error = $result->response->Message;
      $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }
}

/**
 * Delete confirmation form.
 */
function campaign_monitor_subscribers_delete_form($form, &$form_state, $list) {
  $breadcrumb = array();
  drupal_set_breadcrumb($breadcrumb);
  $email = $_GET['email'];
  $form_state['email'] = $email;
  $form_state['cm_list'] = $list;
  $list_uri = entity_uri('cm_list', $list);
  return confirm_form($form,
    t('Are you sure you want to delete e-mail %email from your list?', array('%email' => $email)),
    $list_uri['path'] . '/subscribers',
    t('This action cannot be undone.'),
    t('Delete'),
    t('Cancel')
  );
}
/**
 * Delete form submit handler.
 */
function campaign_monitor_subscribers_delete_form_submit($form, &$form_state) {
  $list = $form_state['cm_list'];
  $email = $form_state['email'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Subscribers', $list->list_id);
  $redirect = 'cm-list/' . $list->id . '/subscribers';
  if ($wrap) {
    $result = $wrap->delete($email);
    if ($result->was_successful()) {
      drupal_set_message(t('E-mail %email was deleted from list %list.', array('%email' => $email, '%list' => entity_label('cm_list', $list))));
    }
    else {
      $error = $result->response->Message;
      $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }
  $form_state['redirect'] = $redirect;
}
/**
 * Update page callback for subscribers.
 */
function campaign_monitor_subscribers_update_page($list) {
  $breadcrumb = array();
  drupal_set_breadcrumb($breadcrumb);
  $email = $_GET['email'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Subscribers', $list->list_id);
  $result = $wrap->get($email);
  $output = '';
  if ($result->was_successful()) {
    $subscriber = $result->response;
    $form = drupal_get_form('campaign_monitor_subscribers_update_form', $list, $subscriber);
    $output = drupal_render($form);
  }
  else {
    $error = $result->response->Message;
    $output = '<p class="panel callout warning">' . $error . '</p>';
    if (!empty($_GET['destination'])) {
      $output .= l(t('Return to previous page'), $_GET['destination']);
    }
  }
  return $output;
}
/**
 * Campaign monitor subscribers update form.
 */
function campaign_monitor_subscribers_update_form($form, &$form_state, $list, $subscriber) {
  $form_state['cm_list'] = $list;
  $form_state['old_email'] = $subscriber->EmailAddress;
  $is_deleted = $subscriber->State == 'Deleted' ? TRUE : FALSE;
  $form['email'] = array(
    '#type' => 'textfield',
    '#title' => t('E-mail Address'),
    '#default_value' => $subscriber->EmailAddress,
    '#required' => TRUE,
    '#element_validate' => array('campaign_monitor_subscribers_email_validate'),
  );
  $form['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Name'),
    '#default_value' => $subscriber->Name,
  );
  // Add resubscribe checkbox if deleted status.
  if ($is_deleted) {
    $form['resubscribe'] = array(
      '#type' => 'checkbox',
      '#title' => t('Resubscribe'),
    );
  }
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
    '#attributes' => array(
      'class' => array('button small'),
    ),
  );
  if (!empty($_GET['destination'])) {
    $form['actions']['cancel'] = array(
      '#type' => 'markup',
      '#markup' => l(t('Cancel'), $_GET['destination'], array('attributes' => array('id' => 'edit-cancel'))),
    );
  }
  
  return $form;
}
function campaign_monitor_subscribers_update_form_submit(&$form, &$form_state) {
  $list = $form_state['cm_list'];
  $old_email = $form_state['old_email'];
  $values = $form_state['values'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Subscribers', $list->list_id);
  $change_values = array(
    'ConsentToTrack' => 'Unchanged',
  );
  $resubscribe = !empty($values['resubscribe']) ? TRUE : FALSE;
  $result = $wrap->update($old_email, array(
    'Name' => $values['name'],
    'EmailAddress' => $values['email'],
    'ConsentToTrack' => 'Unchanged',
    'Resubscribe' => $resubscribe,
  ));
  if ($result->was_successful()) {
    drupal_set_message(t('Subscriber details updated.'));
  }
  else {
    $error = $result->response->Message;
    $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
    drupal_set_message($message, 'error');
    $form_state['rebuild'] = TRUE;
  }
}

