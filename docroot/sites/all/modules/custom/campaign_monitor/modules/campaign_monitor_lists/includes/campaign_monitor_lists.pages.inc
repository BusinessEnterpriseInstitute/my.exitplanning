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
  $breadcrumb[] = l(t('My Newsletter'), 'member/newsletter');
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
    $breadcrumb[] = l(t('My Newsletter'), 'member/newsletter');
    drupal_set_breadcrumb($breadcrumb);
    
    $items = '';
    $destination = drupal_get_destination();
    $link_attributes = array('class' => array('icon'));
    $dashboard = '';
    if (entity_access('update', 'cm_list', $entity)) {
      $change_settings = l(t('Change Settings'), 'cm-list/' . entity_id('cm_list', $entity) . '/edit', array('query' => $destination));
      if (empty($entity->manage_campaigns)) {
        $automate_class = 'warning';
        $automate = 'BEI is <strong><u>not</u></strong> building your brand through automated marketing content! Let us help! ' . $change_settings;
      }
      else {
        $automate_class = 'success';
        $automate = 'BEI is building your brand by sending high-quality automated marketing content to this list! ' . $change_settings;
      }
      $dashboard .= '<p class="panel callout ' . $automate_class . '">' . $automate . '</p>';
      // Subscribe link output if it exists.
      if (!empty($entity->subscribe_link)) {
        $subscribe_box = '<textarea readonly="readonly" wrap="off">' . check_plain($entity->subscribe_link) . '</textarea>';
        $dashboard .= '<p class="panel callout">' . $subscribe_box . '</p>';
      }
      $link = l('<i class="icon-cog"></i>', 'cm-list/' . entity_id('cm_list', $entity) . '/edit', array('query' => $destination, 'html' => TRUE, 'attributes' => $link_attributes));
      $items .= '<li><div class="panel"><h2>Settings</h2>' . $link . '</div></li>';
      if (module_exists('campaign_monitor_subscribers')) {
        $link = l('<i class="icon-address-book"></i>', 'cm-list/' . entity_id('cm_list', $entity) . '/subscribers', array('html' => TRUE, 'attributes' => $link_attributes));
        $items .= '<li><div class="panel"><h2>Subscribers</h2>' . $link . '</div></li>';
      }
      if (module_exists('campaign_monitor_campaigns')) {
        $link = l('<i class="icon-mail3"></i>', 'cm-list/' . entity_id('cm_list', $entity) . '/campaigns', array('html' => TRUE, 'attributes' => $link_attributes));
        $items .= '<li><div class="panel"><h2>Campaigns</h2>' . $link . '</div></li>';
      }
      $stats_link = l('<i class="icon-pie"></i>', 'cm-list/' . entity_id('cm_list', $entity) . '/stats', array('html' => TRUE, 'attributes' => $link_attributes));
      $items .= '<li><div class="panel"><h2>Statistics</h2>' . $stats_link . '</div></li>';
    }
    if (!empty($items)) {
      $dashboard .= '<ul class="large-block-grid-4 small-block-grid-2 dashboard">' . $items . '</ul>';
    }
    $entity->content['dashboard'] = array(
      '#type' => 'markup',
      '#markup' => '<div class="newsletter-dashboard">' . $dashboard . '</div>',
    );
  }
  if ($view_mode == 'raw') {
    $output = campaign_monitor_build_template($entity, $entity_type);
    $entity->content['html_markup'] = array(
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
  $list_uri = entity_uri('cm_list', $list);
  $breadcrumb[] = l(t('Dashboard'), $list_uri['path']);
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
function campaign_monitor_lists_stats($entity) {
  $client = cm_client_load($entity->cid);
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $breadcrumb[] = l(t('My Newsletter'), 'member/newsletter');
  $list_uri = entity_uri('cm_list', $entity);
  $breadcrumb[] = l(t('Dashboard'), $list_uri['path']);
  drupal_set_breadcrumb($breadcrumb);
  $entity->content = array();
  
  $header = array();
  $rows = array();
  $entity->content['stats_wrapper'] = array(
    '#type' => 'container',
    '#attributes' => array(
      'id' => 'stats-wrapper',
      'class' => array('columns large-6'),
    ),
  );
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $entity->list_id);
  $result = $wrap->get_stats();
  if ($result->was_successful()) {
    $stats = $result->response;
    if (module_exists('charts_google')) {
      $chart = array(
        '#type' => 'chart',
        '#chart_type' => 'pie',
        '#chart_library' => 'google',
        //'#legend_position' => 'right',
        '#data_labels' => TRUE,
        '#tooltips' => FALSE,
        //'#width' => '100%',
        //'#height' => '300',
        '#raw_options' => array(
          //'title' => 'Subscriber Summary',
          'titleTextStyle' => array(
            'bold' => TRUE,
            //'fontSize' => 20,
          ),
          'is3D' => FALSE,
          'slices' => array(
            0 => array('color' => '#24CBE5'),
            1 => array('color' => '#5D5D5D'),
            2 => array('color' => '#FFC001'),
            3 => array('color' => '#ED561B'),
          ),
          'width' => '100%',
          'height' => '300',
          'chartArea' => array(
            'left' => 'auto',
            'top' => 'auto',
            'height' => '75%',
            'width' => '100%',
          ),
        ),
      );
      $chart['pie_data'] = array(
        '#type' => 'chart_data',
        '#title' => t('Status'),
        '#labels' => array('Active', 'Unsubscribed', 'Bounces', 'Deleted'),
        '#data' => array($stats->TotalActiveSubscribers, $stats->TotalUnsubscribes, $stats->TotalBounces, $stats->TotalDeleted),
      );
      $entity->content['stats_wrapper']['chart'] = array(
        '#markup' => '<div id="list-summary-chart" style="border:1px solid #ccc; margin-bottom: 20px; padding:10px;"><h6 class="text-center">Subscriber Summary</h6>' . drupal_render($chart) . '</div>',
      );
    }
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
  $entity->content['stats_wrapper']['table'] = array(
    '#type' => 'markup',
    '#markup' => '<div>' . $table . '</div>',
  );
  return $entity->content;
}

