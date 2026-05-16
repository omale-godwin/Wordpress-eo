<?php
/* Template Name: Case Study Layout 1 */
/* Template Post Type: case_studies */
get_header();
global $post;

// Check if current post is not published and user is not logged in
if (get_post_type() === 'case_studies' && $post->post_status !== 'publish' && !is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

?>
<div class="main-body-container custom-maxW">

    <?php get_template_part('template-parts/social-share'); ?>

    <div class="detail-content">
        <div class="detail-content-left">

            <!-- Breadcrumbs -->
            <nav class="breadcrumb-container breadcrumbs detail-cat-tag flex align-item-center gap-16" aria-label="breadcrumb">
                <a href="<?php echo esc_url(home_url()); ?>">Our Work</a>
                <span class="dot-seperate" aria-hidden="true"></span>
                <span class="post-title"><?php the_title(); ?></span>
            </nav>
            <div id="search-filtered-posts">
                <!-- Header -->
                <?php get_template_part('template-parts/article-header'); ?>
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

                                    <div class="mt-24">

                                        <?php if ( !empty($heading) ) : ?>
                                            <h2 class="detail-content-heading">
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
                 <div class="case-study-para">
                    <?php 
                        $desc = get_field('case_study_description');
                        if ( $desc ) {
                            echo wp_kses_post( wpautop($desc) );
                        } else {
                            echo '<!-- FIELD EMPTY OR NOT FOUND -->';
                        }
                    ?>
                </div>

                <!-- Featured Image -->
                <?php
                    // $group = get_field('case_study_banner_library');
                    // $placeholder = $group['image_placeholder_group'] ?? [];

                    // if (!empty($placeholder['enable_image_banner'])) {
                    //     $image = $placeholder['placeholder_image'] ?? '';

                    //     // If return format is Image Array (recommended):
                    //     if (is_array($image)) {
                    //         echo wp_get_attachment_image($image['ID'], 'full', false, [
                    //             'alt' => esc_attr($image['alt'] ?? 'Placeholder Image'),
                    //             'loading' => 'lazy',
                    //         ]);
                    //     } elseif (is_string($image)) {
                    //         // If return format is Image URL:
                    //         echo '<img src="' . esc_url($image) . '" alt="Placeholder Image" loading="lazy">';
                    //     } else {
                    //         echo '<p>No placeholder image selected.</p>';
                    //     }
                    // } else {
                    //     echo '<p>Image banner not enabled.</p>';
                    // }
                ?>
                <?php if ( have_rows('image_placeholder_section_image_placeholder') ) : ?>
                    <?php while ( have_rows('image_placeholder_section_image_placeholder') ) : the_row(); ?>

                        <?php if ( get_sub_field('enable_image_block') ) : ?>
                            <?php 
                                $content = get_sub_field('image_block');
                                $content = preg_replace(
                                    '/<p>\s*(<img[^>]+>)\s*<\/p>/i',
                                    '<div class="image-wrap">$1</div>',
                                    $content
                                );
                            ?>
                            <div class="image-block">
                                <?= wp_kses_post($content); ?>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>


                <!-- Misalignment Problem -->
                

                <?php 
                $block = get_field('misalignment_problem');
                if ($block) :
                ?>
                <section class="misalignment-problem mt-24">

                    <!-- MAIN HEADING -->
                    <?php if (!empty($block['heading'])) : ?>
                        <h2 class="detail-content-heading">
                            <?php echo esc_html($block['heading']); ?>
                        </h2>
                    <?php endif; ?>

                    <!-- DESCRIPTION -->
                    <?php if (!empty($block['description'])) : ?>
                        <div class="detail-para"><?php echo wp_kses_post( wpautop($block['description']) ); ?></div>
                    <?php endif; ?>

                    <!-- FLEXIBLE CONTENT: BULLET POINT BLOCKS -->
                    <?php if (!empty($block['bullet_points'])) : ?>
                        <div class="misalign-bullets-wrapper">
                            <?php foreach ($block['bullet_points'] as $row) : ?>
                                <?php if ($row['acf_fc_layout'] === 'bullet_point') : ?>
                                    <div class="misalign-bullet-block mt-24">

                                        <!-- BULLET BLOCK HEADING -->
                                        <?php if (!empty($row['heading'])) : ?>
                                            <h3 class="bullet-block-heading">
                                                <?php echo esc_html($row['heading']); ?>
                                            </h3>
                                        <?php endif; ?>

                                        <!-- BULLETS (REPEATER) -->
                                        <?php if (!empty($row['bullets'])) : ?>
                                            <ul class="misalignment-list">
                                                <?php foreach ($row['bullets'] as $bullet) : ?>
                                                    <li>
                                                       <img src="https://cdn.electricoctopus.agency/ourwork/bullet-point.png" 
                                                alt="Bullet icon" loading="lazy" width="16" height="16"> <?php echo esc_html($bullet['bullet_text']); ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </section>
                <?php 
                endif;
                ?>

                <!-- cta banner -->
                <?php get_template_part('template-parts/body-banners/cta/cta-banner'); ?>
                                        
                <!-- Discovery & Strategy -->
                <?php if ($ds = get_field('discovery_strategy')) : ?>
                    <section class="mt-24">
                        <?php if (!empty($ds['icp_heading'])) : ?>
                            <h2 class="detail-content-heading"><?php echo esc_html($ds['icp_heading']); ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($ds['icp_content'])) : ?>
                            <div class="detail-para"><?php echo wp_kses_post( wpautop($ds['icp_content']) ); ?></div>

                        <?php endif; ?>
                    </section>
                <?php endif; ?>

                <!-- gartner_recognition Banner -->
                <?php get_template_part('template-parts/cta-gartner'); ?>
                <?php get_template_part('template-parts/gartner-block'); ?>

                <!-- Secondary Banner -->
                <?php
                // if ($img_id = get_field('image_banner_2')) {
                //     echo wp_get_attachment_image($img_id, 'full', false, ['class' => 'banner-img-2', 'loading' => 'lazy']);
                // }
                ?>
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
                            <div class="image-block">
                                <?= wp_kses_post($content); ?>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>



                <!-- Quotes Section -->
                <section class="mt-24">
                     <?php 
                        $results_head = get_field('results_head');

                        if ($results_head) {
                            echo '<h2 class="detail-content-heading mt-24">' . wp_kses_post( wpautop($results_head) ) . '</h2>';
                        }
                        ?>
                        <?php 
                        $results_content = get_field('top_content');

                        if ($results_content) {
                            echo '<div class="detail-para result-para mt-24">' . wp_kses_post( wpautop($results_content) ) . '</div>';
                        }
                        ?>
                    <?php get_template_part('template-parts/body-banners/qoutes/qoutes-banner'); ?>
                    <!-- pod -->
                    <?php //get_template_part('template-parts/body-banners/podcast/podcast-banner'); ?>
                    <?php 
                        $block = get_field('result_bottom');
                        if ($block && !empty($block['content_section'])) :
                        ?>
                        <section class="result-bottom-section mt-24">
                            <div class="result-bottom-content detail-para">
                                <?php echo wp_kses_post($block['content_section']); ?>
                            </div>
                        </section>
                        <?php 
                        endif;
                        ?>

                </section>

                <!-- Value Banner -->
                <section>
                    <?php get_template_part('template-parts/body-banners/values-visual/values-banner'); ?>
                </section>
                 <!-- content block-->
                  <?php if ( have_rows('image_banner_section_3_image_placeholder') ) : ?>
                    <?php while ( have_rows('image_banner_section_3_image_placeholder') ) : the_row(); ?>

                        <?php if ( get_sub_field('enable_image_block') ) : ?>
                            <?php 
                                $content = get_sub_field('image_block');
                                $content = preg_replace(
                                    '/<p>\s*(<img[^>]+>)\s*<\/p>/i',
                                    '<div class="image-wrap">$1</div>',
                                    $content
                                );
                            ?>
                            <div class="image-block">
                                <?= wp_kses_post($content); ?>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>
                  <?php 
                        $block = get_field('result_bottom_2');
                        if ($block && !empty($block['content_section'])) :
                        ?>
                        <section class="result-bottom-section mt-24">
                            <div class="result-bottom-content detail-para">
                                <?php echo wp_kses_post($block['content_section']); ?>
                            </div>
                        </section>
                        <?php 
                        endif;
                        ?>

                <!-- Mid Content Blocks -->
                <?php
                $icp_assessment = get_field('icp_assessment_section');

                if ($icp_assessment) :
                    $heading = $icp_assessment['heading'] ?? '';
                    $mid_content_section = $icp_assessment['mid_content_section'] ?? [];
                    ?>

                    <?php if (!empty($heading)) : ?>
                        <h2 class="detail-content-heading mt-24"><?php echo esc_html($heading); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($mid_content_section)) : ?>
                        <div class="content-block mt-24">
                            <?php foreach ($mid_content_section as $row) :
                                $img = $row['block_image'] ?? '';
                                $text = $row['block_text'] ?? '';
                            ?>
                                <div class="content-block-left">
                                    <?php if (!empty($img['url'])) : ?>
                                        <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt'] ?: 'Block Image'); ?>" loading="lazy">
                                    <?php endif; ?>

                                    <?php if (!empty($text)) : ?>
                                        <div><?php echo wp_kses_post( wpautop($text) ); ?></div>

                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>

                <!-- Final Body Text -->
                <div class="detail-content-body">
                    <?php the_field('text_field_2'); ?>
                </div>

                <!-- Author Box -->
                <?php get_template_part('template-parts/author-box'); ?>

                <!-- Custom Comments -->
                <?php if (comments_open()) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
            </div>

        </div><!-- Closing .detail-content-left -->

        <!-- Sidebar -->
        <aside class="custom-sidebar">
            <?php if (is_active_sidebar('custom-sidebar')) : ?>
                <?php dynamic_sidebar('custom-sidebar'); ?>
            <?php else : ?>
                <?php get_template_part('sidebar', 'custom'); ?>
            <?php endif; ?>
        </aside>
    </div>
</div>
    <!-- Recent Posts -->
    <section class="recent-post-section">
        <div class="main-body-container custom-maxW mt-0 pt-0">
            <h2>Our Recent Work</h2>
            <?php get_template_part('template-parts/recent-post-slider'); ?>
        </div>
    </section>

    <!-- Common Section -->
    <?php get_template_part('template-parts/content', 'common-section'); ?>




<?php get_footer(); ?>