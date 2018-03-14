<?php
/**
 * Implements hook_form_FORM_ID_alter().
 */
function bei_form_system_theme_settings_alter(&$form, &$form_state) {
  $form['zurb_foundation']['topbar']['zurb_foundation_top_bar_enable']['#options'][3] = 'Always for Members';
  $form['zurb_foundation']['custom'] = array(
    '#type' => 'fieldset',
    '#title' => t('Custom Settings'),
    '#description' => t('Some additional custom options.'),
  );
  $form['zurb_foundation']['custom']['mobile_logo'] = array(
    '#title' => t('Mobile Logo'),
    '#description' => t('Add mobile version of logo for smaller devices. The theme will use the site name if left blank.'),
    '#type' => 'managed_file',
    '#upload_location' => 'public://',
    '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg svg'),
    ),
    '#default_value' => theme_get_setting('mobile_logo'),
  );
  $form['#submit'][] = 'bei_settings_form_submit';
  // Get all themes.
  $themes = list_themes();
  // Get the current theme
  $active_theme = $GLOBALS['theme_key'];
  $form_state['build_info']['files'][] = str_replace("/$active_theme.info", '', $themes[$active_theme]->filename) . '/theme-settings.php';
}

function bei_settings_form_submit(&$form, $form_state) {
  $image_fid = $form_state['values']['mobile_logo'];
  $image = file_load($image_fid);
  if (is_object($image)) {
    // Check to make sure that the file is set to be permanent.
    if ($image->status == 0) {
      // Update the status.
      $image->status = FILE_STATUS_PERMANENT;
      // Save the update.
      file_save($image);
      // Add a reference to prevent warnings.
      file_usage_add($image, 'bei', 'theme', 1);
    }
  }
}
