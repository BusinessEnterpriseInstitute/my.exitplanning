<?php

/**
 * @file
 * Campaign Monitor subscribers module admin settings.
 */

/*
 * Subscribers form.
 */
function campaign_monitor_subscribers_import_form($form, &$form_state, $list) {
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $list_uri = entity_uri('cm_list', $list);
  $breadcrumb[] = l(t('@list', array('@list' => entity_label('cm_list', $list))), $list_uri['path']);
  $breadcrumb[] = l(t('Subscribers'), $list_uri['path'] . '/subscribers');
  drupal_set_breadcrumb($breadcrumb);
  drupal_set_title('Sync Subscribers');
  $form_state['cm_list'] = $list;
  $form['report_type'] = array(
    '#type' => 'radios',
    '#title' => t('Subscriber status'),
    '#options' => array(
      'active' => t('Active'),
      'unconfirmed' => t('Unconfirmed'),
      'unsubscribed' => t('Unsubscribed'),
      'bounced' => t('Bounced'),
      'deleted' => t('Deleted'),
    ),
    '#required' => TRUE,
  );
  $form['actions'] = array(
    '#type' => 'actions',
  );
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );
  return $form;
}
function campaign_monitor_subscribers_import_form_submit(&$form, &$form_state) {
  $list = $form_state['cm_list'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
  $values = $form_state['values'];
  $report_type = $values['report_type'];
  $result = NULL;
  switch ($report_type) {
    case 'active':
      $result = $wrap->get_active_subscribers();
      break;
    case 'unconfirmed':
      $result = $wrap->get_unconfirmed_subscribers();
      break;
    case 'unsubscribed':
      $result = $wrap->get_unsubscribed_subscribers();
      break;
    case 'bounced':
      $result = $wrap->get_bounced_subscribers();
      break;
    case 'deleted':
      $result = $wrap->get_deleted_subscribers();
      break;
  }
  if ($result && $result->was_successful()) {
    $count = $result->response->TotalNumberOfRecords;
    if ($count >= 1) {
      $subscribers = $result->response->Results;
      $counter = 0;
      foreach ($subscribers as $item) {
        $query = 'SELECT s.id FROM {campaign_monitor_subscribers} s WHERE s.lid = :lid AND s.email = :email';
        $subscriber_exists = db_query($query, array(':lid' => $list->id, ':email' => $item->EmailAddress))->fetchField();
        if (!$subscriber_exists) {
          $subscriber = entity_create('cm_subscriber', array(
            'email' => $item->EmailAddress,
            'name' => $item->Name,
            'created' => strtotime($item->Date),
            'changed' => strtotime($item->Date),
            'state' => $item->State,
            'lid' => $list->id,
            'list_id' => $list->list_id,
            'uid' => $list->uid,
          ));
          $subscriber->save();
          $counter++;
        }
      }
      $message = t('Imported @count new subscribers for %list', array('@count' => number_format($counter), '%list' => entity_label('cm_list', $list)));
      drupal_set_message($message);
    }
    else {
      $message = t('No %type subscribers found for %list', array('%type' => $report_type, '%list' => entity_label('cm_list', $list)));
      drupal_set_message($message, 'error');
    }
  }
  else {
    $error = $result->response->Message;
    $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
    drupal_set_message($message, 'error');
  }
}
/*
 * Subscriber entity form.
 */
function cm_subscriber_form($form, &$form_state, $cm_subscriber = NULL, $list = NULL) {
  global $user;
  if (!isset($cm_subscriber->id)) {
    $cm_subscriber = entity_create('cm_subscriber', array(
      'lid' => $list->id,
      'uid' => $user->uid
    ));
  }
  $data = isset($cm_subscriber->id) ? $cm_subscriber->subscriber_data : array();
  $is_new = isset($cm_subscriber->is_new) ? TRUE : FALSE;
  if (!$is_new) {
    $title = entity_label('cm_subscriber', $cm_subscriber);
    $list = cm_list_load($cm_subscriber->lid);
  }
  else {
    $title = 'Create subscriber';
  }
  drupal_set_title($title);
  $form_state['cm_list'] = $list;
  $form_state['cm_subscriber'] = $cm_subscriber;
  $form['email'] = array(
    '#type' => 'textfield',
    '#title' => t('E-mail Address'),
    '#required' => TRUE,
    '#default_value' => isset($cm_subscriber->email) ? $cm_subscriber->email : '',
    '#element_validate' => array('campaign_monitor_subscribers_email_validate'),
  );
  $form['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Name'),
    '#default_value' => isset($cm_subscriber->name) ? $cm_subscriber->name : '',
  );
  if (!$is_new && $cm_subscriber->state == 'Deleted') {
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
  return $form;
}
/**
 * Implementation of hook_validate().
 *
 * Errors should be signaled with form_set_error().
 */
function campaign_monitor_subscribers_email_validate($element, &$form_state, $form) {
  $list = $form_state['cm_list'];
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
  $email = $_GET['email'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Subscribers', $list->list_id);
  $result = $wrap->get($email);
  $output = '';
  if ($result->was_successful()) {
    $subscriber = $result->response;
    $form = drupal_get_form('campaign_monitor_subscribers_update_form', $list, $subscriber);
    $output = drupal_render($form);
  }
  return $output;
}
/**
 * Campaign monitor subscribers update form.
 */
function campaign_monitor_subscribers_update_form($form, &$form_state, $list, $subscriber) {
  $form_state['cm_list'] = $list;
  $form_state['old_email'] = $subscriber->EmailAddress;
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
  $changed = FALSE;
  $values = $form_state['values'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Subscribers', $list->list_id);
  $change_values = array(
    'ConsentToTrack' => 'Unchanged',
  );
  $result = $wrap->update($old_email, array(
    'Name' => $values['name'],
    'EmailAddress' => $values['email'],
    'ConsentToTrack' => 'Unchanged',
  ));
  if ($result->was_successful()) {
    drupal_set_message(t('Updated subscriber %email.', array('%email' => $old_email)));
  }
  else {
    $error = $result->response->Message;
    $message = t('Failed with code @code. %error', array('@code' => $result->response->Code, '%error' => $error));
    drupal_set_message($message, 'error');
    $form_state['rebuild'] = TRUE;
  }
}

