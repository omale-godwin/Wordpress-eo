<?php
function ajax_load_posts() {
    // Get data from the AJAX request
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $search_query = isset($_POST['search_query']) ? sanitize_text_field($_POST['search_query']) : '';
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $industry = isset($_POST['industry']) ? sanitize_text_field($_POST['industry']) : '';

    // Build query arguments
    $args = array(
        'post_type' => 'articles',
        'posts_per_page' => 6,
        'paged' => $paged,
        's' => $search_query,
        'tax_query' => array(
            'relation' => 'OR',
        ),
    );

    // Add category filter to the query if selected
    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'article_category', // Replace with your taxonomy name
            'field' => 'slug',
            'terms' => $category,
        );
    }

    // Add industry filter to the query if selected
    if (!empty($industry)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'article_industry', // Replace with your taxonomy name
            'field' => 'slug',
            'terms' => $industry,
        );
    }

    // Create the query
    $query = new WP_Query($args);

    // Output the posts
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
               <?php get_template_part('template-parts/article-view-block');?>
            <?php
        endwhile;
        
    else :
        get_template_part('template-parts/no-results'); // Load no-results template
    endif;

    wp_reset_postdata();
    wp_die();
}