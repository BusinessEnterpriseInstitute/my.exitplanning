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

function campaign_monitor_subscribers_cm_subscriber_view($entity, $view_mode = 'full') {
  // Our entity type, for convenience.
  $entity_type = 'cm_subscriber';
  // Start setting up the content.
  $entity->content = array(
    '#view_mode' => $view_mode,
  );
  $data = $entity->subscriber_data;
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
  }
  return $entity->content;
}
/*
 * Page callback to return view of subscribers referenced to list.
 */
function campaign_monitor_subscribers_list($list) {
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $list_uri = entity_uri('cm_list', $list);
  $breadcrumb[] = l(t('@list', array('@list' => entity_label('cm_list', $list))), $list_uri['path']);
  drupal_set_breadcrumb($breadcrumb);
  $view = views_get_view('campaign_monitor_subscribers','default');
  $view->set_arguments(array($list->id));
  $view->override_url = drupal_get_path_alias($_GET['q']);

  $output = $view->preview();
  return $output;
}
