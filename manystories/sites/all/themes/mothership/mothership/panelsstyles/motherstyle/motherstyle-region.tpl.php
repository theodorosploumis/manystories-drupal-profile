<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!--stylista-region.tpl.php-->
<?php } ?>

<?php
  $markup_wrapper = !empty($settings['region_markup_wrapper']) ? $settings['region_markup_wrapper'] : 'div';
  //css
  $region_grid_layout = !empty($settings['region_grid_layout']) ? $settings['region_grid_layout'] : '';
  $region_grid_cell = !empty($settings['region_grid_cell']) ? $settings['region_grid_cell'] : '';
  $css_class = $region_grid_layout  . ' '  . $region_grid_cell ;
  $css_class .= (!empty($settings['sneaky_class'])) ? ' ' . $settings['sneaky_class'] : '';
  $css = !empty($css_class) ? 'class="' . $css_class . '"' : '';
?>

<?php if (isset($content)): ?>
  <<?php print $markup_wrapper;?> <?php print $css ?>>

  <?php if (!empty($title)): ?>
   <h2><?php print $title; ?></h2>
  <?php endif ?>

  <?php print render($content); ?>

  </<?php print $markup_wrapper;?>>
<?php endif ?>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- /stylista-region.tpl.php -->
<?php } ?>
