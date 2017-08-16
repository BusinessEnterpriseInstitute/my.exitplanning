<?php

/**
 * Implements hook_panels_layouts()
 */

$plugin = array(
  'title' => t('Dynamic: regions and columns'),
  'category' => t('Custom'),
  'icon' => 'dynamic_columns.png',
  'theme' => 'dynamic_columns',
  'regions' => array(
    'top' => t('Top'),
    'left' => t('Left'),
    'right' => t('Right'),
    'bottom' => t('Bottom'),
  ),
  'settings form'     => '_dynamic_columns_form',
  'settings validate' => '_dynamic_columns_validate',
  'settings submit'   => '_dynamic_columns_submit',
);

/**
 * Form for layout settings.
 */
function _dynamic_columns_form(&$display, $layout, $settings) {
  $form = array();

  $form['layout_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Layout settings'),
    '#description' => t('Note: if this setting is used, a wrapper div will be added to accomodate the needed classes.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  // Create a classes text field for each region in the layout.
  foreach ($layout['regions'] as $region => $label) {
    $form['layout_settings'][$region] = array(
      '#type' => 'fieldset',
      '#title' => $label,
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['layout_settings'][$region][$region . '_classes'] = array(
      '#type' => 'textfield',
      '#title' => t('Classes for the @region region', array('@region' => $label)),
      '#default_value' => isset($settings[$region][$region . '_classes']) ? $settings[$region][$region . '_classes'] : '',
      '#description' => t('CSS class (or classes) to apply to the @region region in the layout. This may be blank.', array('@region' => $label)),
    );
    if ($region == 'left' || $region == 'right') {
      $form['layout_settings'][$region][$region . '_classes_alternate'] = array(
        '#type' => 'textfield',
        '#title' => t('Alternate Classes for the @region region when displayed alone.', array('@region' => $label)),
        '#default_value' => isset($settings[$region][$region . '_classes_alternate']) ? $settings[$region][$region . '_classes_alternate'] : 'columns',
        '#description' => t('Alternate CSS class (or classes) to apply to the @region region in the layout. This may be blank.', array('@region' => $label)),
      );
    }
    else {
      $form['layout_settings'][$region][$region . '_wrapper_classes'] = array(
        '#type' => 'textfield',
        '#title' => t('Wrapper classes for the @region region.', array('@region' => $label)),
        '#default_value' => isset($settings[$region][$region . '_wrapper_classes']) ? $settings[$region][$region . '_wrapper_classes'] : 'row',
      );
    }
  }


  return $form;
}

/**
 * Form validation for layout settings.
 */
function _dynamic_columns_validate(&$form_state, $form, &$display, $layout, $settings) {
  // Since we allow underscores, change the css filter from Drupal's default.
  $filter = array(' ' => '-', '/' => '-', '[' => '-', ']' => '');
  foreach (array_keys($layout['regions']) as $region) {
    // Ensure that each class is valid.
    foreach (explode(' ', $form_state['layout_settings'][$region][$region . '_classes']) as $class) {
      $cleaned_class = drupal_clean_css_identifier($class, $filter);
      // CSS identifiers can't start with a number or a dash and a number.
      $cleaned_class = preg_replace('/^\-?\d+/', '', $cleaned_class);
      if ($class != $cleaned_class) {
        form_set_error($region . '_classes', t('The class @class is invalid. Here\'s an alternative class name that is valid: @alternate', array('@class' => $class, '@alternate' => $cleaned_class)));
      }
    }
    if ($region == 'left' || $region == 'right') {
      foreach (explode(' ', $form_state['layout_settings'][$region][$region . '_classes_alternate']) as $class) {
        $cleaned_class = drupal_clean_css_identifier($class, $filter);
        // CSS identifiers can't start with a number or a dash and a number.
        $cleaned_class = preg_replace('/^\-?\d+/', '', $cleaned_class);
        if ($class != $cleaned_class) {
          form_set_error($region . '_classes_alternate', t('The class @class is invalid. Here\'s an alternative class name that is valid: @alternate', array('@class' => $class, '@alternate' => $cleaned_class)));
        }
      }
    }
    else {
      foreach (explode(' ', $form_state['layout_settings'][$region][$region . '_wrapper_classes']) as $class) {
        $cleaned_class = drupal_clean_css_identifier($class, $filter);
        // CSS identifiers can't start with a number or a dash and a number.
        $cleaned_class = preg_replace('/^\-?\d+/', '', $cleaned_class);
        if ($class != $cleaned_class) {
          form_set_error($region . '_wrapper_classes', t('The class @class is invalid. Here\'s an alternative class name that is valid: @alternate', array('@class' => $class, '@alternate' => $cleaned_class)));
        }
      }
    }
  }
}

/**
 * Form submit handler for layout settings.
 */
function _dynamic_columns_submit(&$form_state, &$display, $layout, $settings) {
  // Move the settings out of the 'layout_settings' array.
  foreach (array_keys($form_state['layout_settings']) as $key) {
    $form_state[$key] = $form_state['layout_settings'][$key];
  }
  unset($form_state['layout_settings']);
}

/**
 * Implements hook_preprocess_HOOK().
 */
function template_preprocess_dynamic_columns(&$variables, $hook) {
  foreach (array_keys($variables['layout']['regions']) as $region) {
    // Pull out the region classes to easy-to-handle variables.
    $variables[$region . '_classes'] = !empty($variables['settings'][$region][$region . '_classes']) ? $variables['settings'][$region][$region . '_classes'] : '';
    $variables[$region . '_classes_alternate'] = !empty($variables['settings'][$region][$region . '_classes_alternate']) ? $variables['settings'][$region][$region . '_classes_alternate'] : '';
    $variables[$region . '_wrapper_classes'] = !empty($variables['settings'][$region][$region . '_wrapper_classes']) ? $variables['settings'][$region][$region . '_wrapper_classes'] : '';
  }
}
