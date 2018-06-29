<?php

/**
 * @file
 * Bulding pages for campaign nodes..
 */

/**
 * Menu callback to build a list of users that have opened the campaign.
 *
 * @see bei_mailchimp_menu().
 */
function bei_campaign_pages_open($campaign, $op) {
  $list = field_get_items('node', $campaign, 'field_subscriber_list');
  $lid = $list ? $list[0]['target_id'] : NULL;
  $pager = '';
  // Build breadcrumbs
  $breadcrumb = array();

  if ($lid) {
    $list = node_load($lid);
    if ($list) {
      $breadcrumb[] = l(t('Campaigns Sent'), 'node/' . $list->nid . '/archives');
    }
  }
  $breadcrumb[] = l(t('Campaign Summary'), 'node/' . $campaign->nid);
  // Set Breadcrumbs
  drupal_set_breadcrumb($breadcrumb);
  $email_activity = array(
    //'unopen',
    //'open', @see hook_menu arg changed to 'opened' to use 2.0 library
    //'bounce',
  );
  if (in_array($op, $email_activity)) {
    $sub = 'email-activity';
  }
  else {
    $sub = $op;
  }

  $cid = !empty($campaign->campaign_id) ? $campaign->campaign_id : NULL;
  $stats = FALSE;
  $header = array();
  $rows = array();
  if ($cid) {
    // Opened
    if ($op == 'opened') {
      $start = 0;
      $limit = 25;
      $mcapi = mailchimp_old_get_api_object();
      if (!empty($_GET['page']) && is_numeric($_GET['page'])) {
        $stats = $mcapi->reports->{$op}($cid, array(
          'start' => $_GET['page'],
          'limit' => $limit,
        ));
      }
      else {
        // Either this is the first page, or there are less items than the limit.
        $stats = $mcapi->reports->{$op}($cid, array());
        if ($stats['total'] > $limit) {
          // Overwrite the full list with a limited list.
          $stats = $mcapi->reports->{$op}($cid, array(
            'start' => $start,
            'limit' => $limit,
          ));
        }
      }
      pager_default_initialize($stats['total'], $limit);
      $pager = theme('pager');
    }
    elseif ($op == 'unopen') {
      $start = 0;
      $limit = 25;
      $mcapi = mailchimp_old_get_api_object();
      if (!empty($_GET['page']) && is_numeric($_GET['page'])) {
        $stats = $mcapi->reports->{'notOpened'}($cid, array(
          'start' => $_GET['page'],
          'limit' => $limit,
        ));
      }
      else {
        // Either this is the first page, or there are less items than the limit.
        $stats = $mcapi->reports->{'notOpened'}($cid, array());
        if ($stats['total'] > $limit) {
          // Overwrite the full list with a limited list.
          $stats = $mcapi->reports->{'notOpened'}($cid, array(
            'start' => $start,
            'limit' => $limit,
          ));
        }
      }
      pager_default_initialize($stats['total'], $limit);
      $pager = theme('pager');
    }
    elseif ($op == 'bounce') {
      $start = 0;
      $limit = 100;
      $mcapi = mailchimp_old_get_api_object();
      $hard_bounces = $mcapi->reports->{'sentTo'}($cid, array(
        'status' => 'hard',
        'start' => $start,
        'limit' => $limit,
      ));
      $soft_bounces = $mcapi->reports->{'sentTo'}($cid, array(
        'status' => 'soft',
        'start' => $start,
        'limit' => $limit,
      ));
      $header = array(
        array(
          'data' => t('Bounce Type'),
        ),
        array(
          'data' => t('E-mail Address'),
        ),
        array(
          'data' => t('Name'),
        ),
      );
      if ($hard_bounces['total'] > 0) {
        foreach ($hard_bounces['data'] as $stat) {
          $name = $stat['member']['merges']['FNAME'] . ' ' . $stat['member']['merges']['LNAME'];
          $rows[] = array(
            array(
              'data' => check_plain($stat['status']),
            ),
            array(
              'data' => check_plain($stat['member']['email']),
            ),
            array(
              'data' => check_plain($name),
            ),
          );
        }
      }
      if ($soft_bounces['total'] > 0) {
        foreach ($soft_bounces['data'] as $stat) {
          $name = $stat['member']['merges']['FNAME'] . ' ' . $stat['member']['merges']['LNAME'];
          $rows[] = array(
            array(
              'data' => check_plain($stat['status']),
            ),
            array(
              'data' => check_plain($stat['member']['email']),
            ),
            array(
              'data' => check_plain($name),
            ),
          );
        }
      }
    }
    else {
      // Try to load stats from cache first.
      $cache = cache_get('campaign-' . $sub . '-' . $cid, 'cache_mailchimp');
      $limit = 500;
      $offset = 0;
      $total = 0;
      if ($cache) {
        if ($cache->expire > REQUEST_TIME) {
          $cache = $cache->data;
          switch ($op) {
            //case 'opened':
            //case 'unopen':
            //case 'bounce':
              //$stats = $cache->emails;
              //break;
            case 'unsubscribed':
              $stats = $cache->unsubscribes;
              break;
            case 'click-details':
              $stats = $cache->urls_clicked;
              break;
          }
        }
        else {
          cache_clear_all('campaign-' . $sub . '-' . $cid, 'cache_mailchimp');
          $report = bei_campaign_get_campaign_report($cid, $sub, $limit, $offset);
          if ($report) {
            $total = $sub == 'opened' ? $report['total'] : $report->total_items;
            // If the total items are <= our limit, cache the results
            if ($total <= $limit) {
              switch ($op) {
              //case 'opened':
              //case 'unopen':
              case 'bounce':
                $stats = $report->emails;
                break;
              case 'unsubscribed':
                $stats = $report->unsubscribes;
                break;
              case 'click-details':
                $stats = $report->urls_clicked;
                break;
              }
            }
          }
        }
      }
      else {
        $report = bei_campaign_get_campaign_report($cid, $sub, $limit, $offset);
        if ($report) {
          $total = $report->total_items;
          // If the total items are <= our limit, cache the results
          if ($total <= $limit) {
            switch ($op) {
              //case 'opened':
              //case 'unopen':
              case 'bounce':
                $stats = $report->emails;
                break;
              case 'unsubscribed':
                $stats = $report->unsubscribes;
                break;
              case 'click-details':
                $stats = $report->urls_clicked;
                break;
            }
          }
        }
      }
    }
    if ($stats) {
      // Unsubscribed
      if ($op == 'unsubscribed') {
        $header = array(
          array(
            'data' => t('Email'),
          ),
          array(
            'data' => t('First Name'),
          ),
          array(
            'data' => t('Last Name'),
          ),
          array(
            'data' => t('Reason'),
          ),
          array(
            'data' => t('Timestamp'),
          ),
        );
        foreach ($stats as $stat) {
          $rows[] = array(
            array(
              'data' => $stat->email_address,
            ),
            array(
              'data' => check_plain($stat->merge_fields->FNAME),
            ),
            array(
              'data' => check_plain($stat->merge_fields->LNAME),
            ),
            array(
              'data' => check_plain($stat->reason),
            ),
            array(
              'data' => format_date(strtotime($stat->timestamp), 'short'),
            ),
          );
        }
      }
      elseif ($op == 'click-details') {
        $header = array(
          array(
            'data' => t('URL'),
          ),
          array(
            'data' => t('Total Clicks'),
          ),
          array(
            'data' => t('Unique Clicks'),
          ),
          array(
            'data' => t('Last Click'),
          )
        );
        foreach ($stats as $stat) {
          $rows[] = array(
            array(
              'data' => $stat->url,
            ),
            array(
              'data' => $stat->total_clicks,
            ),
            array(
              'data' => $stat->unique_clicks,
            ),
            array(
              'data' => format_date(strtotime($stat->last_click), 'short'),
            ),
          );
        }
      }
      elseif ($op == 'opened') {
        $header = array(
          array(
            'data' => t('Opens'),
          ),
          array(
            'data' => t('E-mail Address'),
          ),
          array(
            'data' => t('Name'),
          ),
        );
        foreach ($stats['data'] as $stat) {
          $name = $stat['member']['merges']['FNAME'] . ' ' . $stat['member']['merges']['LNAME'];
          $rows[] = array(
            array(
              'data' => $stat['opens'],
            ),
            array(
              'data' => $stat['member']['email'],
            ),
            array(
              'data' => check_plain($name),
            ),
          );
        }
      }
      elseif ($op == 'unopen') {
        $header = array(
          array(
            'data' => t('E-mail Address'),
          ),
          array(
            'data' => t('Name'),
          ),
        );
        foreach ($stats['data'] as $stat) {
          $name = $stat['merges']['FNAME'] . ' ' . $stat['merges']['LNAME'];
          $rows[] = array(
            array(
              'data' => $stat['email'],
            ),
            array(
              'data' => check_plain($name),
            ),
          );
        }
      }
    }
    if (empty($pager) && !empty($rows)) {
      // Setup pager.
      $paged_limit = 25;
      $total = count($rows);
      $current_page = pager_default_initialize($total, $paged_limit);
      $pager = theme('pager', array('quantity', $total));
      // Split list into pages sized chunks
      $chunks = array_chunk($rows, $paged_limit, TRUE);
      $rows = $chunks[$current_page];
    }
    $table = theme('table', array(
      'header' => $header,
      'rows' => $rows,
      'empty' => t('No stats available'),
      'attributes' => array(
        'id' => 'bei-mailchimp-stats-opened',
      ),
    ));
    return $table . $pager;
  }
}

/*
 * Helper function to sort array of activities by timestamp.
 */
function bei_campaign_sort_activities($a, $b) {
    if ($a['timestamp'] == $b['timestamp']) return 0;
    return ($a['timestamp'] < $b['timestamp']) ? 1 : -1;
}
