<?php

/**
 * @file
 * Extended field comparator example.
 */

/**
 * Class ExtendedFieldComparator.
 */
class ExtendedFieldComparator extends CFDefaultFieldComparator {

  /**
   * {@inheritdoc}
   */
  public function getDefaultComparableProperties(array $fieldInfo) {
    $properties = [];

    // Return comparable field properties for extra or custom field type.
    if ($fieldInfo['field_base']['type'] == 'changed_fields_custom_field') {
      $properties = [
        'value_1',
      ];
    }

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function extendComparableProperties(array $fieldInfo, array $properties) {
    // Return extended field properties for a given field type based on
    // $fieldInfo['field_base'] or $fieldInfo['field_instance'] data.
    if ($fieldInfo['field_base']['type'] == 'changed_fields_custom_field') {
      $properties[] = 'value_2';
    }

    return $properties;
  }

}
