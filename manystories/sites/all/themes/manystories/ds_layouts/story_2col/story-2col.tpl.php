<?php
if ($teaser) {
  $attributes = "";
}
?>

<<?php print $layout_wrapper; print $layout_attributes; ?> class="<?php print $classes; ?>" <?php print $attributes; ?>>

  <?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <div class="story-wrapper">

    <?php if ($top) : ?>
      <<?php print $top_wrapper . ' class="region-story-top"' ?>>
        <?php print $top; ?>
      </<?php print $top_wrapper ?>>
    <?php endif ?>

    <?php if ($region_1) : ?>
      <<?php print $region_1_wrapper . ' class="region-story-one"' ?>>
        <?php print $region_1; ?>
      </<?php print $region_1_wrapper ?>>
    <?php endif ?>

    <?php if ($region_2 && !$region_2_plus) : ?>
      <<?php print $region_2_wrapper . ' class="region-story-two"' ?>>
        <?php print $region_2; ?>
      </<?php print $region_2_wrapper ?>>
    <?php endif ?>

    <?php if ($region_2 && $region_2_plus) : ?>
      <<?php print $region_2_wrapper . ' class="region-story-two"' ?>>
        <div class="region-story-two-up">
          <?php print $region_2; ?>
        </div>

        <<?php print $region_2_plus_wrapper . ' class="region-story-two-plus"' ?>>
          <?php print $region_2_plus; ?>
        </<?php print $region_2_plus_wrapper ?>>

      </<?php print $region_2_wrapper ?>>
    <?php endif ?>

    <?php if ($bottom) : ?>
      <<?php print $bottom_wrapper . ' class="region-story-bottom"' ?>>
        <?php print $bottom; ?>
      </<?php print $bottom_wrapper ?>>
    <?php endif; ?>

  </div>

</<?php print $layout_wrapper ?>>

  <?php if ($region_3) : ?>
    <<?php print $region_3_wrapper . ' class="region-story-three"' ?>>
      <?php print $region_3; ?>
    </<?php print $region_3_wrapper ?>>
  <?php endif ?>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
