<?php
/**
 * @file
 * page layout with header & footer markup
 */
?>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- tpl:  allerbase/panels/layout-page/layoutpage.tpl.php -->
<?php } ?>

<?php
/* Use Drupals basic markup for the backend  */
if (arg(0) =="admin"){
?>

<div class="panel-2col-stacked clearfix panel-display" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if ($content['top']): ?>
    <div class="panel-col-top panel-panel clearfix">

      <div class="panel-panel panel-col-first">
        <div class="inside"><?php print $content['top']; ?></div>
      </div>

    </div>
  <?php endif; ?>

  <div class="panel-panel panel-col clearfix">
      <div class="inside"><?php print $content['main']; ?></div>
  </div>

  <?php if ($content['bottom']): ?>
    <div class="panel-col-bottom panel-panel">
      <div class="inside"><?php print $content['bottom']; ?></div>
    </div>
  <?php endif; ?>
</div>

<?php
}else{
/*  and a clean mean markup for the frontend w*/
?>
<div class="l-container" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

  <header role="banner">
    <?php print $content['top']; ?>
  </header>

  <main role="main" id="main-content">
    
    <?php print $content['main']; ?>
  </main>

  <footer role="contentinfo">
    <?php print $content['bottom']; ?>
  </footer>
</div>
<?php } ?>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!--  / tpl:  allerbase/panels/layout-page/layoutpage.tpl.php -->
<?php } ?>
