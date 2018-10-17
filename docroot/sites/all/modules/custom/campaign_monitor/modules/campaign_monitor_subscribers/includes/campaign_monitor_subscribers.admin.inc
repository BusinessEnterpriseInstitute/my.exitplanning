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
  $subscriber = $form_state['cm_subscriber'];
  $is_new = isset($subscriber->is_new) || !isset($subscriber->id);
  if ($is_new) {
    $list = $form_state['cm_list'];
    if (!valid_email_address($element['#value'])) {
      form_error($element, t($element['#title'] . ' is not a valid email address.'));
    }
    /*
    else {
      $unique = campaign_monitor_subscribers_unique_email($element['#value'], $list->list_id);
      if (is_array($unique)) {
        $status = $unique['status'];
        // Email is already on the current list.
        if ($unique['match'] == 'self') {
          $message = t($element['#title'] . ' already exists on your list with a status of !status.', array('!status' => $status));
        }
        elseif ($unique['match'] == 'other') {
          $message = t($element['#title'] . ' already exists on another list.');
        }
        form_error($element, $message);
      }
    }*/
  }
}
function cm_subscriber_form_submit(&$form, &$form_state) {
  $values = $form_state['values'];
  $list = $form_state['cm_list'];
  $subscriber = $form_state['cm_subscriber'];
  $wrap = campaign_monitor_get_api_object('CS_REST_Subscribers', $list->list_id);
  $is_new = isset($subscriber->is_new) || !isset($subscriber->id);
  if ($is_new) {
    if ($wrap) {
      $result = $wrap->add(array(
        'EmailAddress' => $values['email'],
        'Name' => $values['name'],
        'ConsentToTrack' => 'Unchanged',
      ));
      if ($result->was_successful()) {
        /*
        $subscriber->lid = $list->id;
        $subscriber->list_id = $list->list_id;
        $subscriber->email = $values['email'];
        $subscriber->name = $values['name'];
        $subscriber->state = 'Active';
        $subscriber->uid = $list->uid;
        $subscriber->save();*/
        
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
  else {
    $unchanged_subscriber = entity_load_unchanged('cm_subscriber', $subscriber->id);
    $changed = FALSE;
    $messages = array();
    if ($unchanged_subscriber->email != $values['email']) {
      $changed = TRUE;
      $messages[] = t('Updated e-mail address %old_email to %new_email', array('%old_email' => $unchanged_subscriber->email, '%new_email' => $values['email']));
    }
    if ($unchanged_subscriber->name != $values['name']) {
      $changed = TRUE;
      $messages[] = t('Updated name %old_name to %new_name', array('%old_name' => $unchanged_subscriber->name, '%new_name' => $values['name']));
    }
    if (!empty($values['resubscribe'])) {
      $changed = TRUE;
      $messages[] = t('Resubscribed this e-mail to %list.', array('%list' => entity_label('cm_list', $list)));
    }
    if ($changed) {
      $result = $wrap->update($unchanged_subscriber->email, array(
        'EmailAddress' => $values['email'],
        'Name' => $values['name'],
        'ConsentToTrack' => 'Unchanged',
        'Resubscribe' => isset($values['resubscribe']) ? $values['resubscribe'] : FALSE,
      ));
      if ($result->was_successful()) {
        $subscriber->email = $values['email'];
        $subscriber->name = $values['name'];
        if (!empty($values['resubscribe'])) {
          $subscriber->state = 'Active';
        }
        $subscriber->save();
        foreach ($messages as $message) {
          drupal_set_message($message);
        }
      }
      else {
        $error = $result->response->Message;
        $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
        drupal_set_message($message, 'error');
      }
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

