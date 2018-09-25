<?php

/**
 * @file
 * Admin tasks using batch processing to create/update lists.
 */

/**
 * Page callback.
 *
 * @see bei_list_menu().
 */
function bei_list_batch_form() {
  $form = array();

  $form['important'] = array(
    '#type' => 'markup',
    '#prefix' => '<div>',
    '#markup' => t('Clicking submit will run a batch processor to create non-existing lists. Do not refresh the batch processor until it is complete.'),
    '#suffix' => '</div><br>',
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
 * @see bei_list_batch_form()
 */
function bei_list_batch_form_submit($form, $form_state) {
  $mc_lists = bei_list_get_lists(TRUE);
  if ($mc_lists) {
    $lists = array();
    $start = 0;
    $break = FALSE;
    $operations = array();
    $counter = 0;
    $total = count($mc_lists);
    if ($total > 5) {
      foreach ($mc_lists as $list) {
        $lists[] = $list;
        unset($list);
        $counter++;

        if ($counter >= 5) {
          $counter = 0;
          $operations[] = array(
            'bei_list_batch_processing',
            array($lists),
          );
          $lists = array();
        }
      }
      // Add any remaining lists.
      if (!empty($lists)) {
        $operations[] = array(
          'bei_list_batch_processing',
           array($lists),
        );
      }
    }
    else {
      $operations[] = array(
        'bei_list_batch_processing',
        array($mc_lists),
      );
    }
    // Once everything is gathered and ready to be processed... process it!
    $batch = array(
      'title' => t('Creating lists...'),
      'operations' => $operations,
      'finished' => 'bei_list_batch_finished',
      'error_message' => t('The list sync batch processor has encountered an error.'),
      'progress_message' => t('Checked @current of @total lists.'),
    );
    batch_set($batch);
  }
}
