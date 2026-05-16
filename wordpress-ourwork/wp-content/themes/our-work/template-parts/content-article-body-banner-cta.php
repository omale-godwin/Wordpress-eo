<?php
/**
 * Template part for displaying Body Banner CTA dynamically
 * @package OC-theme
 */

$banner3_fields = get_field('banner_3_fields');

if ($banner3_fields) {
    $heading      = $banner3_fields['heading'] ?? 'Default Banner 3 Heading';
    $content      = $banner3_fields['content'] ?? 'Default content for banner 3.';
    $button_text  = $banner3_fields['button_text'] ?? 'Click Here';
    $button_link  = $banner3_fields['button_link'] ?? '#';
    $layout       = $banner3_fields['layout_type'] ?? 'layout1';
}

// Define your layout styles
$layout_config = [
    'layout1' => [
        'bg_color'    => '#A8E0BD',
        'bg_image'    => '',
        'banner_img'  => 'object_1.webp',
    ],
    'layout2' => [
        'bg_color'    => '#fff',
        'bg_image'    => '',
        'banner_img'  => 'object_2.webp',
    ],
    'layout3' => [
        'bg_color'    => '#2A1830',
        'bg_image'    => '',
        'banner_img'  => 'object_3.webp',
    ],
    'layout4' => [
        'bg_color'    => '#091836',
        'bg_image'    => '',
        'banner_img'  => 'object_4.webp',
    ],
    'layout5' => [
        'bg_color'    => '#19136E',
        'bg_image'    => '',
        'banner_img'  => 'object_5.webp',
    ],
    'layout6' => [
        'bg_color'    => '',
        'bg_image'    => 'layout_bg1.webp',
        'banner_img'  => '',
    ],
    'layout7' => [
        'bg_color'    => '',
        'bg_image'    => 'layout_bg2.webp',
        'banner_img'  => '',
    ],
];

$config = $layout_config[$layout] ?? $layout_config['layout1'];

// Build inline styles
$inline_style = '';
if ($config['bg_color']) {
    $inline_style .= "background-color: {$config['bg_color']};";
}
if ($config['bg_image']) {
    $inline_style .= "background-image: url('" . get_template_directory_uri() . "/assets/images/cta-banner-248/{$config['bg_image']}');";
    $inline_style .= "background-size: cover; background-repeat: no-repeat;";
}
?>

<div class="mt-24 body-tmp-03 banner3-wrapper <?php echo esc_attr($layout); ?>" style="<?php echo esc_attr($inline_style); ?>">
    <div class="banner3-content">
        <h2><?php echo esc_html($heading); ?></h2>
        <p><?php echo esc_html($content); ?></p>
        <?php if ($layout === 'layout4') : ?>
        <?php if ($layout === 'layout4' && !empty($banner3_fields['bullet_points'])) : ?>
            <ul class="banner3-list">
                <?php foreach ($banner3_fields['bullet_points'] as $item) : ?>
                    <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check_circle.webp"><?php echo esc_html($item['point']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>

        <a href="<?php echo esc_url($button_link); ?>" class="banner3-button">
            <?php echo esc_html($button_text); ?>
        </a>
    </div>

    <?php if (!empty($config['banner_img'])): ?>
        <div class="banner3-img">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/cta-banner-248/' . $config['banner_img']); ?>" alt="Banner Image">
        </div>
    <?php endif; ?>
</div>