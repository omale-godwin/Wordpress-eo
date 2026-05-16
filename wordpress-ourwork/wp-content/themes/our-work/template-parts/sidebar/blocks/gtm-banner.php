<?php
$variant = get_field('select_sidebar_variant') ?: 'default';
$group = get_field("sidebar_{$variant}_group");

if (!$group || empty($group['gtm_reporting_banner'])) return;

$gtm = $group['gtm_reporting_banner'];

$enabled = $gtm['enable_gtm_banner'] ?? false;
if (!$enabled) return;

// Get field values (with prefixes due to Clone settings)
$layout     = $gtm['gtm_banner_layout'] ?? 'layout1';
$image      = $gtm['gtm_banner_image'] ?? '';
$image_url  = is_array($image) ? ($image['url'] ?? '') : '';
$heading    = $gtm['gtm_banner_heading'] ?? '';
$subheading = $gtm['gtm_banner_subheading'] ?? '';
$desc       = $gtm['gtm_banner_desc'] ?? '';
$cta_text   = $gtm['gtm_banner_cta_text'] ?? '';
$cta_url    = $gtm['gtm_banner_cta_url'] ?? '';

// Fallback image if needed
if (!$image_url) {
    $image_url = get_template_directory_uri() . '/assets/images/sidebar/gtm-fallback.webp';
}
?>

<div class="gtm-banner <?php echo esc_attr($layout); ?> mt-24">
    <div class="gtm-banner-inner">
        <div class="gtm-image">
            <img src="<?php echo esc_url($image_url); ?>" alt="GTM Banner" loading="lazy">
        </div>
        <div class="gtm-content">
            <?php if ($heading): ?><h3><?php echo esc_html($heading); ?></h3><?php endif; ?>
            <?php if ($subheading): ?><h4><?php echo esc_html($subheading); ?></h4><?php endif; ?>
            <?php if ($desc): ?><p><?php echo esc_html($desc); ?></p><?php endif; ?>
            <?php if ($cta_text): ?>
                <a href="<?php echo esc_url($cta_url); ?>" class="ebook-button mt-16"><?php echo esc_html($cta_text); ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>
