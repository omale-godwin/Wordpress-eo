<?php
/**
 * Sidebar Banner Partial
 * 
 * Usage:
 * get_template_part('partials/sidebar-banner', null, [
 *    'category_name' => 'HealthCare',
 *    'category_icon' => 'https://cdn.electricoctopus.agency/electric-octopus/blog/health.png',
 *    'background_image' => get_template_directory_uri() . '/assets/images/sidebar-template/HealthCare.jpg'
 * ]);
 */

$category_name = $args['category_name'] ?? 'Category';
$category_icon = $args['category_icon'] ?? '';
$background_image = $args['background_image'] ?? '';
?>

<div class="side-banner-section">
    <div class="side-banner-wrapper">

        <div class="side-banner-top">
            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/tag-bg-1.png" alt="Background" loading="lazy">
            <div class="sidebar-cat-tag">
                <img src="<?php echo esc_url($category_icon); ?>" alt="<?php echo esc_attr($category_name); ?> Icon" loading="lazy">
                <span><?php echo esc_html($category_name); ?></span>
            </div>
        </div>

        <div class="side-banner-body" style="background: #131416 url('<?php echo esc_url($background_image); ?>') no-repeat center center; background-size: cover;">
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