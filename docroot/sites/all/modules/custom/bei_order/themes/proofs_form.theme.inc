<?php

/**
 * Returns HTML for the proofs table in the bei order form.
 */
function theme_proofs_form($variables) {
  $form = $variables['form'];

  $header = array(t('File'), t('Review'), '');
  $rows = array();
  foreach (element_children($form) as $key) {
    if (is_numeric($key)) {
      $row = array();
      $row['data'][] = drupal_render($form[$key]['file']);
      $row['data'][] = drupal_render($form[$key]['download']);
      $row['no_striping'] = TRUE;
      $rows[] = $row;
    }
  }
  $empty_message = t('No proofs available.');
  $output = theme('table', array('header' => $header, 'rows' => $rows, 'attributes' => array('id' => 'proofs-table'), 'empty' => $empty_message));
  $output .= drupal_render_children($form);

  return $output;
}
