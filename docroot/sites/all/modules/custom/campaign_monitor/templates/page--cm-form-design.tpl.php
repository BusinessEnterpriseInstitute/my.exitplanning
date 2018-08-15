<!--.page -->
<div role="document" class="page cm-design-form">
  <a id="main-content"></a>
  <?php if ($form_preview): ?>
      <div class="cm-form-preview"><?php print $form_preview; ?></div>
  <?php endif; ?>
  <div class="cm-form-content">
    <?php if ($messages && !$zurb_foundation_messages_modal): ?>
      <!--.l-messages -->
      <section class="l-messages row">
        <div class="columns">
          <?php if ($messages): print $messages; endif; ?>
        </div>
      </section>
      <!--/.l-messages -->
    <?php endif; ?>
    <section class="l-main row">
      <div class="columns">
        <?php print render($page['content']); ?>
      </div>
    </section>
  </div>
  <?php if ($messages && $zurb_foundation_messages_modal): print $messages; endif; ?>
</div>
<!--/.page -->
