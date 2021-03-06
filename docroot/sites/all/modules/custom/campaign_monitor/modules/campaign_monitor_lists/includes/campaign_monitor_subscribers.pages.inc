<?php

/*
 * Page callback to return view of subscribers referenced to list.
 */
function campaign_monitor_subscribers_list($list, $status = 'active') {
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $breadcrumb[] = l(t('My Newsletter'), 'member/newsletter');
  $list_uri = entity_uri('cm_list', $list);
  $breadcrumb[] = l(t('Dashboard'), $list_uri['path']);
  drupal_set_breadcrumb($breadcrumb);
  $title = 'Subscribers';
  $wrap = campaign_monitor_get_api_object('CS_REST_Lists', $list->list_id);
  $rows = array();
  $pager = '';
  $delete_link = TRUE;
  $update_link = FALSE;
  if ($wrap) {
    $parameters = array(
      //'date' => NULL,
      // Drupal pagers start with 0 so we have to add 1 to query parameter for CM request.
      'page' => !empty($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] + 1 : 1,
      'pagesize' => 100,
      'orderfield' => 'email',
      'orderdirection' => 'asc',
      'includetrackingpreference' => TRUE,
    );
    if (!empty($_GET['sort']) && !empty($_GET['order'])) {
      $parameters['orderdirection'] = $_GET['sort'];
      switch($_GET['order']) {
        case 'E-mail':
          $parameters['orderfield'] = 'email';
          break;
        case 'Name':
          $parameters['orderfield'] = 'name';
          break;
        case 'Date':
          $parameters['orderfield'] = 'date';
          break;
      }
    }
    $result = NULL;
    $help_text = '';
    $counter = '';
    switch ($status) {
      case 'active':
        $title = 'Active Subscribers';
        $result = $wrap->get_active_subscribers('', $parameters['page'], $parameters['pagesize'], $parameters['orderfield'], $parameters['orderdirection']);
        $help_text = t('E-mails sent to your subscriber list are only sent to active subscribers on the list.');
        $update_link = TRUE;
        break;
      case 'unconfirmed':
        $title = 'Unconfirmed Subscribers';
        $result = $wrap->get_unconfirmed_subscribers('', $parameters['page'], $parameters['pagesize'], $parameters['orderfield'], $parameters['orderdirection']);
        $help_text = t('These are people who subscribed to a confirmed opt-in list but have not clicked the link in the verification email sent to them.');
        break;
      case 'unsubscribed':
        $title = 'Unsubscribed Subscribers';
        $result = $wrap->get_unsubscribed_subscribers('', $parameters['page'], $parameters['pagesize'], $parameters['orderfield'], $parameters['orderdirection']);
        $help_text = t('These are people who have either opted out via an unsubscribe link, or form, or their status has been changed to unsubscribed through your account.');
        $delete_link = FALSE;
        break;
      case 'bounced':
        $title = 'Bounced Subscribers';
        $result = $wrap->get_bounced_subscribers('', $parameters['page'], $parameters['pagesize'], $parameters['orderfield'], $parameters['orderdirection']);
        $help_text = t('These are email addresses that have hard bounced, meaning we cannot deliver emails to them. Hard bounces are automatically removed from your list so
                       you don\'t send to them again, and are also added to a suppression list to prevent them from being accidentally re-added.');
        break;
      case 'deleted':
        $title = 'Deleted Subscribers';
        $result = $wrap->get_deleted_subscribers('', $parameters['page'], $parameters['pagesize'], $parameters['orderfield'], $parameters['orderdirection']);
        $help_text = t('You will only see subscribers with this status if they have been deleted from the list through your account or were imported from a previous
                       newsletter platform with the same status.');
        $delete_link = FALSE;
        $update_link = TRUE;
        break;
    }
    if (!empty($help_text)) {
      $help_text = '<p class="panel callout">' . $help_text . '</p>';
    }
    if ($result) {
      if ($result->was_successful()) {
        $total_records = $result->response->TotalNumberOfRecords;
        $page_records = $result->response->RecordsOnThisPage;
        $number_pages = $result->response->NumberOfPages;
        $page_size = $result->response->PageSize;
        $page_number = $result->response->PageNumber;
        if ($total_records >= 1) {
          $start = $page_number === 1 ? 1 : ($page_size * ($page_number - 1)) + 1;
          $end = $page_number === 1 ? $page_records : (($page_number - 1) * $page_size) + $page_records;
          $total = number_format($total_records);
          $counter = '<p class="subheader">' . t('Displaying !start - !end of !total', array('!start' => $start, '!end' => $end, '!total' => $total)) . '</p>';
        }
        foreach ($result->response->Results as $item) {
          $linked_email = l($item->EmailAddress, 'cm-list/' . $list->id . '/subscribers/history', array('query' => array('email' => $item->EmailAddress), 'attributes' => array('title'=> 'View e-mail history')));
          $row = array(
            'data' => array(
              'email' => array('data' => $linked_email),
              'name' => array('data' => $item->Name),
              'date' => array('data' => format_date(strtotime($item->Date), 'short')),
              array('data' => $item->ReadsEmailWith),
            ),
          );
          // Add an update link on every page applicable.
          if ($update_link) {
            $options = array('html' => TRUE, 'query' => array('email' => $item->EmailAddress, drupal_get_destination()), 'attributes' => array('title' => t('Update this subscriber')));
            $row['data'][] = array('data' => l(t('<i class="icon-pencil"></i>'), 'cm-list/' . $list->id . '/subscribers/update', $options), 'class' => array('icon'));
          }
          // Add a delete link on every page applicable.
          if ($delete_link) {
            $options = array('html' => TRUE, 'query' => array('email' => $item->EmailAddress, drupal_get_destination()));
            $row['data'][] = array('data' => l(t('<i class="icon-remove"></i>'), 'cm-list/' . $list->id . '/subscribers/delete', $options), 'class' => array('icon'));
          }
          $rows[] = $row;
        }
        pager_default_initialize($total_records, $parameters['pagesize']);
        $pager = theme('pager');
      }
      else {
        $error = $result->response->Message;
        $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
        drupal_set_message($message, 'error');
      }
    }
  }
  $header = array(
    array('data' => t('E-mail'), 'field' => 'email'),
    array('data' => t('Name'), 'field' => 'name'),
    array('data' => t('Date'), 'field' => 'date'),
    t('Reads e-mail with'),
  );
  // Add extra header column for update link on applicable pages.
  if ($update_link) {
    $header[] = '';
  }
  // Add extra header column for delete link on applicable pages.
  if ($delete_link) {
    $header[] = '';
  }
  drupal_set_title($title);
  $table = theme('table', array(
    'header' => $header,
    'rows' => $rows,
    'empty' => t('No subscriber information available'),
    'attributes' => array(
      'id' => 'cm-subscribers-active',
    ),
  ));

  return $help_text . $counter . $table . $pager;
}

/**
 * Menu callback to display subscriber history.
 */
function campaign_monitor_subscribers_subscriber_history($list) {
  $email = $_GET['email'];
  drupal_set_title($email);
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $breadcrumb[] = l(t('My Newsletter'), 'member/newsletter');
  $list_uri = entity_uri('cm_list', $list);
  $breadcrumb[] = l(t('Dashboard'), $list_uri['path']);
  $breadcrumb[] = l(t('Subscribers'), $list_uri['path'] . '/subscribers');
  drupal_set_breadcrumb($breadcrumb);
  $wrap = campaign_monitor_get_api_object('CS_REST_Subscribers', $list->list_id);
  $result = $wrap->get_history($email);
  $campaigns = '';
  if ($result->was_successful()) {
    $items = $result->response;
    if (!empty($items)) {
      foreach ($items as $item) {
        $cid = cm_campaign_get_campaign_entity_id($item->ID);
        $campaign_entity = $cid ? cm_campaign_load($cid) : NULL;
        $campaign = '<h6 class="subheader">Activity for ' . check_plain($item->Name);
        if ($campaign_entity) {
          $campaign_uri = entity_uri('cm_campaign', $campaign_entity);
          $campaign .= l(t('&nbsp;&nbsp;<i class="icon-pie"></i>'), $campaign_uri['path'], array('html' => TRUE));
        }
        $campaign .= '</h6>';
        $header = array(t('Action'), t('Date'));
        $rows = array();
        foreach ($item->Actions as $action) {
          $event = $action->Event;
          switch ($event) {
            case 'Open':
              $event = t('<strong>Opened</strong> your e-mail', array('html' => TRUE));
              break;
            case 'Click':
              $event = t('<strong>Clicked</strong> !link', array('html' => TRUE, '!link' => $action->Detail));
              break;
            case 'Forward':
              $event = t('<strong>Forwarded</strong> your e-mail to a friend', array('html' => TRUE));
              break;
            case 'Bounce':
              $event = t('<strong>Bounced</strong>', array('html' => TRUE));
              break;
          }
          $row = array(
            'data' => array(
              array('data' => $event, 'style' => 'width:50%;'),
              array('data' => format_date(strtotime($action->Date), 'short')),
            ),
            'no_striping' => TRUE,
          );
          $rows[] = $row;
        }
        $table = theme('table', array(
          'header' => $header,
          'rows' => $rows,
          'attributes' => array(
            'id' => 'cm-subscribers-history',
          ),
          'empty' => t('There hasn\'t been any activity for this e-mail yet.'),
        ));
        $campaign .= $table;
        $campaigns .= $campaign;
      }
    }
    else {
      $campaigns = '<p class="panel callout warning">' . t('You haven\'t sent any trackable emails to %email yet. As soon as you do, we\'ll show you a full breakdown here.', array('%email' => $email)) . '</p>';
    }
  }
  else {
    $campaigns = '<p class="panel callout warning">' . t('!message', array('!message' => $result->response->Message)) . '</p>';
  }
  return $campaigns;
}
