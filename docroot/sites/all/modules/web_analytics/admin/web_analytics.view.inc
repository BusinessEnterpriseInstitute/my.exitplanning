<?php

/**
 * @file
 * View Page for the Web Analytics Module.
 */

/**
 * Custom hooks for viewing the Statistical Report.
 */
function web_analytics_view() {

  $header = array();

  $header[] = array(
    'data'  => 'Title',
  );

  $header[] = array(
    'data'  => 'Type',
    'field' => 'type',
    'sort'  => 'ASC',
  );

  $header[] = array(
    'data'  => 'Machine Name',
    'field' => 'name',
    'sort'  => 'ASC',
  );

  $header[] = array(
    'data'  => 'Total Views',
    'field' => 'total_views',
    'sort'  => 'DESC',
  );

  $header[] = array(
    'data'  => 'First Access',
    'field' => 'first_view',
    'sort'  => 'ASC',
  );

  $header[] = array(
    'data'  => 'Last Access',
    'field' => 'last_view',
    'sort'  => 'ASC',
  );

  $order = 'total_views';
  $sort = 'DESC';
  if (isset($_GET['order'])) {
    if (strtolower($_GET['order']) == 'type') {
      $order = 'type';
    }
    if (strtolower($_GET['order']) == 'name') {
      $order = 'name';
    }
  }
  if (isset($_GET['sort']) && $_GET['sort'] == 'asc') {
    $sort = 'ASC';
  }
  $get_analytics = db_select('web_analytics', 'w')
    ->fields('w')
    ->orderBy($order, $sort)
    ->extend('PagerDefault')
    ->extend('TableSort')
    ->limit(25);

  $results = $get_analytics->execute();

  $rows = array();
  foreach ($results as $row) {
    if ($row->type == 'node') {
      $node = node_load($row->id);
      $rows[] = array(
        '<a href="/node/' . $row->id . '">' . $node->title . '</a>',
        $row->type,
        $row->name,
        $row->total_views,
        format_date($row->first_view, 'short'),
        format_date($row->last_view, 'short'),
      );
    }
    elseif ($row->type == 'term') {
      $term = taxonomy_term_load($row->id);
      $rows[] = array(
        '<a href="/taxonomy/term/' . $row->id . '">' . $term->name . '</a>',
        $row->type,
        $row->name,
        $row->total_views,
        format_date($row->first_view, 'short'),
        format_date($row->last_view, 'short'),
      );
    }
    elseif ($row->type == 'view') {
      if (module_exists('views')) {
        $view = views_get_view($row->name);
        $rows[] = array(
          $view->human_name,
          $row->type,
          $row->name,
          $row->total_views,
          format_date($row->first_view, 'short'),
          format_date($row->last_view, 'short'),
        );
      }
    }
  }

  $output = theme('table', array(
    'header' => $header,
    'rows'   => $rows,
    'empty'  => 'No Stats found.',
  ));

  $output .= theme('pager');

  return $output;
}
