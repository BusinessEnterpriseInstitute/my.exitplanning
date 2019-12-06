<?php

/**
 * @file
 * This file update counter for node view.
 */

$module_path = getcwd();
if (!defined('DRUPAL_ROOT')) {
  // Suppose that the module folder is located in "sites/all/modules/contrib", and calculate drupal root path.
  define('DRUPAL_ROOT', $module_path . '/../../../../..');
}

// Initialize the database system.
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);

// Increase the view count.
if (!empty($_REQUEST['entity_type']) && !empty($_REQUEST['bundle']) && !empty($_REQUEST['entity_id'])) {
  db_insert('most_viewed_hits')
    ->fields(array(
      'entity_id' => check_plain($_REQUEST['entity_id']),
      'entity_type' => check_plain($_REQUEST['entity_type']),
      'bundle' => check_plain($_REQUEST['bundle']),
      'created' => REQUEST_TIME,
    ))
    ->execute();
}

$image = imagecreatefromgif($module_path . '/spacer.gif');
header('Content-Type: image/gif');
imagegif($image);
imagedestroy($image);
exit;
