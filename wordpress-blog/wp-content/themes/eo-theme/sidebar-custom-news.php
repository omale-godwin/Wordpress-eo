<div class="sidebar-widget">

    <!-- Search Bar -->
    <div class="search-post w-100">
        <div class="cat-search w-100">
            <form id="announcement-search-form" class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>" id="announcement-search-input" autocomplete="off" />
                <input type="hidden" name="post_type" value="news_posts">
                <button type="submit">
                    <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/search-2-fill.png" alt="search" class="cursor-point" loading="lazy" width="24" height="24">
                </button>
            </form>
        </div>
        <p>Max 15 Characters</p>
    </div>
    <!-- Category Dropdown -->
    <div class="portfolio-right  mt-24 w-100">
        <div class="cat-dropdown w-100">
            <form id="new-category-filter">
                <select name="news-article_category" id="news-category-dropdown" class="custom-select placeholder w-100" aria-label="Select Category">
                    <option value="" selected>Category</option>
                    <?php 
                        $terms = get_terms(array(
                            'taxonomy' => 'news_category',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                            echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                        }
                    ?>
                </select>
            </form>
         </div>
    </div>
    <div class="sidebar-tag-list mt-24">
        <h3><?php _e('Popular Tags', 'textdomain'); ?></h3>
        <div class="articles-tags">
            <div class="tag-list">
                <?php 
                    $tags = get_terms(array(
                        'taxonomy' => 'news_tags',
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

    <div class="recent-post-cls mt-24">
        <h3><?php _e('Latest Announcements', 'textdomain'); ?></h3>
        <?php
            $recent_announcements = wp_get_recent_posts(array(
                'post_type'      => 'announcements_news',
                'numberposts'    => 5,
                'post_status'    => 'publish',
                'meta_query'     => array(
                    array(
                        'key'     => 'is_announcement',
                        'value'   => '1',
                        'compare' => '='
                    ),
                ),
            ));
            foreach ($recent_announcements as $post) :
                $terms = get_the_terms($post['ID'], 'news_category');
        ?>
        <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>" class="recent-post-block" style="text-decoration: none; color: inherit;">
            <div class="recent-post-img">
                <?php echo get_the_post_thumbnail($post['ID'], 'thumbnail'); ?>
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
                            $announcement_news_tags = get_the_terms($post['ID'], 'news_tags');
                            if ($announcement_news_tags && !is_wp_error($announcement_news_tags)) {
                                $max_display = 1;
                                $display_tags = array_slice($announcement_news_tags, 0, $max_display);
                                if (isset($display_tags[0])) {
                                    echo '<span class="full-tag" data-tag-id="' . esc_attr($display_tags[0]->term_id) . '">' . esc_html($display_tags[0]->name) . '</span>';
                                }
                               
                                if (count($announcement_news_tags) > $max_display) {
                                    echo '<span class="custom-tag-count">+' . esc_html(count($announcement_news_tags) - $max_display) . '</span>';
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
    <div class="recent-post-cls mt-24">
        <h3><?php _e('Latest News', 'textdomain'); ?></h3>
        <?php
            $recent_news = wp_get_recent_posts(array(
                'post_type'      => 'announcements_news',
                'numberposts'    => 5,
                'post_status'    => 'publish',
                'meta_query'     => array(
                    array(
                        'key'     => 'is_announcement',
                        'value'   => '1',
                        'compare' => '!=', // Exclude announcements
                    ),
                ),
            ));
            foreach ($recent_news as $post) :
                $terms = get_the_terms($post['ID'], 'news_category');
        ?>
        <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>" class="recent-post-block" style="text-decoration: none; color: inherit;">
            <div class="recent-post-img">
                <?php echo get_the_post_thumbnail($post['ID'], 'thumbnail'); ?>
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
                            $announcement_news_tags = get_the_terms($post['ID'], 'news_tags');
                            if ($announcement_news_tags && !is_wp_error($announcement_news_tags)) {
                                $max_display = 1;
                                $display_tags = array_slice($announcement_news_tags, 0, $max_display);
                                if (isset($display_tags[0])) {
                                    echo '<span class="full-tag" data-tag-id="' . esc_attr($display_tags[0]->term_id) . '">' . esc_html($display_tags[0]->name) . '</span>';
                                }
                               
                                if (count($announcement_news_tags) > $max_display) {
                                    echo '<span class="custom-tag-count">+' . esc_html(count($announcement_news_tags) - $max_display) . '</span>';
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

    <div class="marketing-pulse-form mt-24">
        <h3>Weekly Performance Marketing Pulse</h3>
        <p class="mt-16">Join 15,000 Marketing & Sales Professionals</p>
        
        <form id="marketing-subscribe-form">
            <input type="text" id="subscriber-name" name="full_name" placeholder="Full name" required>
            <input type="email" id="subscriber-email" name="work_email" placeholder="Work email" required>
            <button type="submit" class="custom-button w-100">Subscribe</button>
        </form>
    </div>                 
    <div class="followus-block mt-24">
        <h3>Follow us on</h3>
        <div class="foo-social-links mt-24">
        <?php if (is_active_sidebar('sicial-media')) : ?>
                        <?php dynamic_sidebar('sicial-media'); ?>
                    <?php endif; ?>
                       
        </div>
    </div>
    <div class="sidebar-widget mt-24">  
        <?php
        // Array of available banner template files
        $banner_templates = [
            'template-sidebar-banner-1.php',
            'template-sidebar-banner-2.php',
            'template-sidebar-banner-3.php',
            'template-sidebar-banner-4.php',
            'template-sidebar-banner-5.php',
            'template-sidebar-banner-6.php',
            'template-sidebar-banner-7.php',
            'template-sidebar-banner-8.php',
            'template-sidebar-banner-9.php',
            'template-sidebar-banner-10.php',
            'template-sidebar-banner-11.php',
            'template-sidebar-banner-12.php',
        ];

        // Pick one at random
        $random_template = $banner_templates[array_rand($banner_templates)];

    // Build the path
        $template_path = locate_template('partials/side-banners-templates/' . $random_template);

        // Include or fallback
        if ($template_path) {
            include $template_path;
        } else {
            echo 'Banner template not found: ' . esc_html($random_template);
        }
        ?>
    </div>
</div>