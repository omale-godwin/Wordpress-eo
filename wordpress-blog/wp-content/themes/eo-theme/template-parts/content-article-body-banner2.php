<?php
/**
 * Template part for displaying Body Banner 2
 * @package OC-theme
 */

$banner2_fields = get_query_var('banner_2_fields');

if (!$banner2_fields) {
    $banner2_fields = get_field('banner_2_fields');
}


if ($banner2_fields) {
    $bg_color     = $banner2_fields['background_color'] ?? '#7C0044';
    $image_id     = $banner2_fields['user_image'] ?? '';
    $heading_text = $banner2_fields['heading_text'] ?? 'Your Heading Here';
    $content      = $banner2_fields['content'] ?? 'Your content goes here.';
    $button_text  = $banner2_fields['button_text'] ?? 'TALK TO EXPERT';
    $button_link  = $banner2_fields['button_link'] ?? '#';
} else {
    $bg_color     = get_field('background_color') ?: '#7C0044';
    $image_id     = get_field('user_image');
    $heading_text = get_field('heading_text') ?: 'Your Heading Here';
    $content      = get_field('content') ?: 'Your content goes here.';
    $button_text  = get_field('button_text') ?: 'TALK TO EXPERT';
    $button_link  = get_field('button_link') ?: '#';
}
?>

<div class="mk-pro-block mt-24" style="background: <?php echo esc_attr($bg_color); ?>;">
    <div class="mk-pro-block-left">
        <?php
        if ($image_id) {
            echo wp_get_attachment_image($image_id, 'medium', false, [
                'loading' => 'lazy',
                'class'   => 'author-img',
                'alt'     => esc_attr($heading_text),
            ]);
        }
        ?>
    </div>
    <div class="mk-pro-block-right">
        <h3><?php echo esc_html($heading_text); ?></h3>
        <p class="mt-16"><?php echo esc_html($content); ?></p>
        <div class="mt-16">
            <a href="<?php echo esc_url($button_link); ?>" class="msg-button white border white-border transparent-bg" target="_blank" rel="noopener noreferrer">
                <?php echo esc_html($button_text); ?>
            </a>
        </div>
    </div>
</div>