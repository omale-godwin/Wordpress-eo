<?php
/**
 * Template Name: Announcements & News
 */
get_header();
?>

<div class="main-body-container custom-maxW">
    

  <!-- social share section -->
  <?php get_template_part('template-parts/social-share'); ?>

    <div class="detail-content">
        <div class="detail-content-left">
            
            <div id="default-breadcrumb" class="breadcrumbs detail-cat-tag flex align-item-center gap-16">
                <a href="<?php echo home_url(); ?>">Blog</a> <span class="dot-separate"> </span>
                <?php
                $post_id = get_the_ID();
                $is_announcement = get_post_meta($post_id, 'is_announcement', true);
                
                if ($is_announcement == '1') {
                    echo '<a href="' . home_url('/announcements/') . '">Announcements</a> <span class="dot-separate"> </span> ';
                } else {
                    echo '<a href="' . home_url('/news/') . '">News</a> <span class="dot-separate"> </span> ';
                }
                ?>
                <?php the_title(); ?>
            </div>
            <div id="filtered-breadcrumb" class="breadcrumb-container detail-cat-tag" data-post-title="<?php echo esc_attr(get_the_title()); ?>"></div>
            <div id="search-news-filtered-posts">
                
            </div>
        </div> <!-- Closing div for .detail-content-left -->

        <div class="custom-sidebar">
            <?php get_template_part('sidebar', 'custom-news'); ?>
        </div>
    </div> <!-- Closing div for .detail-content -->

                    
</div>

<?php get_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/custom-scripts/serch-announcement-news-filter.js"></script>