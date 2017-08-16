<?php

/**
 * @file
 * Plugin to check if course has expired.
 */

$plugin = array(
  'title' => t('Campaign Status'),
  'description' => t('Checks if campaign can be modified.'),
  'callback' => 'bei_campaign_ctools_access_check',
  'default' => array('negate' => 0),
  'summary' => 'bei_campaign_ctools_access_summary',
  'required context' => new ctools_context_required(t('Node'), 'node'),
);

/**
 * Provide a summary description for course access.
 */
function bei_campaign_ctools_access_summary($conf, $context) {
  return t('Campaign is accessible if status is not scheduled or sent.');
}

/**
 * Check for course access.
 */
function bei_campaign_ctools_access_check($conf, $context) {
  // Return false if context is not set.
  if (empty($context) || empty($context->data)) {
    return FALSE;
  }
  $node = $context->data;
  if ($node->campaign_status !== 'save') {
    return FALSE;
  }
  else {
    return TRUE;
  }
}
