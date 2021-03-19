<?php

/**
 * @file
 * Observer example.
 */

/**
 * Class ExtendedFieldComparatorObserver.
 */
class ExtendedFieldComparatorObserver implements CFObserverInterface {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return [
      'article' => [
        'title',
        'body',
        'custom_field',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function update(SplSubject $nodeSubject) {
    $node = $nodeSubject->getNode();
    $changedFields = $nodeSubject->getChangedFields();

    // Do something with $node depends on $changedFields.
  }

}
