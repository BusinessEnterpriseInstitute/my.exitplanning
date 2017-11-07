<?php
function bei_order_view($order, $view_mode='full', $langcode = NULL) {
  global $user;
  drupal_set_title('Order Summary');
  
  // Set the breadcrumb.
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $breadcrumb[] = l(t('My Material Orders'), 'user/' . $user->uid . '/orders');
  drupal_set_breadcrumb($breadcrumb);
  
  $order->content = array();
  $summary = '';
  $data = isset($order->data) ? $order->data : NULL;
  $header = array();
  $summary_rows = array();
  $summary_rows[] = array(
    'data' => array(
      array('data' => t('NAME'), 'header' => TRUE),
      array('data' => check_plain($order->name)),
    ),
    'no_striping' => TRUE,
  );
  $summary_rows[] = array(
    'data' => array(
      array('data' => t('COMPANY'), 'header' => TRUE),
      array('data' => check_plain($order->company_name)),
    ),
    'no_striping' => TRUE,
  );
  $address = check_plain($data['address']['street']) . '<br />';
  if (!empty($data['address']['additional'])) {
    $address .= check_plain($data['address']['additional']) . '<br />';
  }
  $address .= check_plain($data['address']['city']) . ', ' . $data['address']['state'] . ' ' . check_plain($data['address']['postal_code']);
  $summary_rows[] = array(
    'data' => array(
      array('data' => t('ADDRESS'), 'header' => TRUE),
      array('data' => $address),
    ),
    'no_striping' => TRUE,
  );
  if (!empty($order->phone)) {
    $summary_rows[] = array(
      'data' => array(
        array('data' => t('PHONE'), 'header' => TRUE),
        array('data' => check_plain($order->phone)),
      ),
      'no_striping' => TRUE,
    );
  }
  if (!empty($order->email)) {
    $summary_rows[] = array(
      'data' => array(
        array('data' => t('E-MAIL ADDRESS'), 'header' => TRUE),
        array('data' => check_plain($order->email)),
      ),
      'no_striping' => TRUE,
    );
  }
  if (!empty($order->website)) {
    $summary_rows[] = array(
      'data' => array(
        array('data' => t('WEBSITE'), 'header' => TRUE),
        array('data' => check_plain($order->website)),
      ),
      'no_striping' => TRUE,
    );
  }
  // Branding
  $summary_rows[] = array(
    'data' => array(
      array('data' => t('BACKGROUND COLOR'), 'header' => TRUE),
      array('data' => $data['branding']['background_color']['colorfield_picker']),
    ),
    'no_striping' => TRUE,
  );
  $summary_rows[] = array(
    'data' => array(
      array('data' => t('PRIMARY COLOR'), 'header' => TRUE),
      array('data' => $data['branding']['primary_color']['colorfield_picker']),
    ),
    'no_striping' => TRUE,
  );
  $summary_rows[] = array(
    'data' => array(
      array('data' => t('SECONDARY COLOR'), 'header' => TRUE),
      array('data' => $data['branding']['secondary_color']['colorfield_picker']),
    ),
    'no_striping' => TRUE,
  );
  $disclaimer_field = field_get_items('bei_order', $order, 'field_disclaimers');
  $mission_field = field_get_items('bei_order', $order, 'field_mission');
  if ($disclaimer_field) {
    $summary_rows[] = array(
      'data' => array(
        array('data' => t('DISCLAIMERS'), 'colspan' => '2', 'header' => TRUE),
      ),
      'no_striping' => TRUE,
    );
    $summary_rows[] = array(
      'data' => array(
        array('data' => check_markup($disclaimer_field[0]['value'], $disclaimer_field[0]['format']), 'colspan' => '2'),
      ),
      'no_striping' => TRUE,
    );
  }
  if ($mission_field) {
    $summary_rows[] = array(
      'data' => array(
        array('data' => t('MISSION'), 'colspan' => '2', 'header' => TRUE),
      ),
      'no_striping' => TRUE,
    );
    $summary_rows[] = array(
      'data' => array(
        array('data' => check_markup($mission_field[0]['value'], $mission_field[0]['format']), 'colspan' => '2'),
      ),
      'no_striping' => TRUE,
    );
  }
  $order->content['order_summary'] = array(
    '#markup' => theme('table', array(
      'header' => array(),
      'rows' => $summary_rows,
    )),
    '#weight' => 1,
  );
  return $order->content;
}

function bei_order_review($order, $view_mode='full', $langcode = NULL) {
  global $user;
  $label = entity_label('bei_order', $order);
  drupal_set_title($label);
  
  // Set the breadcrumb.
  $breadcrumb = array();
  $breadcrumb[] = l(t('Home'), '<front>');
  $breadcrumb[] = l(t('My Material Orders'), 'user/' . $user->uid . '/orders');
  drupal_set_breadcrumb($breadcrumb);
  
  $order->content = array();
  
  $proofs_field = field_get_items('bei_order', $order, 'field_order_proofs');
  $header = array(t('File'), t('Review'));
  $rows = array();
  if ($proofs_field) {
    foreach ($proofs_field as $key => $file) {
      $file_label = !empty($file['description']) ? $file['description'] : $file['filename'];
      $proof_file = field_view_value('bei_order', $order, 'field_order_proofs', $proofs_field[$key], array(
        'type' => 'file_download_link',
        'settings' => array(
          'text' => t('Download'),
        ),
      ));
      $row = array(
        'data' => array(
          array('data' => t($file_label)),
          array('data' => render($proof_file)),
        ),
        'no_striping' => TRUE,
      );
      $rows[] = $row;
    }
  }
  $order->content['proofs_review'] = array(
    '#markup' => theme('table', array(
      'header' => $header,
      'rows' => $rows,
      'empty' => t('No proofs available for review.'),
    ))
  );
  if ($order->uid === $user->uid) {
    $proofs_form = drupal_get_form('bei_order_view_form', $order);
    $order->content['proofs_review_form'] = array(
      '#markup' => drupal_render($proofs_form),
    );
  }
  
  return $order->content;
}

function bei_order_view_form($form, &$form_state, $order) {
  $form_state['order'] = $order;
  $form['actions'] = array(
    '#type' => 'container',
    '#attributes' => array(
      'class' => array('text-center'),
    ),
  );
  $form['actions']['approve'] = array(
    '#type' => 'submit',
    '#value' => t('Approve Proofs'),
    '#name' => 'approve_submit',
    '#submit' => array('bei_order_approve_submit'),
  );
  $form['actions']['change'] = array(
    '#type' => 'submit',
    '#value' => t('Request Changes'),
    '#name' => 'change_submit',
    '#submit' => array('bei_order_change_submit'),
  );
  return $form;
}
function bei_order_change_submit($form, &$form_state) {
  $order = $form_state['order'];
  unset($_GET['destination']);
  $form_state['redirect'] = 'bei-order/' . $order->oid . '/edit';
}
function bei_order_approve_submit($form, &$form_state) {
  $order = $form_state['order'];
  $order->status = 4;
  bei_order_save($order);
  drupal_set_message(t('Your order is now approved!'));
  unset($_GET['destination']);
  $form_state['redirect'] = 'bei-order/' . $order->oid . '/done';
}
