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

}

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
class ListEntityController extends EntityAPIController {

}




