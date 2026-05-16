<?php 
$enable_banner = get_field('enable__disable_banner');

if ($enable_banner) :

    $banner_group = get_field('cta_banner_gartner_recognition');

    if ($banner_group) {

        // User-selected layout
        $layout = $banner_group['banner_layout'];

        // Custom background (if uploaded)
        $custom_bg = $banner_group['banner_bg_image'];

        // Fixed default backgrounds for each layout
        $default_images = [
            'layout1' => get_template_directory_uri() . '/assets/images/download-report-bg1.webp',
            'layout2' => get_template_directory_uri() . '/assets/images/download-report-bg2.webp',
            'layout3' => get_template_directory_uri() . '/assets/images/download-report-bg3.webp',
            'layout3' => get_template_directory_uri() . '/assets/images/download-report-bg4.webp',
        ];

        // Use custom background OR fallback to default for that layout
        $background_url = $custom_bg ? $custom_bg['url'] : $default_images[$layout];

        // Other fields
        $banner_text = $banner_group['gartner_banner_text'];
        $btn_text = $banner_group['banner_button_text'];
        $btn_url  = $banner_group['banner_button_url'];
?>
 
<section class="cta-dynamic-banner mt-24"
    style="background-image:url('<?php echo esc_url($background_url); ?>'); background-size:cover;">
    
    <div class="banner-content">
        <div class="banner-right">

            <?php if ($banner_text) : ?>
                <?php echo wp_kses_post($banner_text); ?>
            <?php endif; ?>

            <?php if ($btn_text) : ?>
                <a class="btn-download" href="<?php echo esc_url($btn_url); ?>">
                    <?php echo esc_html($btn_text); ?>
                    <span class="icon">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/btn-arw.png'); ?>" alt="→">
                    </span>
                </a>
            <?php endif; ?>

        </div>
    </div>

</section>

<?php 
    }
endif;
?>
