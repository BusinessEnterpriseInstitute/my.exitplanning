<?php

/**
 * Implements hook_panels_layouts()
 */

$plugin = array(
  'title' => t('No wrapper: stacked'),
  'category' => t('Custom'),
  'icon' => 'no_wrapper_stacked.png',
  'theme' => 'no_wrapper_stacked',
  'regions' => array(
    'top' => t('Top'),
    'left' => t('Left'),
    'right' => t('Right'),
    'bottom' => t('Bottom'),
  ),
);
