<?php
$variant = get_field('select_sidebar_variant') ?: 'default';
$group   = get_field("sidebar_{$variant}_group");
if (!$group) return;

$ebook = $group['ebook_banner_block'] ?? [];

if (empty($ebook['ebook_banner_enable'])) return;

$set = $ebook['ebook_banner_set'] ?? 'set1';

// Determine selected layout based on set
$layout = '';
if ($set === 'set1') {
    $layout = $ebook['ebook_banner_set1_layout'] ?? '';
} elseif ($set === 'set2') {
    $layout = $ebook['ebook_banner_set2_layout'] ?? '';
}

if (!$layout) return;

// Include layout file: example — layout name is like `set1_layout1`
$layout_file = locate_template("template-parts/sidebar/ebook/{$layout}.php");

if ($layout_file) {
    // Pass $ebook to the layout
    include $layout_file;
}
