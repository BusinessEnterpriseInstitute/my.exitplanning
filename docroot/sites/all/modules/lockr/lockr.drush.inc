<?php

/**
 * @file
 * Hooks and callbacks for drush.
 */

/**
 * Implements hook_drush_command().
 */
function lockr_drush_command() {
  $info['lockdown'] = [
    'description' => 'Patch modules to work with key.',
    'aliases' => ['ld'],
    'core' => ['7'],
    'scope' => 'site',
  ];

  $info['lockr-register'] = [
    'description' => 'Register a site for Lockr.',
    'aliases' => ['lr'],
    'core' => ['7'],
    'scope' => 'site',
    'arguments' => [
      'email' => 'The email to register with.',
    ],
    'options' => [
      'password' => 'The password to match given email (if applicable).',
      'keyring-id' => 'The KeyRing ID to register against an existing KeyRing.',
    ],
  ];

  return $info;
}

/**
 * Registers the site with lockr.
 */
function drush_lockr_register($email) {
  $name = variable_get('site_name', '');
  $lc = lockr_client();
  $password = drush_get_option('password');
  if (!$password) {
    return drush_set_error('LOCKR_PASS_REQUIRED', '--password is required');
  }

  $data = $lc->requestClientToken(
    $email,
    $password,
    $name,
    $name,
    drush_get_option('keyring-id')
  );
  if (isset($data['error'])) {
    return drush_set_error('LOCKR_CLIENT_TOKEN', $data['error']);
  }
  $client_token_id = $data['client_token'];
  $partner = lockr_get_partner();
  try {
    if ($partner) {
      if ($partner['name'] === 'pantheon') {
        $lc->createPantheonClient($client_token_id);
      }
      else {
        throw new \Exception('Unknown lockr partner');
      }
    }
    else {
      $dn = [
        'countryName' => 'US',
        'stateOrProvinceName' => 'Washington',
        'localityName' => 'Tacoma',
        'organizationName' => 'Lockr',
      ];
      $result = $lc->createClientCert($client_token_id, $dn);
      $dir = "private://lockr/dev";
      _lockr_write_key_files($dir, $result);
      variable_set('lockr_cert', "{$dir}/pair.pem");
      variable_set('lockr_custom', TRUE);
    }
  }
  catch (\Exception $e) {
    return drush_set_error('LOCKR_CREATE_CLIENT', $e->getMessage());
  }

  drush_log('Site has been registered.', 'success');
}

/**
 * Patches installed modules for Key.
 */
function drush_lockr_lockdown() {
  $raw_path = 'https://raw.githubusercontent.com/CellarDoorMedia/Lockr-Patches/drupal7';

  $reg_file = "{$raw_path}/registry.json";
  drush_log("Downloading registry file: {$reg_file}.");
  $registry = file_get_contents($reg_file);
  $registry = json_decode($registry, TRUE);

  if (json_last_error() !== JSON_ERROR_NONE) {
    drush_log(
      'There was an error downloading the patch registry.',
      LogLevel::ERROR
    );
    return;
  }

  // We use `system_rebuild_module_data()' instead of individual calls
  // to `drupal_get_path()` and `system_get_info()' because we want to
  // find disabled modules as well as enabled ones.
  $module_data = system_rebuild_module_data();

  $names = implode(', ', array_keys($registry));
  drush_log("Patches available for: {$names}.");

  foreach ($registry as $name => $patches) {
    if (!isset($module_data[$name])) {
      drush_log("Module not found: {$name}.");
      continue;
    }

    $module_info = $module_data[$name];

    $module_version = $module_info->info['version'];
    if (!in_array($module_version, array_keys($patches))) {
      drush_log("Module version not supported: {$name} ({$module_version}).");
      continue;
    }

    $path = $patches[$module_version];

    $module_path = DRUPAL_ROOT . '/' . dirname($module_info->filename);

    if (!is_dir($module_path)) {
      drush_log("Module path does not exist: {$module_path}");
      continue;
    }

    // The lockfile prevents double-patching a module if lockdown is
    // called more than once. Applying a patch more than once can be
    // disastrous, and we don't want that.
    $lockfile = "{$module_path}/.lockr-patched";
    if (is_file($lockfile)) {
      drush_log("{$name} already patched.");
      drush_log("Remove {$lockfile} to patch again.");
      drush_log("Do so at your own peril.");
      continue;
    }

    $patch_path = "{$module_path}/key-integration.patch";
    $patch_remote = "{$raw_path}/{$path}";
    drush_log("Downloading {$patch_remote}.");
    copy($patch_remote, $patch_path);

    drush_log("Patching {$name}.");
    $cmd = implode(' ', [
      'patch',
      // We do not need a backup because reverting the patch can be done
      // via the user's version control system.
      '--no-backup-if-mismatch',
      '-N',
      '-p1',
      '-d', escapeshellarg($module_path),
      '<', escapeshellarg($patch_path),
    ]);
    drush_log("Running `{$cmd}`.");
    ob_start();
    passthru($cmd, $return_code);
    drush_log(ob_get_clean());

    if ($return_code === 0) {
      // Patch is OK, go ahead and write the lockfile and remove the
      // downloaded patch.
      drush_log("Patch successful, writing lockfile.");
      file_put_contents($lockfile, '');
      unlink($patch_path);
    }
    else {
      drush_log("Failed to patch {$name}.", 'error');
      drush_log("Patch file left at '{$patch_path}'.", 'error');
    }
  }
}
