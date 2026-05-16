<?php
/**
 * Template part for displaying Body Banner CTA dynamically
 * @package OC-theme
 */

// First, try to fetch from new grouped field
$banner5_fields = get_query_var('banner_6_fields');

if (!$banner5_fields) {
    $banner5_fields = get_field('banner_6_fields');
}

if ($banner5_fields) {
    $heading      = $banner5_fields['cta_heading'] ?? 'Default Banner 3 Heading';
    $content      = $banner5_fields['cta_content'] ?? 'Default content for banner 3.';
    $button_text  = $banner5_fields['cta_button_text'] ?? 'Click Here';
    $button_link  = $banner5_fields['cta_button_link'] ?? '#';
    $layout       = $banner5_fields['select_layout'] ?? 'layout1';
}

// Define your layout styles
$layout_config = [
    'layout1' => [
        'bg_image'    => 'temp-bg1.webp',
    ],
    'layout2' => [
        'bg_image'    => 'temp-bg2.webp',
    ],
    'layout3' => [
        'bg_image'    => 'temp-bg3.webp',
    ],
    'layout4' => [
        'bg_image'    => 'temp-bg4.webp',
    ],
    'layout5' => [
        'bg_image'    => 'temp-bg5.webp',
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



<div class="mt-24 banner-template-<?php echo esc_attr($layout); ?> common-bdy-cls"
     style="<?php echo esc_attr($inline_style); ?>">
    
    <div class="bdy-bnner-left"></div>
    
     <div class="bdy-bnner-right">
       <h2><?php echo esc_html($heading); ?></h2>
        <p><?php echo esc_html($content); ?></p>
        <a href="<?php echo esc_url($button_link); ?>" class="find-mo-btn">
           <?php echo esc_html($button_text); ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-arw.png" alt="arrow">
        </a>
    </div>
</div>