<?php

/**
 * Interface CFObserverInterface.
 */
interface CFObserverInterface extends SplObserver {

  /**
   * Returns associative array of node types with their fields for watching.
   *
   * @return array
   */
  public function getInfo();

}
