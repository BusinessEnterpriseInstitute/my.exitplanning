<!--.page -->
<div role="document" class="page">

  <!--.l-header -->
  <header class="l-header">
    <?php if (!empty($page['header_top'])): ?>
      <section class="l-header-top hide-for-small sticky">
        <!--.l-header-top-region -->
        <section class="l-header-top-region row">
            <?php print render($page['header_top']); ?>
        </section>
        <!--/.l-header-top-region -->
      </section>
    <?php endif; ?>

    <?php if ($top_bar): ?>
      <!--.top-bar -->
      <?php if ($top_bar_main_menu || $top_bar_secondary_menu || !empty($page['top_bar'])): ?>
        <?php if ($top_bar_classes): ?>
          <div class="<?php print $top_bar_classes; ?>">
        <?php endif; ?>
        <nav class="top-bar" data-topbar <?php print $top_bar_options; ?>>
          <ul class="title-area">
            <li class="name">
              <p>
                <?php if ($linked_logo): ?>
                  <span class="hide-for-small logo"><?php print $linked_logo; ?></span>
                <?php endif; ?>
                <?php if (!empty($mobile_version_logo)): ?>
                <?php print $mobile_version_logo; ?>
                <?php else: ?>
                <?php print $linked_site_name; ?>
                <?php endif; ?>
              </p>
            </li>
            <li class="toggle-topbar menu-icon">
              <a href="#"><span><?php print $top_bar_menu_text; ?></span></a></li>
          </ul>
          <section class="top-bar-section">
            <?php if ($top_bar_main_menu) : ?>
              <?php print $top_bar_main_menu; ?>
            <?php endif; ?>
            <?php if ($top_bar_secondary_menu) : ?>
              <?php print $top_bar_secondary_menu; ?>
            <?php endif; ?>
            <?php if(!empty($page['top_bar'])) :?>
              <?php print render($page['top_bar']); ?>
            <?php endif; ?>
          </section>
        </nav>
        <?php if ($top_bar_classes): ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>
      <!--/.top-bar -->
    <?php endif; ?>

    <!-- Title, slogan and menu -->
    <?php if ($alt_header): ?>
      <section class="row <?php print $alt_header_classes; ?>">
        <div class="columns l-banner">
        <?php if ($linked_logo): print $linked_logo; endif; ?>

        <?php if ($site_name): ?>
          <?php if ($title): ?>
            <div id="site-name" class="element-invisible">
              <strong>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </strong>
            </div>
          <?php else: /* Use h1 when the content title is empty */ ?>
            <h1 id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <h2 title="<?php print $site_slogan; ?>" class="site-slogan"><?php print $site_slogan; ?></h2>
        <?php endif; ?>

        <?php if ($alt_main_menu): ?>
          <nav id="main-menu" class="navigation" role="navigation">
            <?php print ($alt_main_menu); ?>
          </nav> <!-- /#main-menu -->
        <?php endif; ?>

        <?php if ($alt_secondary_menu): ?>
          <nav id="secondary-menu" class="navigation" role="navigation">
            <?php print $alt_secondary_menu; ?>
          </nav> <!-- /#secondary-menu -->
        <?php endif; ?>
        </div>
      </section>
    <?php endif; ?>
    <!-- End title, slogan and menu -->

    <?php if (!empty($page['header'])): ?>
      <!--.l-header-region -->
      <section class="l-header-region row">
        <div class="columns">
          <?php print render($page['header']); ?>
        </div>
      </section>
      <!--/.l-header-region -->
    <?php endif; ?>

  </header>
  <!--/.l-header -->

  <?php if (!empty($page['help'])): ?>
    <!--.l-help -->
    <section class="l-help row">
      <div class="columns">
        <?php print render($page['help']); ?>
      </div>
    </section>
    <!--/.l-help -->
  <?php endif; ?>

  <!--.l-main -->
  <main class="l-main">
    <?php if (!empty($page['search'])): ?>
    <!-- .l-search -->
    <section class="l-search">
      <div class="row">
        <div class="columns">
          <?php print render($page['search']); ?>
        </div>
      </div>
    </section>
    <!-- /.l-search -->
    <?php endif; ?>

    <?php if (!empty($page['page_banner'])): ?>
      <div class="page-header">
        <div class="row">
          <div class="columns">
          <?php if ($title): ?>
              <?php print render($title_prefix); ?>
              <h1 id="page-title" class="title"><?php print $title; ?></h1>
              <?php print render($title_suffix); ?>
          <?php endif; ?>
          <?php if (!empty($page['page_banner'])): ?>
            <?php print render($page['page_banner']); ?>
          <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
    <!-- .l-main region -->

    <?php if ($messages && !$zurb_foundation_messages_modal): ?>
      <!--.l-messages -->
      <section class="l-messages row">
        <div class="columns">
          <?php if ($messages): print $messages; endif; ?>
        </div>
      </section>
      <!--/.l-messages -->
    <?php endif; ?>
    
    <div class="row">
      <?php if ($breadcrumb): ?>
        <div class="columns small-12">
          <?php print $breadcrumb; ?>
        </div>
      <?php endif; ?>
      <div class="<?php print $main_grid; ?> main columns">
        <?php if (empty($page['page_banner']) && $title): ?>
          <?php print render($title_prefix); ?>
          <h1 id="page-title" class="title"><?php print $title; ?></h1>
          <?php print render($title_suffix); ?>
        <?php endif; ?>
        <?php if ($action_links): ?>
          <ul class="action-links">
            <?php print render($action_links); ?>
          </ul>
        <?php endif; ?>
        <?php if (!empty($page['highlighted'])): ?>
          <div class="highlight panel callout">
            <?php print render($page['highlighted']); ?>
          </div>
        <?php endif; ?>

        <a id="main-content"></a>

        <?php print render($page['content']); ?>
      </div>
      <!--/.l-main region -->

      <?php if (!empty($page['sidebar_first'])): ?>
        <aside class="<?php print $sidebar_first_grid; ?> sidebar-first columns sidebar">
          <?php print render($page['sidebar_first']); ?>
        </aside>
      <?php endif; ?>

      <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="<?php print $sidebar_sec_grid; ?> sidebar-second columns sidebar">
          <?php print render($page['sidebar_second']); ?>
        </aside>
      <?php endif; ?>
    </div>
  </main>
  <!--/.l-main -->
  
  <?php if (!empty($page['featured'])): ?>
    <!--.l-featured -->
    <section class="l-featured">
      <div class="row">
      <div class="columns">
        <?php print render($page['featured']); ?>
      </div>
      </div>
    </section>
    <!--/.l-featured -->
  <?php endif; ?>
  
  <?php if (!empty($page['cta'])): ?>
    <!--.l-cta -->
    <section class="l-cta">
      <div class="row">
      <div class="columns">
        <?php print render($page['cta']); ?>
      </div>
      </div>
    </section>
    <!--/.l-cta -->
  <?php endif; ?>
  <?php if (!empty($page['action_bar'])): ?>
    <!--.l-action-bar -->
    <section class="l-action-bar">
      <div class="row">
      <div class="columns">
        <?php print render($page['action_bar']); ?>
      </div>
      </div>
    </section>
    <!--/.l-action-bar -->
  <?php endif; ?>
  <!--.l-footer -->
  <footer class="l-footer">
    <?php if (!empty($page['footer'])): ?>
      <section class="l-footer-region">
          <?php print render($page['footer']); ?>
      </section>
    <?php endif; ?>
    <?php if (!$logged_in): ?>
      <!--Hubspot Script-->
        <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/6036342.js"></script>
        <!-- End of HubSpot Embed Code -->
      <!--End of Hubspot Script-->
      <!-- Hotjar Tracking Code for www.exitplanning.com -->
      <script>
          (function(h,o,t,j,a,r){
              h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
              h._hjSettings={hjid:1659536,hjsv:6};
              a=o.getElementsByTagName('head')[0];
              r=o.createElement('script');r.async=1;
              r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
              a.appendChild(r);
          })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
      </script>
      <!--End of Hotjar Tracking Code -->
    <?php endif;?>
  </footer>
  <!--/.l-footer -->

  <?php if ($messages && $zurb_foundation_messages_modal): print $messages; endif; ?>
</div>
<!--/.page -->
