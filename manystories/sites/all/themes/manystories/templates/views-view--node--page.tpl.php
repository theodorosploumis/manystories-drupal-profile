<?php if(!empty($css_class)){ ?>
<div class="<?php print $css_class; ?>">
<?php } ?>

<?php if ($rows): ?>
  <?php print $rows; ?>
<?php endif; ?>

<?php if(!empty($css_class)){ ?>
</div> <?php /* class view */ ?>
<?php } ?>

