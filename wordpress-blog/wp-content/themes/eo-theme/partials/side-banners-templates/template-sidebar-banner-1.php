<?php 
/* Template Name: sidebar-banner-1 */

// Define category-specific variables
$categoryName = 'HealthCare';
$categoryIcon = 'https://cdn.electricoctopus.agency/electric-octopus/blog/health.png';
$backgroundImage = get_template_directory_uri() . '/assets/images/sidebar-template/HealthCare.webp';
?>

<div class="side-banner-section">
    <div class="side-banner-wrapper">

        <!-- Top Section -->
        <div class="side-banner-top">
            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/tag-bg-1.png" alt="Background" loading="lazy">
            <div class="sidebar-cat-tag">
                <img src="<?php echo esc_url($categoryIcon); ?>" alt="<?php echo esc_attr($categoryName); ?> Icon" loading="lazy">
                <span><?php echo esc_html($categoryName); ?></span>
            </div>
        </div>

        <!-- Body Section -->
        <div class="side-banner-body" 
             style="background: #131416 url('<?php echo esc_url($backgroundImage); ?>') no-repeat center center; background-size: cover;">
            
            <div>
                <h2><?php echo esc_html(get_field('banner_heading', 'option')); ?></h2>
                <p class="ban-text1"><?php echo esc_html(get_field('banner_sub_heading', 'option')); ?></p>
                <p class="ban-text2"><?php echo esc_html(get_field('banner_content', 'option')); ?></p>

                <?php if (have_rows('banner_list_content', 'option')) : ?>
                    <ul>
                        <?php while (have_rows('banner_list_content', 'option')) : the_row(); ?>
                            <li>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/checkbox-circle-fill.png" alt="Bullet Point Icon" loading="lazy">
                                <?php echo esc_html(get_sub_field('bullet_points')); ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div>
                <a href="<?php echo esc_url(get_field('button_link', 'option')); ?>" class="msg-button">
                    <?php echo esc_html(get_field('button_text', 'option')); ?>
                </a>
            </div>

            <?php get_template_part('partials/buyers-block'); ?>

        </div>
    </div>
</div>