<!-- talk to expert -->
<?php
$variant = get_field('select_sidebar_variant') ?: 'default';
$group_key = "sidebar_{$variant}_group";
$group = get_field($group_key);

if (!$group) {
    echo "<!-- No group found for: {$group_key} -->";
    return;
}

// STEP 1: Get selected banner variant: 'default' or 'red'
$banner_variant = $group['select_talk_banner_variant'] ?? 'default';
echo "<!-- Selected banner variant: {$banner_variant} -->";

// STEP 2: Load appropriate banner data
$banner = ($banner_variant === 'red')
    ? ($group['talk_to_expert_red_banner'] ?? [])
    : ($group['talk_banner_block'] ?? []);

if (empty($banner)) {
    echo "<!-- No banner data found for variant: {$banner_variant} -->";
    return;
}

// STEP 3: Extract field values
$heading     = $banner['talk_banner_heading'] ?? '';
$description = $banner['talk_banner_description'] ?? '';
$button_url  = $banner['talk_banner_url'] ?? '';
$bg_color    = $banner['talk_banner_bg_color'] ?? '';
$red_template = $banner['red_banner_template'] ?? 'template1';
$is_enabled  = isset($banner['talk_banner_enabled']) ? $banner['talk_banner_enabled'] : true;

echo "<!-- Banner Enabled: " . var_export($is_enabled, true) . " -->";
echo "<!-- Heading: {$heading} | Description: {$description} | Button: {$button_url} | BG: {$bg_color} -->";

// STEP 4: Show red banner (template part)
if ($banner_variant === 'red' && $is_enabled) {
    $template_path = "template-parts/talk-banner/red/{$red_template}.php";
    echo "<!-- Red banner: looking for template: {$template_path} -->";

    if (file_exists(get_template_directory() . '/' . $template_path)) {
        set_query_var('banner', $banner);
        get_template_part("template-parts/talk-banner/red/{$red_template}");
    } else {
        echo "<!-- Template not found: {$template_path} -->";
    }

// STEP 5: Show default inline banner
} elseif ($banner_variant === 'default' && $is_enabled && $heading && $description && $button_url) { ?>
    <div class="talk-banner default-template mt-24" style="background-color: <?php echo esc_attr($bg_color); ?>;">
        <h2><?php echo nl2br(esc_html($heading)); ?></h2>
        <p><?php echo esc_html($description); ?></p>
        <a href="<?php echo esc_url($button_url); ?>">Talk to Expert</a>
    </div>
<?php } else {
    echo "<!-- No valid banner displayed -->";
} ?>
