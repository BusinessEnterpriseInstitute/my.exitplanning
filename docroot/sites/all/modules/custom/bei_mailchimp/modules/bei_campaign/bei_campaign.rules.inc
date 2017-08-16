<?php
/*
 * Implements hook_rules_action_info().
 */
function bei_campaign_rules_action_info() {
  return array(
    'create_template_campaign' => array(
      'label' => t('Create a Mailchimp Campaign'),
      'parameter' => array(
        'article' => array(
          'type' => 'node',
          'label' => t('Newsletter Article'),
        ),
        'list' => array(
          'type' => 'node',
          'label' => t('Subscriber List'),
        ),
      ),
      'provides' => array(
        'created_campaign' => array(
          'type' => 'node',
          'label' => t('Campaign'),
        ),
      ),
      'group' => t('BEI Campaign'),
      'base' => 'rules_action_create_template_campaign',
      'callbacks' => array(
        //'validate' => 'rules_action_custom_validation',
        //'help' => 'rules_mail_help',
      ),
    ),
  );
}

/*
 * Function to create a cammpaign from variables.
 */
function rules_action_create_template_campaign($article, $list) {
  $node = new stdClass();
  $node->type = 'campaign';
  node_object_prepare($node);

  $node->title = $article->title;
  $node->uid = $list->uid;
  $body = field_get_items('node', $article, 'body');
  $default_logo = field_get_items('node', $list, 'field_mc_logo');
  $default_profile_pic = field_get_items('node', $list, 'field_mc_profile_pic');
  $default_banner = field_get_items('node', $list, 'field_mc_banner');
  $default_bg_color = field_get_items('node', $list, 'field_mc_color_email_bg');
  $default_bg_header_color = field_get_items('node', $list, 'field_mc_color_primary');
  if ($body) {
    $node->body[LANGUAGE_NONE][0]['value'] = $body[0]['value'];
    $node->body[LANGUAGE_NONE][0]['safe_value'] = $body[0]['safe_value'];
    $node->body[LANGUAGE_NONE][0]['format'] = $body[0]['format'];
  }
  $node->field_newsletter_ref[LANGUAGE_NONE][0]['target_id'] = $article->nid;
  $node->field_subscriber_list[LANGUAGE_NONE][0]['target_id'] = $list->nid;
  $node->from_email = $list->from_email;
  $node->from_name = $list->from_name;
  $node->subject = !empty($list->subject) ? $list->subject : $article->title;
  $node->list_id = $list->list_id;
  $node->headline = $article->title;
  if ($default_logo) {
    $file = file_load($default_logo[0]['fid']);
    $node->field_mc_logo[LANGUAGE_NONE][0] = (array)$file;
  }
  if ($default_profile_pic) {
    $file = file_load($default_profile_pic[0]['fid']);
    $node->field_mc_profile_pic[LANGUAGE_NONE][0] = (array)$file;
  }
  if ($default_banner) {
    $file = file_load($default_banner[0]['fid']);
    $node->field_mc_banner[LANGUAGE_NONE][0] = (array)$file;
  }
  if ($default_bg_color) {
    $node->field_mc_color_email_bg[LANGUAGE_NONE][0]['rgb'] = $default_bg_color[0]['rgb'];
  }
  if ($default_bg_header_color) {
    $node->field_mc_color_primary[LANGUAGE_NONE][0]['rgb'] = $default_bg_header_color[0]['rgb'];
  }

  // Save the node!
  node_save($node);
  return array(
    'created_campaign' => $node,
  );
}
