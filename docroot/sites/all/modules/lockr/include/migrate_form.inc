<?php

/**
 * @file
 * Form handlers for migrate admin settings.
 */

use Lockr\Exception\LockrClientException;
use Lockr\Exception\LockrServerException;

function lockr_admin_migrate_form() {
  $form = array();

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Migrate to Production',
    '#submit' => array('lockr_admin_migrate_submit'),
  );

  return $form;
}

function lockr_admin_migrate_submit($form, &$form_state) {
  $cert_file = variable_get('lockr_cert');
  $cert_info = openssl_x509_parse(file_get_contents($cert_file));

  $subject = $cert_info['subject'];
  $dn = array(
    'countryName' => $subject['C'],
    'stateOrProvinceName' => $subject['ST'],
    'localityName' => $subject['L'],
    'organizationName' => $subject['O'],
  );

  $client = lockr_site_client();

  try {
    $result = $client->createCert($dn);
  }
  catch (LockrClientException $e) {
    watchdog_exception('lockr', $e);
    drupal_set_message(
      'Please make sure that the current Lockr certificate is valid.',
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

  $dir = 'private://lockr/prod';

  _lockr_write_key_files($dir, $result);

  $private_wrapper = new DrupalPrivateStreamWrapper();
  $private_wrapper->setUri("{$dir}/pair.pem");
  variable_set('lockr_cert', $private_wrapper->realpath());
  variable_set('lockr_custom', TRUE);

  _lockr_rmtree('private://lockr/dev');
}

function _lockr_rmtree($path) {
  if (is_dir($path)) {
    foreach (scandir($path, SCANDIR_SORT_NONE) as $name) {
      if ($name === '.' || $name === '..') {
        continue;
      }

      _lockr_rmtree("{$path}/{$name}");
    }
  }

  unlink($path);
}

