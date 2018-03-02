<?php

/**
 * Implements template_preprocess_html().
 */
function bei_preprocess_html(&$variables) {
    if (!empty($variables['page']['header_top'])) {
        $variables['classes_array'][] = 'top-header-enabled';
    }
    if (!empty($variables['page']['page_banner'])) {
        $variables['classes_array'][] = 'title-banner';
    }
    /*
    $node = menu_get_object();
    if (isset($node->nid)) {
        $variables['classes_array'][] = 'is-node';
    }*/
    // Adds Apple touch icons.
    $theme_path = base_path() . drupal_get_path('theme', 'bei') . '/icons';
    $apple_touch_icon_sizes = array(
      '57x57',
      '114x114',
      '72x72',
      '60x60',
      '120x120',
      '144x144',
      '76x76',
      '152x152',
      '180x180',
    );
    foreach ($apple_touch_icon_sizes as $apple_touch_icon_size) {
      $element = array(
        '#tag' => 'link',
        '#attributes' => array(
          'rel' => 'apple-touch-icon',
          'sizes' => $apple_touch_icon_size,
          'href' => $theme_path . '/apple-touch-icon-' . $apple_touch_icon_size . '.png',
        ),
      );
      drupal_add_html_head($element, 'bei_apple_touch_icon_' . $apple_touch_icon_size);
    }
    // Adds generic icons
    $generic_sizes = array(
      '96x96',
      '16x16',
      '32x32',
    );
    foreach ($generic_sizes as $generic_size) {
      $element = array(
        '#tag' => 'link',
        '#attributes' => array(
          'rel' => 'icon',
          'type' => 'image/png',
          'href' => $theme_path . '/favicon-' . $generic_size . '.png',
          'sizes' => $generic_size,
        ),
      );
      drupal_add_html_head($element, 'bei_generic_icon_' . $generic_size);
    }
    // Adds Android icon
    $android_icon = array(
      '#tag' => 'link',
      '#attributes' => array(
        'rel' => 'icon',
        'type' => 'image/png',
        'href' => $theme_path . '/android-chrome-192x192.png',
        'sizes' => '192x192',
      ),
    );
    drupal_add_html_head($android_icon, 'bei_android_icon_192');
        $logo = theme_get_setting('logo');
    $structured_data = array(
        '@context' => 'http://schema.org',
        '@type' => 'Organization',
        'url' => 'https://www.exitplanning.com',
        'logo' => $logo,
    );

    $structured_data = defined('JSON_UNESCAPED_SLASHES') ? json_encode($structured_data, JSON_UNESCAPED_SLASHES) : json_encode($structured_data);

    $json_ld_script = array(
      '#type' => 'markup',
      '#markup' => '<script type="application/ld+json">'.$structured_data.'</script>'."\n"
    );
    drupal_add_html_head($json_ld_script, 'structured_data_schemaorg_json_ld');
}

/**
 * Implements template_preprocess_page.
 */
function bei_preprocess_page(&$variables) {
    // Top bar.
    if ($variables['top_bar'] = theme_get_setting('zurb_foundation_top_bar_enable')) {
        $top_bar_classes = array();
        if (theme_get_setting('zurb_foundation_top_bar_grid')) {
          $top_bar_classes[] = 'contain-to-grid';
        }

        if (theme_get_setting('zurb_foundation_top_bar_sticky')) {
          $top_bar_classes[] = 'sticky';
        }

        if ($variables['top_bar'] == 2) {
          $top_bar_classes[] = 'show-for-small';
        }
        $variables['top_bar_members'] = FALSE;
        if ($variables['top_bar'] == 3) {
            if (!user_is_logged_in()) {
                $top_bar_classes[] = 'show-for-small';
            }
            else {
                $variables['top_bar_members'] = TRUE;
            }
        }
        $variables['top_bar_classes'] = implode(' ', $top_bar_classes);
        // Alternative header.
        // This is what will show up if the top bar is disabled or enabled only for
        // mobile.
        if ($variables['alt_header'] = ($variables['top_bar'] != 1)) {
          // Hide alt header on mobile if using top bar in mobile.
          $variables['alt_header_classes'] = $variables['top_bar'] == 2 || $variables['top_bar'] == 3 ? ' hide-for-small' : '';
        }
    }
     // Get rid of taxonomy term no content message.
    if (isset($variables['page']['content']['system_main']['no_content'])) {
        unset($variables['page']['content']['system_main']['no_content']);
    }
    $variables['mobile_version_logo'] = '';
    $logo = theme_get_setting('mobile_logo');
    if (!empty($logo)) {
        $fid = theme_get_setting('mobile_logo');
        $file_url = file_create_url(file_load($fid)->uri);
        $file_output = theme_image(array(
            'path' => $file_url,
            'alt'   => strip_tags($variables['site_name']) . ' ' . t('logo'),
            'title' => strip_tags($variables['site_name']) . ' ' . t('Home'),
            'attributes' => array(
                'class' => array('logo mobile')
            )
        ));
        $variables['mobile_version_logo'] = l($file_output, '<front>', array(
            'attributes' => array(
                'rel' => 'home',
                'title' => strip_tags($variables['site_name']) . ' ' . t('Home'),
                'class' => array('logo left show-for-small'),
            ),
            'html' => TRUE,
        ));
    }
    // Convenience variables.
    if (!empty($variables['page']['sidebar_first'])) {
      $left = $variables['page']['sidebar_first'];
    }
  
    if (!empty($variables['page']['sidebar_second'])) {
      $right = $variables['page']['sidebar_second'];
    }
  
    // Dynamic sidebars.
    if (!empty($left) && !empty($right)) {
      $variables['main_grid'] = 'medium-6 medium-push-3';
      $variables['sidebar_first_grid'] = 'medium-3 medium-pull-6';
      $variables['sidebar_sec_grid'] = 'medium-3';
    }
    elseif (empty($left) && !empty($right)) {
      $variables['main_grid'] = 'medium-8';
      $variables['sidebar_first_grid'] = '';
      $variables['sidebar_sec_grid'] = 'medium-4';
    }
    elseif (!empty($left) && empty($right)) {
      $variables['main_grid'] = 'medium-8 medium-push-4';
      $variables['sidebar_first_grid'] = 'medium-4 medium-pull-8';
      $variables['sidebar_sec_grid'] = '';
    }
    else {
      $variables['main_grid'] = '';
      $variables['sidebar_first_grid'] = '';
      $variables['sidebar_sec_grid'] = '';
    }
    // Unset the normal theme messages so we can display in our panel template.
    $design_forms = array(
        'subscriber_list',
        'campaign',
    );
    if (isset($variables['node']) && in_array($variables['node']->type, $design_forms) && arg(2) == 'edit' && !arg(3)) {
        $variables['show_messages'] = FALSE;
    }
}

/**
 * Implements template_preprocess_node.
 */
/*
function bei_preprocess_node(&$variables) {
}
*/
/**
 * Implements hook_form_alter().
 * Perform alterations before a form is rendered.
 */
function bei_form_alter(&$form, &$form_state, $form_id) {
    // User login form.
    if (isset($form['#id']) && ($form['#id'] == 'user-login-form')) {
        $form['actions']['submit']['#attributes']['class'][] = 'expand';
    }
}

/**
 * Overrides theme_menu_tree().
 */
function bei_menu_tree__main_menu($vars) {

  // Add a class to main menu. This will be overridden for child menus
  // by the next function.
  return '<ul class="menu">' . $vars['tree']    . '</ul>';
}
function bei_menu_tree__menu_advisor_menu($vars) {
    return '<ul class="menu">' . $vars['tree'] . '</ul>';
}
/**
 * A custom wrapper overrides theme_menu_tree() yet again, but only for
 * child menus. This wrapper is declared in mytheme_menu_link__main_menu().
 */
function bei_menu_tree__main_menu__children($vars) {

  // Add a 'dropdown' class to a child menu's <ul> element.
  return '<ul class="dropdown">' . $vars['tree']    . '</ul>';
}
function bei_menu_tree__menu_advisor_menu__children($vars) {
    return '<ul class="dropdown">' . $vars['tree'] . '</ul>';
}
/**
 * Overrides theme_menu_link().
 */
function bei_menu_link__main_menu($vars){
  $element = $vars['element'];
  $sub_menu = '';

  // Perform operations on list items with child menus.
  if ($element['#below']) {

    // Add 'has-dropdown' class to list item.
    $element['#attributes']['class'][] = 'has-dropdown';

    // Declare a new theme wrapper for this list item's child menu.
    $element['#below']['#theme_wrappers'][0] = 'menu_tree__main_menu__children';

    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
function bei_menu_link__menu_advisor_menu($vars){
  $element = $vars['element'];
  $sub_menu = '';

  // Perform operations on list items with child menus.
  if ($element['#below']) {

    // Add 'has-dropdown' class to list item.
    $element['#attributes']['class'][] = 'has-dropdown';

    // Declare a new theme wrapper for this list item's child menu.
    $element['#below']['#theme_wrappers'][0] = 'menu_tree__main_menu__children';

    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Add odd/even classes to panel panes
 */
function bei_preprocess_panels_pane(&$vars) {
  $vars['classes_array'][] = $vars['zebra'];
}

// Alter theme ignored forms
function bei_zurb_foundation_ignored_forms_alter(&$form_ids) {
  $form_ids[] = 'field_collection_item_form';
  $form_ids[] = 'masquerade_block_1';
  $form_ids[] = 'webform_client_form_6164';
}
