<?php

/**
 * Class CFDefaultFieldComparator.
 */
class CFDefaultFieldComparator {

  /**
   * Method that runs comparison of field values.
   *
   * @param array $fieldInfo
   *   Array contains field instance and field base information.
   * @param mixed $oldValue
   *   Old field value to compare.
   * @param mixed $newValue
   *   Old field value to compare.
   *
   * @return array|bool
   *   TRUE if fields are identical or array with differences if fields are
   *   different.
   */
  public function runFieldComparison(array $fieldInfo, $oldValue, $newValue) {
    $similarFields = TRUE;

    if ($fieldInfo['field_base']['type'] == 'field_collection') {
      // If collection was added or removed then we have already
      // different collections.
      if ((!$oldValue && $newValue) || ($oldValue && !$newValue)) {
        $similarFields = $this->makeResultArray($fieldInfo['field_base']['type'], $oldValue, $newValue);
      }
      else {
        if ($oldValue && $newValue) {
          // If value was added|removed to|from multi-value field then we have
          // already different values.
          if (count($newValue) != count($oldValue)) {
            $similarFields = $this->makeResultArray($fieldInfo['field_base']['type'], $oldValue, $newValue);
          }
          else {
            foreach ($oldValue as $key => $fc) {
              if (is_array($similarFields)) {
                break;
              }

              $oldFc = entity_load('field_collection_item', [$fc['value']]);
              $oldFc = reset($oldFc);
              $newFc = $newValue[$key]['entity'];
              $fcFields = field_info_instances('field_collection_item', $fieldInfo['field_base']['field_name']);

              foreach ($fcFields as $fcFieldName => $fcFieldData) {
                $fcFieldData = field_info_field($fcFieldName);
                $oldFcFieldValue = field_get_items('field_collection_item', $oldFc, $fcFieldName);
                $newFcFieldValue = field_get_items('field_collection_item', $newFc, $fcFieldName);
                $similarFields = $this->runFieldComparison($fcFieldData, $oldFcFieldValue, $newFcFieldValue);

                // If changes have been detected.
                if (is_array($similarFields)) {
                  // Make result array with old and new
                  // field collection entities.
                  $similarFields = $this->makeResultArray($fieldInfo['field_base']['type'], $oldValue, $newValue);
                  break;
                }
              }
            }
          }
        }
      }
    }
    else {
      $similarFields = $this->compareFieldValues($fieldInfo, $oldValue, $newValue);
    }

    return $similarFields;
  }

  /**
   * Method that returns comparable properties for existing field type.
   *
   * @param array $fieldInfo
   *   Array contains field instance and field base information.
   *
   * @return array
   *    Array with properties that we need to use to compare two field values.
   */
  private function getComparableProperties(array $fieldInfo) {
    switch ($fieldInfo['field_base']['type']) {
      case 'text_with_summary':
        $properties = [
          'value',
          'summary',
          'format',
        ];
        break;

      case 'text':
      case 'text_long':
      case 'number_decimal':
      case 'number_float':
      case 'number_integer':
      case 'list_float':
      case 'list_integer':
      case 'list_boolean':
      case 'list_text':
      case 'phone':
        $properties = ['value'];
        break;

      case 'taxonomy_term_reference':
        $properties = ['tid'];
        break;

      case 'entityreference':
        $properties = ['target_id'];
        break;

      case 'image':
        $properties = [
          'fid',
          'width',
          'height',
        ];

        if (!empty($fieldInfo['field_instance']['settings']['alt_field'])) {
          $properties[] = 'alt';
        }

        if (!empty($fieldInfo['field_instance']['settings']['title_field'])) {
          $properties[] = 'title';
        }

        break;

      case 'file':
        $properties = ['fid'];

        if (!empty($fieldInfo['field_instance']['settings']['description_field'])) {
          $properties[] = 'description';
        }

        if (!empty($fieldInfo['field_instance']['settings']['display_field'])) {
          $properties[] = 'display';
        }

        break;

      case 'date':
      case 'datetime':
      case 'datestamp':
        $properties = [
          'value',
          'timezone',
        ];
        break;

      case 'email':
        $properties = ['email'];
        break;

      case 'link_field':
        $properties = [
          'url',
          'title',
        ];
        break;

      default:
        $properties = $this->getDefaultComparableProperties($fieldInfo);
        break;
    }

    return $this->extendComparableProperties($fieldInfo, $properties);
  }

  /**
   * Method that returns comparable properties for extra or custom field type.
   *
   * Use it if you want to add comparison support
   * for extra or custom field types.
   *
   * @param array $fieldInfo
   *   Array contains field instance and field base information.
   *
   * @return array
   *   Array with properties that system needs to use to compare two field
   *   values depends on custom or extra field type.
   */
  protected function getDefaultComparableProperties(array $fieldInfo) {
    return [];
  }

  /**
   * Method that returns extended comparable properties for field type.
   *
   * Use it if you want to extend comparable properties for a given field type.
   *
   * @param array $fieldInfo
   *   Array contains field instance and field base information.
   * @param array $properties
   *   Array with properties that we need to use to compare two field values.
   *
   * @return array
   *   Array with extended properties that system needs to use to compare two
   *   field values depends on core field type.
   */
  protected function extendComparableProperties(array $fieldInfo, array $properties) {
    return $properties;
  }

  /**
   * Method that compares old and new field values.
   *
   * @param array $fieldInfo
   *   Array contains field instance and field base information.
   * @param mixed $oldValue
   *   Old field value to compare.
   * @param mixed $newValue
   *   New field value to compare.
   *
   * @return array|bool
   *   TRUE if fields are identical or array with differences if fields are
   *   different.
   */
  private function compareFieldValues(array $fieldInfo, $oldValue, $newValue) {
    $result = TRUE;
    $properties = $this->getComparableProperties($fieldInfo);

    // If value was added or removed then we have already different values.
    if ((!$oldValue && $newValue) || ($oldValue && !$newValue)) {
      $result = $this->makeResultArray($fieldInfo['field_base']['type'], $oldValue, $newValue);
    }
    else {
      if ($oldValue && $newValue) {
        // Simple comparison (for title).
        if (empty($properties) && $fieldInfo['field_base']['type'] == 'title') {
          if ($newValue != $oldValue) {
            $result = $this->makeResultArray($fieldInfo['field_base']['type'], $oldValue, $newValue);
          }
        }
        // Compare field value properties.
        else {
          // If value was added|removed to|from multi-value field then we have
          // already different values.
          if (count($newValue) != count($oldValue)) {
            $result = $this->makeResultArray($fieldInfo['field_base']['type'], $oldValue, $newValue);
          }
          else {
            // Walk through each field value and compare it's properties.
            foreach ($newValue as $key => $value) {
              if (is_array($result)) {
                break;
              }

              foreach ($properties as $property) {
                if (array_key_exists($property, $newValue[$key]) &&
                  array_key_exists($property, $oldValue[$key]) &&
                  $newValue[$key][$property] != $oldValue[$key][$property]
                ) {
                  $result = $this->makeResultArray($fieldInfo['field_base']['type'], $oldValue, $newValue);
                  break;
                }
              }
            }
          }
        }
      }
    }

    return $result;
  }

  /**
   * Method that generates result array for CFDefaultFieldComparator::compareFieldValues().
   *
   * @param string $fieldType
   *   Field type.
   * @param mixed $oldValue
   *   Old field value to compare.
   * @param mixed $newValue
   *   New field value to compare.
   *
   * @return array
   *   Array with old and new field values for compareFieldValues() method.
   */
  private function makeResultArray($fieldType, $oldValue, $newValue) {
    // Return field collection item entities like field values for
    // 'field_collection' field type.
    if ($fieldType == 'field_collection') {
      $resultOldValue = FALSE;
      $resultNewValue = FALSE;

      if ($oldValue) {
        foreach ($oldValue as $key => $fc) {
          $oldFc = entity_load('field_collection_item', [$fc['value']]);
          $oldFc = reset($oldFc);
          $resultOldValue[] = $oldFc;
        }
      }

      if ($newValue) {
        foreach ($newValue as $key => $fc) {
          $resultNewValue[] = $fc['entity'];
        }
      }
    }
    else {
      $resultOldValue = $oldValue;
      $resultNewValue = $newValue;
    }

    return [
      'old_value' => $resultOldValue,
      'new_value' => $resultNewValue,
    ];
  }

}
