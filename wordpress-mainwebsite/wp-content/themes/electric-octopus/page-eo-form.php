<?php
/* Template Name: EO Multi Step Form */
get_header();
?>

<div id="eo-form-root">

  <div data-form-part="part1">
    <?php include get_template_directory() . '/eo-form/part1.php'; ?>
  </div>

  <div data-form-part="part2" style="display:none">
    <?php include get_template_directory() . '/eo-form/part2.php'; ?>
  </div>

  <div data-form-part="part3" style="display:none">
    <?php include get_template_directory() . '/eo-form/part3.php'; ?>
  </div>

</div>

<?php get_footer(); ?>
