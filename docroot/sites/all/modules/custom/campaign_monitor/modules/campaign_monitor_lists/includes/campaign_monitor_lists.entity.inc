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
class ListEntityController extends EntityAPIController {

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




