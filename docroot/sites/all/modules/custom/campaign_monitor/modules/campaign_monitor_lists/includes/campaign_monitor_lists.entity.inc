<?php

/**
 * List entity class extending the Entity class
 */
class ListEntity extends Entity {
  protected function defaultUri() {
    return array('path' => 'cm-list/' . $this->identifier());
  }
  /*
  protected function defaultLabel() {
    $email = isset($this->email) ? $this->email : '';
    return $email;
  }*/
  /*
  public function buildContent($entity, $view_mode = 'full', $langcode = NULL, $content = array()) {

    // Our additions to the $build render array
    return parent::buildContent($entity, $view_mode, $langcode, $content);
  }*/
}
/**
 * Webhook entity class extending the Entity class
 */
class WebhookEntity extends Entity {
  protected function defaultUri() {
    return array('path' => 'cm-webhook/' . $this->identifier());
  }
}
class ListEntityController extends EntityAPIController {
  public function create(array $values = array()) {
    $values += array(
      'manage_campaigns' => FALSE,
      'from_name' => '',
      'confirmed_opt_in' => FALSE,
      'unsubscribe_setting' => 'AllClientLists',
      'unsubscribe_page' => '',
      'confirmation_success_page' => '',
    );
    return parent::create($values);
  }
  public function save($entity, DatabaseTransaction $transaction = NULL) {
    if (isset($entity->is_new)) {
      $entity->created = REQUEST_TIME;
    }
    $entity->changed = REQUEST_TIME;
    $from_domain = $entity->from_domain;
    $domain = db_query('SELECT * FROM {campaign_monitor_domains} d WHERE d.domain = :from_domain', array(':from_domain' => $from_domain))->fetchObject();
    if (!$domain) {
      // Create a new cm_domain entity.
      $cm_domain = entity_create('cm_domain', array(
        'domain' => $from_domain,
      ));
      $cm_domain->save();
      // Create a new cm_client_domain entity referencing the cm_domain entity.
      $cm_client_domain = entity_create('cm_client_domain', array(
        'domain_id' => entity_id('cm_domain', $cm_domain),
        'cid' => $entity->cid,
      ));
      $cm_client_domain->save();
    }
    else {
      // Check to see if the referenced client for the list is associated with the existing domain.
      $client_domain = db_query('SELECT id FROM {campaign_monitor_client_domains} cd WHERE cd.domain_id = :domain_id AND cd.cid = :cid', array(':domain_id' => $domain->id, ':cid' => $entity->cid))->fetchField();
      if (!$client_domain) {
        // Create a new cm_client_domain entity referencing the cm_domain entity.
        $cm_client_domain = entity_create('cm_client_domain', array(
          'domain_id' => $domain->id,
          'cid' => $entity->cid,
        ));
        $cm_client_domain->save();
      }
    }
    return parent::save($entity, $transaction);
  }
}

class ListEntityUIController extends EntityDefaultUIController {

  /**
   * Overrides hook_menu() defaults.
   */
  public function hook_menu() {
    $items = parent::hook_menu();
    unset($items[$this->path . '/add']);
    return $items;
  }
}




