<?php
function ajax_load_news_posts() {
    // Get data from the AJAX request
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $search_query = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : '';
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    // Build query arguments
    $args = array(
        'post_type' => 'announcements_news',
        'posts_per_page' => 3,
        'paged' => $paged,
        's' => $search_query,
        'meta_query'     => array(
            array(
                'key'     => 'is_announcement',
                'value'   => '1',
                'compare' => '!=',
            ),
        ),
        'tax_query' => array(
            'relation' => 'OR',
        ),
    );

    // Add category filter to the query if selected
    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'news_category', // Replace with your taxonomy name
            'field' => 'slug',
            'terms' => $category,
        );
    }

   

    // Create the query
    $query = new WP_Query($args);

    // Output the posts
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
               <?php get_template_part('template-parts/news-view-block');?>
            <?php
        endwhile;
        
    else :
        get_template_part('template-parts/no-results'); // Load no-results template
    endif;

    wp_reset_postdata();
    wp_die();
}