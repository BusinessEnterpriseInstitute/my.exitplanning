<?php

/**
 * @file
 * Form callbacks for Lockr register form.
 */

use GuzzleHttp\Exception\ConnectException;
use Lockr\Exception\LockrApiException;

require_once __DIR__ . '/include/status.inc';

function lockr_admin_page() {
  $lc = lockr_client();
  try {
    $info = $lc->getInfo();
  }
  catch (ConnectException $e) {
    drupal_set_message(t('We are having trouble connecting to the Lockr servers.'), 'error');
    return [];
  }
  catch (LockrApiException $e) {
    $info = NULL;
  }
  catch (\Exception $e) {
    watchdog_exception('lockr', $e);
    drupal_set_message(t('The Lockr service has returned an error. Please try again.'), 'error');
    return $form;
  }
  $content['status'] = ['#markup' => lockr_admin_status($info)];
  if ($info) {
    $header_text = t("All systems are a go! Your site is registered, your certificate is valid, and everything seems good on our end. The table below will give you the status of all elements. Should anything look out of the ordinary just let us know on the Slack channel and we'd be happy to help. Happy Keying!");
  }
  else {
    $header_text = t("Welcome to Lockr! You're just a few steps away from storing your keys safe and secure. To make things simple we've laid out a few key elements (pun intended) that the system requires in order to run. Fill out the forms below and once all rows on the table are green, you're good to go! It's that simple! If you'd like assistance in getting up and running be sure to <a href=\"@email\">email us</a> or connect with us on <a href=\"@slack\">Slack</a>.", ['@email' => 'mailto:support@lockr.io', '@slack' => 'http://slack.lockr.io']);
  }
  $content['header'] = [
    '#prefix' => '<p>',
    '#markup' => $header_text,
    '#suffix' => '</p>',
  ];
  $partner = lockr_get_partner();
  if ($partner) {
    $content['description'] = [
      '#prefix' => '<p>',
      '#markup' => $partner['description'],
      '#suffix' => '</p>',
    ];
  }
  if (!$info) {
    $content['register'] = drupal_get_form('lockr_admin_register_form');
  }
  elseif ($info['env'] !== 'prod' && !$partner) {
    $content['move_to_prod'] = drupal_get_form('lockr_admin_migrate_form', $info);
  }
  $content['advanced'] = drupal_get_form('lockr_admin_advanced_form');
  return $content;
}

function lockr_admin_migrate_form($form, &$form_state, $info) {
  $form['instructions'] = [
    '#markup' => t('Click the button below to deploy this site to production. This should only be done in your production environment as it writes a new certificate to the file system.'),
  ];

  $accounts_host = variable_get('lockr_accounts_host', 'accounts.lockr.io');
  $form['#attached']['js'] = [
    [
      'type' => 'setting',
      'data' => [
        'lockr' => [
          'accounts_host' => "https://{$accounts_host}",
          'keyring_id' => $info['keyring']['id'],
        ],
      ],
    ],
    drupal_get_path('module', 'lockr') . '/js/move_to_prod.js',
  ];

  $form['client_token'] = [
    '#type' => 'hidden',
    '#required' => TRUE,
  ];

  $form['move_to_prod'] = [
    '#type' => 'button',
    '#value' => t('Migrate to Production'),
    '#attributes' => [
      'class' => ['move-to-prod'],
    ],
  ];

  $form['submit'] = [
    '#type' => 'submit',
    '#value' => 'Submit',
    '#attributes' => [
      'class' => ['move-to-prod-submit'],
    ],
  ];

  return $form;
}

function lockr_admin_migrate_form_submit($form, &$form_state) {
  $client_token = $form_state['values']['client_token'];
  $lc = lockr_client();
  try {
    $dn = [
      'countryName' => 'US',
      'stateOrProvinceName' => 'Washington',
      'localityName' => 'Tacoma',
      'organizationName' => 'Lockr',
    ];
    $result = $lc->createCertClient($client_token, $dn);
  }
  catch (\Exception $e) {
    form_set_error('', t('An unknown error has occurred, please try again later.'));
    return;
  }
  $dir = "private://lockr/prod";
  _lockr_write_key_files($dir, $result);
  $private_wrapper = new DrupalPrivateStreamWrapper();
  $private_wrapper->setUri("{$dir}/pair.pem");
  variable_set('lockr_cert', $private_wrapper->realpath());
  variable_set('lockr_custom', TRUE);
}

function lockr_admin_register_form($form, &$form_state) {
  $accounts_host = variable_get('lockr_accounts_host', 'accounts.lockr.io');
  $form['#attached']['js'] = [
    [
      'type' => 'setting',
      'data' => [
        'lockr' => [
          'site_name' => variable_get('site_name'),
          'accounts_host' => "https://{$accounts_host}",
        ],
      ],
    ],
    drupal_get_path('module', 'lockr') . '/js/register.js',
  ];

  $form['client_token'] = [
    '#type' => 'hidden',
    '#required' => TRUE,
  ];

  $form['register'] = [
    '#type' => 'button',
    '#value' => t('Register site'),
    '#attributes' => [
      'class' => ['register-site'],
    ],
  ];

  $form['submit'] = [
    '#type' => 'submit',
    '#value' => 'Submit',
    '#attributes' => [
      'class' => ['register-submit'],
    ],
  ];

  return $form;
}

function lockr_admin_register_form_submit($form, &$form_state) {
  $client_token = $form_state['values']['client_token'];
  $lc = lockr_client();
  $partner = lockr_get_partner();
  try {
    if (is_null($partner)) {
      $dn = [
        'countryName' => 'US',
        'stateOrProvinceName' => 'Washington',
        'localityName' => 'Tacoma',
        'organizationName' => 'Lockr',
      ];
      $result = $lc->createCertClient($client_token, $dn);
      $dir = "private://lockr/dev";
      _lockr_write_key_files($dir, $result);
      $private_wrapper = new DrupalPrivateStreamWrapper();
      $private_wrapper->setUri("{$dir}/pair.pem");
      variable_set('lockr_cert', $private_wrapper->realpath());
      variable_set('lockr_custom', TRUE);
    }
    else if ($partner['name'] === 'pantheon') {
      $lc->createPantheonClient($client_token);
    }
  }
  catch (\Exception $e) {
    form_set_error('', t('An unknown error has occurred, please try again later.'));
    return;
  }

  drupal_set_message(t("That's it! You're signed up with Lockr; your keys can now be safely stored off-site."));
}

function lockr_admin_advanced_form() {
  $content = [
    '#type' => 'fieldset',
    '#title' => t('Advanced'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  ];

  $content['region'] = [
    '#type' => 'select',
    '#title' => t('Region'),
    '#default_value' => variable_get('lockr_region'),
    '#empty_option' => '- Nearest -',
    '#options' => [
      'us' => t('US'),
      'eu' => t('EU'),
    ],
  ];

  $content['custom'] = [
    '#type' => 'checkbox',
    '#title' => 'Set custom certificate location',
    '#default_value' => variable_get('lockr_custom'),
  ];

  $content['custom_cert'] = [
    '#type' => 'textfield',
    '#title' => t('Certificate Path'),
    '#default_value' => variable_get('lockr_cert'),
    '#states' => [
      'visible' => [
        ':input[name="custom"]' => ['checked' => TRUE],
      ],
    ],
  ];

  $content['submit'] = [
    '#type' => 'submit',
    '#value' => t('Save'),
  ];

  $form['content'] = $content;

  return $form;
}

function lockr_admin_advanced_form_validate($form, &$form_state) {
  $values = $form_state['values'];

  if (!$values['custom']) {
    return;
  }

  $cert_path = $values['custom_cert'];

  if (!$cert_path) {
    form_set_error(
      'custom_cert',
      t('Certificate location is required for custom certs')
    );
    return;
  }

  $real_cert_path = drupal_realpath($cert_path);
  if (is_dir($cert_path) || !is_readable($cert_path)) {
    form_set_error(
      'custom_cert',
      t('Certificate must be a readable file')
    );
  }
}

function lockr_admin_advanced_form_submit($form, &$form_state) {
  $values = $form_state['values'];

  if ($values['region']) {
    variable_set('lockr_region', $values['region']);
  }
  else {
    variable_del('lockr_region');
  }

  $custom = $values['custom'];

  variable_set('lockr_custom', $custom);
  if ($custom) {
    variable_set('lockr_cert', $values['custom_cert']);
  }
  else {
    variable_del('lockr_cert');
  }
}
