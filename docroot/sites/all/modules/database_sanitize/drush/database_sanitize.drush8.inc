<?php

/**
 * @file
 * Drush Database Sanitize commands.
 */

/**
 * Implements hook_drush_help().
 */
function database_sanitize_drush_help($section) {
  switch ($section) {
    case 'meta:database_sanitize:title':
      return dt('Database Sanitize commands.');

    case 'meta:database_sanitize:summary':
      return dt('Helper commands for dealing with database sanitization YAML files.');

    case 'drush:db-sanitize-analyze':
      return dt('Compares existing database_sanitize.yml files on the site installation against existing database tables.');

    case 'drush:db-sanitize-generate':
      return dt('Generates a database_sanitize.yml file for tables not specified on sanitize YML files.');
  }
}

/**
 * Implements hook_drush_command().
 */
function database_sanitize_drush_command() {
  $sanitize_filename = 'database.sanitize.yml';
  $items['db-sanitize-analyze'] = [
    'description' => "Compares existing $sanitize_filename files on the site installation against existing database tables.",
    'callback' => 'database_sanitize_analyze',
    'aliases' => ['dbsa'],
    'options' => [
      'file' => [
        'description' => 'The full path to a sanitize YML file.',
        'required' => FALSE,
        'example-value' => "NON-PUBLIC-FOLDER/$sanitize_filename",
      ],
      'list' => [
        'description' => 'List the table names.',
        'required' => FALSE,
      ],
    ],
    'bootstrap' => DRUSH_BOOTSTRAP_DRUPAL_FULL,
  ];

  $items['db-sanitize-generate'] = [
    'description' => "Generates a $sanitize_filename file for tables not specified on sanitize YML files.",
    'callback' => 'database_sanitize_generate',
    'aliases' => ['dbsg'],
    'options' => [
      'file' => [
        'description' => 'The full path to a sanitize YML file.',
        'required' => FALSE,
        'example-value' => "NON-PUBLIC-FOLDER/$sanitize_filename",
      ],
      'machine-name' => [
        'description' => 'The machine name to export the tables under.',
        'required' => TRUE,
        'example-value' => 'MODULE_NAME',
      ],
    ],
    'outputformat' => [
      'default' => 'yaml',
      'output-data-type' => 'format-yaml',
      'pipe-format' => 'json',
    ],
    'bootstrap' => DRUSH_BOOTSTRAP_DRUPAL_FULL,
  ];

  return $items;
}

/**
 * Command callback for db-sanitize-analyze.
 */
function database_sanitize_analyze() {
  $yml_file_path = drush_get_option('file');
  if ($yml_file_path && !file_exists($yml_file_path)) {
    return drush_set_error(dt('File does not exist @file', ['@file' => $yml_file_path]));
  }
  require __DIR__ . '/../inc/database_sanitize.inc';
  $missing_tables = database_sanitize_get_unspecified_tables($yml_file_path);

  if (!$missing_tables) {
    drush_log(dt('All database tables are already specified in sanitize YML files'), 'ok');
    return;
  }

  drush_log(dt('There are @count tables not defined on sanitize YML files', ['@count' => count($missing_tables)]), 'warning');

  if (drush_get_option('list')) {
    drush_log(implode("\n", $missing_tables), 'warning');
  }
}

/**
 * Command callback for db-sanitize-generate.
 */
function database_sanitize_generate() {
  $machine_name = drush_get_option('machine-name');
  if (empty($machine_name)) {
    return drush_set_error(dt('You must specify a machine-name'));
  }

  $yml_file_path = drush_get_option('file');

  require __DIR__ . '/../inc/database_sanitize.inc';
  $missing_tables = database_sanitize_get_unspecified_tables($yml_file_path);

  if (!$missing_tables) {
    drush_log(dt('All database tables are already specified in sanitize YML files'), 'ok');
    return;
  }

  $content = [
    'sanitize' => [
      $machine_name => [],
    ],
  ];
  foreach ($missing_tables as $table) {
    $content['sanitize'][$machine_name][$table] = [
      'description' => "Sanitization entry for {$table}. Generated by drush db-sanitize-generate.",
      'query' => "TRUNCATE TABLE {$table}",
    ];
  }

  return $content;
}
