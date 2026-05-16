<?php
$heading = $banner['banner_heading'] ?? '';
$desc    = $banner['banner_description'] ?? '';
$url     = $banner['banner_button_url'] ?? '';
?>
<div class="red-banner red-template-2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/red-banner/red-banner3.webp')">
    <div class="red-banner-block">
        <h2><?php echo esc_html($heading); ?></h2>
        <p><?php echo esc_html($desc); ?></p>
        <a href="<?php echo esc_url($url); ?>" class="talk-xpert-btn">Talk to Expert</a>
    </div>
</div>
