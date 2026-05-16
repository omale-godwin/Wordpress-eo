<?php
if (!defined('ABSPATH')) exit;

add_action('init', function () {
    register_post_type('eo_assessment', [
        'labels' => [
            'name' => 'Assessments',
            'singular_name' => 'Assessment'
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => ['title'],
    ]);
});
