<?php
/**
 * @file
 * page layout with header & footer markup
 */
?>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- tpl:  layout-contact.tpl.php -->
<?php } ?>

<?php
/* Use Drupals basic markup for the backend  */
if (arg(0) =="admin"){
?>

<div class="panel-display" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

  <div class="panel-panel panel-col-100">
    <div class="inside"><?php print $content['content-1']; ?></div>
  </div>


  <div class="panel-panel panel-col-100">
    <div class="panel-panel panel-col-75">
      <div class="inside"><?php print $content['content-2']; ?></div>
    </div>
    <div class="panel-panel panel-col-25">
      <div class="inside"><?php print $content['content-3']; ?></div>
    </div>
  </div>

    <div class="panel-panel panel-col-100">
      <div class="inside"><?php print $content['content-4']; ?></div>
    </div>

  </div>

</div>


<?php
}else{
/*  and a clean mean markup for the frontend w*/
?>
<?php
  $css_sneaky = !empty($settings['sneaky_class']) ? ' '.$settings['sneaky_class'] : '';
?>
<div class="lr-contact<?php print $css_sneaky; ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if(!empty($variables['display']->title)){ ?>
    <header>
    <h2><?php print $variables['display']->title; ?></h2>
    </header>
  <?php } ?>

  <div class="top"><?php print $content['content-1']; ?></div>
  <div class="lr-8-4">
    <div class="lc-1"><?php print $content['content-2']; ?></div>
    <div class="lc-2"><?php print $content['content-3']; ?></div>
  </div>
  <div class="footer"><?php print $content['content-4']; ?></div>
</div>
<?php } ?>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- / tpl:  layout-contact.tpl.php -->
<?php } ?>


