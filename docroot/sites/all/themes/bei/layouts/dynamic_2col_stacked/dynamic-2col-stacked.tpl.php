<?php
/**
 * @file
 * Template for a 2 column panel layout.
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
  <div class="row">
    <div class="large-12 columns">
    <?php print $content['top']; ?>
    </div>
  </div>
<?php endif; ?>
<?php if ($content['left'] && $content['right']): ?>
<div class="row">
  <?php if ($left_classes): ?>
    <?php print '<div class="' . $left_classes . '">' . $content['left'] . '</div>'; ?>
  <?php else: ?>
    <?php print $content['left']; ?>
  <?php endif; ?>
  <?php if ($right_classes): ?>
    <?php print '<div class="' . $right_classes . '">' . $content['right'] . '</div>'; ?>
  <?php else: ?>
    <?php print $content['right']; ?>
  <?php endif; ?>
</div>
<?php elseif ($content['left'] || $content['right']): ?>
<div class="row">
  <?php if ($content['left']): ?>
    <?php if ($left_classes_alternate): ?>
      <?php print '<div class="' . $left_classes_alternate . '">' . $content['left'] . '</div>'; ?>
    <?php else: ?>
    <?php print $content['left']; ?>
    <?php endif; ?>
  <?php endif; ?>
  <?php if ($content['right']): ?>
    <?php if ($right_classes_alternate): ?>
      <?php print '<div class="' . $right_classes_alternate . '">' . $content['right'] . '</div>'; ?>
    <?php else: ?>
    <?php print $content['right']; ?>
    <?php endif; ?>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php if ($content['bottom']): ?>
  <div class="row">
    <div class="large-12 columns">
    <?php print $content['bottom']; ?>
    </div>
  </div>
<?php endif; ?>
