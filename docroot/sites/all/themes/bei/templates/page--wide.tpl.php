<!--.page -->
<div role="document" class="page">

  <?php if (!empty($page['help'])): ?>
    <!--.l-help -->
    <section class="l-help row">
      <div class="columns">
        <?php print render($page['help']); ?>
      </div>
    </section>
    <!--/.l-help -->
  <?php endif; ?>
  
  <!--.l-preview-->
  <?php if (!empty($page['form_preview'])): ?>
  <section class="l-preview">
    <?php print render($page['form_preview']); ?>
  </section>
  <?php endif; ?>
  <!--/.l-preview-->

  <!--.l-main -->
  <main role="main" class="l-main">

    <?php if ($messages && !$zurb_foundation_messages_modal): ?>
      <!--.l-messages -->
      <section class="l-messages row">
        <div class="columns">
          <?php if ($messages): print $messages; endif; ?>
        </div>
      </section>
      <!--/.l-messages -->
    <?php endif; ?>
    <a id="main-content"></a>
    <?php print render($page['content']); ?>
  </main>
  <!--/.l-main -->

  <?php if ($messages && $zurb_foundation_messages_modal): print $messages; endif; ?>
</div>
<!--/.page -->
