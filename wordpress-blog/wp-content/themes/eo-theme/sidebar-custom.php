<div class="sidebar-widget">
    <!-- Search Bar -->
    <div class="search-post w-100">
        <div class="cat-search w-100">
            <form id="search-form" class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input 
                    type="text" 
                    name="s" 
                    placeholder="Search article" 
                    value="<?php echo get_search_query(); ?>" 
                    id="search-input"
                    autocomplete="off"
                    maxlength="15"
                />
                <input type="hidden" name="post_type" value="articles">
                <button type="submit">
                    <img 
                        src="https://cdn.electricoctopus.agency/electric-octopus/blog/search-2-fill.png" 
                        alt="search" 
                        class="cursor-point" 
                        id="search-icon" 
                        data-default="https://cdn.electricoctopus.agency/electric-octopus/blog/search-2-fill.png"
                        data-active="https://cdn.electricoctopus.agency/electric-octopus/blog/search-active-fill.png"
                        loading="lazy"
                        width="24" height="24"
                    >
                </button>
            </form>
        </div>
        <p>Max 15 Characters</p>
    </div>

    <!-- Industry Dropdown -->
    <div class="portfolio-right mt-24">
        <div class="cat-dropdown w-100">
            <form id="industry-filter" class="w-100">
                <select name="article_industry" id="search-industry-dropdown" class="custom-select placeholder w-100" aria-label="Select Industry">
                    <option value="" selected>Industry</option>
                    <?php 
                        $terms = get_terms(array(
                            'taxonomy' => 'article_industry',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                            $selected = (isset($_GET['filter']) && strpos($_GET['filter'], $term->slug) !== false) ? 'selected' : '';
                            echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($term->name) . '</option>';
                        }
                    ?>
                </select>
            </form>
        </div>
    </div>

    <!-- Category Dropdown -->
    <div class="portfolio-right mt-24">
        <div class="cat-dropdown w-100">
            <form id="article-category-filter" class="w-100">
                <select name="article_category" id="search-category-dropdown" class="custom-select placeholder w-100" aria-label="Select Category">
                    <option value="" selected>Category</option>
                    <?php 
                        $terms = get_terms(array(
                            'taxonomy' => 'article_category',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                            $selected = (isset($_GET['filter']) && strpos($_GET['filter'], $term->slug) !== false) ? 'selected' : '';
                            echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($term->name) . '</option>';
                        }
                    ?>
                </select>
            </form>
        </div>
    </div>

    <!-- Tag List -->
    <div class="sidebar-tag-list mt-24">
        <h3><?php _e('Popular Tags', 'textdomain'); ?></h3>
        <div class="articles-tags">
            <div class="tag-list">
                <?php 
                    $tags = get_terms(array(
                        'taxonomy' => 'post_tag',
                        'hide_empty' => false,
                    ));

                    if (!empty($tags) && !is_wp_error($tags)) {
                        $count = 0;
                        foreach ($tags as $tag) {
                            $is_hidden = $count >= 10;
                            $class = $is_hidden ? 'hidden-tags' : '';
                            $style = $is_hidden ? 'style="display:none !important;"' : '';
                            echo '<span class="custom-tag-link ' . esc_attr($class) . '" ' . $style . ' data-tag-id="' . esc_attr($tag->term_id) . '">' . esc_html($tag->name) . '</span>';
                            $count++;
                        }

                        if (count($tags) > 10) {
                            echo '<div class="show-more" id="toggle-tags">show more <span>+</span></div>';
                        }
                    }
                ?>
            </div>
        </div>

    </div>


    <!-- Recent Articles -->
    <div class="recent-post-cls mt-24">
        <h3><?php _e('Recent Articles', 'textdomain'); ?></h3>
        <?php
            $recent_posts = wp_get_recent_posts(array(
                'post_type' => 'articles',
                'numberposts' => 5,
                'post_status' => 'publish',
            ));
            foreach ($recent_posts as $post) :
                $terms = get_the_terms($post['ID'], 'article_industry');
        ?>
        <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>" class="recent-post-block" style="text-decoration: none; color: inherit;" aria-label="Read more about <?php the_title_attribute(); ?>">
            <div class="recent-post-img">
                <?php echo get_the_post_thumbnail($post['ID'], 'full'); ?>
            </div>

            <div class="post-left-content">
                <p>
                    <?php 
                        $article_heading = get_post_meta($post['ID'], 'article_heading', true);
                        echo !empty($article_heading) ? esc_html($article_heading) : esc_html($post['post_title']); 
                    ?>
                </p>
                <div class="recenttag">
                    <div class="viewd-tag">
                        <?php
                            $article_tags = get_the_terms($post['ID'], 'post_tag');
                            if ($article_tags && !is_wp_error($article_tags)) {
                                $max_display = 1;
                                $display_tags = array_slice($article_tags, 0, $max_display);
                                if (isset($display_tags[0])) {
                                    echo '<span class="full-tag" data-tag-id="' . esc_attr($display_tags[0]->term_id) . '">' . esc_html($display_tags[0]->name) . '</span>';
                                }
                               
                                if (count($article_tags) > $max_display) {
                                    echo '<span class="custom-tag-count">+' . esc_html(count($article_tags) - $max_display) . '</span>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="recent-dateg"><?php echo get_the_date('F j, Y', $post['ID']); ?></div>
            </div>
        </a>
        <?php endforeach; wp_reset_query(); ?>
    </div>


    <!-- Most Viewed -->
    <div class="most-viewed-post mt-24">
        <h3 class="mb-24"><?php _e('Most Viewed', 'textdomain'); ?></h3>
        <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

            $args = array(
                'post_type'      => 'articles',
                'posts_per_page' => 2,
                'paged'          => $paged,
                'meta_key'       => 'post_views_count',
                'orderby'        => 'meta_value_num',
                'order'          => 'DESC',
                's'              => $search_query,
            );
            
            
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
        ?>
        <div class="grid-item mt-24"> 
            <a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
                <div>
                    <div class="viewd-post-img">
                        <?php if (has_post_thumbnail()) the_post_thumbnail('full'); ?>
                    </div>
                    <div class="viewd-card">
                        <p class="article-para"><?php the_field('article_heading'); ?></p>
                        <div class="cat-tag viewd-tag">
                            <?php
                                $article_tags = get_the_terms(get_the_ID(), 'post_tag');
                                if ($article_tags && !is_wp_error($article_tags)) {
                                    $max_display = 2;
                                    $display_tags = array_slice($article_tags, 0, $max_display);
                                    if (isset($display_tags[0])) {
                                        echo '<span class="custom-tag-link full-tag" data-tag-id="' . esc_attr($display_tags[0]->term_id) . '">' . esc_html($display_tags[0]->name) . '</span>';
                                    }
                                    if (isset($display_tags[1])) {
                                        echo '<span class="custom-tag-link ellipsis-tag" data-tag-id="' . esc_attr($display_tags[1]->term_id) . '">' . esc_html($display_tags[1]->name) . '</span>';
                                    }
                                    if (count($article_tags) > $max_display) {
                                        echo '<span class="custom-tag-count">+' . esc_html(count($article_tags) - $max_display) . '</span>';
                                    }
                                }
                            ?>
                        </div>
                        <div class="post-client-data">
                            <div class="post-client-data-left">
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
                            <div class="post-client-data-right">
                                <p><?php echo get_the_date(); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>

    <!-- Follow Us -->
    <div class="followus-block mt-24">
        <h3>Follow us on</h3>
        <div class="foo-social-links mt-24">
            <?php if (is_active_sidebar('sicial-media')) : ?>
                <?php dynamic_sidebar('sicial-media'); ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sidebar Banner -->
    <div class="sidebar-widget mt-24">  
    <?php
        // Get the terms for the current post
        $industry_terms = wp_get_post_terms(get_the_ID(), 'article_industry');

        // Mapping of term slugs to sidebar templates
        $industry_template_map = [
            'healthcare'       => 'template-sidebar-banner-1.php',
            'manufacturing'    => 'template-sidebar-banner-2.php',
            'logistics'        => 'template-sidebar-banner-3.php',
            'telecom'          => 'template-sidebar-banner-4.php',
            'technology'       => 'template-sidebar-banner-5.php',
            'textile'          => 'template-sidebar-banner-6.php',
            'mining'           => 'template-sidebar-banner-7.php',
            'construction'     => 'template-sidebar-banner-8.php',
            'energy-utilities' => 'template-sidebar-banner-9.php',
            'financial'        => 'template-sidebar-banner-10.php',
            'defense-space'    => 'template-sidebar-banner-11.php',  // Ensure this matches your term slug
            'agriculture'      => 'template-sidebar-banner-12.php',
        ];

        // Default template
        $selected_template = 'template-sidebar-banner-1.php';

        // Check if the terms are assigned and if a matching template exists
        if (!empty($industry_terms) && isset($industry_template_map[$industry_terms[0]->slug])) {
            $selected_template = $industry_template_map[$industry_terms[0]->slug];
        }

        // Locate the selected template
        $template_path = locate_template('partials/side-banners-templates/' . $selected_template);

        if ($template_path) {
            // Include the template if found
            include $template_path;
        } else {
            echo 'Banner template not found: ' . esc_html($selected_template);
        }
    ?>
</div>
</div>