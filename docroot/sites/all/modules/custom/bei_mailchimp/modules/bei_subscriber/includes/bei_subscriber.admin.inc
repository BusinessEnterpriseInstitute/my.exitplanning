<?php

/**
 * Menu callback form.
 *
 * @see bei_subscriber_menu()
 */
function bei_subscriber_form($form, &$form_state, $subscriber) {
  $form_state['bei_subscriber'] = $subscriber;
  $disabled = FALSE;
  if (isset($subscriber->is_new) && $list = menu_get_object()) {
    $form_state['bei_list'] = $list;
  }
  $subscriber_id = entity_id('bei_subscriber', $subscriber);
  if (!empty($subscriber_id)) {
    $disabled = TRUE;
  }
  $form['email'] = array(
    '#type' => 'textfield',
    '#title' => t('Email Address'),
    '#default_value' => isset($subscriber->email) ? $subscriber->email : '',
    '#required' => TRUE,
    '#element_validate' => array('bei_subscriber_email_validate'),
    '#disabled' => $disabled,
  );
  $form['first_name'] = array(
    '#type' => 'textfield',
    '#title' => t('First Name'),
    '#default_value' => isset($subscriber->first_name) ? $subscriber->first_name : '',
    '#required' => FALSE,
  );
  $form['last_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Last Name'),
    '#default_value' => isset($subscriber->last_name) ? $subscriber->last_name : '',
    '#required' => FALSE,
  );
  field_attach_form('bei_subscriber', $subscriber, $form, $form_state);
  $form['actions'] = array('#type' => 'actions');
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );
  // Show Delete button if we edit subscriber.
  if (!empty($subscriber_id) && bei_subscriber_access('delete', $subscriber)) {
    $form['actions']['delete'] = array(
      '#type' => 'submit',
      '#value' => t('Delete'),
      '#submit' => array('bei_subscriber_form_submit_delete'),
    );
  }
  return $form;
}
/**
 * Implementation of hook_validate().
 *
 * Errors should be signaled with form_set_error().
 */
function bei_subscriber_email_validate($element, &$form_state, $form) {
  $subscriber = $form_state['bei_subscriber'];
  if (isset($subscriber->is_new)) {
    $list = $form_state['bei_list'];
    if (!valid_email_address($element['#value'])) {
      form_error($element, t($element['#title'] . ' is not a valid email address.'));
    }
    else {
      $unique = _bei_subscriber_unique_email($element['#value'], $list->list_id);
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
    }
  }
}
function bei_subscriber_form_submit($form, &$form_state) {
  $subscriber = entity_ui_form_submit_build_entity($form, $form_state);
  // Add to mailchimp immediately instead of waiting for cron run.
  $skip_cron = TRUE;
  $is_new = isset($subscriber->is_new) || !isset($subscriber->id);
  if ($is_new) {
    $list = $form_state['bei_list'];
    $subscriber->lid = $list->nid;
    $subscriber->uid = $list->uid;
    $subscriber->list_id = $list->list_id;
    $subscriber->status = 'subscribed';
  }
  // Save and go back.
  bei_subscriber_save($subscriber, $skip_cron, $is_new);
  drupal_set_message(t('Your changes have been saved.'));
}
/*
 * Submit callback for Delete button.
 */
function bei_subscriber_form_submit_delete($form, &$form_state) {
  $subscriber = $form_state['bei_subscriber'];
  $subscriber_uri = entity_uri('bei_subscriber', $subscriber);
  unset($_GET['destination']);
  $form_state['redirect'] = $subscriber_uri['path'] . '/delete';
}
/**
 * Delete confirmation form.
 */
function bei_subscriber_delete_form($form, &$form_state, $subscriber) {
  $form_state['bei_subscriber'] = $subscriber;
  // Always provide entity id in the same form key as in the entity edit form.
  $form['subscriber_id'] = array('#type' => 'value', '#value' => entity_id('bei_subscriber', $subscriber));
  $subscriber_uri = entity_uri('bei_subscriber', $subscriber);
  return confirm_form($form,
    t('Are you sure you want to delete subscriber %title?', array('%title' => entity_label('bei_subscriber', $subscriber))),
    $subscriber_uri['path'],
    t('This action cannot be undone.'),
    t('Delete'),
    t('Cancel')
  );
}
/**
 * Delete form submit handler.
 */
function bei_subscriber_delete_form_submit($form, &$form_state) {
  $subscriber = $form_state['bei_subscriber'];
  $lid = $subscriber->lid;
  bei_subscriber_delete($subscriber);

  drupal_set_message(t('Subscriber %email deleted.', array('%email' => $subscriber->email)));

  $form_state['redirect'] = 'node/' . $lid . '/subscribers';
}

/**
 * Page callback.
 *
 * @see bei_mailchimp_menu().
 */
function bei_subscriber_batch_form() {
  $form = array();

  $form['important'] = array(
    '#type' => 'markup',
    '#prefix' => '<div>',
    '#markup' => t('Clicking submit will run a batch processor to sync subscribers with lists. Do not refresh the batch processor until it is complete.'),
    '#suffix' => '</div><br>',
  );

  $form['list'] = array(
    '#type' => 'select',
    '#title' => t('List'),
    '#description' => t('Choose the list that you would like to sync subscribers with.'),
    '#options' => bei_mailchimp_get_lists(TRUE),
  );
  $form['status'] = array(
    '#type' => 'select',
    '#title' => t('Subscriber status'),
    '#options' => array(
      'subscribed' => t('Subscribed'),
      'unsubscribed' => t('Unsubscribed'),
      'cleaned' => t('Cleaned'),
      'pending' => t('Pending'),
    ),
    '#empty_option' => t('- Select -'),
    '#required' => FALSE,
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Sync Subscribers'),
  );

  return $form;
}

/**
 * Submit handler.
 *
 * @see bei_subscriber_batch_form()
 */
function bei_subscriber_batch_form_submit($form, &$form_state) {
  // Using the list that was selected, load the List ID.
  $list_id = db_query('SELECT l.list_id FROM {bei_list} l WHERE l.nid = :nid', array(
    ':nid' => $form_state['values']['list'],
  ))->fetchField();
  if (!empty($list_id)) {
    $node = node_load($form_state['values']['list']);
    $uid = $node->uid;
    // Assign an api key if one exists.
    $existing_key = bei_mailchimp_load_key_by_user($uid);
    $mc_key = $existing_key != FALSE ? $existing_key['key'] : NULL;
    $break = FALSE;
    $total = 0;
    $subscribers = array();
    $counter = 0;
    $limit = 500;
    $fields = array(
      'total_items',
      'members.email_address',
      'members.status',
      'members.merge_fields',
      'members.timestamp_signup',
      'members.timestamp_opt',
      'members.last_changed',
      'members.list_id',
      'members.unique_email_id',
    );
    $options = array(
      'offset' => 0,
      'count' => $limit,
      'fields' => implode(',', $fields),
    );

    if (!empty($form_state['values']['status'])) {
      $options['status'] = $form_state['values']['status'];
    }
    do {
      $members = bei_subscriber_get_members($list_id, $options, $mc_key);
      if ($members) {
        $total = $members->total_items;
        //$counter += count($members->members);
        foreach ($members->members as $member) {
          $subscriber = array(
            'lid' => $node->nid,
            'uid' => $uid,
            'member_info' => $member
          );
          bei_subscriber_addto_queue('bei_subscriber_queue_import', $subscriber);
          $counter++;
        }
        $options['offset'] = $counter;
      }
    } while ($counter !== $total);
  }
}

/**
 * Grab a subscriber batch.
 */

function bei_subscriber_get_members($list_id, $options = array(), $mc_key = NULL) {
  $members = NULL;
  $mc_lists = mailchimp_get_api_object('MailchimpLists', $mc_key);
  try {
    if (!$mc_lists) {
      throw new MailchimpException('Cannot get members without MailChimp API. Check API key has been entered.');
    }
    $response = $mc_lists->getMembers($list_id, $options);
    if ($response && $response->total_items > 0) {
      $members = $response;
    }
  }
  catch (Exception $e) {
    watchdog('mailchimp', 'An error occurred pulling member info for a list. "%message"', array(
      '%message' => $e->getMessage(),
    ), WATCHDOG_ERROR);
  }
  return $members;
}
