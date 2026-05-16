<?php
/* Template Name: Article Layout 2 */
/* Template Post Type: articles */
get_header();
?>

<div class="main-body-container custom-maxW ">
    

    <!-- social share section -->
    <?php get_template_part('template-parts/social-share'); ?>

    <div class="detail-content">
        <div class="detail-content-left">
            <div class="breadcrumb-container detail-cat-tag" data-post-title="<?php echo esc_attr(get_the_title()); ?>"></div>  
            <div id="search-filtered-posts">
                <?php get_template_part('template-parts/article-header'); ?>
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
             
                <?php if ( have_rows('image_banner_section_image_placeholder') ) : ?>
                    <?php while ( have_rows('image_banner_section_image_placeholder') ) : the_row(); ?>

                        <?php if ( get_sub_field('enable_image_block') ) : ?>
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
                <!-- Content Sections -->
                <div class="detail-content-body">
                    <?php
                        $group = get_field('image_content_group_block');
                        $image_id = $group['image_block'] ?? '';
                        $content = $group['content_block'] ?? '';
                        ?>

                        <?php if ($image_id || $content) : ?>
                        <div class="flex gap-24 mt-24">
                            <!-- Image Section -->
                            <?php if ($image_id) : ?>
                                <div class="w-50">
                                    <div class="detail-fetured-img">
                                        <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Text Section -->
                            <?php if ($content) : ?>
                                <div class="dtail-para w-50 image-content">
                                    <?php echo wp_kses_post( wpautop( $content ) ); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
              
                    <!-- Additional Text Sections -->
                    <?php if ( have_rows('content_section') ) : ?>
                        <div class="content-section-wrapper">

                            <?php while ( have_rows('content_section') ) : the_row(); ?>

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

                </div>
                <!-- Body Banner -->
                <?php
                    $cta_group = get_field('body_banner_group');

                    if (
                        isset($cta_group['enable_banner']) &&
                        $cta_group['enable_banner'] &&
                        !empty($cta_group['body_banner_block'])
                    ) {
                        $block = $cta_group['body_banner_block'];

                        if (isset($block['select_body_banner'])) {
                            $selected_banner = $block['select_body_banner']; // e.g., 'banner1'
                            $banner_number = str_replace('banner', '', $selected_banner); // e.g., '1'
                            $field_key = 'banner_' . $banner_number . '_fields'; // banner_1_fields
                            $template_part = 'template-parts/content-article-body-banner' . $banner_number;

                            if (!empty($block[$field_key])) {
                                // Set ACF fields as a global variable for use inside template part
                                set_query_var($field_key, $block[$field_key]);
                                get_template_part($template_part);
                            } else {
                                echo '<!-- Banner fields not found for ' . esc_html($field_key) . ' -->';
                            }
                        } else {
                            echo '<!-- select_body_banner not set -->';
                        }
                    } else {
                        echo '<!-- CTA banner is disabled or group is empty -->';
                    }
                ?>                                  
                <div class="detail-content-body">

                    <!-- Packing & Safety -->
                    <?php if ( have_rows('content_section_3') ) : ?>
                        <div class="content-section-wrapper">

                            <?php while ( have_rows('content_section_3') ) : the_row(); ?>

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
                   

                </div>
                
                <!-- body Quotes banner -->
                <div class="mt-24">
                    <?php
                    // You already have the variant as a value now, no need to extract again.
                    set_query_var('template_variant', $template_variant);
                    get_template_part('template-parts/quotes-banners/template-quotes-banner');
                    ?>
                </div>
                 <!-- Banner Image-->
                <?php if ( have_rows('image_banner_section_2_image_placeholder') ) : ?>
                    <?php while ( have_rows('image_banner_section_2_image_placeholder') ) : the_row(); ?>

                        <?php if ( get_sub_field('enable_image_block') ) : ?>
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
                
                <!-- Content Block -->
                    <?php if ( have_rows('content_section_4') ) : ?>
                        <div class="content-section-wrapper">

                            <?php while ( have_rows('content_section_4') ) : the_row(); ?>

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
                 
                <div class="detail-content-body">
                    <!-- creative team -->
                    
                    <?php
                        $team = get_field('team_creative_block');
                        if ($team) :
                            $heading     = $team['our_team_creative_heading'] ?? '';
                            $content_1   = $team['our_team_creative_content_1'] ?? '';
                            $content_2   = $team['our_team_creative_content_2'] ?? '';
                            $image_id    = $team['our_team_creative_image'] ?? '';
                        ?>
                        <div class="flex align-item-center gap-24 mt-24">
                            <div class="creative-t w-50">
                                <?php if ($heading) : ?>
                                    <h3><?php echo esc_html($heading); ?></h3>
                                <?php endif; ?>
                                <?php if ($content_1) : ?>
                                    <div class="creative-t-p"><?php echo wp_kses_post( wpautop($content_1) ); ?></div>
                                <?php endif; ?>
                                
                                 <?php if ($content_2) : ?>
                                    <div class="creative-para"><?php echo wp_kses_post( wpautop($content_2) ); ?></div>
                                <?php endif; ?>       
                            </div>
                            <div class="w-50">
                                <?php if ($image_id) : ?>
                                    <div class="detail-fetured-img">
                                        <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <!-- Content Block -->
                    <?php if ( have_rows('content_section_5') ) : ?>
                        <div class="content-section-wrapper">

                            <?php while ( have_rows('content_section_5') ) : the_row(); ?>

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
                    <!-- Author Section -->
                <?php get_template_part('template-parts/author-box'); ?>
                <!-- Comments Section -->
                <?php if (comments_open()) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
            </div>
        </div> <!-- Closing .detail-content-left -->

        <!-- Sidebar -->
        <div class="custom-sidebar">
            <?php get_template_part('sidebar', 'custom'); ?>
        </div>
    </div> <!-- Closing .detail-content -->
    
</div>

<?php get_footer(); ?>

<!-- //for dynamic url -->

<script src="<?php echo get_template_directory_uri(); ?>/custom-scripts/serch-filter-article.js"></script>