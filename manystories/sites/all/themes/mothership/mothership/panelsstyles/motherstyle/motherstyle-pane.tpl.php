<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- femina stylista-pane.tpl.php -->
<?php } ?>

<?php
  $css_id = !empty($content->css_id) ? " id=$content->css_id" : '';
  $markup_wrapper = !empty($settings['markup_wrapper']) ? $settings['markup_wrapper'] : 'div';

  $stylista_class = array();

  // Make sure to allow for the native CSS properties on the pane.
  if (!empty($content->css_class)) {
    $stylista_class[] = $content->css_class;
  }

  foreach (array('teaser_class', 'grid_cell', 'grid_flow', 'grid_fixes') as $key) {
    if (!empty($settings[$key])) {
      $stylista_class[] = $settings[$key];
    }
  }

  if (!empty($settings['layout_helpers'])){
    foreach ($settings['layout_helpers'] as $key => $value) {
      if (!empty($value)) {
        $stylista_class[] = $value;
      }
    }
  }

  /**
   * @todo move all sneaky_class content on panes into CSS properties on the css panes or provide an alternative and end-user friendly way of selection between content stylings.
   */
  if (!empty($settings['sneaky_class'])){
    $stylista_class[] = $settings['sneaky_class'];
  }

  if (count($stylista_class) > 0){
   $css = 'class="' . implode(" ", $stylista_class) . '"';
  }else{
    $css ="";
  }
?>

<<?php print $markup_wrapper;?> <?php print $css; ?> <?php print $css_id ?>>

  <?php if (isset($admin_links)): ?>
    <?php print $admin_links; ?>
  <?php endif; ?>

  <?php if (!empty($title)): ?>
   <header>
    <h2><?php print $title; ?></h2>
   </header>
  <?php endif ?>

  <?php if (isset($content->content)): ?>
    <?php print render($content->content); ?>
  <?php endif ?>

</<?php print $markup_wrapper;?>>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- /stylista-pane.tpl.php -->
<?php } ?>
