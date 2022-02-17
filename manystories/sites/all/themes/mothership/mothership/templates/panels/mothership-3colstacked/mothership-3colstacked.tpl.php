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
    <div class="inside"><?php print $content['top']; ?></div>
  </div>


  <div class="panel-panel panel-col-100">
    <div class="panel-panel panel-col-33">
      <div class="inside"><?php print $content['left']; ?></div>
    </div>
    <div class="panel-panel panel-col-33">
      <div class="inside"><?php print $content['middle']; ?></div>
    </div>

    <div class="panel-panel panel-col-33">
      <div class="inside"><?php print $content['right']; ?></div>
    </div>
  </div>

    <div class="panel-panel panel-col-100">
      <div class="inside"><?php print $content['bottom']; ?></div>
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
<article class="<?php print $css_sneaky; ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if(!empty($variables['display']->title)){ ?>
    <header>
    <h2><?php print $variables['display']->title; ?></h2>
    </header>
  <?php } ?>
  <?php if(!empty($content['top']){ ?>
  <div class=""><?php print $content['top']; ?></div>
  <?php } ?>
  
  <div class=""><?php print $content['left']; ?></div>
  
  <div class=""><?php print $content['middle']; ?></div>  
  
  <div class=""><?php print $content['right']; ?></div>

  <?php if(!empty($content['bottom']){ ?>
  <div class=""><?php print $content['bottom']; ?></div>
  <?php } ?>
</article>
<?php } ?>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- / tpl:  layout-contact.tpl.php -->
<?php } ?>


