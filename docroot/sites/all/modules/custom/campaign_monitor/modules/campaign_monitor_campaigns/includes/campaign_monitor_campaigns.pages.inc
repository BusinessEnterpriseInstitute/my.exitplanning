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
function campaign_monitor_campaigns_list($list, $status = 'all') {
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $list_uri = entity_uri('cm_list', $list);
  $breadcrumb[] = l(t('!list', array('!list' => entity_label('cm_list', $list))), $list_uri['path']);
  drupal_set_breadcrumb($breadcrumb);
  $exclude = NULL;
  if ($status == 'sent') {
    $status = 3;
    drupal_set_title('Campaigns Sent');
  }
  else {
    $exclude = 3;
  }
  $output = views_embed_view('campaign_monitor_campaigns', 'default', $list->id, $status, $exclude);
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
  $rows = array();
  if ($view_mode == 'full') {
    $list = cm_list_load($entity->lid);
    $breadcrumb = array();
    $breadcrumb[] = l(t('Home'), '<front>');
    if ($list) {
      $list_uri = entity_uri('cm_list', $list);
      $breadcrumb[] = l(t('@list', array('@list' => entity_label('cm_list', $list))), $list_uri['path']);
    }
    drupal_set_breadcrumb($breadcrumb);
    $title = !empty($entity->subject) ? $entity->subject : 'Campaign Summary';
    drupal_set_title($title);
    $wrap = campaign_monitor_get_api_object('CS_REST_Campaigns', $entity->campaign_id);
    $result = $wrap->get_summary();
    $header_text = t('0 e-mails were sent');
    $stats = array(
      'opens' => array(
        'title' => t('Opens'),
        'count' => t('0 opened'),
        'percent' => t('0%'),
      ),
      'clicks' => array(
        'title' => t('Clicks'),
        'count' => t('0 clicked'),
        'percent' => t('0%'),
      ),
      'forwards' => array(
        'title' => t('Forwards'),
        'count' => t('0 forwarded'),
        'percent' => t('0%'),
      ),
      'bounces' => array(
        'title' => t('Bounces'),
        'count' => t('0 bounced'),
        'percent' => t('0%'),
      ),
      'spam' => array(
        'title' => t('Spam'),
        'count' => t('0 spam complaints'),
        'percent' => t('0%'),
      ),
      'unsubscribed' => array(
        'title' => t('Unsubscribed'),
        'count' => t('0 unsubscribed'),
        'percent' => t('0%'),
      ),
      'unopens' => array(
        'title' => t('Unopens'),
        'count' => t('0 unopened'),
        'percent' => t('0%'),
      ),
    );
    // Set some default variables for chart.
    $unique_opened = 0;
    $unopened = 0;
    $bounced = 0;
    $unsubscribed = 0;
    if ($result->was_successful()) {
      $response = $result->response;
      $forwards = $response->Forwards;
      $likes = $response->Likes;
      $mentions = $response->Mentions;
      $recipients = $response->Recipients;
      $total_opened = $response->TotalOpened;
      $clicks = $response->Clicks;
      $unsubscribed = $response->Unsubscribed;
      $bounced = $response->Bounced;
      $unique_opened = $response->UniqueOpened;
      $spam_complaints = $response->SpamComplaints;
      $unopened = $recipients - ($unique_opened + $bounced);
      
      if ($recipients > 0) {
        $header_text = t('<span>!count</span> e-mails were sent', array('!count' => number_format($recipients)), array('html' => TRUE));
        if ($unique_opened > 0) {
          $opened_calc = ($unique_opened / $recipients) * 100;
          $stats['opens']['count'] = t('!count opened', array('!count' => number_format($unique_opened)));
          $stats['opens']['percent'] = $opened_calc < 1 ? '&lt;1%' : t('!count%', array('!count' => number_format($opened_calc)));
        }
        if ($clicks > 0) {
          $clicked_calc = ($clicks / $recipients) * 100;
          $stats['clicks']['count'] = t('!count clicked', array('!count' => number_format($clicks)));
          $stats['clicks']['percent'] = $clicked_calc < 1 ? '&lt;1%' : t('!count%', array('!count' => number_format($clicked_calc)));
        }
        if ($forwards > 0) {
          $forwards_calc = ($forwards / $recipients) * 100;
          $stats['forwards']['count'] = t('!count forwarded', array('!count' => number_format($forwards)));
          $stats['forwards']['percent'] = $forwards_calc < 1 ? '&lt;1%' : t('!count%', array('!count' => number_format($forwards_calc)));
        }
        if ($bounced > 0) {
          $bounced_calc = ($bounced / $recipients) * 100;
          $stats['bounces']['count'] = t('!count bounced', array('!count' => number_format($bounced)));
          $stats['bounces']['percent'] = $bounced_calc < 1 ? '&lt;1%' : t('!count%', array('!count' => number_format($bounced_calc)));
        }
        if ($spam_complaints > 0) {
          $spam_calc = ($spam_complaints / $recipients) * 100;
          $stats['spam']['count'] = t('!count spam complaints', array('!count' => number_format($spam_complaints)));
          $stats['spam']['percent'] = $spam_calc < 1 ? '&lt;1%' : t('!count%', array('!count' => number_format($spam_calc)));
        }
        if ($unsubscribed > 0) {
          $unsubscribed_calc = ($unsubscribed / $recipients) * 100;
          $stats['unsubscribed']['count'] = t('!count unsubscribed', array('!count' => number_format($unsubscribed)));
          $stats['unsubscribed']['percent'] = $unsubscribed_calc < 1 ? '&lt;1%' : t('!count%', array('!count' => number_format($unsubscribed_calc)));
        }
        $unopened_calc = ($unopened / $recipients) * 100;
        $stats['unopens']['count'] = t('!count unopened', array('!count' => number_format($unopened)));
        $stats['unopens']['percent'] = $unopened_calc < 1 ? '&lt;1%' : t('!count%', array('!count' => number_format($unopened_calc)));
      }
      foreach ($stats as $key => $stat) {
        $first_cell = 
        $row = array(
          'data' => array(
            array('data' => $stat['title'] . '<br /><span>' . $stat['percent'] . '</span>'),
            array('data' => $stat['count']),
          ),
          'no_striping' => TRUE,
          'class' => $key,
        );
        $rows[] = $row;
      }
    }
    if (module_exists('charts_google')) {
      $chart = array(
        '#type' => 'chart',
        '#chart_type' => 'pie',
        '#chart_library' => 'google',
        '#legend_position' => 'right',
        '#data_labels' => FALSE,
        '#tooltips' => TRUE,
        '#width' => '900',
        '#height' => '500',
        '#raw_options' => array(
          'title' => 'Distribution of E-mails',
          'titleTextStyle' => array(
            'bold' => TRUE,
            'fontSize' => 20,
          ),
          'is3D' => TRUE,
          'slices' => array(
            0 => array('color' => '#24CBE5'),
            1 => array('color' => '#5D5D5D'),
            2 => array('color' => '#FFC001'),
            3 => array('color' => '#ED561B'),
          ),
        ),
      );
      $chart['pie_data'] = array(
        '#type' => 'chart_data',
        '#title' => t('Status'),
        '#labels' => array('Opened', 'Unopened', 'Bounces', 'Unsubscribed'),
        '#data' => array($unique_opened, $unopened, $bounced, $unsubscribed),
      );
      $entity->content['chart'] = array(
        '#markup' => '<div id="campaign-summary-chart" class="columns large-8">' . drupal_render($chart) . '</div>',
      );
    }
    
    $entity->content['summary'] = array(
      '#theme_wrappers' => array('container'),
      '#attributes' => array(
        'class' => array('columns large-4'),
      ),
      'header' => array(
        '#prefix' => '<div class="table-header">',
        '#markup' => $header_text,
        '#suffix' => '</div>',
      ),
      'table' => array(
        '#markup' => theme('table', array(
          'header' => array(),
          'rows' => $rows,
          'attributes' => array(
            'width' => '100%',
          ),
        )),
      ),
    );
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
