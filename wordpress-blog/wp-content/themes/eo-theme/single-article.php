<?php
/**
 * Template Name: single Article Template
 */

$layout = sanitize_text_field(get_post_meta(get_the_ID(), 'article_layout_template', true));

if ($layout && substr($layout, -4) !== '.php') {
    $layout .= '.php';
}

if ($layout && locate_template($layout)) {
    include locate_template($layout);
} else {
    get_template_part('template-parts/content', 'article-default');
}
