<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
  <!--  stylista-mini-panel.tpl.php
        path: <?php print (__FILE__)  ?>
  -->
<?php } ?>

<?php
  $css_id = !empty($content->css_id) ? " id=$content->css_id" : '';
  $markup_wrapper = !empty($settings['markup_wrapper']) ? $settings['markup_wrapper'] : 'div';

  $stylista_class = array();
  $stylista_class[] = $content->css_class;

  foreach (array('teaser_class', 'grid_flow', 'grid_fixes') as $key) {
    if (!empty($settings[$key])) {
      $stylista_class[] = $settings[$key];
    }
  }

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

      <h2>
        <?php
        if (!empty($pane->configuration['aller_panes_link'])) {
          $title = l($title, $pane->configuration['aller_panes_link']);
        }
        print $title;
        ?>
      </h2>


   </header>
  <?php endif ?>

  <?php if (isset($content->content)): ?>
    <?php print render($content->content); ?>
  <?php endif ?>

</<?php print $markup_wrapper;?>>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- /stylista-mini-panel.tpl.php -->
<?php } ?>
