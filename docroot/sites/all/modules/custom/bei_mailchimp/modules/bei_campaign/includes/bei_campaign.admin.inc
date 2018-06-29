<?php

/**
 * Page callback.
 *
 * @see bei_campaign_menu().
 */
function bei_campaign_batch_form() {
  $form = array();
  $form['important'] = array(
    '#type' => 'markup',
    '#prefix' => '<div>',
    '#markup' => t('Clicking submit will run a batch processor to create or update campaigns. Do not refresh the batch processor until it is complete.'),
    '#suffix' => '</div><br>',
  );
  $form['list'] = array(
    '#type' => 'select',
    '#title' => t('List'),
    '#description' => t('Choose the list that you would like to sync subscribers with.'),
    '#options' => bei_mailchimp_get_lists(TRUE),
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Import'),
  );
  return $form;
}

/**
 * Submit handler.
 *
 * @see bei_campaign_batch_form()
 */
function bei_campaign_batch_form_submit($form, $form_state) {
  // Using the list that was selected, load the List ID.
  $list_id = db_query('SELECT l.list_id FROM {bei_list} l WHERE l.nid = :nid', array(
    ':nid' => $form_state['values']['list'],
  ))->fetchField();
  if (!empty($list_id)) {
    $offset = 0;
    $count = 500;
    $mc_campaigns = bei_campaign_get_list_campaigns(FALSE, $list_id, $offset, $count);
    if ($mc_campaigns) {
      $campaigns = array();
      $operations = array();
      $counter = 0;
      $total = count($mc_campaigns);
      if ($total > 5) {
        foreach ($mc_campaigns as $campaign) {
          $campaigns[] = $campaign;
          unset($campaign);
          $counter++;
          if ($counter >= 5) {
            $counter = 0;
            $operations[] = array(
              'bei_campaign_batch_processing',
              array($campaigns),
            );
            $campaigns = array();
          }
        }
        // Add any remaining campaigns.
        if (!empty($campaigns)) {
          $operations[] = array(
            'bei_campaign_batch_processing',
             array($campaigns),
          );
        }
      }
      else {
        $operations[] = array(
          'bei_campaign_batch_processing',
          array($mc_campaigns),
        );
      }
      // Once everything is gathered and ready to be processed... process it!
      $batch = array(
        'title' => t('Syncing campaigns...'),
        'operations' => $operations,
        'finished' => 'bei_campaign_batch_finished',
        'error_message' => t('The campaign sync batch processor has encountered an error.'),
        'progress_message' => t('Checked @current of @total lists.'),
      );
      batch_set($batch);
    }
  }
}
