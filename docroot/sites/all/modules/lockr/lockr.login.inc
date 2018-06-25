<?php

/**
 * @file
 * Form callbacks for the Lockr login form.
 */

use Lockr\Exception\LockrClientException;
use Lockr\Exception\LockrServerException;

/**
 * Register a Lockr user with already established credentials.
 */
function lockr_login_form($form, &$form_state) {
  try {
    $status = lockr_check_registration();
  }
  catch (LockrServerException $e) {
    drupal_goto('admin/config/system/lockr');
  }

  if ($status['exists']) {
    drupal_goto('admin/config/system/lockr');
  }

  $default_email = isset($_GET['email'])
    ? $_GET['email']
    : NULL;

  $form['email'] = array(
    '#type' => 'textfield',
    '#title' => t('Email'),
    '#required' => TRUE,
    '#default_value' => $default_email,
    '#description' => t('Enter your @s email.', array('@s' => 'Lockr')),
  );

  $form['pass'] = array(
    '#type' => 'password',
    '#title' => t('Password'),
    '#required' => TRUE,
    '#description' => t('Enter the password that accompanies your email.'),
  );

  $form['actions'] = array('#type' => 'actions');
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Log in'),
  );

  $form_state['storage']['next'] = isset($_GET['next'])
    ? $_GET['next']
    : '/admin/config/system/keys/add';

  return $form;
}

/**
 * Attempt to log in with the credentials given.
 */
function lockr_login_form_validate($form, &$form_state) {
  if (!valid_email_address($form_state['values']['email'])) {
    form_set_error('email', t('Please enter a valid email address'));
  }
}

/**
 * Use login credentials to register the site.
 */
function lockr_login_form_submit($form, &$form_state) {
  $values = $form_state['values'];
  $name = variable_get('site_name');
  try {
    lockr_site_client()->register($values['email'], $values['pass'], $name);
  }
  catch (LockrClientException $e) {
    form_set_error('', t('Login credentials incorrect, please try again.'));
    return;
  }
  catch (LockrServerException $e) {
    form_set_error('', t('An unknown error has occurred, please try again later.'));
    return;
  }
  drupal_set_message(t("That's it! This site is added to Lockr; your keys are now safely stored off-site."));
  $form_state['redirect'] = $form_state['storage']['next'];
}
