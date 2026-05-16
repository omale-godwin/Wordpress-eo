<?php
/* Template Name: template news layout 1 */
/* Template Post Type: announcements_news */
get_header();
?>

<div class="main-body-container custom-maxW">

    <!-- Social Share Section -->
    <?php get_template_part('template-parts/social-share'); ?>

    <div class="detail-content">
        <div class="detail-content-left">

            <!-- Breadcrumbs -->
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

            <div id="filtered-breadcrumb" class="breadcrumb-container detail-cat-tag" 
                 data-post-title="<?php echo esc_attr(get_the_title()); ?>"></div>

            <div id="search-news-filtered-posts">

                <!-- Head Section -->
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
                <!-- Banner Image -->
                <?php if (have_rows('image_banner_section_image_placeholder')) : ?>
                    <?php while (have_rows('image_banner_section_image_placeholder')) : the_row(); ?>

                        <?php if (get_sub_field('enable_image_block')) : ?>
                            <?php 
                                $content = get_sub_field('image_block');
                                $content = preg_replace(
                                    '/<p>\s*(<img[^>]+>)\s*<\/p>/i',
                                    '<div class="image-wrap">$1</div>',
                                    $content
                                );
                            ?>
                            <div class="image-block mt-24">
                                <?= wp_kses_post($content); ?>
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
                                $heading = $clone['heading'] ?? '';
                                $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">

                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading">
                                            <?php echo esc_html($heading); ?>
                                        </h2>
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

                <!-- Image Content Group Block -->
                <?php
                $group = get_field('image_content_group_block');
                $image_id = $group['image_block'] ?? '';
                $content = $group['content_block'] ?? '';
                ?>

                <?php if ($image_id || $content) : ?>
                    <div class="flex gap-24 mt-24">

                        <?php if ($image_id) : ?>
                            <div class="w-50">
                                <div class="detail-fetured-img">
                                    <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($content) : ?>
                            <div class="dtail-para w-50 image-content">
                                <?php echo wp_kses_post(wpautop($content)); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <!-- Content Section 2 -->
                <?php if (have_rows('content_section_2')) : ?>
                    <div class="content-section-wrapper">

                        <?php while (have_rows('content_section_2')) : the_row(); ?>

                            <?php if (get_row_layout() == 'content_block') : ?>

                                <?php 
                                $clone = get_sub_field('post_description_block'); 
                                $heading = $clone['heading'] ?? '';
                                $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">

                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading">
                                            <?php echo esc_html($heading); ?>
                                        </h2>
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

                <!-- Body Banner -->
                <?php
                $cta_group = get_field('news_body_banner_group');

                if (!empty($cta_group['enable_banner']) && !empty($cta_group['body_banner_block'])) {
                    $block = $cta_group['body_banner_block'];

                    if (!empty($block['select_body_banner'])) {

                        $selected_banner = $block['select_body_banner'];
                        $banner_number = str_replace('banner', '', $selected_banner);
                        $field_key = 'banner_' . $banner_number . '_fields';
                        $template_part = 'template-parts/content-article-body-banner' . $banner_number;

                        if (!empty($block[$field_key])) {
                            set_query_var($field_key, $block[$field_key]);
                            get_template_part($template_part);
                        }

                    }
                }
                ?>

                <!-- Content Section 3 -->
                <?php if (have_rows('content_section_3')) : ?>
                    <div class="content-section-wrapper">

                        <?php while (have_rows('content_section_3')) : the_row(); ?>

                            <?php if (get_row_layout() == 'content_block') : ?>

                                <?php 
                                $clone = get_sub_field('post_description_block'); 
                                $heading = $clone['heading'] ?? '';
                                $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">
                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading">
                                            <?php echo esc_html($heading); ?>
                                        </h2>
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

                <!-- Banner Image (Section 2) -->
                <?php if (have_rows('image_banner_section_2_image_placeholder')) : ?>
                    <?php while (have_rows('image_banner_section_2_image_placeholder')) : the_row(); ?>

                        <?php if (get_sub_field('enable_image_block')) : ?>
                            <?php 
                            $content = get_sub_field('image_block');
                            $content = preg_replace(
                                '/<p>\s*(<img[^>]+>)\s*<\/p>/i',
                                '<div class="image-wrap">$1</div>',
                                $content
                            );
                            ?>
                            <div class="image-block mt-24">
                                <?= wp_kses_post($content); ?>
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
                                $heading = $clone['heading'] ?? '';
                                $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">
                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading">
                                            <?php echo esc_html($heading); ?>
                                        </h2>
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

                <!-- Body Quotes Banner -->
                <div class="mt-24">
                    <?php
                    set_query_var('template_variant', $template_variant);
                    get_template_part('template-parts/quotes-banners/template-quotes-banner');
                    ?>
                </div>

                <!-- Content Section 5 -->
                <?php if (have_rows('content_section_5')) : ?>
                    <div class="content-section-wrapper">

                        <?php while (have_rows('content_section_5')) : the_row(); ?>

                            <?php if (get_row_layout() == 'content_block') : ?>

                                <?php 
                                $clone = get_sub_field('post_description_block'); 
                                $heading = $clone['heading'] ?? '';
                                $description = $clone['post_description'] ?? '';
                                ?>

                                <div class="content-block mt-24">
                                    <?php if (!empty($heading)) : ?>
                                        <h2 class="dtail-heading content-block-heading">
                                            <?php echo esc_html($heading); ?>
                                        </h2>
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

                <!-- Author -->
                <?php get_template_part('template-parts/author-box'); ?>

                <!-- Comments -->
                <?php get_template_part('template-parts/content', 'comment'); ?>

            </div><!-- #search-news-filtered-posts -->

        </div><!-- .detail-content-left -->

        <!-- Sidebar -->
        <div class="custom-sidebar">
            <?php get_template_part('sidebar', 'custom-news'); ?>
        </div>

    </div><!-- .detail-content -->

</div><!-- .main-body-container -->

<?php get_footer(); ?>

<!-- Custom JS -->
<script src="<?php echo get_template_directory_uri(); ?>/custom-scripts/serch-announcement-news-filter.js"></script>
