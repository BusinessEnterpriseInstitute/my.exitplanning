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
function campaign_monitor_client_view($entity, $view_mode = 'full') {
  // Our entity type, for convenience.
  $entity_type = 'cm_client';
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
  $data = $entity->client_data;
  if (isset($data['BasicDetails'])) {
    $basic = $data['BasicDetails'];
    $header = array();
    $rows = array();
    $rows[] = array(
      'data' => array(
        array('data' => t('Client ID:'), 'header' => TRUE),
        array('data' => $basic->ClientID),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Company Name:'), 'header' => TRUE),
        array('data' => check_plain($basic->CompanyName)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Contact Name:'), 'header' => TRUE),
        array('data' => check_plain($basic->ContactName)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('E-mail Address:'), 'header' => TRUE),
        array('data' => check_plain($basic->EmailAddress)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Country:'), 'header' => TRUE),
        array('data' => check_plain($basic->Country)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Timezone:'), 'header' => TRUE),
        array('data' => check_plain($basic->TimeZone)),
      ),
      'no_striping' => TRUE,
    );
    $entity->content['basic_details'] = array(
      '#type' => 'fieldset',
      '#title' => t('Basic Details'),
      '#theme' => 'table',
      '#header' => array(),
      '#rows' => $rows,
    );
  }

  // And finally return the content.
  return $entity->content;
}
function campaign_monitor_client_view_lists($entity, $view_mode = 'full') {
  $lists = db_query('SELECT * FROM {campaign_monitor_lists} l WHERE l.cid = :cid', array(':cid' => $entity->id))->fetchAll();
  $header = array(t('Id'), t('Title'));
  $rows = array();
  foreach ($lists as $list) {
    
  }
}

function campaign_monitor_cm_client_session_view($client) {
  $integrator_id = variable_get('campaign_monitor_integrator_id', '');
  $cm = campaign_monitor_get_api_object();
  $session_url = NULL;
  $error = '';
  $output = '';
  if ($cm) {
    $result = $cm->external_session_url(array(
      'Email' => 'apmsooner@gmail.com',
      'Chrome' => 'Tabs',
      'Url' => '/subscribers',
      'IntegratorID' => $integrator_id,
      'ClientID' => $client->client_id,
    ));
    if ($result->was_successful()) {
      $session_url = $result->response->SessionUrl;
    }
    else {
      $error = $result->response->Message;
      $message = t('Failed with code @code. %error', array('@code' => $result->http_status_code, '%error' => $error));
      drupal_set_message($message, 'error');
    }
  }
  if ($session_url) {
    $output = array(
      '#type' => 'markup',
      '#markup' => '<iframe src="' . $session_url . '" style="height:640px;width:100%;border:none;"></iframe>',
    );
  }
  return $output;
}
