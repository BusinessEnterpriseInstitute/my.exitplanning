<?php

/**
 * @file
 * Lockr autoloader.
 */

/**
 * Autoloader for Lockr library.
 */
function lockr_autoload($class) {
  if (substr($class, 0, 6) !== 'Lockr\\') {
    return FALSE;
  }
  $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
  if (file_exists($file)) {
    include_once $file;
    return TRUE;
  }
  return FALSE;
}

spl_autoload_register('lockr_autoload');
