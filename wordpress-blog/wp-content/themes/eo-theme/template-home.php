<?php
/* 
Template Name: Home Page
*/

get_header(); 
?>

<div class="main-body-container custom-maxW">
    <h1 class="visually-hidden">Welcome to Electric Octopus — Discover how to thrive online with creative excellence and smart strategy</h1>

    <!-- Slider Section -->
    <div class="slider-container mb-36">
        <!-- Featured Post Header -->
        <div class="post-cat-head">
            <span class="post-cat-tag">FEATURED Articles</span>        
        </div>
        <!-- Slider Image -->
        <div class="featured-post-slider">       
            <?php
            // Define the main query args for the featured articles
            $args = array(
                'post_type'      => 'articles', // Only articles
                'meta_key'       => 'is_featured',
                'meta_value'     => '1',        // Posts marked as featured
                'posts_per_page' => 3,          // Number of featured posts to show
            );

            // Modify query to apply filter based on URL parameter
            // if ( isset($_GET['filter']) && !empty($_GET['filter']) ) {
            //     $filter = sanitize_text_field($_GET['filter']);
            //     $filter_params = explode('/', $filter); // Splits the filter into parts

            //     // Initialize tax_query with a relation
            //     $tax_query = array('relation' => 'AND');

            //     // Filter by Industry (first segment)
            //     if ( isset($filter_params[0]) && !empty($filter_params[0]) ) {
            //         $industry_slug = $filter_params[0];
            //         $tax_query[] = array(
            //             'taxonomy' => 'article_industry', // Replace with your taxonomy slug
            //             'field'    => 'slug',
            //             'terms'    => $industry_slug,
            //         );
            //     }

            //     // Filter by Category (second segment)
            //     if ( isset($filter_params[1]) && !empty($filter_params[1]) ) {
            //         $category_slug = $filter_params[1];
            //         $tax_query[] = array(
            //             'taxonomy' => 'article_category', // Replace with your taxonomy slug
            //             'field'    => 'slug',
            //             'terms'    => $category_slug,
            //         );
            //     }

            //     // Only add tax_query if at least one condition exists
            //     if ( count($tax_query) > 1 ) {
            //         $args['tax_query'] = $tax_query;
            //     }
                
            //     // Optionally, filter by search term (third segment)
            //     if ( isset($filter_params[2]) && !empty($filter_params[2]) ) {
            //         $args['s'] = sanitize_text_field($filter_params[2]);
            //     }
            // }

            // Run the custom query
            $query = new WP_Query($args);

            // Loop through posts and display them
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) : $query->the_post();
            ?>
                <div class="slide">
                    <article>
                        <a href="<?php the_permalink(); ?>" aria-label="Read more about <?php the_title_attribute(); ?>" tabindex="0">
                            <div class="img-block mt-24">
                                <?php
                                $image = get_field('featured_image');

                                if ($image) {
                                    echo '<img 
                                        src="' . esc_url($image['url']) . '" 
                                        alt="' . esc_attr($image['alt'] ?: get_the_title()) . '"
                                    >';
                                }
                                ?>
                            </div>


                            <!-- Tags -->
                            <div class="flex-line flex align-item-center justify-space-between gap-24">
                                <div class="cat-tag">
                                    <?php
                                    $post_tags = get_the_tags();
                                    if ( $post_tags && !is_wp_error($post_tags) ) {
                                        $max_display = 3;
                                        $total_tags  = count($post_tags);
                                        $display_tags = array_slice($post_tags, 0, $max_display);
                                        foreach ( $display_tags as $tag ) {
                                            echo '<span class="custom-tag-link" data-tag-id="' . esc_attr($tag->term_id) . '">' . esc_html($tag->name) . '</span>';
                                        }
                                        if ( $total_tags > $max_display ) {
                                            $remaining_count = $total_tags - $max_display;
                                            echo '<span class="custom-tag-count">+' . esc_html($remaining_count) . '</span>';
                                        }
                                    }
                                    ?>
                                </div>
                                <span class="post-date"><?php echo get_the_date(); ?></span>
                            </div>

                            <!-- Post Content -->
                            <div class="slide-content mb-16">
                                <h2 class="head-text font-24"><?php the_field('article_heading'); ?></h2>
                                <p class="para-text"><?php the_field('article_sub_heading'); ?></p>
                            </div>

                            <!-- Client Data -->
                            <div class="flex justify-space-between align-item-center gap-24">
                                <div class="flex align-item-center client-data gap-16">
                                    <?php 
                                    $author_id = get_the_author_meta('ID');
                                    $author_image = get_field('author_image', 'user_' . $author_id);
                                    if ($author_image): ?>
                                        <div class="author-pic">
                                            <img src="<?php echo esc_url($author_image); ?>" alt="Profile image of <?php the_author(); ?>" width="36" height="36" loading="lazy">
                                        </div>
                                    <?php endif; ?>
                                    <span>Mikael Kayanian<?php //the_author(); ?></span>
                                </div>
                            </div>            
                        </a>
                    </article>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>

    <!-- Newsletter Section -->
    <?php get_template_part('template-parts/content', 'newsletter'); ?>

    <!-- Portfolio Section -->
    <?php get_template_part('template-parts/content', 'blog-article'); ?>
     
    <!-- Announcement and News section -->
    <?php get_template_part('template-parts/content', 'announcement-news'); ?>
</div>

<?php get_footer(); ?>
<!-- //for dynamic url -->
<script>
    // JavaScript to handle dynamic URL generation and form submission
    document.addEventListener('DOMContentLoaded', function() {
        const industryDropdown = document.getElementById('custom-industry-dropdown');
        const categoryDropdown = document.getElementById('custom-category-dropdown');
        const searchInput = document.getElementById('search-input');
        
        function updateUrl() {
            const industry = industryDropdown.value;
            const category = categoryDropdown.value;
            let search = searchInput.value;

            // Replace spaces with hyphens for URL compatibility
            search = search.replace(/\s+/g, '-');

            // Build the filter string: industry/category/search
            let filter = 'filter=';
            if ( industry ) {
                filter += industry;
            }
            if ( category ) {
                filter += '/' + category;
            }
            if ( search ) {
                filter += '/' + search;
            }
            // Update the URL path (modify the path if needed)
            window.history.pushState({}, '', '/articles?' + filter);
        }

        // Add event listeners
        industryDropdown.addEventListener('change', updateUrl);
        categoryDropdown.addEventListener('change', updateUrl);
        searchInput.addEventListener('input', updateUrl);
    });
</script>