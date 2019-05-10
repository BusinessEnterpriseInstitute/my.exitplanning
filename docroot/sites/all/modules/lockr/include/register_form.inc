<?php

/**
 * @file
 * Form handlers for registration.
 */

use Lockr\Exception\LockrClientException;
use Lockr\Exception\LockrServerException;

/**
 * Returns the register form.
 */
function lockr_admin_register_form(&$form_state) {
  $form = array();

  $form['instructions'] = array(
    '#markup' => t('Please enter an email below to continue installation of Lockr and securing your API and encryption keys. If the email you enter does not have a Lockr account associated with it, we will create one for you and send you a follow on email with account details.'),
  );

  $form['email'] = array(
    '#type' => 'textfield',
    '#title' => t('Email address'),
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Sign up'),
    '#validate' => array('lockr_admin_register_validate'),
    '#submit' => array('lockr_admin_register_submit'),
  );

  $next = isset($_GET['next'])
    ? $_GET['next']
    : '/admin/config/system/keys';
  $form_state['storage']['redirect'] = $next;

  return $form;
}

/**
 * Validate the register form.
 */
function lockr_admin_register_validate($form, &$form_state) {
  if (!valid_email_address($form_state['values']['email'])) {
    form_set_error('email', t('Please enter a valid email address'));
  }
}

/**
 * Submit the register form.
 */
function lockr_admin_register_submit($form, &$form_state) {
  $values = $form_state['values'];
  $next = $form_state['storage']['redirect'];
  $name = variable_get('site_name');
  try {
    lockr_site_client()->register($values['email'], NULL, $name);
  }
  catch (LockrClientException $e) {
    if ($e->title === 'Site exists') {
      drupal_set_message('This site is already registered.');
      $form_state['redirect'] = $next;
      return;
    }
    else {
      drupal_set_message(t('This email is already registered with Lockr. Please login to register a new site.'));
      drupal_goto('admin/config/system/lockr/login', array(
        'query' => array(
          'next' => $next,
          'email' => $form_state['values']['email'],
        ),
      ));
    }
  }
  catch (LockrServerException $e) {
    form_set_error('', t('An unknown error has occurred, please try again later.'));
  }

  drupal_set_message(t("That's it! You're signed up with Lockr; your keys can now be safely stored off-site."));
  $form_state['redirect'] = $next;
}
