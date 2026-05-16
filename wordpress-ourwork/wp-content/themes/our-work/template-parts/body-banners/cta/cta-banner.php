<?php
$banner_group = get_field('case_study_banner_library');
$group = $banner_group['cta_banner_group'] ?? [];

if (!empty($group['enable_cta_banner'])) {
    $category = $group['cta_category'] ?? '';
    $layout = '';

    switch ($category) {
        case 'cta_category1':
            $layout = $group['cta_layout_category1'] ?? '';
            break;
        case 'cta_category2':
            $layout = $group['cta_layout_category2'] ?? '';
            break;
        case 'cta_category3':
            $layout = $group['cta_layout_category3'] ?? '';
            break;
        case 'cta_category4':
            $layout = $group['cta_layout_category4'] ?? '';
            break;
        case 'cta_category5':
            $layout = $group['cta_layout_category5'] ?? '';
            break;
        case 'cta_category6':
            $layout = $group['cta_layout_category6'] ?? '';
            break;
    }

    if ($category && $layout) {
        $template = "template-parts/body-banners/cta/{$category}-{$layout}.php";
        if (locate_template($template)) {
            include locate_template($template);
        } else {
            echo "<!-- Template not found: {$template} -->";
        }
    } else {
        echo "<!-- CTA banner category or layout missing -->";
    }
}
?>
