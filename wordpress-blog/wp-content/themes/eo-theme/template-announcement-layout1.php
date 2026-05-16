<?php
/* Template Name: template announcement layout1 */
/* Template Post Type: announcements_news */
get_header();
?>

<div class="main-body-container custom-maxW">

    <!-- social share section -->
    <?php get_template_part('template-parts/social-share'); ?>

    <div class="detail-content">
        <div class="detail-content-left">

            <!-- Breadcrumb -->
            <div id="default-breadcrumb" class="breadcrumbs detail-cat-tag flex align-item-center gap-16">
                <a href="<?php echo home_url(); ?>">Blog</a> 
                <span class="dot-separate"></span>

                <?php
                $post_id = get_the_ID();
                $is_announcement = get_post_meta($post_id, 'is_announcement', true);

                if ($is_announcement == '1') {
                    echo '<a href="' . home_url('/announcements/') . '">Announcements</a> <span class="dot-separate"></span>';
                } else {
                    echo '<a href="' . home_url('/news/') . '">News</a> <span class="dot-separate"></span>';
                }
                ?>

                <?php the_title(); ?>
            </div>

            <div id="filtered-breadcrumb" 
                 class="breadcrumb-container detail-cat-tag" 
                 data-post-title="<?php echo esc_attr(get_the_title()); ?>">
            </div>

            <div id="search-news-filtered-posts">

                <?php get_template_part('template-parts/announcement-new-head'); ?> 
                <!-- main paragraph -->
                <?php if ( have_rows('main_paragraph') ) : ?>
                        <div class="content-section-wrapper">

                            <?php while ( have_rows('main_paragraph') ) : the_row(); ?>

                                <?php if ( get_row_layout() == 'content_block' ) : ?>

                                    <?php 
                                        // Clone group
                                        $clone = get_sub_field('post_description_block'); 
                                        
                                        // Individual fields
                                        $heading     = $clone['heading'] ?? '';
                                        $description = $clone['post_description'] ?? '';
                                    ?>

                                    <div class="content-block mt-24">

                                        <?php if ( !empty($heading) ) : ?>
                                            <h2 class="dtail-heading content-block-heading">
                                                <?php echo esc_html( $heading ); ?>
                                            </h2>
                                        <?php endif; ?>

                                        <?php if ( !empty($description) ) : ?>
                                            <div class="dtail-para mt-24">
                                                <?php echo wp_kses_post( wpautop($description) ); ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                <?php endif; ?>
                                                
                            <?php endwhile; ?>

                        </div>
                    <?php endif; ?>
                <!-- Banner Image Section 1 -->
                <?php if (have_rows('image_banner_section_image_placeholder')) : ?>
                    <?php while (have_rows('image_banner_section_image_placeholder')) : the_row(); ?>

                        <?php if (get_sub_field('enable_image_block')) : ?>
                            <?php 
                                $content = get_sub_field('image_block');
                                $content = preg_replace('/<p>\s*(<img[^>]+>)\s*<\/p>/i', '<div class="image-wrap">$1</div>', $content);
                            ?>
                            <div class="image-block mt-24">
                                <?php echo wp_kses_post($content); ?>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>  

                <!-- Content Section 1 -->
                <?php if (have_rows('content_section')) : ?>
                    <div class="content-section-wrapper">

                        <?php while (have_rows('content_section')) : the_row(); ?>
                            <?php if (get_row_layout() == 'content_block') : ?>

                                <?php 
                                    $clone = get_sub_field('post_description_block');
                                    $heading     = $clone['heading'] ?? '';
                                    $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">

                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading"><?php echo esc_html($heading); ?></h2>
                                    <?php endif; ?>

                                    <?php if (!empty($description)) : ?>
                                        <div class="dtail-para mt-24">
                                            <?php echo wp_kses_post(wpautop($description)); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>
                        <?php endwhile; ?>

                    </div>
                <?php endif; ?>

                <!-- Banner Image Section 2 -->
                <?php if (have_rows('image_banner_section_2_image_placeholder')) : ?>
                    <?php while (have_rows('image_banner_section_2_image_placeholder')) : the_row(); ?>

                        <?php if (get_sub_field('enable_image_block')) : ?>
                            <?php 
                                $content = get_sub_field('image_block');
                                $content = preg_replace('/<p>\s*(<img[^>]+>)\s*<\/p>/i', '<div class="image-wrap">$1</div>', $content);
                            ?>
                            <div class="image-block mt-24">
                                <?php echo wp_kses_post($content); ?>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>  

                <!-- Content Section 2 -->
                <?php if (have_rows('content_section_2')) : ?>
                    <div class="content-section-wrapper">

                        <?php while (have_rows('content_section_2')) : the_row(); ?>
                            <?php if (get_row_layout() == 'content_block') : ?>

                                <?php 
                                    $clone = get_sub_field('post_description_block');
                                    $heading     = $clone['heading'] ?? '';
                                    $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">

                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading"><?php echo esc_html($heading); ?></h2>
                                    <?php endif; ?>

                                    <?php if (!empty($description)) : ?>
                                        <div class="dtail-para mt-24">
                                            <?php echo wp_kses_post(wpautop($description)); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>
                        <?php endwhile; ?>

                    </div>
                <?php endif; ?>

                <!-- Body Banner 2 -->
                <?php get_template_part('template-parts/content-article-body-banner2'); ?>    

                <!-- Content Section 3 -->
                <?php if (have_rows('content_section_3')) : ?>
                    <div class="content-section-wrapper">

                        <?php while (have_rows('content_section_3')) : the_row(); ?>
                            <?php if (get_row_layout() == 'content_block') : ?>

                                <?php 
                                    $clone = get_sub_field('post_description_block');
                                    $heading     = $clone['heading'] ?? '';
                                    $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">

                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading"><?php echo esc_html($heading); ?></h2>
                                    <?php endif; ?>

                                    <?php if (!empty($description)) : ?>
                                        <div class="dtail-para mt-24">
                                            <?php echo wp_kses_post(wpautop($description)); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>
                        <?php endwhile; ?>

                    </div>
                <?php endif; ?>

                <!-- Quote Banner -->
                <div class="mt-24">
                    <?php
                    set_query_var('template_variant', $template_variant);
                    get_template_part('template-parts/quotes-banners/template-quotes-banner');
                    ?>
                </div>

                <!-- Banner Image Section 3 -->
                <?php if (have_rows('image_banner_section_3_image_placeholder')) : ?>
                    <?php while (have_rows('image_banner_section_3_image_placeholder')) : the_row(); ?>

                        <?php if (get_sub_field('enable_image_block')) : ?>
                            <?php 
                                $content = get_sub_field('image_block');
                                $content = preg_replace('/<p>\s*(<img[^>]+>)\s*<\/p>/i', '<div class="image-wrap">$1</div>', $content);
                            ?>
                            <div class="image-block mt-24">
                                <?php echo wp_kses_post($content); ?>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>  

                <!-- Content Section 4 -->
                <?php if (have_rows('content_section_4')) : ?>
                    <div class="content-section-wrapper">

                        <?php while (have_rows('content_section_4')) : the_row(); ?>
                            <?php if (get_row_layout() == 'content_block') : ?>

                                <?php 
                                    $clone = get_sub_field('post_description_block');
                                    $heading     = $clone['heading'] ?? '';
                                    $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">

                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading"><?php echo esc_html($heading); ?></h2>
                                    <?php endif; ?>

                                    <?php if (!empty($description)) : ?>
                                        <div class="dtail-para mt-24">
                                            <?php echo wp_kses_post(wpautop($description)); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>
                        <?php endwhile; ?>

                    </div>
                <?php endif; ?>

                <!-- Image + Content Group Block -->
                <?php 
                $group = get_field('image_content_group_section');
                if ($group) :
                    $image = $group['image_block'] ?? '';
                    $content = $group['content_block'] ?? [];
                    $heading = $content['heading'] ?? '';
                    $description = $content['description'] ?? '';
                ?>
                <div class="flex gap-24 mt-24 image-content-group-section">

                    <?php if ($image) : ?>
                        <div class="detail-fetured-img image-block w-50">
                            <img src="<?php echo esc_url($image['url']); ?>" 
                                 alt="<?php echo esc_attr($image['alt']); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="content-block w-50">

                        <?php if ($heading) : ?>
                            <h2 class="dtail-heading content-heading"><?php echo esc_html($heading); ?></h2>
                        <?php endif; ?>

                        <?php if ($description) : ?>
                            <div class="dtail-para mt-24 content-description">
                                <?php echo wp_kses_post(wpautop($description)); ?>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
                <?php endif; ?>

                <!-- Content Section 5 -->
                <?php if (have_rows('content_section_5')) : ?>
                    <div class="content-section-wrapper">

                        <?php while (have_rows('content_section_5')) : the_row(); ?>
                            <?php if (get_row_layout() == 'content_block') : ?>

                                <?php 
                                    $clone = get_sub_field('post_description_block');
                                    $heading     = $clone['heading'] ?? '';
                                    $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">

                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading"><?php echo esc_html($heading); ?></h2>
                                    <?php endif; ?>

                                    <?php if (!empty($description)) : ?>
                                        <div class="dtail-para mt-24">
                                            <?php echo wp_kses_post(wpautop($description)); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>
                        <?php endwhile; ?>

                    </div>
                <?php endif; ?>

                <!-- Author Section -->
                <?php get_template_part('template-parts/author-box'); ?>

                <!-- Comments Section -->
                <?php get_template_part('template-parts/content', 'comment'); ?>

            </div><!-- End #search-news-filtered-posts -->

        </div><!-- End .detail-content-left -->

        <div class="custom-sidebar">
            <?php get_template_part('sidebar', 'custom-news'); ?>
        </div>

    </div><!-- End .detail-content -->

</div><!-- End .main-body-container -->

<?php get_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/custom-scripts/serch-announcement-news-filter.js"></script>
