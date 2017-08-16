<?php

/**
 * Returns HTML for the materials subform in the bei order form.
 */
function theme_adjustments_form($variables) {
  $form = $variables['form'];

  $header = array(t('Adjustment'), t('Cost'), '');
  $rows = array();
  foreach (element_children($form) as $key) {
    if (is_numeric($key)) {
      $row = array();
      $row['data'][] = drupal_render($form[$key]['adjustment']);
      $row['data'][] = drupal_render($form[$key]['adjustment_cost']);
      $row['data'][] = drupal_render($form[$key]['remove']);
      $row['no_striping'] = TRUE;
      $rows[] = $row;
    }
  }
  $empty_message = t('No adjustments applied.');
  $output = theme('table', array('header' => $header, 'rows' => $rows, 'attributes' => array('id' => 'pricing-adjustments-table'), 'empty' => $empty_message));
  $output .= drupal_render_children($form);

  return $output;
}
