<?php
/**
 * Subscriber entity class extending the Entity class
 */
class BeiOrderEntity extends Entity {
  protected function defaultUri() {
    return array('path' => 'bei-order/' . $this->identifier());
  }
  protected function defaultLabel() {
    $title = 'Order #' . $this->identifier();
    return $title;
  }
  
  
  /*
  public function buildContent($entity, $view_mode = 'full', $langcode = NULL, $content = array()) {

    // Our additions to the $build render array
    return parent::buildContent($entity, $view_mode, $langcode, $content);
  */
}
class BeiOrderController extends EntityAPIController {
  public function buildContent($entity, $view_mode = 'full', $langcode = NULL, $content = array()) {

    // Our additions to the $build render array
    /*
    $content['narrative'] = array(
      '#type' => 'markup',
      '#markup' => check_markup($entity->description, $entity->format),
    );*/
    return parent::buildContent($entity, $view_mode, $langcode, $content);
  }
}
