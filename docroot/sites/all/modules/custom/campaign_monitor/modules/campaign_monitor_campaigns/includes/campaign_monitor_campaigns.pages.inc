<?php
/**
 * Menu callback to display an entity.
 *
 * As we load the entity for display, we're responsible for invoking a number
 * of hooks in their proper order.
 *
 * @see hook_entity_prepare_view()
 * @see hook_entity_view()
 * @see hook_entity_view_alter()
 */
/*
 * Page callback to return view of campaigns referenced to list.
 */
function campaign_monitor_campaigns_list($list) {
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $list_uri = entity_uri('cm_list', $list);
  $breadcrumb[] = l(t('@list', array('@list' => entity_label('cm_list', $list))), $list_uri['path']);
  drupal_set_breadcrumb($breadcrumb);
  
  $output = views_embed_view('campaign_monitor_campaigns', 'default', $list->id);
  return $output;
}

function campaign_monitor_campaigns_cm_campaign_view($entity, $view_mode = 'full') {
  // Our entity type, for convenience.
  $entity_type = 'cm_campaign';
  // Start setting up the content.
  $entity->content = array(
    '#view_mode' => $view_mode,
  );
  //$data = $entity->list_data;
  // Build fields content - this is where the Field API really comes in to play.
  // The task has very little code here because it all gets taken care of by
  // field module.
  // field_attach_prepare_view() lets the fields load any data they need
  // before viewing.
  //field_attach_prepare_view($entity_type, array($entity->id => $entity), $view_mode);
  // We call entity_prepare_view() so it can invoke hook_entity_prepare_view()
  // for us.
  entity_prepare_view($entity_type, array($entity->id => $entity));
  // Now field_attach_view() generates the content for the fields.
  //$entity->content += field_attach_view($entity_type, $entity, $view_mode);
  if ($view_mode == 'full') {
    $list = cm_list_load($entity->lid);
    $breadcrumb = array();
    $breadcrumb[] = l(t('Home'), '<front>');
    if ($list) {
      $list_uri = entity_uri('cm_list', $list);
      $breadcrumb[] = l(t('@list', array('@list' => entity_label('cm_list', $list))), $list_uri['path']);
    }
    drupal_set_breadcrumb($breadcrumb);
    /*
    $summary = isset($data['details']) ? $data['details'] : NULL;
    if ($summary) {
      $rows = array();
      $rows[] = array(
        'data' => array(
          array('data' => t('List ID:'), 'header' => TRUE),
          array('data' => $summary->ListID),
        ),
        'no_striping' => TRUE,
      );
      $rows[] = array(
        'data' => array(
          array('data' => t('Unsubscribe Page:'), 'header' => TRUE),
          array('data' => !empty($summary->UnsubscribePage) ? $summary->UnsubscribePage : t('n/a')),
        ),
        'no_striping' => TRUE,
      );
      $rows[] = array(
        'data' => array(
          array('data' => t('Confirmed Opt-in:'), 'header' => TRUE),
          array('data' => $summary->ConfirmedOptIn ? t('Yes') : t('No')),
        ),
        'no_striping' => TRUE,
      );
      $rows[] = array(
        'data' => array(
          array('data' => t('Confirmation Success Page:'), 'header' => TRUE),
          array('data' => !empty($summary->ConfirmationSuccessPage) ? $summary->ConfirmationSuccessPage : t('n/a')),
        ),
        'no_striping' => TRUE,
      );
      $rows[] = array(
        'data' => array(
          array('data' => t('Unsubscribe Setting:'), 'header' => TRUE),
          array('data' => $summary->UnsubscribeSetting == 'AllClientLists' ? t('All client lists') : t('Only this list')),
        ),
        'no_striping' => TRUE,
      );
      $entity->content['summary'] = array(
        '#type' => 'fieldset',
        '#title' => t('Summary'),
        '#theme' => 'table',
        '#header' => array(),
        '#rows' => $rows,
      );
    }*/
  }
  if ($view_mode == 'raw') {
    $output = campaign_monitor_build_template($entity, $entity_type);
    
    $entity->content['footer'] = array(
      '#type' => 'markup',
      '#markup' => $output,
    );
  }
  return $entity->content;
}
