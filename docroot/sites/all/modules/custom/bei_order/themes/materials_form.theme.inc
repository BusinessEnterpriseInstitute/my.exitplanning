<?php

/**
 * Returns HTML for the materials subform in the bei order form.
 */
function theme_materials_form($variables) {
  $form = $variables['form'];

  $header = array(t('Material'), t('Quantity'), t('Unit Price'), t('Cost'));
  $rows = array();
  foreach (element_children($form) as $key) {
    // skip the total cost field.
    if (is_numeric($key)) {
      $row = array();
      $row['data'][] = check_plain($form[$key]['quantity']['#title']);
      $row['data'][] = drupal_render($form[$key]['quantity']);
      $row['data'][] = drupal_render($form[$key]['unit_cost']);
      $row['data'][] = drupal_render($form[$key]['cost']);
      $row['no_striping'] = TRUE;
      $rows[] = $row;
    }
    if ($key === 'adjustments') {
      $adjustments = element_children($form[$key]);
      if (!empty($adjustments)) {
        $rows[] = array(
          'data' => array(
            array('data' => t('Pricing Adjustments'), 'header' => TRUE, 'colspan' => '4'),
          ),
          'no_striping' => TRUE,
        );
        foreach ($adjustments as $adjustment) {
          $rows[] = array(
            'data' => array(
              array('data' => drupal_render($form[$key][$adjustment]['remove']) . drupal_render($form[$key][$adjustment]['adjustment'])),
              array('data' => ''),
              array('data' => ''),
              array('data' => drupal_render($form[$key][$adjustment]['adjustment_cost'])),
            ),
            'no_striping' => TRUE,
          );
        }
      }
    }
  }
  // add the total cost field.
  $rows[] = array(
    'data' => array(
      array('data' => t('<strong>TOTAL COST:</strong> ', array('html' => TRUE)), 'colspan' => '3', 'class' => 'text-right'),
      array('data' => drupal_render($form['total_cost'])),
    ),
    'no_striping' => TRUE,
  );

  $output = theme('table', array('header' => $header, 'rows' => $rows, 'attributes' => array('id' => 'pricing-table')));
  $output .= drupal_render_children($form);

  return $output;
}
