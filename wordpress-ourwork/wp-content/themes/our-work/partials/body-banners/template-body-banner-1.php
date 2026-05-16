<?php
$heading = $banner['banner_heading'] ?? '';
$desc    = $banner['banner_description'] ?? '';
$url     = $banner['banner_button_url'] ?? '';
?>
<div class="red-template-1" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/red-banner/red-banner1.webp')">
    <h2><?php echo esc_html($heading); ?></h2>
    <p><?php echo esc_html($desc); ?></p>
    <a href="<?php echo esc_url($url); ?>">Talk to Expert</a>
</div>
