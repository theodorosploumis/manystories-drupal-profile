<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!--
  views-view.tpl.php
  display: <?php print $display_id;  ?>
-->
<?php } ?>

<?php if(!empty($css_class)){ ?>
<div class="<?php print $css_class; ?>">
<?php } ?>

  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($rows): ?>
    <?php print $rows; ?>
  <?php endif; ?>

<?php if(!empty($css_class)){ ?>
</div> <?php /* class view */ ?>
<?php } ?>

