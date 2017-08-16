<?php

/**
 * @file
 * Documentation for Rules Panes API.
 */

/**
 * Declares name conversions between data type names in Rules/Entity API and
 * CTools contexts.
 *
 * @return
 *   An array where the keys are the Rules/Entity API names, and the values are
 *   the corresponding names of the CTools contexts.
 */
function hook_rules_panes_convert_type_names() {
  return array(
    'text' => 'string',
    'rules_name_for_data' => 'ctools_context_name',
  );
}
