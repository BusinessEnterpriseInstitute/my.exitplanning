<?php

/**
 * @file
 * Views custom cache all arguments plugin.
 */

/**
 * Views caching given view's all arguments.
 *
 * @see views_plugin_cache()
 */
class views_custom_cache_plugin_multi_cache extends views_plugin_cache {

  /**
   * Implements views_plugin_cache#summary_title().
   */
  function summary_title() {
    $time = $this->get_time();
    $role = $this->options['per_role'] ? 'Yes' : 'No';
    $entities = isset($this->options['entities']) ? $this->options['entities'] : 'none';
    if ($this->options['cache_time'] == '-1') {
      return t('Never cache');
    }
    elseif ($this->options['cache_time'] == '0') {
      return t('Cache permanent' . ' / ' . t('Per role') . ': ' . $role . ' / ' . t('Updates awareness') . ': ' . $entities);
    }
    else {
      return t('Time') . ': ' . format_interval($time, 1) . ' / ' . t('Per role') . ': ' . $role . ' / ' . t('Updates awareness') . ': ' . $entities;
    }
  }

  /**
   * Implements views_object#option_definition().
   */
  function option_definition() {
    $options = parent::option_definition();
    $options['cache_time'] = array('default' => 3600);
    $options['cache_time_custom'] = array('default' => 0);
    $options['per_role'] = array('default' => 1);
    $options['entities'] = array('default' => 'none');
    $options['bundles'] = array('default' => 'all');
    return $options;
  }

  /**
   * Implements views_object#option_defaults().
   */
  function option_defaults(&$options) {
    $options['cache_time'] = 3600;
    $options['cache_time_custom'] = 0;
    $options['per_role'] = 1;
    $options['entities'] = 'none';
    $options['bundles'] = 'all';
  }

  /**
   * Implements views_plugin#options_form().
   */
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $options = array(60, 300, 1800, 3600, 21600, 86400, 518400);
    $options = drupal_map_assoc($options, 'format_interval');
    $options = array(-1 => t('Never cache')) + array(0 => t('Permanent cache')) + $options + array('custom' => t('Custom'));
    $options_per_user = array(1 => t('Yes'), 0 => t('No'));
    $options_entities = array('none' => t('Unaware'), 'node' => t('Node aware'));
    $options_bundles = $this->get_node_bundles();

    $form['cache_time'] = array(
      '#type' => 'select',
      '#title' => t('Cache duration time.'),
      '#options' => $options,
      '#default_value' => $this->options['cache_time'],
    );
    $form['cache_time_custom'] = array(
      '#type' => 'textfield',
      '#title' => t('Custom time.'),
      '#size' => '25',
      '#maxlength' => '30',
      '#description' => t('Cache duration time in seconds.'),
      '#default_value' => $this->options['cache_time_custom'],
      '#process' => array('ctools_dependent_process'),
      '#dependency' => array(
        'edit-cache-options-cache-time' => array('custom'),
      ),
    );
    $form['per_role'] = array(
      '#type' => 'select',
      '#title' => t('Cache per role?'),
      '#options' => $options_per_user,
      '#default_value' => $this->options['per_role'],
    );
    $form['entities'] = array(
      '#type' => 'select',
      '#title' => t('Updates awareness'),
      '#options' => $options_entities,
      '#default_value' => $this->options['entities'],
    );
    $form['bundles'] = array(
      '#type' => 'select',
      '#multiple' => TRUE,
      '#title' => t('Be aware of following bundles'),
      '#options' => $options_bundles,
      '#description' => t('Empty selection means to be aware of all bundles.'),
      '#default_value' => $this->options['bundles'],
      '#dependency' => array(
        'edit-cache-options-entities' => array('node'),
      ),
    );
  }

  /**
   * Validates options form.
   */
  function options_validate(&$form, &$form_state) {
    $custom_fields = array('cache_time');
    foreach ($custom_fields as $field) {
      if ($form_state['values']['cache_options'][$field] == 'custom' && !is_numeric($form_state['values']['cache_options'][$field . '_custom'])) {
        form_error($form[$field .'_custom'], t('Custom time values must be numeric.'));
      }
      if ($form_state['values']['cache_options'][$field] == 'custom' && $form_state['values']['cache_options'][$field . '_custom'] <= 0) {
        $mssg = t('Custom cache time must be greater than zero.');
        form_error($form[$field .'_custom'], $mssg);
      }
    }
  }

  /**
   * Returns cache time defined by user.
   */
  function get_time() {
    $time = $this->options['cache_time'] == 'custom' ? $this->options['cache_time_custom'] : $this->options['cache_time'];
    return $time;
  }

  /**
   * Implements views_plugin_cache#get_results_key().
   */
  function get_results_key() {
    $per_role = isset($this->options['per_role']) ? $this->options['per_role'] : 1;
    $entities = isset($this->options['entities']) ? $this->options['entities'] : 'none';
    $bundles = isset($this->options['bundles']) ? $this->options['bundles'] : array();
    if (!isset($this->_results_key)) {
      $this->_results_key = $this->view->name . ':' . $this->display->id . ':results:' . $this->get_all_arg();
      if ($per_role) {
        $this->_results_key .= ':' . $this->get_cache_key();
      }
      if (!empty($entities) && $entities == 'node') {
        $last_changed = $this->node_get_last_changed_date($bundles);
        $this->_results_key .= ':' . $last_changed;
      }
    }
    return $this->_results_key;
  }

  /**
   * Implements views_plugin_cache#get_output_key().
   */
  function get_output_key() {
    $per_role = isset($this->options['per_role']) ? $this->options['per_role'] : 1;
    $entities = isset($this->options['entities']) ? $this->options['entities'] : 'none';
    $bundles = isset($this->options['bundles']) ? $this->options['bundles'] : array();
    if (!isset($this->_output_key)) {
      $key_data = array(
        'theme' => $GLOBALS['theme'],
      );
      $this->_output_key = $this->view->name . ':' . $this->display->id . ':output:' . $this->get_all_arg();
      if ($per_role) {
        $this->_output_key .= ':' . $this->get_cache_key($key_data);
      }
      if (!empty($entities) && $entities == 'node') {
        $last_changed = $this->node_get_last_changed_date($bundles);
        $this->_output_key .= ':' . $last_changed;
      }
    }

    return $this->_output_key;
  }

  /**
   * Implements views_plugin_cache#cache_expire().
   *
   * Determine the expiration time of the cache type, or NULL if no expire.
   *
   * @param string $type
   *   The cache type, either 'query', 'result' or 'output'.
   */
  function cache_expire($type) {
    $expiration_time = $this->get_time();
    if ($expiration_time) {
      $cutoff = REQUEST_TIME - $expiration_time;
      return $cutoff;
    }
    else {
      return NULL;
    }
  }

  /**
   * Implements views_plugin_cache#cache_set_expire().
   *
   * Determine expiration time in the cache table of the cache type
   * or CACHE_PERMANENT if item shouldn't be removed automatically from cache.
   *
   * @param string $type
   *   The cache type, either 'query', 'result' or 'output'.
   */
  function cache_set_expire($type) {
    $expiration_time = $this->get_time();
    if ($expiration_time) {
      return REQUEST_TIME + $expiration_time;
    }
    else {
      return CACHE_PERMANENT;
    }
  }

  /**
   * Custom function which takes all arguments of view.
   */
  function get_all_arg() {
    global $language;

    $key = '';

    if (!empty($_GET['page'])) {
      $key .= $_GET['page'];
    }
    elseif (!empty($_POST['page'])) {
      $key .= $_POST['page'];
    }

    if (!empty($_GET['f'])) {
      // search api facets.
      $key .= serialize($_GET['f']);
    }

    if (!empty($this->view->args)) {
      $key .= serialize($this->view->args);
    }

    if (!empty($this->view->exposed_raw_input)) {
      $key .= serialize($this->view->exposed_raw_input);
    }

    if (empty($key)) {
      $key = 'none';
    }
    else {
      $key = md5($key);
    }

    $key .= ':' . $language->language;

    return $key;
  }

  /**
   * Returns the change date of most recent node.
   *
   * @param array $bundles
   *   Bundles to check out.
   *
   * @return int
   *   Change date in unixtime.
   */
  function node_get_last_changed_date($bundles) {
    $query = db_select('node', 'n');

    if (empty($bundles)) {
      $result = $query->fields('n', array('changed'))
        ->orderBy('n.changed', 'DESC')
        ->range(0, 1)
        ->execute()
        ->fetchAssoc();
    }
    else {
      $result = $query->fields('n', array('changed'))
        ->orderBy('n.changed', 'DESC')
        ->condition('n.type', array_keys($bundles), 'IN')
        ->range(0, 1)
        ->execute()
        ->fetchAssoc();
    }

    return $result['changed'];
  }

  /**
   * Returns the list of available node bundles.
   *
   * @return array
   *   List of bundles.
   */
  function get_node_bundles() {
    $bundles = array();

    $ctypes = node_type_get_types();
    foreach ($ctypes as $key => $ct) {
      $bundles[$key] = $ct->name;
    }

    return $bundles;
  }
}
