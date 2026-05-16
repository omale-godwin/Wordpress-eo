
<?php 
/* Template Name: value Template 1 */
/* Template Post Type: case-study */
?>
<div class="value-banner-template-1 value-banner">
    <?php if (have_rows('value_content')) : ?>
        <?php while (have_rows('value_content')) : the_row(); 
        $value_color = get_sub_field('value_color');
        ?>
        <div class="val-inner">
        <h3 style="color: <?php echo esc_attr($value_color); ?>;">
                <?php the_sub_field('value'); ?>
            </h3>
            <p><?php the_sub_field('context');?></p>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>       
</div>

               
               