<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<!--div class="columns large-2 small-12">
	<!-- Print custom block content -->
	<?php
		   /** $block = module_invoke('block', 'block_view', 31);
		   * print render($block['content']);
		   */
	?>

</div-->
<div class="columns small-12 large-10">
<?php foreach ($rows as $id => $row): ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
</div>
<!--div>
	<?php
	/**$views_block = module_invoke('views','block_view','cta-block');
	*print render($views_block);
   */
	?>
</div-->