<?php
/* Template Name: Case Study Layout 2 */
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


                <!-- Onganization friction -->
                <?php 
                    $org = get_field('organizational_friction');

                    if ($org) : 
                    ?>
                        <div class="organizational-friction">

                            <!-- Heading -->
                            <?php if (!empty($org['heading'])) : ?>
                                <h2 class="org-heading detail-content-heading">
                                    <?php echo esc_html($org['heading']); ?>
                                </h2>
                            <?php endif; ?>


                            <!-- Description -->
                            <?php if (!empty($org['description'])) : ?>
                                <div class="org-description detail-para">
                                    <?php echo wp_kses_post( wpautop($org['description']) ); ?>
                                </div>
                            <?php endif; ?>


                            <!-- Bullets Repeater -->
                            <?php if (!empty($org['bullets'])) : ?>
                                <ul class="misalignment-list">
                                    <?php foreach ($org['bullets'] as $item) : ?>
                                        <li>
                                            <img src="https://cdn.electricoctopus.agency/ourwork/bullet-point.png" 
                                                alt="Bullet icon" loading="lazy" width="16" height="16">
                                            <?php echo esc_html($item['bullet_text']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                        </div>
                    <?php 
                    endif;
                    ?>

                 <!-- gartner_recognition Banner -->
                <?php get_template_part('template-parts/cta-gartner'); ?>
                <?php get_template_part('template-parts/gartner-block'); ?>    
                <!-- youtube video -->
                 <?php 
                $yt_block = get_field('youtube_content_block');

                if ($yt_block && !empty($yt_block['enable__disable_banner'])) : ?>

                    <div class="vdo-cls mt-24">

                        <?php
                            // Values inside group
                            $video_url = $yt_block['youtube_url'] ?? '';
                            $image_id  = $yt_block['youtube_image'] ?? '';

                            // Show YouTube video if URL available
                            if ($video_url) {

                                echo wp_oembed_get($video_url);

                            // Else show fallback image
                            } elseif ($image_id) {

                                echo wp_get_attachment_image($image_id, 'full', false, [
                                    'loading' => 'lazy',
                                    'class'   => 'youtube-fallback-image'
                                ]);
                            }
                        ?>

                    </div>

                <?php endif; ?>


                <?php 
                $uni = get_field('unification_strategy_section');

                if ($uni) : ?>

                    <section class="unification-strategy mt-24">

                        <?php if (!empty($uni['heading'])) : ?>
                            <h2 class="detail-content-heading">
                                <?php echo esc_html($uni['heading']); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if (!empty($uni['unification_strategy_content'])) : ?>
                            <div class="detail-para">
                                <?php 
                                    echo wp_kses_post(
                                        wpautop($uni['unification_strategy_content'])
                                    );
                                ?>
                            </div>
                        <?php endif; ?>

                    </section>

                <?php endif; ?>


                <!-- cta banner -->
                <?php get_template_part('template-parts/body-banners/cta/cta-banner'); ?>
                                        
                <!-- Secondary Banner -->
                 <?php
                    $clone_data = get_field('image_placeholder_section_2');
                    $heading = '';

                    if ( isset($clone_data['image_placeholder'][0]['heading']) ) {
                        $heading = $clone_data['image_placeholder'][0]['heading'];
                    }
                    ?>

                    <div class="mt-24">
                        <?php if ( ! empty($heading) ) : ?>
                            <h2 class="detail-content-heading"><?php echo esc_html($heading); ?></h2>
                        <?php endif; ?>

                        <?php if ( have_rows('image_placeholder_section_2_image_placeholder') ) : ?>
                            <?php while ( have_rows('image_placeholder_section_2_image_placeholder') ) : the_row(); ?>

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
                    </div>


                <!-- pod -->
                    <?php get_template_part('template-parts/body-banners/podcast/podcast-banner'); ?>
                <div class="gtm-assessment mt-24">
                    <?php 
                    $content_block = get_field('content_block');

                    if ( $content_block ) : 
                        $heading = $content_block['content_heading'] ?? '';
                        $content = $content_block['content_integration'] ?? '';
                    ?>
                        <div class="gtm-content-block mt-24">

                            <?php if ( ! empty($heading) ) : ?>
                                <h2 class="detail-content-heading">
                                    <?php echo esc_html($heading); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if ( ! empty($content) ) : ?>
                                <div class="content-block-body detail-para">
                                    <?php 
                                        echo wp_kses_post(
                                            wpautop( $content )
                                        );
                                    ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>


                </div>
                <!-- Value Banner -->
                <section>
                    <?php get_template_part('template-parts/body-banners/values-visual/values-banner'); ?>
                </section>
                <!-- content block-->
                 <div class="gtm-assessment mt-24">
                    <?php 
                    $content_block = get_field('content_block_5');

                    if ( $content_block ) : 
                        $heading = $content_block['content_heading'] ?? '';
                        $content = $content_block['content_integration'] ?? '';
                    ?>
                        <div class="gtm-content-block mt-24">

                            <?php if ( ! empty($heading) ) : ?>
                                <h2 class="detail-content-heading">
                                    <?php echo esc_html($heading); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if ( ! empty($content) ) : ?>
                                <div class="content-block-body detail-para">
                                    <?php 
                                        echo wp_kses_post(
                                            wpautop( $content )
                                        );
                                    ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>


                </div>  
                <!-- qoute block -->
                <?php get_template_part('template-parts/body-banners/qoutes/qoutes-banner'); ?>   
                <!-- content block-->
                 <div class="gtm-assessment mt-24">
                    <?php 
                    $content_block = get_field('content_block');

                    if ( $content_block ) : 
                        $heading = $content_block['content_heading'] ?? '';
                        $content = $content_block['content_integration'] ?? '';
                    ?>
                        <div class="gtm-content-block mt-24">

                            <?php if ( ! empty($heading) ) : ?>
                                <h2 class="detail-content-heading">
                                    <?php echo esc_html($heading); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if ( ! empty($content) ) : ?>
                                <div class="content-block-body detail-para">
                                    <?php 
                                        echo wp_kses_post(
                                            wpautop( $content )
                                        );
                                    ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>


                </div>                       
                <!-- content block-->
                 <div class="gtm-assessment mt-24">
                    <?php 
                    $content_block = get_field('content_block_4');

                    if ( $content_block ) : 
                        $heading = $content_block['content_heading'] ?? '';
                        $content = $content_block['content_integration'] ?? '';
                    ?>
                        <div class="gtm-content-block mt-24">

                            <?php if ( ! empty($heading) ) : ?>
                                <h2 class="detail-content-heading">
                                    <?php echo esc_html($heading); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if ( ! empty($content) ) : ?>
                                <div class="content-block-body detail-para">
                                    <?php 
                                        echo wp_kses_post(
                                            wpautop( $content )
                                        );
                                    ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>


                </div>  
                <!-- image Banner -->
                 <?php
                    $clone_data = get_field('image_placeholder_section_3');
                    $heading = '';

                    if ( isset($clone_data['image_placeholder'][0]['heading']) ) {
                        $heading = $clone_data['image_placeholder'][0]['heading'];
                    }
                    ?>

                    <div class="mt-24">
                        <?php if ( ! empty($heading) ) : ?>
                            <h2 class="detail-content-heading"><?php echo esc_html($heading); ?></h2>
                        <?php endif; ?>

                        <?php if ( have_rows('image_placeholder_section_3_image_placeholder') ) : ?>
                            <?php while ( have_rows('image_placeholder_section_3_image_placeholder') ) : the_row(); ?>

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