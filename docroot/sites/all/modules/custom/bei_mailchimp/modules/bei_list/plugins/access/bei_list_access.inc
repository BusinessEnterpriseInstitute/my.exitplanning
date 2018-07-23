<?php

/**
 * @file
 * Plugin to check if course has expired.
 */

$plugin = array(
  'title' => t('List: Import enabled'),
  'description' => t('Checks if importing is enabled for the list.'),
  'callback' => 'bei_list_ctools_access_check',
  'default' => array('negate' => 0),
  'summary' => 'bei_list_ctools_access_summary',
  'required context' => new ctools_context_required(t('Node'), 'node'),
);

/**
 * Provide a summary description for list access.
 */
function bei_list_ctools_access_summary($conf, $context) {
  return t('Importing is enabled if the checkbox is checked.');
}

/**
 * Check for course access.
 */
function bei_list_ctools_access_check($conf, $context) {
  // Return false if context is not set.
  if (empty($context) || empty($context->data)) {
    return FALSE;
  }
  $node = $context->data;
  if (isset($node->import) && $node->import != FALSE) {
    return TRUE;
  }
  else {
    return FALSE;
  }
}
