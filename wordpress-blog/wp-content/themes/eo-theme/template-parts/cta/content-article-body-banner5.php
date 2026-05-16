<?php
/**
 * Template part for displaying Body Banner CTA dynamically
 * @package OC-theme
 */

// First, try to fetch from new grouped field
$banner4_fields = get_query_var('banner_5_fields');

if (!$banner4_fields) {
    $banner4_fields = get_field('banner_5_fields');
}

if ($banner4_fields) {
    $heading      = $banner4_fields['heading'] ?? 'Default Banner 3 Heading';
    $content      = $banner4_fields['content'] ?? 'Default content for banner 3.';
    $button_text  = $banner4_fields['button_text'] ?? 'Click Here';
    $button_link  = $banner4_fields['button_link'] ?? '#';
    $layout       = $banner4_fields['layout_type'] ?? 'layout1';
}

// Define your layout styles
$layout_config = [
    'layout1' => [
        'bg_image'    => 'cta-bg1.webp',
    ],
    'layout2' => [
        'bg_image'    => 'cta-bg2.webp',
    ],
    'layout3' => [
        'bg_image'    => 'cta-bg3.webp',
    ],
    'layout4' => [
        'bg_image'    => 'cta-bg4.webp',
    ],
    'layout5' => [
        'bg_image'    => 'cta-bg5.webp',
    ],
    'layout6' => [
        'bg_image'    => 'cta-bg6.webp',
    ],
   
];

$config = $layout_config[$layout] ?? $layout_config['layout1'];

// Build inline styles
$inline_style = '';
if ($config['bg_image']) {
    $inline_style .= "background-image: url('" . get_template_directory_uri() . "/assets/images/cta-banner-2-248/{$config['bg_image']}');";
    $inline_style .= "background-size: cover; background-repeat: no-repeat;";
}
?>

<div class="mt-24 banner4-wrapper <?php echo esc_attr($layout); ?>" style="<?php echo esc_attr($inline_style); ?>">
    <div class="cta-bnner-left">
        <h2><?php echo esc_html($heading); ?></h2>
        <p><?php echo esc_html($content); ?></p>
        <?php if ($layout === 'layout4') : ?>
        <?php if ($layout === 'layout4' && !empty($banner4_fields['bullet_points'])) : ?>
            <ul class="banner3-list">
                <?php foreach ($banner4_fields['bullet_points'] as $item) : ?>
                    <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check_circle.webp"><?php echo esc_html($item['point']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>

        <a href="<?php echo esc_url($button_link); ?>" class="msg-button">
            <?php echo esc_html($button_text); ?>
        </a>
    </div>
</div>