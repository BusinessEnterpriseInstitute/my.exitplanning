<?php

/**
 * @file
 * Form handlers for CSR admin settings.
 */

use Lockr\Exception\LockrClientException;
use Lockr\Exception\LockrServerException;

/**
 * Returns form array for CSR settings.
 */
function lockr_admin_csr_form() {
  $dn = variable_get('lockr_cert_dn', array());

  $form['description'] = array(
    '#prefix' => '<p>',
    '#markup' =>
      'Thank you for your interest in Lockr! ' .
      'Our system is detecting that your website is not currently hosted by a supported provider. ' .
      'Use the form below to create a development certificate and start using Lockr.',
    '#suffix' => '</p>',
  );

  $form['country'] = array(
    '#type' => 'textfield',
    '#title' => 'Country',
    '#default' => isset($dn['countryName']) ? $dn['countryName'] : NULL,
    '#maxlength' => 2,
    '#required' => TRUE,
    '#attributes' => array(
      'placeholder' => array('US'),
    ),
  );

  $form['state'] = array(
    '#type' => 'textfield',
    '#title' => 'State or Province',
    '#default' => isset($dn['stateOrProvinceName']) ? $dn['stateOrProvinceName'] : NULL,
    '#required' => TRUE,
    '#attributes' => array(
      'placeholder' => array('Washington'),
    ),
  );

  $form['city'] = array(
    '#type' => 'textfield',
    '#title' => 'Locality',
    '#default' => isset($dn['localityName']) ? $dn['localityName'] : NULL,
    '#required' => TRUE,
    '#attributes' => array(
      'placeholder' => array('Seattle'),
    ),
  );

  $form['organization'] = array(
    '#type' => 'textfield',
    '#title' => 'Organization',
    '#default' => isset($dn['organizationName']) ? $dn['organizationName'] : NULL,
    '#required' => TRUE,
    '#attributes' => array(
      'placeholder' => array('ACME Inc.'),
    ),
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Create Certificate',
    '#validate' => array('lockr_admin_csr_validate'),
    '#submit' => array('lockr_admin_csr_submit'),
  );

  return $form;
}

function lockr_admin_csr_validate($form, &$form_state) {
  if (!is_dir(variable_get('file_private_path', ''))) {
    form_set_error(
      '',
      format_string(
        'File private path is not a directory, ' .
        'please <a href="@link">update the private file system path</a>. ' .
        'Preferrably to a location outside the webroot.',
        array('@link' => '/admin/config/media/file-system')
      )
    );
  }
}

function lockr_admin_csr_submit($form, &$form_state) {
  $values = $form_state['values'];

  $dn = array(
    'countryName' => $values['country'],
    'stateOrProvinceName' => $values['state'],
    'localityName' => $values['city'],
    'organizationName' => $values['organization'],
  );
  variable_set('lockr_cert_dn', $dn);

  $site_client = lockr_site_client();

  try {
    $result = $site_client->createCert($dn);
  }
  catch (LockrClientException $e) {
    watchdog_exception('lockr', $e);
    drupal_set_message(
      'Please check form inputs.',
      'error'
    );
    return;
  }
  catch (LockrServerException $e) {
    watchdog_exception('lockr', $e);
    drupal_set_message(
      'Lockr encountered an unexpected server error, please try again.',
      'error'
    );
    return;
  }

  $dir = "private://lockr/dev";

  _lockr_write_key_files($dir, $result);

  $private_wrapper = new DrupalPrivateStreamWrapper();
  $private_wrapper->setUri("{$dir}/pair.pem");
  variable_set('lockr_cert', $private_wrapper->realpath());
  variable_set('lockr_custom', TRUE);
}

