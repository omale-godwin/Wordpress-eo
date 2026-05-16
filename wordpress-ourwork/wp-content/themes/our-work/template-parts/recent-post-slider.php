<div class="recent-post-slider">
    <?php
    $paged = get_query_var('paged') ?: 1;
    $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    $args = [
        'post_type'      => 'case_studies',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'paged'          => $paged,
        's'              => $search_query,
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $post_id = get_the_ID();
            $post_title = get_the_title();
            $post_url = get_the_permalink();
            $post_thumbnail = get_the_post_thumbnail_url($post_id, 'medium');
    ?>
            <a href="<?php echo esc_url($post_url); ?>" class="case-study-link-wrapper" aria-label="Read more about <?php echo esc_attr($post_title); ?>">
                <article class="case-study-recent-post-block">
                    <div class="case-study-post-block-left" style="flex: 1;">
                        <?php if ($post_thumbnail) : ?>
                            <img src="<?php echo esc_url($post_thumbnail); ?>" alt="<?php echo esc_attr($post_title); ?>" loading="lazy" decoding="async" />
                        <?php else : ?>
                            <p>No image found</p>
                        <?php endif; ?>
                    </div>

                    <div class="case-study-post-block-right" style="flex: 2;">
                        <img src="https://cdn.electricoctopus.agency/ourwork/Arrow.png" loading="lazy" alt="" class="post-link" />

                        <div class="case-study-post-sect">
                            <div class="cat-selection" style="margin-bottom: 8px;">
                                <?php
                                $industry_terms = wp_get_post_terms($post_id, 'casestudy_industry');
                                if (!empty($industry_terms)) {
                                    echo '<span class="industry-cat">' . esc_html($industry_terms[0]->name) . '</span>';
                                }

                                $category_terms = wp_get_post_terms($post_id, 'casestudy_category');
                                if (!empty($category_terms)) {
                                    echo '<span class="category-cat">' . esc_html($category_terms[0]->name) . '</span>';
                                }
                                ?>
                            </div>

                            <h2><?php echo esc_html($post_title); ?></h2>

                            <div class="flex align-item-center mb-16" style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                <div class="flex align-item-center client-data gap-8 author-data" style="display: flex; align-items: center; gap: 8px;">
                                    <?php 
                
                                        $author_id = get_the_author_meta('ID');
                                        $author_image = get_field('author_image', 'user_' . $author_id);
                                        $author_name = get_field('author_name', 'user_' . $author_id);?>
                                        <?php if ($author_image): ?>
                                            <img src="<?php echo esc_url($author_image); ?>" alt="Author Image" loading="lazy">
                                        <?php endif; ?>
                                        <?php if ($author_name): ?>
                                            <?php echo esc_html($author_name); ?>
                                        <?php endif; ?>
                                   
                                </div>

                                <div class="case-study-post-date" style="color: #999;">
                                    &nbsp;|&nbsp;
                                    <span class="date-white"><?php echo esc_html(get_the_date('d, l')); ?></span>
                                    <span class="date-gray"><?php echo esc_html(get_the_date('M Y')); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="cat-tag" style="margin-top: 12px;">
                            <?php
                            $post_tags = get_the_tags();
                            if ($post_tags && !is_wp_error($post_tags)) {
                                $max_display = 3;
                                foreach ($post_tags as $index => $tag) {
                                    $class = $index === 0 ? 'full-tag' : ($index < $max_display ? 'ellipsis-tag' : 'hidden-tag');
                                    $style = $index < $max_display ? '' : ' style="display:none;"';
                                    echo '<span class="custom-tag-link ' . esc_attr($class) . '" data-tag-id="' . esc_attr($tag->term_id) . '"' . $style . '>' . esc_html($tag->name) . '</span>';
                                }

                                $remaining = count($post_tags) - $max_display;
                                if ($remaining > 0) {
                                    echo '<span class="custom-tag-count" data-total-tags="' . esc_attr($remaining) . '">+' . esc_html($remaining) . '</span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </article>
            </a>
    <?php
        endwhile;
    else :
        echo '<p>No case studies found.</p>';
    endif;
    wp_reset_postdata();
    ?>
</div>
