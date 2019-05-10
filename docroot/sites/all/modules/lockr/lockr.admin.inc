<?php

/**
 * @file
 * Form callbacks for Lockr register form.
 */

use Lockr\Exception\LockrServerException;

require_once __DIR__ . '/include/advanced_form.inc';
require_once __DIR__ . '/include/csr_form.inc';
require_once __DIR__ . '/include/migrate_form.inc';
require_once __DIR__ . '/include/register_form.inc';
require_once __DIR__ . '/include/status.inc';

/**
 * Form constructor for Lockr registration form.
 *
 * @ingroup forms
 */
function lockr_admin_form($form, &$form_state) {
  $form = array();

  try {
    $status = lockr_check_registration();
  }
  catch (LockrServerException $e) {
    watchdog_exception('lockr', $e);
    drupal_set_message('The Lockr service has returned an error. Please try again.', 'error');
    return $form;
  }

  $form['status'] = array('#markup' => lockr_admin_status($status));

  $cert_valid = $status['cert_valid'];
  $exists = $status['exists'];

  if ($exists) {
    $header_text = <<<EOL
All systems are a go!
Your site is registered, your certificate is valid, and everything seems
good on our end.
The table below will give you the status of all elements.
Should anything look out of the ordinary just let us know on the Slack
channel and we'd be happy to help.
Happy Keying!
EOL;
  }
  else {
    $header_text = <<<EOL
Welcome to Lockr!
You're just a few steps away from storing your keys safe and secure.
To make things simple we've laid out a few key elements (pun intended)
that the system requires in order to run.
Fill out the forms below and once all rows on the table are green,
you're good to go!
It's that simple!
If you'd like assistance in getting up and running be sure to
<a href="@email">email us</a>
or connect with us on <a href="@slack">Slack</a>.
EOL;
    $header_text = format_string(
      $header_text,
      array(
        '@email' => 'mailto:support@lockr.io',
        '@slack' => 'http://slack.lockr.io',
      )
    );
  }

  $form['header'] = array(
    '#prefix' => '<p>',
    '#markup' => $header_text,
    '#suffix' => '</p>',
  );

  $partner = lockr_get_partner();
  if ($partner) {
    $form['description'] = array(
      '#prefix' => '<p>',
      '#markup' => $partner['description'],
      '#suffix' => '</p>',
    );
  }
  elseif (!$cert_valid) {
    $form['csr'] = lockr_admin_csr_form();
  }
  elseif ($exists && $status['info']['env'] === 'dev') {
    $form['migrate_info'] = array(
      '#prefix' => '<p>',
      '#markup' =>
        'Click the button below to deploy this site to production. ' .
        'This should only be done in your production environment as it writes a new certificate to the file system. ',
      '#suffix' => '</p>',
    );
    $form['migrate'] = lockr_admin_migrate_form();
  }

  if (!$exists && $cert_valid) {
    $form['register'] = lockr_admin_register_form($form_state);
  }

  $form['advanced'] = lockr_admin_advanced_form();

  return $form;
}
