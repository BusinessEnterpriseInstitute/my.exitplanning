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

function campaign_monitor_list_view($entity, $view_mode = 'full') {
  // Our entity type, for convenience.
  $entity_type = 'cm_list';
  // Start setting up the content.
  $entity->content = array(
    '#view_mode' => $view_mode,
  );
  $data = $entity->list_data;
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
    }
  }
  if ($view_mode == 'raw') {
    
    $mc_banner = field_get_items($entity_type, $entity, 'field_mc_banner');
    $rows = array();
    // Top spacer row.
    $rows[] = array(
      'data' => array(
        array('data' => '', 'class' => 'w600', 'height' => '20'),
      ),
      'no_striping' => TRUE,
    );
    // Top bar row.
    $top_bar_table = '
    <table id="top-bar" class="w600" width="600" cellspacing="0" cellpadding="0" border="0"><tbody>
      <tr>
        <td class="w15" width="15"></td>
        <td class="w340" width="340" valign="middle" align="left">
            <table class="w340" width="340" cellspacing="0" cellpadding="0" border="0"><tbody>
              <tr><td class="w340" width="340" height="8"></td></tr>
            </tbody></table>
            <div class="header-content"><webversion>Web version</webversion><span class="hide">&nbsp;&nbsp;|&nbsp; <preferences>Update preferences</preferences>&nbsp;&nbsp;|&nbsp; <unsubscribe>Unsubscribe</unsubscribe></span></div>
            <table class="w340" width="340" cellspacing="0" cellpadding="0" border="0"><tbody>
              <tr><td class="w340" width="340" height="8"></td></tr>
            </tbody></table>
        </td>
        <td class="w230" width="230" valign="middle" align="right">
          <table class="w230" width="230" cellspacing="0" cellpadding="0" border="0"><tbody>
            <tr><td class="w230" width="230" height="8"></td></tr>
          </tbody></table>
          <table cellspacing="0" cellpadding="0" border="0"><tbody>
            <tr>
              <td valign="middle"><fblike><img src="https://img.createsend1.com/img/templatebuilder/like-glyph.png" alt="Facebook icon" =""="" width="8" height="14" border="0"></fblike></td>
              <td width="3"></td>
              <td valign="middle"><div class="header-content"><fblike>Like</fblike></div></td>
              <td class="w10" width="10"></td>
              <td valign="middle"><tweet><img src="https://img.createsend1.com/img/templatebuilder/tweet-glyph.png" alt="Twitter icon" =""="" width="17" height="13" border="0"></tweet></td>
              <td width="3"></td>
              <td valign="middle"><div class="header-content"><tweet>Tweet</tweet></div></td>
              <td class="w10" width="10"></td>
              <td valign="middle"><forwardtoafriend><img src="https://img.createsend1.com/img/templatebuilder/forward-glyph.png" alt="Forward icon" =""="" width="19" height="14" border="0"></forwardtoafriend></td>
              <td width="3"></td>
              <td valign="middle"><div class="header-content"><forwardtoafriend>Forward</forwardtoafriend></div></td>
            </tr>
          </tbody></table>
          <table class="w230" width="230" cellspacing="0" cellpadding="0" border="0"><tbody>
            <tr><td class="w230" width="230" height="8"></td></tr>
          </tbody></table>
        </td>
        <td class="w15" width="15"></td>
      </tr>
    </tbody></table>
    ';
    $rows[] = array(
      'data' => array(
        array('data' => $top_bar_table, 'class' => 'w600', 'width' => '600'),
      ),
      'no_striping' => TRUE,
    );
    // Banner.
    if ($mc_banner) {
      $mc_banner_file = file_load($mc_banner[0]['fid']);
      $mc_banner_output = array(
        '#theme' => 'image_style',
        '#style_name' => 'mc_banner',
        '#path' => $mc_banner_file->uri,
        '#width' => $mc_banner_file->width,
        '#height' => $mc_banner_file->height,
      );
      $banner_table = '
      <table id="banner" class="w600" width="600" cellspacing="0" cellpadding="0" border="0"><tbody>
          <tr>
              <td align="center" valign="top">
              ' . render($mc_banner_output) . '
              </td>
          </tr>
      </tbody></table>';
      $rows[] = array(
        'data' => array(
          array('data' => $banner_table, 'class' => 'w600', 'width' => '600'),
        ),
        'no_striping' => TRUE,
      );
    }
    // Article
    $article = variable_get('campaign_monitor_article_preview', FALSE);
    if ($article) {
      $article_output = check_markup($article['value'], $article['format']);
      $disclaimer = variable_get('campaign_monitor_disclaimer', FALSE);
      if ($disclaimer) {
        $article_output .= check_markup($disclaimer['value'], $disclaimer['format']);
      }
      $article_table = '
      <table id="article" class="w600" width="600" cellspacing="0" cellpadding="0" border="0"><tbody>
          <tr>
              <td valign="top">
              <div class="article-content">' . $article_output . '</div>
              </td>
          </tr>
      </tbody></table>';
      $rows[] = array(
        'data' => array(
          array('data' => $article_table, 'class' => 'w600', 'width' => '600'),
        ),
        'no_striping' => TRUE,
      );
    }
    $table = theme('table', array(
      'header' => array(),
      'rows' => $rows,
      'attributes' => array(
        'class' => 'w600',
        'width' => '600',
        'cellpadding' => '0',
        'cellspacing' => '0',
        'border' => '0',
      ),
    ));
    $table_wrapper = theme('table', array(
      'header' => array(),
      'rows' => array(
        array(
          array('data' => $table, 'align' => 'center'),
        ),
      ),
      'attributes' => array(
        'width' => '100%',
        'cellpadding' => '0',
        'cellspacing' => '0',
        'border' => '0',
        'id' => 'background-table',
      ),
    ));
    
    $entity->content['footer'] = array(
      '#type' => 'markup',
      '#markup' => $table_wrapper,
    );
  }
  return $entity->content;
}
/*
 * Webhooks page for lists.
 */
function campaign_monitor_list_webhooks($entity) {
  $client = cm_client_load($entity->cid);
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  if ($client) {
    $client_uri = entity_uri('cm_client', $client);
    $breadcrumb[] = l(t('@client', array('@client' => $client->name)), $client_uri['path']);
  }
  drupal_set_breadcrumb($breadcrumb);
  $data = $entity->list_data;
  $webhooks = isset($data['webhooks']) ? $data['webhooks'] : array();
  $rows = array();
  foreach ($webhooks as $webhook) {
    $rows[] = array(
      'data' => array(
        array('data' => t('Webhook ID:'), 'header' => TRUE),
        array('data' => check_plain($webhook->WebhookID)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Events:'), 'header' => TRUE),
        array('data' => theme_item_list(array('items' => $webhook->Events, 'title' => NULL, 'type' => 'ul', 'attributes' => array()))),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Url:'), 'header' => TRUE),
        array('data' => check_plain($webhook->Url)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Status:'), 'header' => TRUE),
        array('data' => check_plain($webhook->Status)),
      ),
      'no_striping' => TRUE,
    );
    $rows[] = array(
      'data' => array(
        array('data' => t('Payload Format:'), 'header' => TRUE),
        array('data' => check_plain($webhook->PayloadFormat)),
      ),
      'no_striping' => TRUE,
    );
  }
  $table = theme('table', array(
    'header' => array(),
    'rows' => $rows,
    'empty' => t('No webhooks exist for this list.'),
  ));
  $output = array(
    '#type' => 'markup',
    '#markup' => $table,
  );
  return $output;
}

