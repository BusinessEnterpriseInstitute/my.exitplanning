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
    $breadcrumb[] = l(t('My Newsletter', 'member/newsletter'));
    if ($list) {
      $list_uri = entity_uri('cm_list', $list);
      $breadcrumb[] = l(t('Dashboard'), $list_uri['path']);
    }
    drupal_set_breadcrumb($breadcrumb);
  }
  return $entity->content;
}
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
  $header = array();
  $rows = array();
  $pager = '';
  if ($wrap) {
    $parameters = array(
      //'date' => NULL,
      'page' => !empty($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1,
      'pagesize' => 10,
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
      }
    }
    $header = array(
      array('data' => t('E-mail'), 'field' => 'email'),
      array('data' => t('Name'), 'field' => 'name'),
      t('Date'),
      t('Reads e-mail with')
    );
    $result = NULL;
    $help_text = '';
    switch ($status) {
      case 'active':
        $title = 'Active Subscribers';
        $result = $wrap->get_active_subscribers('', $parameters['page'], $parameters['pagesize'], $parameters['orderfield'], $parameters['orderdirection']);
        $help_text = t('E-mails sent to your subscriber list are only sent to active subscribers on the list.');
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
        foreach ($result->response->Results as $item) {
          $row = array(
            'data' => array(
              'email' => array('data' => $item->EmailAddress),
              'name' => array('data' => $item->Name),
              'date' => array('data' => format_date(strtotime($item->Date), 'short')),
              array('data' => $item->ReadsEmailWith),
            ),
          );
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
  drupal_set_title($title);
  $table = theme('table', array(
    'header' => $header,
    'rows' => $rows,
    'empty' => t('No subscriber information available'),
    'attributes' => array(
      'id' => 'cm-subscribers-active',
    ),
  ));
  /*
  $view = views_get_view('campaign_monitor_subscribers','default');
  $view->set_arguments(array($list->id));
  $view->override_url = drupal_get_path_alias($_GET['q']);

  $output = $view->preview();*/
  
  return $help_text . $table . $pager;
}
