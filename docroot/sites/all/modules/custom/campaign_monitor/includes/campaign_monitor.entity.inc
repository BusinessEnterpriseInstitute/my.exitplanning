<?php
/**
 * Client entity class extending the Entity class
 */
class ClientEntity extends Entity {
  protected function defaultUri() {
    return array('path' => 'cm-client/' . $this->identifier());
  }
  /*
  protected function defaultLabel() {
    $email = isset($this->email) ? $this->email : '';
    return $email;
  }*/
  /*
  public function buildContent($entity, $view_mode = 'full', $langcode = NULL, $content = array()) {

    // Our additions to the $build render array
    $build = parent::buildContent($entity, $view_mode, $langcode, $content);
    return $build;
  }*/
}
class ClientEntityController extends EntityAPIController {
  public function create(array $values = array()) {
    global $user;
    $values += array(
      'uid' => $user->uid,
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




