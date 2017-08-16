<?php

/**
 * @file
 * This file contains the theme functions for the field-collection modal widget.
 */

/**
 * Returns HTML for an individual form element.
 *
 * Combine multiple values into a table with drag-n-drop reordering.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: A render element representing the form element.
 *
 * @return string
 *   HTML for an individual form element.
 *
 * @ingroup themeable
 */
function theme_field_collection_modal_value_form($variables) {
  $element = $variables['element'];

  $table_id = drupal_html_id($element['#field_name'] . '_values');
  $order_class = $element['#field_name'] . '-delta-order';
  $required = !empty($element['#required']) ? theme('form_required_marker', $variables) : '';

  // Sort items according to '_weight' (needed when the form comes back after
  // preview or failed validation)
  $items = array();
  foreach (element_children($element) as $key) {
    if ($key === 'add_more') {
      $add_more_button = &$element[$key];
    }
    else {
      $items[] = &$element[$key];
    }
  }
  usort($items, '_field_sort_items_value_helper');

  $header = array();
  $header[] = array(
    'data' => '<label>' . t('!title !required', array('!title' => $element['#title'], '!required' => $required)) . '</label>',
    'colspan' => $element['#cardinality'] != 1 ? 2 : 1,
    'class' => array('field-label'),
  );
  if ($element['#cardinality'] != 1 && !empty($items)) {
    $header[] = t('Order');
  }

  $rows = array();

  // Add the items as table rows.
  foreach ($items as $key => $item) {
    hide($item['_weight']);

    $cells = array(drupal_render($item));
    if ($element['#cardinality'] != 1) {
      array_unshift($cells, array('data' => '', 'class' => array('field-multiple-drag')));

      show($item['_weight']);
      $item['_weight']['#attributes']['class'] = array($order_class);
      $delta_element = drupal_render($item['_weight']);
      $cells[] = array('data' => $delta_element, 'class' => array('delta-order'));
    }

    $rows[] = array(
      'data' => $cells,
      'class' => $element['#cardinality'] ? array('draggable') : array(),
    );
  }

  $output = '<div class="form-item">';
  $output .= theme('table', array(
    'header' => $header,
    'rows' => $rows,
    'empty' => t('No items.'),
    'attributes' => array('id' => $table_id, 'class' => $element['#cardinality'] ? array('field-multiple-table') : array()),
  ));
  $output .= $element['#description'] ? '<div class="description">' . $element['#description'] . '</div>' : '';
  $output .= '<div class="clearfix">' . drupal_render($add_more_button) . '</div>';

  if ($element['#cardinality'] != 1) {
    drupal_add_tabledrag($table_id, 'order', 'sibling', $order_class);
  }

  $output .= '</div>';

  return $output;
}
