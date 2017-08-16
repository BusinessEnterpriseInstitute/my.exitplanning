<?php 
/* fields for subscription_plan of entity type node 
* Generated from our bei_install_helper module -- ie: http://xxxxx/bei/fields/subscription_plan/node 
* 
*/ 
$field_data["subscription_plan"] =
array (
  0 => 
  array (
    'field' => 
    array (
      'entity_types' => 
      array (
        0 => 'node',
      ),
      'foreign keys' => 
      array (
        'format' => 
        array (
          'table' => 'filter_format',
          'columns' => 
          array (
            'format' => 'format',
          ),
        ),
      ),
      'indexes' => 
      array (
        'format' => 
        array (
          0 => 'format',
        ),
      ),
      'settings' => 
      array (
        'profile2_private' => false,
      ),
      'translatable' => '0',
      'storage' => 
      array (
        'type' => 'field_sql_storage',
        'settings' => 
        array (
        ),
        'module' => 'field_sql_storage',
        'active' => '1',
        'details' => 
        array (
          'sql' => 
          array (
            'FIELD_LOAD_CURRENT' => 
            array (
              'field_data_body' => 
              array (
                'value' => 'body_value',
                'summary' => 'body_summary',
                'format' => 'body_format',
              ),
            ),
            'FIELD_LOAD_REVISION' => 
            array (
              'field_revision_body' => 
              array (
                'value' => 'body_value',
                'summary' => 'body_summary',
                'format' => 'body_format',
              ),
            ),
          ),
        ),
      ),
      'field_permissions' => 
      array (
        'type' => '0',
      ),
      'field_name' => 'body',
      'type' => 'text_with_summary',
      'module' => 'text',
      'active' => '1',
      'locked' => '0',
      'cardinality' => '1',
      'deleted' => '0',
      'columns' => 
      array (
        'value' => 
        array (
          'type' => 'text',
          'size' => 'big',
          'not null' => false,
        ),
        'summary' => 
        array (
          'type' => 'text',
          'size' => 'big',
          'not null' => false,
        ),
        'format' => 
        array (
          'type' => 'varchar',
          'length' => 255,
          'not null' => false,
        ),
      ),
      'bundles' => 
      array (
        'node' => 
        array (
          0 => 'page',
          1 => 'article',
          2 => 'newsletter',
          3 => 'video',
          4 => 'group',
          5 => 'forum',
          6 => 'event',
          7 => 'campaign',
          8 => 'webform',
          9 => 'blog_post',
          10 => 'whitepaper',
          11 => 'product',
          12 => 'testimonial',
          13 => 'event_session',
          14 => 'event_speaker',
          15 => 'sessions_attended',
          16 => 'newsletter_series',
          17 => 'subscription_plan',
        ),
      ),
    ),
    'instance' => 
    array (
      'label' => 'Body',
      'widget' => 
      array (
        'type' => 'text_textarea_with_summary',
        'settings' => 
        array (
          'rows' => 20,
          'summary_rows' => 5,
        ),
        'weight' => '1',
        'module' => 'text',
      ),
      'settings' => 
      array (
        'display_summary' => true,
        'text_processing' => 1,
        'user_register_form' => false,
      ),
      'display' => 
      array (
        'default' => 
        array (
          'label' => 'hidden',
          'type' => 'text_default',
          'weight' => '0',
          'settings' => 
          array (
          ),
          'module' => 'text',
        ),
        'teaser' => 
        array (
          'label' => 'hidden',
          'type' => 'text_summary_or_trimmed',
          'settings' => 
          array (
            'trim_length' => 600,
          ),
          'module' => 'text',
          'weight' => 0,
        ),
      ),
      'required' => false,
      'description' => '',
      'field_name' => 'body',
      'entity_type' => 'node',
      'bundle' => 'subscription_plan',
      'deleted' => '0',
      'default_value' => NULL,
    ),
  ),
  1 => 
  array (
    'field' => 
    array (
      'translatable' => '0',
      'entity_types' => 
      array (
      ),
      'settings' => 
      array (
        'attributes' => 
        array (
          'target' => 'default',
          'class' => '',
          'rel' => '',
        ),
        'url' => 0,
        'title' => 'optional',
        'title_value' => '',
        'title_maxlength' => 128,
        'enable_tokens' => 1,
        'display' => 
        array (
          'url_cutoff' => 80,
        ),
      ),
      'storage' => 
      array (
        'type' => 'field_sql_storage',
        'settings' => 
        array (
        ),
        'module' => 'field_sql_storage',
        'active' => '1',
        'details' => 
        array (
          'sql' => 
          array (
            'FIELD_LOAD_CURRENT' => 
            array (
              'field_data_field_plan_checkout_link' => 
              array (
                'url' => 'field_plan_checkout_link_url',
                'title' => 'field_plan_checkout_link_title',
                'attributes' => 'field_plan_checkout_link_attributes',
              ),
            ),
            'FIELD_LOAD_REVISION' => 
            array (
              'field_revision_field_plan_checkout_link' => 
              array (
                'url' => 'field_plan_checkout_link_url',
                'title' => 'field_plan_checkout_link_title',
                'attributes' => 'field_plan_checkout_link_attributes',
              ),
            ),
          ),
        ),
      ),
      'foreign keys' => 
      array (
      ),
      'indexes' => 
      array (
      ),
      'field_permissions' => 
      array (
        'type' => '0',
      ),
      'field_name' => 'field_plan_checkout_link',
      'type' => 'link_field',
      'module' => 'link',
      'active' => '1',
      'locked' => '0',
      'cardinality' => '1',
      'deleted' => '0',
      'columns' => 
      array (
        'url' => 
        array (
          'type' => 'varchar',
          'length' => 2048,
          'not null' => false,
          'sortable' => true,
        ),
        'title' => 
        array (
          'type' => 'varchar',
          'length' => 255,
          'not null' => false,
          'sortable' => true,
        ),
        'attributes' => 
        array (
          'type' => 'text',
          'size' => 'medium',
          'not null' => false,
        ),
      ),
      'bundles' => 
      array (
        'node' => 
        array (
          0 => 'subscription_plan',
        ),
      ),
    ),
    'instance' => 
    array (
      'label' => 'Plan Checkout Link',
      'widget' => 
      array (
        'weight' => '6',
        'type' => 'link_field',
        'module' => 'link',
        'active' => 0,
        'settings' => 
        array (
        ),
      ),
      'settings' => 
      array (
        'absolute_url' => 0,
        'validate_url' => 0,
        'url' => 0,
        'title' => 'required',
        'title_value' => '',
        'title_label_use_field_label' => 0,
        'title_maxlength' => '128',
        'enable_tokens' => 1,
        'display' => 
        array (
          'url_cutoff' => '80',
        ),
        'attributes' => 
        array (
          'target' => 'default',
          'rel' => '',
          'configurable_class' => 0,
          'class' => 'button',
          'configurable_title' => 0,
          'title' => '',
        ),
        'rel_remove' => 'default',
        'user_register_form' => false,
      ),
      'display' => 
      array (
        'default' => 
        array (
          'label' => 'hidden',
          'type' => 'link_default',
          'weight' => '1',
          'settings' => 
          array (
          ),
          'module' => 'link',
        ),
        'teaser' => 
        array (
          'type' => 'hidden',
          'label' => 'above',
          'settings' => 
          array (
          ),
          'weight' => 0,
        ),
      ),
      'required' => 0,
      'description' => 'Button link text as title. Specific checkout URL string as link.',
      'fences_wrapper' => 'div',
      'default_value' => NULL,
      'field_name' => 'field_plan_checkout_link',
      'entity_type' => 'node',
      'bundle' => 'subscription_plan',
      'deleted' => '0',
    ),
  ),
  2 => 
  array (
    'field' => 
    array (
      'translatable' => '0',
      'entity_types' => 
      array (
      ),
      'settings' => 
      array (
      ),
      'storage' => 
      array (
        'type' => 'field_sql_storage',
        'settings' => 
        array (
        ),
        'module' => 'field_sql_storage',
        'active' => '1',
        'details' => 
        array (
          'sql' => 
          array (
            'FIELD_LOAD_CURRENT' => 
            array (
              'field_data_field_subscription_details' => 
              array (
                'value' => 'field_subscription_details_value',
                'format' => 'field_subscription_details_format',
              ),
            ),
            'FIELD_LOAD_REVISION' => 
            array (
              'field_revision_field_subscription_details' => 
              array (
                'value' => 'field_subscription_details_value',
                'format' => 'field_subscription_details_format',
              ),
            ),
          ),
        ),
      ),
      'foreign keys' => 
      array (
        'format' => 
        array (
          'table' => 'filter_format',
          'columns' => 
          array (
            'format' => 'format',
          ),
        ),
      ),
      'indexes' => 
      array (
        'format' => 
        array (
          0 => 'format',
        ),
      ),
      'field_permissions' => 
      array (
        'type' => '0',
      ),
      'field_name' => 'field_subscription_details',
      'type' => 'text_long',
      'module' => 'text',
      'active' => '1',
      'locked' => '0',
      'cardinality' => '1',
      'deleted' => '0',
      'columns' => 
      array (
        'value' => 
        array (
          'type' => 'text',
          'size' => 'big',
          'not null' => false,
        ),
        'format' => 
        array (
          'type' => 'varchar',
          'length' => 255,
          'not null' => false,
        ),
      ),
      'bundles' => 
      array (
        'node' => 
        array (
          0 => 'subscription_plan',
        ),
      ),
    ),
    'instance' => 
    array (
      'label' => 'Subscription Details',
      'widget' => 
      array (
        'weight' => '7',
        'type' => 'text_textarea',
        'module' => 'text',
        'active' => 1,
        'settings' => 
        array (
          'rows' => '5',
        ),
      ),
      'settings' => 
      array (
        'text_processing' => '1',
        'better_formats' => 
        array (
          'allowed_formats_toggle' => 1,
          'allowed_formats' => 
          array (
            'raw_html' => 'raw_html',
            'epic' => 0,
            'filtered_html' => 0,
            'mailchimp_campaign' => 0,
            'full_html' => 0,
            'plain_text' => 0,
            'php_code' => 0,
          ),
          'default_order_toggle' => 0,
          'default_order_wrapper' => 
          array (
            'formats' => 
            array (
              'epic' => 
              array (
                'weight' => '0',
              ),
              'raw_html' => 
              array (
                'weight' => '0',
              ),
              'filtered_html' => 
              array (
                'weight' => '0',
              ),
              'mailchimp_campaign' => 
              array (
                'weight' => '0',
              ),
              'full_html' => 
              array (
                'weight' => '1',
              ),
              'plain_text' => 
              array (
                'weight' => '10',
              ),
              'php_code' => 
              array (
                'weight' => '11',
              ),
            ),
          ),
        ),
        'user_register_form' => false,
      ),
      'display' => 
      array (
        'default' => 
        array (
          'label' => 'hidden',
          'type' => 'text_default',
          'weight' => '2',
          'settings' => 
          array (
          ),
          'module' => 'text',
        ),
        'teaser' => 
        array (
          'type' => 'hidden',
          'label' => 'above',
          'settings' => 
          array (
          ),
          'weight' => 0,
        ),
      ),
      'required' => 0,
      'description' => '',
      'fences_wrapper' => 'div',
      'default_value' => 
      array (
        0 => 
        array (
          'value' => '',
          'format' => 'full_html',
        ),
      ),
      'field_name' => 'field_subscription_details',
      'entity_type' => 'node',
      'bundle' => 'subscription_plan',
      'deleted' => '0',
    ),
  ),
  3 => 
  array (
    'field' => 
    array (
      'translatable' => '0',
      'entity_types' => 
      array (
      ),
      'settings' => 
      array (
      ),
      'storage' => 
      array (
        'type' => 'field_sql_storage',
        'settings' => 
        array (
        ),
        'module' => 'field_sql_storage',
        'active' => '1',
        'details' => 
        array (
          'sql' => 
          array (
            'FIELD_LOAD_CURRENT' => 
            array (
              'field_data_field_subscription_inclusions' => 
              array (
                'value' => 'field_subscription_inclusions_value',
                'format' => 'field_subscription_inclusions_format',
              ),
            ),
            'FIELD_LOAD_REVISION' => 
            array (
              'field_revision_field_subscription_inclusions' => 
              array (
                'value' => 'field_subscription_inclusions_value',
                'format' => 'field_subscription_inclusions_format',
              ),
            ),
          ),
        ),
      ),
      'foreign keys' => 
      array (
        'format' => 
        array (
          'table' => 'filter_format',
          'columns' => 
          array (
            'format' => 'format',
          ),
        ),
      ),
      'indexes' => 
      array (
        'format' => 
        array (
          0 => 'format',
        ),
      ),
      'field_permissions' => 
      array (
        'type' => '0',
      ),
      'field_name' => 'field_subscription_inclusions',
      'type' => 'text_long',
      'module' => 'text',
      'active' => '1',
      'locked' => '0',
      'cardinality' => '1',
      'deleted' => '0',
      'columns' => 
      array (
        'value' => 
        array (
          'type' => 'text',
          'size' => 'big',
          'not null' => false,
        ),
        'format' => 
        array (
          'type' => 'varchar',
          'length' => 255,
          'not null' => false,
        ),
      ),
      'bundles' => 
      array (
        'node' => 
        array (
          0 => 'subscription_plan',
        ),
      ),
    ),
    'instance' => 
    array (
      'label' => 'Subscription Inclusions',
      'widget' => 
      array (
        'weight' => '8',
        'type' => 'text_textarea',
        'module' => 'text',
        'active' => 1,
        'settings' => 
        array (
          'rows' => '5',
        ),
      ),
      'settings' => 
      array (
        'text_processing' => '1',
        'better_formats' => 
        array (
          'allowed_formats_toggle' => 1,
          'allowed_formats' => 
          array (
            'full_html' => 'full_html',
            'epic' => 0,
            'raw_html' => 0,
            'filtered_html' => 0,
            'mailchimp_campaign' => 0,
            'plain_text' => 0,
            'php_code' => 0,
          ),
          'default_order_toggle' => 0,
          'default_order_wrapper' => 
          array (
            'formats' => 
            array (
              'epic' => 
              array (
                'weight' => '0',
              ),
              'raw_html' => 
              array (
                'weight' => '0',
              ),
              'filtered_html' => 
              array (
                'weight' => '0',
              ),
              'mailchimp_campaign' => 
              array (
                'weight' => '0',
              ),
              'full_html' => 
              array (
                'weight' => '1',
              ),
              'plain_text' => 
              array (
                'weight' => '10',
              ),
              'php_code' => 
              array (
                'weight' => '11',
              ),
            ),
          ),
        ),
        'user_register_form' => false,
      ),
      'display' => 
      array (
        'default' => 
        array (
          'label' => 'hidden',
          'type' => 'text_default',
          'weight' => '3',
          'settings' => 
          array (
          ),
          'module' => 'text',
        ),
        'teaser' => 
        array (
          'type' => 'hidden',
          'label' => 'above',
          'settings' => 
          array (
          ),
          'weight' => 0,
        ),
      ),
      'required' => 0,
      'description' => '',
      'fences_wrapper' => 'div',
      'default_value' => 
      array (
        0 => 
        array (
          'value' => '',
        ),
      ),
      'field_name' => 'field_subscription_inclusions',
      'entity_type' => 'node',
      'bundle' => 'subscription_plan',
      'deleted' => '0',
    ),
  ),
  4 => 
  array (
    'field' => 
    array (
      'translatable' => '0',
      'entity_types' => 
      array (
      ),
      'settings' => 
      array (
      ),
      'storage' => 
      array (
        'type' => 'field_sql_storage',
        'settings' => 
        array (
        ),
        'module' => 'field_sql_storage',
        'active' => '1',
        'details' => 
        array (
          'sql' => 
          array (
            'FIELD_LOAD_CURRENT' => 
            array (
              'field_data_field_bottom_text' => 
              array (
                'value' => 'field_bottom_text_value',
                'format' => 'field_bottom_text_format',
              ),
            ),
            'FIELD_LOAD_REVISION' => 
            array (
              'field_revision_field_bottom_text' => 
              array (
                'value' => 'field_bottom_text_value',
                'format' => 'field_bottom_text_format',
              ),
            ),
          ),
        ),
      ),
      'foreign keys' => 
      array (
        'format' => 
        array (
          'table' => 'filter_format',
          'columns' => 
          array (
            'format' => 'format',
          ),
        ),
      ),
      'indexes' => 
      array (
        'format' => 
        array (
          0 => 'format',
        ),
      ),
      'field_permissions' => 
      array (
        'type' => '0',
      ),
      'field_name' => 'field_bottom_text',
      'type' => 'text_long',
      'module' => 'text',
      'active' => '1',
      'locked' => '0',
      'cardinality' => '1',
      'deleted' => '0',
      'columns' => 
      array (
        'value' => 
        array (
          'type' => 'text',
          'size' => 'big',
          'not null' => false,
        ),
        'format' => 
        array (
          'type' => 'varchar',
          'length' => 255,
          'not null' => false,
        ),
      ),
      'bundles' => 
      array (
        'node' => 
        array (
          0 => 'subscription_plan',
        ),
      ),
    ),
    'instance' => 
    array (
      'label' => 'Bottom Text',
      'widget' => 
      array (
        'weight' => '10',
        'type' => 'text_textarea',
        'module' => 'text',
        'active' => 1,
        'settings' => 
        array (
          'rows' => '5',
        ),
      ),
      'settings' => 
      array (
        'text_processing' => '1',
        'better_formats' => 
        array (
          'allowed_formats_toggle' => 0,
          'allowed_formats' => 
          array (
            'epic' => 'epic',
            'raw_html' => 'raw_html',
            'filtered_html' => 'filtered_html',
            'mailchimp_campaign' => 'mailchimp_campaign',
            'full_html' => 'full_html',
            'plain_text' => 'plain_text',
            'php_code' => 'php_code',
          ),
          'default_order_toggle' => 0,
          'default_order_wrapper' => 
          array (
            'formats' => 
            array (
              'epic' => 
              array (
                'weight' => '0',
              ),
              'raw_html' => 
              array (
                'weight' => '0',
              ),
              'filtered_html' => 
              array (
                'weight' => '0',
              ),
              'mailchimp_campaign' => 
              array (
                'weight' => '0',
              ),
              'full_html' => 
              array (
                'weight' => '1',
              ),
              'plain_text' => 
              array (
                'weight' => '10',
              ),
              'php_code' => 
              array (
                'weight' => '11',
              ),
            ),
          ),
        ),
        'user_register_form' => false,
      ),
      'display' => 
      array (
        'default' => 
        array (
          'label' => 'hidden',
          'type' => 'text_default',
          'weight' => '5',
          'settings' => 
          array (
          ),
          'module' => 'text',
        ),
        'teaser' => 
        array (
          'type' => 'hidden',
          'label' => 'above',
          'settings' => 
          array (
          ),
          'weight' => 0,
        ),
      ),
      'required' => 0,
      'description' => '',
      'fences_wrapper' => 'div',
      'default_value' => 
      array (
        0 => 
        array (
          'value' => '',
        ),
      ),
      'field_name' => 'field_bottom_text',
      'entity_type' => 'node',
      'bundle' => 'subscription_plan',
      'deleted' => '0',
    ),
  ),
  5 => 
  array (
    'field' => 
    array (
      'translatable' => '0',
      'entity_types' => 
      array (
      ),
      'settings' => 
      array (
      ),
      'storage' => 
      array (
        'type' => 'field_sql_storage',
        'settings' => 
        array (
        ),
        'module' => 'field_sql_storage',
        'active' => '1',
        'details' => 
        array (
          'sql' => 
          array (
            'FIELD_LOAD_CURRENT' => 
            array (
              'field_data_field_brief_description' => 
              array (
                'value' => 'field_brief_description_value',
                'format' => 'field_brief_description_format',
              ),
            ),
            'FIELD_LOAD_REVISION' => 
            array (
              'field_revision_field_brief_description' => 
              array (
                'value' => 'field_brief_description_value',
                'format' => 'field_brief_description_format',
              ),
            ),
          ),
        ),
      ),
      'foreign keys' => 
      array (
        'format' => 
        array (
          'table' => 'filter_format',
          'columns' => 
          array (
            'format' => 'format',
          ),
        ),
      ),
      'indexes' => 
      array (
        'format' => 
        array (
          0 => 'format',
        ),
      ),
      'field_permissions' => 
      array (
        'type' => '0',
      ),
      'field_name' => 'field_brief_description',
      'type' => 'text_long',
      'module' => 'text',
      'active' => '1',
      'locked' => '0',
      'cardinality' => '1',
      'deleted' => '0',
      'columns' => 
      array (
        'value' => 
        array (
          'type' => 'text',
          'size' => 'big',
          'not null' => false,
        ),
        'format' => 
        array (
          'type' => 'varchar',
          'length' => 255,
          'not null' => false,
        ),
      ),
      'bundles' => 
      array (
        'node' => 
        array (
          0 => 'subscription_plan',
        ),
      ),
    ),
    'instance' => 
    array (
      'label' => 'Brief Description',
      'widget' => 
      array (
        'weight' => '11',
        'type' => 'text_textarea',
        'module' => 'text',
        'active' => 1,
        'settings' => 
        array (
          'rows' => '3',
        ),
      ),
      'settings' => 
      array (
        'text_processing' => '1',
        'better_formats' => 
        array (
          'allowed_formats_toggle' => 0,
          'allowed_formats' => 
          array (
            'epic' => 'epic',
            'raw_html' => 'raw_html',
            'filtered_html' => 'filtered_html',
            'mailchimp_campaign' => 'mailchimp_campaign',
            'full_html' => 'full_html',
            'plain_text' => 'plain_text',
            'php_code' => 'php_code',
          ),
          'default_order_toggle' => 0,
          'default_order_wrapper' => 
          array (
            'formats' => 
            array (
              'epic' => 
              array (
                'weight' => '0',
              ),
              'raw_html' => 
              array (
                'weight' => '0',
              ),
              'filtered_html' => 
              array (
                'weight' => '0',
              ),
              'mailchimp_campaign' => 
              array (
                'weight' => '0',
              ),
              'full_html' => 
              array (
                'weight' => '1',
              ),
              'plain_text' => 
              array (
                'weight' => '10',
              ),
              'php_code' => 
              array (
                'weight' => '11',
              ),
            ),
          ),
        ),
        'user_register_form' => false,
      ),
      'display' => 
      array (
        'default' => 
        array (
          'label' => 'above',
          'type' => 'hidden',
          'weight' => '6',
          'settings' => 
          array (
          ),
        ),
        'teaser' => 
        array (
          'type' => 'hidden',
          'label' => 'above',
          'settings' => 
          array (
          ),
          'weight' => 0,
        ),
      ),
      'required' => 0,
      'description' => 'Used on the Membership Overview page.',
      'fences_wrapper' => 'div',
      'default_value' => 
      array (
        0 => 
        array (
          'value' => '',
        ),
      ),
      'field_name' => 'field_brief_description',
      'entity_type' => 'node',
      'bundle' => 'subscription_plan',
      'deleted' => '0',
    ),
  ),
  6 => 
  array (
    'field' => 
    array (
      'translatable' => '0',
      'entity_types' => 
      array (
      ),
      'settings' => 
      array (
        'max_length' => '255',
      ),
      'storage' => 
      array (
        'type' => 'field_sql_storage',
        'settings' => 
        array (
        ),
        'module' => 'field_sql_storage',
        'active' => '1',
        'details' => 
        array (
          'sql' => 
          array (
            'FIELD_LOAD_CURRENT' => 
            array (
              'field_data_field_price_field' => 
              array (
                'value' => 'field_price_field_value',
                'format' => 'field_price_field_format',
              ),
            ),
            'FIELD_LOAD_REVISION' => 
            array (
              'field_revision_field_price_field' => 
              array (
                'value' => 'field_price_field_value',
                'format' => 'field_price_field_format',
              ),
            ),
          ),
        ),
      ),
      'foreign keys' => 
      array (
        'format' => 
        array (
          'table' => 'filter_format',
          'columns' => 
          array (
            'format' => 'format',
          ),
        ),
      ),
      'indexes' => 
      array (
        'format' => 
        array (
          0 => 'format',
        ),
      ),
      'field_permissions' => 
      array (
        'type' => '0',
      ),
      'field_name' => 'field_price_field',
      'type' => 'text',
      'module' => 'text',
      'active' => '1',
      'locked' => '0',
      'cardinality' => '1',
      'deleted' => '0',
      'columns' => 
      array (
        'value' => 
        array (
          'type' => 'varchar',
          'length' => '255',
          'not null' => false,
        ),
        'format' => 
        array (
          'type' => 'varchar',
          'length' => 255,
          'not null' => false,
        ),
      ),
      'bundles' => 
      array (
        'node' => 
        array (
          0 => 'subscription_plan',
        ),
      ),
    ),
    'instance' => 
    array (
      'label' => 'Price Field',
      'widget' => 
      array (
        'weight' => '12',
        'type' => 'text_textfield',
        'module' => 'text',
        'active' => 1,
        'settings' => 
        array (
          'size' => '60',
        ),
      ),
      'settings' => 
      array (
        'text_processing' => '0',
        'better_formats' => 
        array (
          'allowed_formats_toggle' => 0,
          'allowed_formats' => 
          array (
            'epic' => 'epic',
            'raw_html' => 'raw_html',
            'filtered_html' => 'filtered_html',
            'mailchimp_campaign' => 'mailchimp_campaign',
            'full_html' => 'full_html',
            'plain_text' => 'plain_text',
            'php_code' => 'php_code',
          ),
          'default_order_toggle' => 0,
          'default_order_wrapper' => 
          array (
            'formats' => 
            array (
              'epic' => 
              array (
                'weight' => '0',
              ),
              'raw_html' => 
              array (
                'weight' => '0',
              ),
              'filtered_html' => 
              array (
                'weight' => '0',
              ),
              'mailchimp_campaign' => 
              array (
                'weight' => '0',
              ),
              'full_html' => 
              array (
                'weight' => '1',
              ),
              'plain_text' => 
              array (
                'weight' => '10',
              ),
              'php_code' => 
              array (
                'weight' => '11',
              ),
            ),
          ),
        ),
        'user_register_form' => false,
      ),
      'display' => 
      array (
        'default' => 
        array (
          'label' => 'above',
          'type' => 'hidden',
          'weight' => '7',
          'settings' => 
          array (
          ),
        ),
        'teaser' => 
        array (
          'type' => 'hidden',
          'label' => 'above',
          'settings' => 
          array (
          ),
          'weight' => 0,
        ),
      ),
      'required' => 0,
      'description' => 'Will be prefixed by "Starting at "',
      'fences_wrapper' => 'div',
      'default_value' => NULL,
      'field_name' => 'field_price_field',
      'entity_type' => 'node',
      'bundle' => 'subscription_plan',
      'deleted' => '0',
    ),
  ),
  7 => 
  array (
    'field' => 
    array (
      'translatable' => '0',
      'entity_types' => 
      array (
      ),
      'settings' => 
      array (
        'max_length' => '255',
      ),
      'storage' => 
      array (
        'type' => 'field_sql_storage',
        'settings' => 
        array (
        ),
        'module' => 'field_sql_storage',
        'active' => '1',
        'details' => 
        array (
          'sql' => 
          array (
            'FIELD_LOAD_CURRENT' => 
            array (
              'field_data_field_linked_recurly_plan_codes' => 
              array (
                'value' => 'field_linked_recurly_plan_codes_value',
                'format' => 'field_linked_recurly_plan_codes_format',
              ),
            ),
            'FIELD_LOAD_REVISION' => 
            array (
              'field_revision_field_linked_recurly_plan_codes' => 
              array (
                'value' => 'field_linked_recurly_plan_codes_value',
                'format' => 'field_linked_recurly_plan_codes_format',
              ),
            ),
          ),
        ),
      ),
      'foreign keys' => 
      array (
        'format' => 
        array (
          'table' => 'filter_format',
          'columns' => 
          array (
            'format' => 'format',
          ),
        ),
      ),
      'indexes' => 
      array (
        'format' => 
        array (
          0 => 'format',
        ),
      ),
      'field_permissions' => 
      array (
        'type' => '0',
      ),
      'field_name' => 'field_linked_recurly_plan_codes',
      'type' => 'text',
      'module' => 'text',
      'active' => '1',
      'locked' => '0',
      'cardinality' => '-1',
      'deleted' => '0',
      'columns' => 
      array (
        'value' => 
        array (
          'type' => 'varchar',
          'length' => '255',
          'not null' => false,
        ),
        'format' => 
        array (
          'type' => 'varchar',
          'length' => 255,
          'not null' => false,
        ),
      ),
      'bundles' => 
      array (
        'node' => 
        array (
          0 => 'subscription_plan',
        ),
      ),
    ),
    'instance' => 
    array (
      'label' => 'Linked Recurly Plan Codes',
      'widget' => 
      array (
        'weight' => '13',
        'type' => 'text_textfield',
        'module' => 'text',
        'active' => 1,
        'settings' => 
        array (
          'size' => '60',
        ),
      ),
      'settings' => 
      array (
        'text_processing' => '0',
        'better_formats' => 
        array (
          'allowed_formats_toggle' => 0,
          'allowed_formats' => 
          array (
            'epic' => 'epic',
            'raw_html' => 'raw_html',
            'filtered_html' => 'filtered_html',
            'mailchimp_campaign' => 'mailchimp_campaign',
            'full_html' => 'full_html',
            'plain_text' => 'plain_text',
            'php_code' => 'php_code',
          ),
          'default_order_toggle' => 0,
          'default_order_wrapper' => 
          array (
            'formats' => 
            array (
              'epic' => 
              array (
                'weight' => '0',
              ),
              'raw_html' => 
              array (
                'weight' => '0',
              ),
              'filtered_html' => 
              array (
                'weight' => '0',
              ),
              'mailchimp_campaign' => 
              array (
                'weight' => '0',
              ),
              'full_html' => 
              array (
                'weight' => '1',
              ),
              'plain_text' => 
              array (
                'weight' => '10',
              ),
              'php_code' => 
              array (
                'weight' => '11',
              ),
            ),
          ),
        ),
        'user_register_form' => false,
      ),
      'display' => 
      array (
        'default' => 
        array (
          'label' => 'above',
          'type' => 'hidden',
          'weight' => '8',
          'settings' => 
          array (
          ),
        ),
        'teaser' => 
        array (
          'type' => 'hidden',
          'label' => 'above',
          'settings' => 
          array (
          ),
          'weight' => 0,
        ),
      ),
      'required' => 0,
      'description' => 'The \'Plan Codes\' from Recurly. One per line/field.',
      'fences_wrapper' => 'div',
      'default_value' => NULL,
      'field_name' => 'field_linked_recurly_plan_codes',
      'entity_type' => 'node',
      'bundle' => 'subscription_plan',
      'deleted' => '0',
    ),
  ),
  8 => 
  array (
    'field' => 
    array (
      'translatable' => '0',
      'entity_types' => 
      array (
      ),
      'settings' => 
      array (
        'attributes' => 
        array (
          'target' => 'default',
          'class' => '',
          'rel' => '',
        ),
        'url' => 0,
        'title' => 'optional',
        'title_value' => '',
        'title_maxlength' => 128,
        'enable_tokens' => 1,
        'display' => 
        array (
          'url_cutoff' => 80,
        ),
      ),
      'storage' => 
      array (
        'type' => 'field_sql_storage',
        'settings' => 
        array (
        ),
        'module' => 'field_sql_storage',
        'active' => '1',
        'details' => 
        array (
          'sql' => 
          array (
            'FIELD_LOAD_CURRENT' => 
            array (
              'field_data_field_bottom_membership_link' => 
              array (
                'url' => 'field_bottom_membership_link_url',
                'title' => 'field_bottom_membership_link_title',
                'attributes' => 'field_bottom_membership_link_attributes',
              ),
            ),
            'FIELD_LOAD_REVISION' => 
            array (
              'field_revision_field_bottom_membership_link' => 
              array (
                'url' => 'field_bottom_membership_link_url',
                'title' => 'field_bottom_membership_link_title',
                'attributes' => 'field_bottom_membership_link_attributes',
              ),
            ),
          ),
        ),
      ),
      'foreign keys' => 
      array (
      ),
      'indexes' => 
      array (
      ),
      'field_permissions' => 
      array (
        'type' => '0',
      ),
      'field_name' => 'field_bottom_membership_link',
      'type' => 'link_field',
      'module' => 'link',
      'active' => '1',
      'locked' => '0',
      'cardinality' => '1',
      'deleted' => '0',
      'columns' => 
      array (
        'url' => 
        array (
          'type' => 'varchar',
          'length' => 2048,
          'not null' => false,
          'sortable' => true,
        ),
        'title' => 
        array (
          'type' => 'varchar',
          'length' => 255,
          'not null' => false,
          'sortable' => true,
        ),
        'attributes' => 
        array (
          'type' => 'text',
          'size' => 'medium',
          'not null' => false,
        ),
      ),
      'bundles' => 
      array (
        'node' => 
        array (
          0 => 'subscription_plan',
        ),
      ),
    ),
    'instance' => 
    array (
      'label' => 'Bottom Membership Link',
      'widget' => 
      array (
        'weight' => '9',
        'type' => 'link_field',
        'module' => 'link',
        'active' => 0,
        'settings' => 
        array (
        ),
      ),
      'settings' => 
      array (
        'absolute_url' => 1,
        'validate_url' => 0,
        'url' => 0,
        'title' => 'required',
        'title_value' => '',
        'title_label_use_field_label' => 0,
        'title_maxlength' => '128',
        'enable_tokens' => 1,
        'display' => 
        array (
          'url_cutoff' => '80',
        ),
        'attributes' => 
        array (
          'target' => 'default',
          'rel' => '',
          'configurable_class' => 0,
          'class' => 'button large',
          'configurable_title' => 0,
          'title' => '',
        ),
        'rel_remove' => 'default',
        'user_register_form' => false,
      ),
      'display' => 
      array (
        'default' => 
        array (
          'label' => 'hidden',
          'type' => 'link_default',
          'weight' => '4',
          'settings' => 
          array (
          ),
          'module' => 'link',
        ),
        'teaser' => 
        array (
          'type' => 'hidden',
          'label' => 'above',
          'settings' => 
          array (
          ),
          'weight' => 0,
        ),
      ),
      'required' => 0,
      'description' => 'Button link text as title. Specific checkout URL string as link.',
      'fences_wrapper' => 'div',
      'default_value' => NULL,
      'field_name' => 'field_bottom_membership_link',
      'entity_type' => 'node',
      'bundle' => 'subscription_plan',
      'deleted' => '0',
    ),
  ),
)
;