<?php

/**
 * @file
 * Customize confirmation screen after successful submission.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $progressbar: The progress bar 100% filled (if configured). This may not
 *   print out anything if a progress bar is not enabled for this node.
 * - $confirmation_message: The confirmation message input by the webform
 *   author.
 * - $sid: The unique submission ID of this submission.
 * - $url: The URL of the form (or for in-block confirmations, the same page).
 */
?>

<div class="bei-order-confirmation">
  <?php if ($confirmation_message): ?>
    <?php print $confirmation_message ?>
  <?php else: ?>
    <p><?php print t('Thank you, your order has been received.'); ?></p>
  <?php endif; ?>
</div>

<div class="links">
  <a href="<?php print $url; ?>"><?php print t('Go back to orders summary page.') ?></a>
</div>
