<?php

add_action('wp_ajax_filter_search_news', 'filter_search_news');
add_action('wp_ajax_nopriv_filter_search_news', 'filter_search_news');

function filter_search_news() {
    $category_slug = isset($_POST['category_slug']) ? sanitize_text_field($_POST['category_slug']) : '';
    $search_query  = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $args = array(
        'post_type'      => 'announcements_news',
        'posts_per_page' => -1,
        's'              => $search_query,
    );

    if (!empty($category_slug)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'news_category',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/announcement-search-view-block');
        }
        echo ob_get_clean();
    } else {
        get_template_part('template-parts/no-search-results');
    }

    wp_reset_postdata();
    wp_die();
}