<?php 
/* Template Name: value Template 5 */
/* Template Post Type: case-study */
?>
<div class="value-banner-template-1 value-banner">
    <?php if (have_rows('value_content')) : ?>
        <?php while (have_rows('value_content')) : the_row(); ?>
        <div class="val-inner">
            <h3><?php the_sub_field('value');?></h3>
            <p><?php the_sub_field('context');?></p>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>       
</div>