<?php
$group = get_field('cta_banner_group');
if (!$group || empty($group['enable_cta_banner'])) return;

$category = $group['cta_category'] ?? '';
$layout = '';

switch ($category) {
    case 'cta_category1':
        $layout = $group['cta_layout_cat1'] ?? '';
        break;
    case 'cta_category2':
        $layout = $group['cta_layout_cat2'] ?? '';
        break;
    case 'cta_category3':
        $layout = $group['cta_layout_cat3'] ?? '';
        break;
    case 'cta_category4':
        $layout = $group['cta_layout_cat4'] ?? '';
        break;
    case 'cta_category5':
        $layout = $group['cta_layout_cat5'] ?? '';
        break;
    case 'cta_category6':
        $layout = $group['cta_layout_cat6'] ?? '';
        break;
}

if ($category && $layout) {
    $template = "template-parts/banners/cta/{$category}-{$layout}.php";
    if (locate_template($template)) {
        include locate_template($template);
    }
}
?>
