<?php
//kpr(get_defined_vars());
//kpr($theme_hook_suggestions);
//template naming
//page--[CONTENT TYPE].tpl.php
?>
<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- page.tpl.php-->
<?php } ?>

<?php print $mothership_poorthemers_helper; ?>

<span class="page-loaderNOT"></span>

<header>
  <?php if($page['header']): ?>
    <div class="header-region">
      <?php print render($page['header']); ?>
    </div>
  <?php endif; ?>
</header>

<div class="page">

  <div role="main" id="main-content">
    <?php if ($action_links): ?>
      <ul class="action-links"><?php print render($action_links); ?></ul>
    <?php endif; ?>

    <?php if (isset($tabs['#primary'][0]) || isset($tabs['#secondary'][0])): ?>
      <nav class="tabs"><?php print render($tabs); ?></nav>
    <?php endif; ?>

    <?php if($messages): ?>
      <div class="drupal-messages">
        <?php print $messages; ?>
      </div>
    <?php endif; ?>

    <?php print render($page['content']); ?>

  </div><!-- /main-->
</div><!-- /page-->

<footer class="region-footer">

  <?php if($page['footer_left']): ?>
  <div class="region-footer-left">
    <?php print render($page['footer_left']); ?>
  </div>
  <?php endif; ?>
  <?php if($page['footer_right']): ?>
    <div class="region-footer-right">
      <?php print render($page['footer_right']); ?>
    </div>
  <?php endif; ?>

</footer>

<?php if($page['static']): ?>
  <div class="region-static">
    <?php print render($page['static']); ?>
  </div>
<?php endif; ?>
