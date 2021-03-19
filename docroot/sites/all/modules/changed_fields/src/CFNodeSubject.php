<?php

/**
 * Class CFNodeSubject.
 */
class CFNodeSubject implements SplSubject {

  /**
   * Node object.
   *
   * @var \stdClass
   */
  private $node;

  /**
   * Field comparator object.
   *
   * @var CFDefaultFieldComparator
   */
  private $fieldComparator;

  /**
   * Array contains all registered observers.
   *
   * @var array
   */
  private $observers;

  /**
   * Node subject constructor.
   *
   * @param \stdClass $node
   *   Node object.
   * @param CFDefaultFieldComparator $fieldComparator
   *   Field comparator object.
   */
  public function __construct(\stdClass $node, CFDefaultFieldComparator $fieldComparator) {
    $this->node = $node;
    $this->fieldComparator = $fieldComparator;
  }

  /**
   * {@inheritdoc}
   */
  public function attach(SplObserver $observer) {
    $this->observers[spl_object_hash($observer)] = $observer;
  }

  /**
   * {@inheritdoc}
   */
  public function detach(SplObserver $observer) {
    unset($this->observers[spl_object_hash($observer)]);
  }

  /**
   * {@inheritdoc}
   */
  public function notify() {
    foreach ($this->observers as $observer) {
      foreach ($observer->getInfo() as $nodeType => $fields) {
        if (isset($this->node->original) && $this->node->type == $nodeType) {
          $this->node->changed_fields = [];

          foreach ($fields as $fieldName) {
            if ($fieldName == 'title') {
              $oldValue = $this->node->original->$fieldName;
              $newValue = $this->node->$fieldName;
              $fieldInfo['field_base'] = ['type' => 'title'];
            }
            else {
              $oldValue = field_get_items('node', $this->node->original, $fieldName);
              $newValue = field_get_items('node', $this->node, $fieldName);
              $fieldInfo['field_base'] = field_info_field($fieldName);
            }

            $fieldInfo['field_instance'] = field_info_instance('node', $fieldName, $nodeType);
            $result = $this->fieldComparator->runFieldComparison($fieldInfo, $oldValue, $newValue);

            if (is_array($result)) {
              $this->node->changed_fields[$fieldName] = $result;
            }
          }

          if (!empty($this->node->changed_fields)) {
            $observer->update($this);
          }
        }
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getNode() {
    return $this->node;
  }

  /**
   * {@inheritdoc}
   */
  public function getChangedFields() {
    return $this->node->changed_fields;
  }

}
