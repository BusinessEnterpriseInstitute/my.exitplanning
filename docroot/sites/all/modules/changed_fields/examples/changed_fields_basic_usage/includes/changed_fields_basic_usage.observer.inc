<?php

/**
 * @file
 * Observer example.
 */

/**
 * Class BasicUsageObserver.
 */
class BasicUsageObserver implements CFObserverInterface {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return [
      'article' => [
        'title',
        'body',
        'field_text_test',
        'field_file_test',
        'field_image_test',
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
