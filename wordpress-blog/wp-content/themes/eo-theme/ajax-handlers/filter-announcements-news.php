<?php
// Register AJAX actions
add_action('wp_ajax_filter_announcements', 'filter_announcements');
add_action('wp_ajax_nopriv_filter_announcements', 'filter_announcements');
add_action('wp_ajax_filter_news', 'filter_news');
add_action('wp_ajax_nopriv_filter_news', 'filter_news');

// Shared helper function to get tax_query
function get_common_tax_query($category_slug) {
    $tax_query = array('relation' => 'OR');

    if (!empty($category_slug)) {
        $tax_query[] = array(
            'taxonomy' => 'news_category',
            'field'    => 'slug',
            'terms'    => $category_slug,
        );
    }

    return count($tax_query) > 1 ? $tax_query : array(); // Only return if something added
}

// Shared helper function to execute query and load template
function render_announcements_or_news($args, $template_part) {
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/' . $template_part); // Load correct template
        }
    } else {
        get_template_part('template-parts/no-results');
    }

    wp_reset_postdata();
    wp_die();
}

// 🔔 Announcements AJAX handler
// Announcements AJAX handler
function filter_announcements() {
    // Sanitize inputs
    $category_slug = isset($_POST['category_slug']) ? sanitize_text_field($_POST['category_slug']) : '';
    $search_query  = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    // Query arguments
    $args = array(
        'post_type'      => 'announcements_news',
        'posts_per_page' => 1,
        's'              => $search_query,
        'meta_query'     => array(
            array(
                'key'   => 'is_announcement',
                'value' => '1',
            ),
        ),
    );

    $tax_query = get_common_tax_query($category_slug);
    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    // Query posts
    $query = new WP_Query($args);

    // Debugging the query result
    error_log('Announcements query args: ' . print_r($args, true)); // Log query args
    error_log('Announcements found: ' . $query->found_posts); // Log the number of posts found

    // Check if posts exist and return the appropriate response
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/announcement-view-block');
        }
    } else {
        get_template_part('template-parts/no-results'); // Ensure response if no posts are found
    }

    wp_reset_postdata();
    wp_die();
}



// 📰 News AJAX handler
// News AJAX handler
function filter_news() {
    $category_slug = isset($_POST['category_slug']) ? sanitize_text_field($_POST['category_slug']) : '';
    $search_query  = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $paged         = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    // Query arguments for news
    $args = array(
        'post_type'      => 'announcements_news',
        'posts_per_page' => 3,
        'paged'          => $paged,
        's'              => $search_query,
        'meta_query'     => array(
            array(
                'key'     => 'is_announcement',
                'value'   => '1',
                'compare' => '!=',
            ),
        ),
        'post_status'    => 'publish', // Only get published posts
    );

    // Add tax_query if category is set
    $tax_query = get_common_tax_query($category_slug);
    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    // Get the posts
    render_announcements_or_news($args, 'news-view-block', $paged);
}