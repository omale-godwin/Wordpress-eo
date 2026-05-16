<?php
$variant = get_field('select_sidebar_variant') ?: 'default';
$group   = get_field("sidebar_{$variant}_group");

if (!$group) return;

// Get the podcast banner clone field array
$podcast_banner = $group['podcast_banner'] ?? [];

// ✅ Use the correct enable field
$is_enabled = $podcast_banner['podcast_banner_enable'] ?? true;

if (!$is_enabled) return; // Exit if disabled

// Handle image
$image_url = $podcast_banner['sidebar_image'] ?? '';

if (is_numeric($image_url)) {
    $image_src = wp_get_attachment_image_url($image_url, 'medium');
} elseif (!empty($image_url)) {
    $image_src = $image_url;
} else {
    $image_src = get_template_directory_uri() . '/assets/images/sidebar-placeholder.webp';
}
?>

<div class="sidebar-placeholder-image mt-24">
    <img src="<?php echo esc_url($image_src); ?>" alt="Podcast Banner" loading="lazy" width="300" height="200">
</div>

