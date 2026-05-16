<?php
add_action('wp_ajax_filter_search_articles', 'filter_search_articles');
add_action('wp_ajax_nopriv_filter_search_articles', 'filter_search_articles');

function filter_search_articles() {
    $category_slug = isset($_POST['category_slug']) ? sanitize_text_field($_POST['category_slug']) : '';
    $industry_slug = isset($_POST['industry_slug']) ? sanitize_text_field($_POST['industry_slug']) : '';
    $search_query  = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $tax_query = [];

    // Only add taxonomy queries if values are present
    if (!empty($category_slug)) {
        $tax_query[] = array(
            'taxonomy' => 'casestudy_category',
            'field'    => 'slug',
            'terms'    => $category_slug,
        );
    }

    if (!empty($industry_slug)) {
        $tax_query[] = array(
            'taxonomy' => 'casestudy_industry',
            'field'    => 'slug',
            'terms'    => $industry_slug,
        );
    }

    $args = array(
        'post_type'      => 'case_studies',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        's'              => $search_query,
    );

    // Add tax_query if either filter exists
    if (!empty($tax_query)) {
        $args['tax_query'] = array(
            'relation' => 'AND',
            ...$tax_query
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/case-study-search-view-block');
        }
    } else {
        get_template_part('template-parts/no-results');
    }

    wp_reset_postdata();
    wp_die();
}
