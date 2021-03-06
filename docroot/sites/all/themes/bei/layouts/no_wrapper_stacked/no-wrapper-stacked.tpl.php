<?php
/**
 * @file
 * Template for no wrapper stacked layout.
 *
 * This template provides a two column panel display layout, with
 * additional areas for the top and the bottom.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['top']: Content in the top row.
 *   - $content['left']: Content in the left column.
 *   - $content['right']: Content in the right column.
 *   - $content['bottom']: Content in the bottom row.
 */
?>
<?php if ($content['top']): ?>
  <?php print $content['top']; ?>
<?php endif; ?>
<?php if ($content['left']): ?>
  <?php print $content['left']; ?>
<?php endif; ?>
<?php if ($content['right']): ?>
  <?php print $content['right']; ?>
<?php endif; ?>
<?php if ($content['bottom']): ?>
  <?php print $content['bottom']; ?>
<?php endif; ?>
