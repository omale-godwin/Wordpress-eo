<?php
/**
 * Template Name: Articles page
 */
get_header();
?>

<div class="main-body-container custom-maxW">
    

    <!-- social share section -->
  <?php get_template_part('template-parts/social-share'); ?>

    <div class="detail-content">
        <div class="detail-content-left">
            
        <div class="breadcrumb-container detail-cat-tag" data-post-title="<?php echo esc_attr(get_the_title()); ?>">
            <div id="search-filtered-posts">
                
            </div>
        </div> <!-- Closing div for .detail-content-left -->

        <div class="custom-sidebar">
            <?php get_template_part('sidebar', 'custom'); ?>
        </div>
    </div> <!-- Closing div for .detail-content -->

                    
</div>

<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/custom-scripts/serch-filter-article.js"></script>