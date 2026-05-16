<?php
get_header();
?>
<div class="main-body-container custom-maxW">
    <!-- Slider Section -->
    <div class="slider-container mb-36">
        <!-- Featured Post Header -->
        <div class="post-cat-head">
            <span class="post-cat-tag">FEATURED Articles</span>        
        </div>
        <!-- Slider Image -->
        <div class="featured-post-slider">       
            <?php
            $args = array(
                'post_type'      => 'articles',
                'meta_key'       => 'is_featured',
                'meta_value'     => '1', // Set to 'true' if using ACF True/False field
                'posts_per_page' => 3,   // Number of featured posts to show
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                ?>
                        
                <div class="slide">
                    <a href="<?php the_permalink(); ?>">
                        
                        <div class="img-block mt-24">
                        <?php
                            if ( has_post_thumbnail() ) {
                            // Display featured image
                            the_post_thumbnail( 'full' ); 
                            }
                        ?>
                        </div>
                        <!-- tags -->
                        
                        <!-- Post Metadata -->
                        <div class="flex-line flex align-item-center justify-space-between gap-24">
                        <div class="cat-tag">
                            <?php
                            $post_tags = get_the_tags(); // Get post tags
                            if ($post_tags && !is_wp_error($post_tags)) {
                                $max_display = 3; // Limit tags to 3
                                $total_tags = count($post_tags);
                                $display_tags = array_slice($post_tags, 0, $max_display); // Get only the first 3 tags

                                // Loop through the selected tags and display them
                                foreach ($display_tags as $tag) {
                                    echo '<span class="custom-tag-link" data-tag-id="' . esc_attr($tag->term_id) . '">' . esc_html($tag->name) . '</span>';
                                }

                                // Display remaining count if there are more than 3 tags
                                if ($total_tags > $max_display) {
                                    $remaining_count = $total_tags - $max_display;
                                    echo '<span class="custom-tag-count">+' . esc_html($remaining_count) . '</span>';
                                }
                            }
                            ?>
                        </div>

                            <?php
                                    // Display post date
                                    echo '<span class="post-date">' . get_the_date() . '</span>';
                                ?>
                        </div>
                        <!-- Post Content -->
                        <div class="slide-content mb-16">
                            <h3 class="head-text font-24"><?php the_field('article_heading'); ?><?php //the_title(); ?></h3>
                            <div class="para-text"><?php the_field('article_sub_heading'); ?></div>
                        </div>
                        <!-- Client Data -->
                        <div class="flex justify-space-between align-item-center gap-24">
                            <div class="flex align-item-center client-data gap-16">
                                <?php 
                                    $author_id = get_the_author_meta('ID');
                                    $author_image = get_field('author_image', 'user_' . $author_id);
                                    if ($author_image): ?>
                                        <div class="author-media-section">
                                            <img src="<?php echo esc_url($author_image); ?>" alt="Author Image" loading="lazy">
                                        </div>
                                    <?php endif; ?>
                           
                            <?php the_author(); ?>
                            </div>
                        
                        </div>            
                    </a>
                </div>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

    </div>

    <!-- Newsletter Section -->
    <?php get_template_part( 'template-parts/content', 'newsletter' ); ?>

    <!-- Portfolio Section -->
    <?php get_template_part( 'template-parts/content', 'blog-article' ); ?>
     
    <!-- Announcement and News section -->
    <?php get_template_part( 'template-parts/content', 'announcement-news' ); ?>
      
</div>
<?php
get_footer();
?>
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
