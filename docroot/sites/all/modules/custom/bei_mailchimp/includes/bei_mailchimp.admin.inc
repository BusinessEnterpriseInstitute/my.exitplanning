<?php
/**
 * Menu callback form.
 *
 * @see bei_mailchimp_menu()
 */
function bei_mailchimp_user_key_form($form, &$form_state, $user = NULL) {
  $form_state['user'] = $user;
  $existing_key = isset($user->uid) ? bei_mailchimp_load_key_by_user($user->uid) : FALSE;
  $mc_key = NULL;
  $form['keys_wrapper'] = array(
    '#prefix' => '<div id="keys-wrapper">',
    '#suffix' => '</div>',
  );
  if ($existing_key != FALSE) {
    $mc_key = $existing_key['key'];
    $markup = t('An api key is currently associated for account %account.', array('%account' => $existing_key['account']));
  }
  else {
    $markup = t('No api key exists for this account.');
  }
  $form['keys_wrapper']['markup'] = array(
    '#type' => 'markup',
    '#markup' => $markup,
  );
  if (isset($form_state['add_key'])) {
    $form['keys_wrapper']['mc_key'] = array(
      '#type' => 'textfield',
      '#title' => t('Mailchimp API key'),
      '#default_value' => $mc_key,
      '#required' => TRUE,
      '#element_validate' => array('bei_mailchimp_api_key_validate'),
    );
    $form['keys_wrapper']['actions'] = array(
      '#type' => 'actions',
    );
    $form['keys_wrapper']['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save'),
    );
    $form['keys_wrapper']['actions']['cancel'] = array(
      '#type' => 'submit',
      '#value' => t('Cancel'),
      '#submit' => array('bei_mailchimp_cancel_key_submit'),
      '#name' => 'cancel_button',
      '#limit_validation_errors' => array(),
      '#ajax' => array(
        'callback' => 'bei_mailchimp_user_key_form_ajax',
        'wrapper' => 'keys-wrapper',
        'method' => 'replace',
      ),
      '#attributes' => array(
        'class' => array('secondary'),
      ),
    );
  }
  else {
    $form['keys_wrapper']['actions'] = array(
      '#type' => 'actions',
    );
    $form['keys_wrapper']['actions']['add_key'] = array(
      '#type' => 'submit',
      '#value' => $mc_key ? t('Update key') : t('Add key'),
      '#submit' => array('bei_mailchimp_add_key_submit'),
      '#name' => 'add_key',
      '#ajax' => array(
        'callback' => 'bei_mailchimp_user_key_form_ajax',
        'wrapper' => 'keys-wrapper',
        'method' => 'replace',
      ),
    );
    if ($mc_key) {
      $form['keys_wrapper']['actions']['delete_key'] = array(
        '#type' => 'submit',
        '#value' => t('Delete'),
        '#submit' => array('bei_mailchimp_delete_key_submit'),
        '#name' => 'delete_key',
        '#ajax' => array(
          'callback' => 'bei_mailchimp_user_key_form_ajax',
          'wrapper' => 'keys-wrapper',
          'method' => 'replace',
        ),
        '#attributes' => array(
          'class' => array('secondary'),
        ),
      );
    }
  }
  return $form;
}
function bei_mailchimp_user_key_form_ajax($form, $form_state) {
  return $form['keys_wrapper'];
}
function bei_mailchimp_add_key_submit($form, &$form_state) {
  $form_state['add_key'] = 1;
  $form_state['rebuild'] = TRUE;
}
function bei_mailchimp_delete_key_submit($form, &$form_state) {
  $user = $form_state['user'];
  db_delete('bei_mc_keys')
  ->condition('uid', $user->uid)
  ->execute();
  $form_state['rebuild'] = TRUE;
}
function bei_mailchimp_cancel_key_submit($form, &$form_state) {
  unset($form_state['add_key']);
  $form_state['rebuild'] = TRUE;
}
function bei_mailchimp_api_key_validate($element, &$form_state, $form) {
  if (!empty($element['#value'])) {
    $account = mailchimp_get_api_object('Mailchimp', $element['#value']);
    try {
      if ($account) {
        $user = $account->getAccount();
        if (isset($user->account_name)) {
          $form_state['mc_account'] = check_plain($user->account_name);
          $message = t('The api key was found on Mailchimp for account %account', array('%account' => $user->account_name));
          drupal_set_message($message, 'status');
        }
      }
    }
    catch (Exception $e) {
      form_error($element, t('The api key ' . $element['#value'] . ' was not found on Mailchimp.'));
    }
  }
}

/**
 * Submit callback for bei_mailchimp_user_key_form().
 */
function bei_mailchimp_user_key_form_submit($form, &$form_state) {
  $user = $form_state['user'];
  $key_exists = bei_mailchimp_load_key_by_user($user->uid);
  $account_name = $form_state['mc_account'];
  if (!empty($form_state['values']['mc_key'])) {
    $mc_key = encrypt(trim($form_state['values']['mc_key']));
    if ($key_exists != FALSE) {
      db_update('bei_mc_keys')
      ->fields(array(
        'data' => $mc_key,
        'account' => $account_name,
      ))
      ->condition('uid', $user->uid)
      ->execute();
    }
    else {
      db_insert('bei_mc_keys')
      ->fields(array(
        'uid' => $user->uid,
        'account' => $account_name,
        'data' => $mc_key,
      ))
      ->execute();
    }
  }
  else {
    if ($key_exists != FALSE) {
      db_delete('bei_mc_keys')
      ->condition('uid', $user->uid)
      ->execute();
    }
  }
}

function bei_mailchimp_user_lists_form($form, &$form_state, $user = NULL) {
  $form_state['user'] = $user;
  $existing_key = isset($user->uid) ? bei_mailchimp_load_key_by_user($user->uid) : NULL;
  /*
  $form['address'] = array(
    '#type' => 'bei_addressfield',
    '#title' => t('Address'),
  );*/
  /*
  $lists_query = db_query('SELECT n.nid FROM {node} n WHERE n.type = :type AND n.uid = :uid', array(
  ':type' => 'subscriber_list', ':uid' => $user->uid))->fetchAllAssoc('nid');
  if (!empty($lists_query)) {
    $lists_query = array_keys($lists_query);
    $list_nodes = node_load_multiple($lists_query);
  }*/
  if (!$existing_key) {
    $markup = t('Unable to sync lists without an api key.');
    $form['no_key_markup'] = array(
      '#type' => 'markup',
      '#markup' => $markup,
    );
  }
  else {
    $form_state['existing_key'] = $existing_key;
    $form['sync_lists'] = array(
      '#type' => 'submit',
      '#value' => t('Import Lists'),
      '#submit' => array('bei_mailchimp_user_lists_import_submit'),
    );
  }
  return $form;
}
function bei_mailchimp_user_lists_import_submit($form, &$form_state) {
  $key = $form_state['existing_key'];
  $user = $form_state['user'];
  $mc_key = $key['key'];
  try {
    $mc_lists = mailchimp_get_api_object('MailchimpLists', $mc_key);
    if (!$mc_lists) {
      throw new MailchimpException('Cannot get lists without MailChimp API. Check API key has been entered.');
    }
    else {
      $result = $mc_lists->getLists(array('count' => 50));
      foreach ($result->lists as $list) {
        $query = "SELECT l.nid FROM {bei_list} l WHERE l.list_id = :lid";
        $nid = db_query($query, array(':lid' => $list->id))->fetchField();
        // An array of events the webhook will respond to.
        $events = array(
          'subscribe' => TRUE,
          'unsubscribe' => TRUE,
          'profile' => TRUE,
          'cleaned' => TRUE,
          'upemail' => TRUE,
          'campaign' => TRUE,
        );
        // An array of sources the webhook will respond to.
        $sources = array(
          'user' => TRUE,
          'admin' => TRUE,
          'api' => FALSE,
        );
        $parameters = array(
          'events' => (object) $events,
          'sources' => (object) $sources,
        );
        $url = bei_list_webhook_url();
        global $base_url;
        $webhooks = array();
        $webhooks_result = $mc_lists->getWebhooks($list->id);
        if (empty($nid)) {
          // The node doesn't exist. We should create it.
          $node = new stdClass();
          $node->type = 'subscriber_list';
          node_object_prepare($node);
          //$node->uid = $user->uid;
          $node->title = $list->name;
          $node->language = LANGUAGE_NONE;
          $node->list_id = $list->id;
          $node->from_name = check_plain($list->campaign_defaults->from_name);
          $node->from_email = check_plain($list->campaign_defaults->from_email);
          $node->subject = check_plain($list->campaign_defaults->subject);
        }
        else {
          $node = node_load($nid);
        }
        $add_webhook = TRUE;
        if ($webhooks_result->total_items > 0) {
          $webhooks = $webhooks_result->webhooks;
          foreach ($webhooks as $webhook) {
            if ($url == $webhook->url) {
              $add_webhook = FALSE;
            }
          }
        }
        if ($add_webhook) {
          $new_webhook = $mc_lists->addWebhook($list->id, $url, $parameters);
          if (isset($new_webhook->id)) {
            $webhooks[] = $new_webhook;
          }
        }
        $node->mc_data = array(
          'list' => $list,
          'webhooks' => $webhooks,
        );
        // Save the node!
        node_save($node);
      }
    }
  }
  catch (Exception $e){
    $error = t('An error occurred requesting list information from Mailchimp. "%message"', array(
      '%message' => $e->getMessage()
    ));
    drupal_set_message($error, 'error');
    $form_state['rebuild'] = TRUE;
  }
}
