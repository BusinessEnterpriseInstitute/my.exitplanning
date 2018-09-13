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




