<?php
$heading    = $ebook['ebook_banner_heading'] ?? '';
$subheading = $ebook['ebook_banner_subheading'] ?? '';
$desc       = $ebook['ebook_banner_desc'] ?? '';
$cta_text   = $ebook['ebook_banner_cta_text'] ?? '';
$cta_url    = $ebook['ebook_banner_cta_url'] ?? '';
$layout_class  = basename(__FILE__, '.php'); // e.g. set2_layout1
$image_url = get_template_directory_uri() . '/assets/images/ebook/ebook-set1-img2.webp';
?>

<div class="ebook-banner <?php echo esc_attr($layout_class); ?> mt-24">
    
    <div class="content-wrapper">
        <?php if ($heading): ?><h2><?php echo esc_html($heading); ?></h2><?php endif; ?>
            <div class="mid-img"><img src="<?php echo esc_url($image_url); ?>" alt="ebook"></div>
        <?php if ($subheading): ?><h3><?php echo esc_html($subheading); ?></h3><?php endif; ?>
        <?php if ($desc): ?><p><?php echo esc_html($desc); ?></p><?php endif; ?>
        <?php if ($cta_text): ?>
            <a href="<?php echo esc_url($cta_url); ?>" class="ebook-button"><?php echo esc_html($cta_text); ?></a>
        <?php endif; ?>
    </div>
</div>
