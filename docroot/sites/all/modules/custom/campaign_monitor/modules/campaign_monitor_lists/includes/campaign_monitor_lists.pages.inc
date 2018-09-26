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
 * Page callback to return view of lists referenced to client.
 */
function campaign_monitor_lists_list($client) {
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $client_uri = entity_uri('cm_client', $client);
  $breadcrumb[] = l(t('!client', array('!client' => entity_label('cm_client', $client))), $client_uri['path']);
  drupal_set_breadcrumb($breadcrumb);
  
  $output = views_embed_view('campaign_monitor_lists', 'default', $client->id);
  return $output;
}

function campaign_monitor_lists_cm_list_view($entity, $view_mode = 'full') {
  // Our entity type, for convenience.
  $entity_type = 'cm_list';
  // Start setting up the content.
  $entity->content = array(
    '#view_mode' => $view_mode,
  );
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
    $client = cm_client_load($entity->cid);
    $breadcrumb = array();
    $breadcrumb[] = l(t('Home'), '<front>');
    if ($client) {
      $client_uri = entity_uri('cm_client', $client);
      $breadcrumb[] = l(t('@client', array('@client' => $client->name)), $client_uri['path']);
    }
    drupal_set_breadcrumb($breadcrumb);
   /* <ul class="large-block-grid-4 small-block-grid-2 dashboard">
        <li>
       <div class="panel">
       <h2>Settings</h2>
       <a href="%node:edit-url" class="icon"><i class="icon-cog"></i></a></div>
       </li>
       <li>
       <div class="panel">
       <h2>Subscribers</h2>
       <a href="/node/%node:nid/subscribers" class="icon"><i class="icon-address-book"></i></a></div>
       </li>
       <li>
       <div class="panel">
       <h2>Campaigns</h2>
       <a href="/node/%node:nid/campaigns" class="icon"><i class="icon-mail3"></i></a></div>
       </li>
       <li>
       <div class="panel">
       <h2>Statistics</h2>
       <a href="/node/%node:nid/archives" class="icon"><i class="icon-pie"></i></a></div>
       </li>
       </ul>
    */
    $items = array();
    $destination = drupal_get_destination();
    $link_attributes = array('class' => array('icon'));
    if (entity_access('update', 'cm_list', $entity)) {
      $link = l('<i class="icon-cog"></i>', 'cm-list/' . entity_id('cm_list', $entity) . '/edit', array('query' => $destination, 'html' => TRUE, 'attributes' => $link_attributes));
      $items[] = '<div class="panel"><h2>Settings</h2>' . $link . '</div>';
      if (module_exists('campaign_monitor_subscribers')) {
        $link = l('<i class="icon-address-book"></i>', 'cm-list/' . entity_id('cm_list', $entity) . '/subscribers', array('html' => TRUE, 'attributes' => $link_attributes));
        $items[] = '<div class="panel"><h2>Subscribers</h2>' . $link . '</div>';
      }
      if (module_exists('campaign_monitor_campaigns')) {
        $link = l('<i class="icon-mail3"></i>', 'cm-list/' . entity_id('cm_list', $entity) . '/campaigns', array('html' => TRUE, 'attributes' => $link_attributes));
        $items[] = '<div class="panel"><h2>Campaigns</h2>' . $link . '</div>';
      }
      $stats_link = l('<i class="icon-pie"></i>', 'cm-list/' . entity_id('cm_list', $entity) . '/stats', array('html' => TRUE, 'attributes' => $link_attributes));
      $items[] = '<div class="panel"><h2>Statistics</h2>' . $stats_link . '</div>';
    }
    if (!empty($items)) {
      $dashboard = '<div class="newsletter-dashboard">' . theme_item_list(array('items' => $items, 'type' => 'ul', 'title' => '', 'attributes' => array('class' => array('large-block-grid-4 small-block-grid-2 dashboard')))) . '</div>';
    }
    else {
      $dashboard = '';
    }
    $entity->content['dashboard'] = array(
      '#type' => 'markup',
      '#markup' => $dashboard,
    );
    /*
    $rows = array();
    $rows[] = array(
      'data' => array(
        array('data' => t('List ID:'), 'header' => TRUE),
        array('data' => $entity->list_id),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Unsubscribe Page:'), 'header' => TRUE),
        array('data' => $entity->unsubscribe_page),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Confirmed Opt-in:'), 'header' => TRUE),
        array('data' => $entity->confirmed_opt_in ? t('Yes') : t('No')),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Confirmation Success Page:'), 'header' => TRUE),
        array('data' => $entity->confirmation_success_page),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Unsubscribe Setting:'), 'header' => TRUE),
        array('data' => $entity->unsubscribe_setting == 'AllClientLists' ? t('All client lists') : t('Only this list')),
      ),
      'no_striping' => TRUE,
    );
    $entity->content['summary'] = array(
      '#type' => 'fieldset',
      '#title' => t('Summary'),
      '#theme' => 'table',
      '#header' => array(),
      '#rows' => $rows,
    );*/
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
/*
 * Webhooks page for lists.
 */
function campaign_monitor_lists_webhooks($list) {
  $client = cm_client_load($list->cid);
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  if ($client) {
    $client_uri = entity_uri('cm_client', $client);
    $breadcrumb[] = l(t('!client', array('!client' => entity_label('cm_client', $client))), $client_uri['path']);
  }
  $list_uri = entity_uri('cm_list', $list);
  $breadcrumb[] = l(t('!list', array('!list' => entity_label('cm_list', $list))), $list_uri['path']);
  drupal_set_breadcrumb($breadcrumb);
  $webhooks = db_query('SELECT * FROM {campaign_monitor_list_webhooks} w WHERE w.lid = :lid', array(':lid' => entity_id('cm_list', $list)))->fetchAll();
  $header = array(t('URL'), t('Events'), t('Status'), t('Operations'));
  $rows = array();
  foreach ($webhooks as $webhook) {
    $activate_link = l(t('Activate'), 'cm-webhook/' . entity_id('cm_webhook', $webhook) . '/activate', array('query' => drupal_get_destination()));
    $deactivate_link = l(t('Deactivate'), 'cm-webhook/' . entity_id('cm_webhook', $webhook) . '/deactivate', array('query' => drupal_get_destination()));
    $delete_link = l(t('Delete'), 'cm-webhook/' . entity_id('cm_webhook', $webhook) . '/delete', array('query' => drupal_get_destination()));
    $test_link = l(t('Test'), 'cm-webhook/' . entity_id('cm_webhook', $webhook) . '/test', array('query' => drupal_get_destination()));
    $status_link = $webhook->status == 'Active' ? $deactivate_link : $activate_link;
    $events = unserialize($webhook->events);
    $row = array(
      'data' => array(
        array('data' => check_plain($webhook->url)),
        array('data' => implode(' | ', $events)),
        array('data' => check_plain($webhook->status)),
        array('data' => $test_link . ' | ' . $delete_link . ' | ' . $status_link),
      ),
    );
    $rows[] = $row;
  }
  $table = theme('table', array(
    'header' => $header,
    'rows' => $rows,
    'empty' => t('No webhooks exist for this list.'),
  ));
  $output = array(
    '#type' => 'markup',
    '#markup' => $table,
  );
  return $output;
}
/**
 * Page callback to display campaign monitor stats for list.
 */
function campaign_monitor_lists_stats($list) {
  $client = cm_client_load($list->cid);
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  if ($client) {
    $client_uri = entity_uri('cm_client', $client);
    $breadcrumb[] = l(t('@client', array('@client' => entity_label('cm_client', $client))), $client_uri['path']);
  }
  $list_uri = entity_uri('cm_list', $list);
  $breadcrumb[] = l(t('@list', array('@list' => entity_label('cm_list', $list))), $list_uri['path']);
  drupal_set_breadcrumb($breadcrumb);
  
  $header = array();
  $rows = array();
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
  $result = $wrap->get_stats();
  if ($result->was_successful()) {
    $stats = $result->response;
    $rows[] = array(
      'data' => array(
        array('data' => t('Total Active Subscribers'), 'header' => TRUE),
        array('data' => number_format($stats->TotalActiveSubscribers)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('New Active Subscribers Today'), 'header' => TRUE),
        array('data' => number_format($stats->NewActiveSubscribersToday)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('New Active Subscribers Yesterday'), 'header' => TRUE),
        array('data' => number_format($stats->NewActiveSubscribersYesterday)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('New Active Subscribers This Week'), 'header' => TRUE),
        array('data' => number_format($stats->NewActiveSubscribersThisWeek)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('New Active Subscribers This Month'), 'header' => TRUE),
        array('data' => number_format($stats->NewActiveSubscribersThisMonth)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('New Active Subscribers This Year'), 'header' => TRUE),
        array('data' => number_format($stats->NewActiveSubscribersThisYear)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Total Unsubscribes'), 'header' => TRUE),
        array('data' => number_format($stats->TotalUnsubscribes)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Unsubscribes Today'), 'header' => TRUE),
        array('data' => number_format($stats->UnsubscribesToday)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Unsubscribes Yesterday'), 'header' => TRUE),
        array('data' => number_format($stats->UnsubscribesYesterday)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Unsubscribes This Week'), 'header' => TRUE),
        array('data' => number_format($stats->UnsubscribesThisWeek)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Unsubscribes This Month'), 'header' => TRUE),
        array('data' => number_format($stats->UnsubscribesThisMonth)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Unsubscribes This Year'), 'header' => TRUE),
        array('data' => number_format($stats->UnsubscribesThisYear)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Total Delete'), 'header' => TRUE),
        array('data' => number_format($stats->TotalDeleted)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Deleted Today'), 'header' => TRUE),
        array('data' => number_format($stats->DeletedToday)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Deleted Yesterday'), 'header' => TRUE),
        array('data' => number_format($stats->DeletedYesterday)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Deleted This Week'), 'header' => TRUE),
        array('data' => number_format($stats->DeletedThisWeek)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Deleted This Month'), 'header' => TRUE),
        array('data' => number_format($stats->DeletedThisMonth)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Deleted This Year'), 'header' => TRUE),
        array('data' => number_format($stats->DeletedThisYear)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Total Bounces'), 'header' => TRUE),
        array('data' => number_format($stats->TotalBounces)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Bounces Today'), 'header' => TRUE),
        array('data' => number_format($stats->BouncesToday)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Bounces Yesterday'), 'header' => TRUE),
        array('data' => number_format($stats->BouncesYesterday)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Bounces This Week'), 'header' => TRUE),
        array('data' => number_format($stats->BouncesThisWeek)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Bounces This Month'), 'header' => TRUE),
        array('data' => number_format($stats->BouncesThisMonth)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Bounces This Year'), 'header' => TRUE),
        array('data' => number_format($stats->BouncesThisYear)),
      ),
      'no_striping' => TRUE,
    );
  }
  $table = theme('table', array(
    'header' => $header,
    'rows' => $rows,
    'empty' => t('Unable to produce stats for this list.'),
  ));
  $output = array(
    '#type' => 'markup',
    '#markup' => $table,
  );
  return $output;
}

