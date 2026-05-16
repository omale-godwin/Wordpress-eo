<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OC-theme
 */

get_header();
?>

<div class="main-body-container custom-maxW">
<!-- social share section -->
<?php get_template_part('template-parts/social-share'); ?>

    <?php
    // Get the query parameters
    $industry = isset($_GET['industry']) ? sanitize_text_field($_GET['industry']) : '';
    $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

    $args = array(
        'post_type' => 'articles',
        'posts_per_page' => 10,
        'tax_query' => array(
            'relation' => 'AND',
        ),
    );

    if ($industry) {
        $args['tax_query'][] = array(
            'taxonomy' => 'article_industry',
            'field' => 'slug',
            'terms' => $industry,
        );
    }

    if ($category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'article_category',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    $query = new WP_Query($args);
    ?>
    <div class="detail-content">
        <div class="detail-content-left">
            <div class="breadcrumb-container detail-cat-tag" data-post-title="<?php echo esc_attr(get_the_title()); ?>"></div>
            <div id="search-filtered-posts">
                
            
                <?php
                if ($query->have_posts()) :
                    echo '<div class="article-grid">';
                    while ($query->have_posts()) : $query->the_post();
                        ?>
                        
                        <?php
                        get_template_part('template-parts/article-search-view-block');
                    endwhile;
                    echo '</div>';
                    wp_reset_postdata();
                else :
                    echo '<p>No articles found.</p>';
                endif;
                ?>
            </div>
        </div>
        <div class="custom-sidebar">
            <?php get_template_part('sidebar', 'custom'); ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>
