<?php
/*
 * Implements hook_rules_action_info().
 */
function bei_subscriber_rules_action_info() {
  return array(
    'subscribe_to_mailchimp' => array(
      'label' => t('Subscribe to Mailchimp'),
      'parameter' => array(
        'subscriber' => array(
          'type' => 'bei_subscriber',
          'label' => t('Subscriber'),
        ),
        'skip_cron' => array(
          'type' => 'boolean',
          'label' => t('Skip cron and process immediately'),
        ),
      ),
      'group' => t('BEI Mailchimp'),
      'base' => 'rules_action_subscribe_to_mailchimp',
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
function rules_action_subscribe_to_mailchimp($subscriber, $skip_cron = FALSE) {
  bei_subscriber_subscribe($subscriber, FALSE, $skip_cron);
}
