<?php
add_action('wp_ajax_filter_search_articles', 'filter_search_articles');
add_action('wp_ajax_nopriv_filter_search_articles', 'filter_search_articles');

function filter_search_articles() {
    $category_slug = isset($_POST['category_slug']) ? sanitize_text_field($_POST['category_slug']) : '';
    $industry_slug = isset($_POST['industry_slug']) ? sanitize_text_field($_POST['industry_slug']) : '';
    $search_query = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $tax_query = array('relation' => 'OR');

    if ($category_slug) {
        $tax_query[] = array(
            'taxonomy' => 'article_category',
            'field'    => 'slug',
            'terms'    => $category_slug,
        );
    }

    if ($industry_slug) {
        $tax_query[] = array(
            'taxonomy' => 'article_industry',
            'field'    => 'slug',
            'terms'    => $industry_slug,
        );
    }

    $args = array(
        'post_type'      => 'articles',
        'posts_per_page' => -1,
        's'              => $search_query,
    );

    // Only include tax_query if any filter was selected
    if (!empty($category_slug) || !empty($industry_slug)) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/article-search-view-block');
        }
    } else {
        get_template_part('template-parts/no-search-results');
    }

    wp_reset_postdata();
    wp_die();
}