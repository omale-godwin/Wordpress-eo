<?php
$variant = get_field('select_sidebar_variant') ?: 'default';
$group   = get_field("sidebar_{$variant}_group");

if (!$group) return;

$download = $group['sidebar_download_banner'] ?? [];

// ✅ Use enable/disable field (default to true if not set)
$is_enabled = $download['banner_enabledisable'] ?? true;

if (!$is_enabled) return;

$banner_image   = $download['sidebar_banner_image'] ?? '';
$banner_title   = $download['sidebar_banner_title'] ?? '';
$banner_desc    = $download['sidebar_banner_desc'] ?? '';
$banner_cta     = $download['sidebar_banner_cta'] ?? '';
$banner_url     = $download['sidebar_banner_url'] ?? '';
$bg_color_class = $download['sidebar_banner_bg_color'] ?? 'bg-f4cf98';

$banner_image_url = is_array($banner_image) 
    ? $banner_image['url'] 
    : ($banner_image ?: get_template_directory_uri() . '/assets/images/download-book.webp');

if ($banner_title || $banner_desc || $banner_cta): ?>
    <div class="mt-24 download-sidebar-banner <?php echo esc_attr($bg_color_class); ?>">
        <div class="banner-image">
            <img src="<?php echo esc_url($banner_image_url); ?>" alt="Sidebar Banner" loading="lazy">
        </div>

        <div class="download-content">
            <?php if ($banner_title): ?>
                <h3><?php echo esc_html($banner_title); ?></h3>
            <?php endif; ?>

            <?php if ($banner_desc): ?>
                <p><?php echo esc_html($banner_desc); ?></p>
            <?php endif; ?>

            <?php if ($banner_cta): ?>
                <a href="<?php echo esc_url($banner_url); ?>" class="download-custom-button mt-16">
                    <?php echo esc_html($banner_cta); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
