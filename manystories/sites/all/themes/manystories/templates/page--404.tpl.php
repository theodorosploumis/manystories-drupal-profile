<?php
//kpr(get_defined_vars());
//kpr($theme_hook_suggestions);
//template naming
//page--[CONTENT TYPE].tpl.php
?>
<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!--node.tpl.php-->
<?php } ?>

<?php print $mothership_poorthemers_helper; ?>
<div class="page-not-found">
  <header>
    <div class="siteinfo">
      <?php if ($logo): ?>
        <figure>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
        </figure>
      <?php endif; ?>

      <?php if($site_name OR $site_slogan ): ?>
      <hgroup>
        <?php if($site_name): ?>
          <h1><?php print $site_name; ?></h1>
        <?php endif; ?>
        <?php if ($site_slogan): ?>
          <h2><?php print $site_slogan; ?></h2>
        <?php endif; ?>
      </hgroup>
      <?php endif; ?>
    </div>
  </header>
  <h1>Not Found</h1>
  <a class="go-home" href="/">Homepage</a>

</div>
