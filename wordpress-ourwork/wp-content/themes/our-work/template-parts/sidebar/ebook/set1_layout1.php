<?php
$heading    = $ebook['ebook_banner_heading'] ?? '';
$desc       = $ebook['ebook_banner_desc'] ?? '';
$cta_text   = $ebook['ebook_banner_cta_text'] ?? '';
$cta_url    = $ebook['ebook_banner_cta_url'] ?? '';
$layout_class  = basename(__FILE__, '.php'); // e.g. set2_layout1
$star = get_template_directory_uri() . '/assets/images/ebook/Isolation_Mode.png';
$bg_image_url = get_template_directory_uri() . '/assets/images/ebook/ebook-set1-img1.webp';
?>

<div class="ebook-banner <?php echo esc_attr($layout_class); ?> mt-24">
    <div><img src="<?php echo esc_url($bg_image_url); ?>" alt="ebook"></div>
    <div class="content-wrapper">
        <div class="star-img"><img src="<?php echo esc_url($star); ?>" alt="star"></div>
        <?php if ($heading): ?><h2><?php echo esc_html($heading); ?></h2><?php endif; ?>
        <?php if ($desc): ?><p><?php echo esc_html($desc); ?></p><?php endif; ?>
        <?php if ($cta_text): ?>
            <a href="<?php echo esc_url($cta_url); ?>" class="ebook-button"><?php echo esc_html($cta_text); ?></a>
        <?php endif; ?>
    </div>
</div>
