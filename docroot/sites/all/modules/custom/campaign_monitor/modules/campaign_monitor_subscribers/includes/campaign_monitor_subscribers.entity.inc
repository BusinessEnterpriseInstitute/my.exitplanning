<?php

/**
 * List entity class extending the Entity class
 */
class CmSubscriberEntity extends Entity {
  protected function defaultUri() {
    return array('path' => 'cm-subscriber/' . $this->identifier());
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
class CmSubscriberEntityController extends EntityAPIController {

}



