<?php
$group = get_field('case_study_banner_library');
$placeholder = $group['image_placeholder_group'] ?? [];

if (!empty($placeholder['enable_image_banner_'])) {
    $category = $placeholder['image_banner_category'] ?? '';
    $filename = $placeholder['selected_image'] ?? '';

    if ($category && $filename) {
        $image_url = get_template_directory_uri() . "/assets/images/placeholders/{$category}/{$filename}";
        echo '<img src="' . esc_url($image_url) . '" alt="Placeholder Image" loading="lazy">';
    }
}

?>