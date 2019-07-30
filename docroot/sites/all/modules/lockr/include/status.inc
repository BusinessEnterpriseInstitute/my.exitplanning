<?php

/**
 * @file
 * Status callback for Lockr admin page.
 */

function lockr_admin_status($info) {
  include_once DRUPAL_ROOT . '/includes/install.inc';

  $partner = lockr_get_partner();
  $partner_cert = !is_null($partner) && $partner['cert'];

  $reqs = [];

  if (!is_null($info)) {
    $reqs[] = [
      'title' => t('Certificate Valid'),
      'value' => t('Yes'),
      'description' => "You're a certified Lockr user! We've found your certificate and it validates with our system.",
      'severity' => REQUIREMENT_OK,
    ];
  }
  else {
    $reqs[] = [
      'title' => t('Certificate Valid'),
      'value' => t('No'),
      'description' => "Oops! Looks like we need to know who you are before we give you the keys to the castle. You have not connected this site to a KeyRing on Lockr, please follow the steps below to complete setup. If you've already created a certificate, we are unable to find it. Please check the advanced settings to ensure your path is correct (or if you're on a hosting partner contact their support).",
      'severity' => REQUIREMENT_ERROR,
    ];
  }

  if (!is_null($info)) {
    $reqs[] = [
      'title' => t('Environment'),
      'value' => ucfirst($info['env']),
      'severity' => REQUIREMENT_INFO,
    ];

    $reqs[] = [
      'title' => t('Connected KeyRing'),
      'value' => t('Yes'),
      'description' => "You are currently connected to the {$info['keyring']['label']} KeyRing.",
      'severity' => REQUIREMENT_INFO,
    ];
  }
  elseif (!$partner_cert) {
    $private_path = variable_get('file_private_path');
    if (is_dir($private_path)) {
      $desc_suffix = t('Looks good!');
      $sev = REQUIREMENT_OK;
    }
    else {
      $link = url(
          '/admin/config/media/file-system',
          ['query' => ['destination' => '/admin/config/system/lockr']]
      );
      $desc_suffix = t('Please <a href="@link">set the private directory</a>. Make sure it is not available from the web.', ['@link' => $link]);
      $sev = REQUIREMENT_ERROR;
    }
    $reqs[] = [
      'title' => t('Private Directory'),
      'value' => $private_path ?: t('Unknown'),
      'description' =>
        t("Lockr stores certificates in Drupal's private directory. ") .
        $desc_suffix,
      'severity' => $sev,
    ];
  }

  if (!is_null($info)) {
    $has_cc = $info['keyring']['hasCreditCard'];
    $trial_end = $info['keyring']['trialEnd'];
    if (!is_null($trial_end)) {
      $trial_end = \DateTime::createFromFormat(DateTime::RFC3339, $trial_end);
      if ($trial_end > (new \DateTime())) {
        $reqs[] = [
          'title' => t('Trial Expiration Date'),
          'value' => $trial_end->format('M jS, Y'),
          'severity' => REQUIREMENT_INFO,
        ];
      }
      elseif (!$has_cc) {
        $reqs[] = [
          'title' => t('Trial Expiration Date'),
          'value' => $trial_end->format('M jS, Y'),
          'severity' => REQUIREMENT_ERROR,
        ];
      }
    }

    if (isset($info['auth']['expires'])) {
      $expires = DateTime::createFromFormat(DateTime::RFC3339, $info['auth']['expires']);
      $reqs[] = [
        'title' => t('Certificate Expiration Date'),
        'value' => $expires->format('M jS, Y'),
        'severity' => REQUIREMENT_INFO,
      ];
    }

    $has_no_cc_text = t('Uh oh! Without a credit card we cannot issue a production certificate. Please add one before migrating to production.');
    $has_cc_text = t("We've got your credit card safely on file and you'll be receiving regular invoice for your site.");

    $reqs[] = [
      'title' => t('Credit Card on File'),
      'value' => $has_cc ? t('Yes') : t('No'),
      'description' => $has_cc ? $has_cc_text : $has_no_cc_text,
      'severity' => $has_cc ? REQUIREMENT_OK : REQUIREMENT_ERROR,
    ];
  }

  return theme('status_report', ['requirements' => $reqs]);
}

