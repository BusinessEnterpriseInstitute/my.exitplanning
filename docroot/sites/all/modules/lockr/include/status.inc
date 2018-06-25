<?php

/**
 * @file
 * Status callback for Lockr admin page.
 *
 */

function lockr_admin_status($status) {
  include_once DRUPAL_ROOT . '/includes/install.inc';

  $cert_valid = $status['cert_valid'];
  $exists = $status['exists'];

  $cert_valid_text = <<<EOL
You're a certified Lockr user!
We've found your certificate and it validates with our system.
EOL;
  $cert_invalid_text = <<<EOL
Oops!
Looks like we need to know who you are before we give you the keys to the castle.
Your certificate is not valid, please register for one.
If you've already gotten a certificate, we are unable to find it.
Please check the advanced settings to ensure your path is correct
(or if you're on a hosting partner contact their support).
EOL;

  $reqs[] = array(
    'title' => 'Certificate Valid',
    'value' => $cert_valid ? 'Yes' : 'No',
    'description' => $cert_valid ? $cert_valid_text : $cert_invalid_text,
    'severity' => $cert_valid ? REQUIREMENT_OK : REQUIREMENT_ERROR,
  );

  if ($cert_valid) {
    $reqs[] = array(
      'title' => 'Environment',
      'value' => $status['info']['env'],
      'severity' => REQUIREMENT_INFO,
    );
  }
  else {
    $private_path = variable_get('file_private_path');
    $is_dir = is_dir($private_path);
    $req = array(
      'title' => 'Private Directory',
      'value' => $private_path ?: 'Unknown',
      'description' =>
        "Lockr stores certificates in Drupal's private directory. " .
        ($is_dir
        ? 'Looks good!'
        : format_string(
          'Please <a href="@link">set the private directory</a>. '.
          'Make sure it is not available from the web.',
          array('@link' => '/admin/config/media/file-system')
        )),
      'severity' => $is_dir ? REQUIREMENT_OK : REQUIREMENT_ERROR,
    );
    array_unshift($reqs, $req);
  }

  $exists_text = <<<EOL
You're one of the family.
We've got your site registered and you're all good to go!
EOL;
  $not_exists_text = <<<EOL
Who are you again?
We don't have your site registered with Lockr.
Please use the form below to register your site.
EOL;

  $reqs[] = array(
    'title' => 'Site Registered',
    'value' => $exists ? 'Yes' : 'No',
    'description' => $exists ? $exists_text : $not_exists_text,
    'severity' => $exists ? REQUIREMENT_OK : REQUIREMENT_ERROR,
  );

  if ($cert_valid) {
    $partner = $status['info']['partner'];
    $is_custom = in_array($partner, array('custom', 'lockr'));
    $default = $is_custom
      ? REQUIREMENT_ERROR
      : REQUIREMENT_WARNING;
    $is_custom_text = <<<EOL
Uh oh!
Without a credit card we cannot issue a production certificate.
Please add one before migrating to production.
EOL;
    $is_not_custom_text = "You're all set, no credit card needed for your account.";
    $default_description = $is_custom ? $is_custom_text : $is_not_custom_text;
    $has_cc_text = <<<EOL
We've got your credit card safely on file and you'll be receiving regular
invoice for your key usage.
EOL;

    $has_cc = $status['has_cc'];
    $reqs[] = array(
      'title' => 'Credit Card on File',
      'value' => $has_cc ? 'Yes' : 'No',
      'description' => $has_cc ? $has_cc_text : $default_description,
      'severity' => $has_cc ? REQUIREMENT_OK : $default,
    );
  }

  return theme('status_report', array('requirements' => $reqs));
}

