<?php if (!empty($page['header'])): ?>
  <div id="top-container"><div id="top">
    <div id="language_switcher">
      <?php print render($page['header']);?>
    </div>
  </div></div>
<?php endif; ?>

<?php if (!empty($page['help'])): ?>
  <div id="header-container">
  <div id="header">
    <?php if ($linked_site_name || $linked_logo): ?>
      <div id="logo">
        <?php if ($linked_logo): ?>
          <?php print $linked_logo; ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>
      <div id="help">
        <?php print render($page['help']); ?>
      </div>
  </div>
  </div>
<?php endif; ?>

<?php if ($main_menu_links || !empty($page['navigation'])): ?>
  <div id="nav-container">
  <nav>
    <?php if (!empty($page['navigation'])): ?>
      <?php print render($page['navigation']);?>
    <?php else: ?>
      <?php print $main_menu_links; ?>
    <?php endif; ?>
  </nav>
  </div>
<?php endif; ?>

<div id="page">
  <div id="main">
    <?php if ($breadcrumb): print $breadcrumb; endif; ?>
    <?php if ($messages): print $messages; endif; ?>
    <a id="main-content"></a>

    <?php if (drupal_is_front_page()) : ?>
       <h1 class="element-invisible">
          <?php print $site_name . ' - ' . $site_slogan; ?>
       </h1>
    <?php endif; ?>
    <?php if ($title && !$is_front): ?>
      <?php print render($title_prefix); ?>
      <h1 id="page-title" class="title"><?php print $title; ?></h1>
      <?php print render($title_suffix); ?>
    <?php endif; ?>

    <?php if (!empty($page['highlighted'])): ?>
      <div id="highlight">
        <?php print render($page['highlighted']); ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($tabs)): ?>
      <?php print render($tabs); ?>
      <?php if (!empty($tabs2)): print render($tabs2); endif; ?>
    <?php endif; ?>
    <?php if ($action_links): ?>
      <ul class="action-links">
        <?php print render($action_links); ?>
      </ul>
    <?php endif; ?>
      <?php
      if (drupal_is_front_page()) {
        hide($page['content']['system_main']);
      } ?>
    <?php print render($page['content']); ?>
  </div>
  <div id="sidebar">
    <?php if (!empty($page['sidebar_first'])): ?>
      <div id="sidebar-first">
        <?php print render($page['sidebar_first']); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($page['sidebar_second'])): ?>
      <div id="sidebar-second">
        <?php print render($page['sidebar_second']); ?>
      </div>
    <?php endif; ?>
  </div>
</div><!-- end page -->
<?php if (!empty($page['footer_first']) || !empty($page['footer_middle']) || !empty($page['footer_last'])): ?>
  <footer>
    <?php if (!empty($page['footer_first'])): ?>
      <div id="footer-first">
        <?php print render($page['footer_first']); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($page['footer_middle'])): ?>
      <div id="footer-middle">
        <?php print render($page['footer_middle']); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($page['footer_last'])): ?>
      <div id="footer-last">
        <?php print render($page['footer_last']); ?>
      </div>
    <?php endif; ?>
  </footer>
<?php endif; ?>
