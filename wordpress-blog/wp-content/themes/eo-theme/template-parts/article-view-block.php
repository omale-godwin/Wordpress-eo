<div class="grid-item post-card"> 
    <a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
        <div class="post-img">
            <?php 
            if (has_post_thumbnail()) {
                the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']);
            }
            ?>
        </div>

            <div class="cat-tag">
                <?php
                $post_tags = get_the_tags(); // Get tags
                if ($post_tags && !is_wp_error($post_tags)) {
                    $max_display = 2; // Maximum tags to display
                    $total_tags = count($post_tags);
                    $display_tags = array_slice($post_tags, 0, $max_display); // Get only the first 2 tags

                    // Initialize HTML output
                    $tags_html = '';

                    // Display the first tag fully
                    if (isset($display_tags[0])) {
                        $tags_html .= '<span class="custom-tag-link full-tag" data-tag-id="' . esc_attr($display_tags[0]->term_id) . '">' . esc_html($display_tags[0]->name) . '</span>';
                    }

                    // Display the second tag with ellipsis if needed
                    if (isset($display_tags[1])) {
                        $tags_html .= '<span class="custom-tag-link ellipsis-tag" data-tag-id="' . esc_attr($display_tags[1]->term_id) . '">' . esc_html($display_tags[1]->name) . '</span>';
                    }

                    // Display the remaining count if there are more than 2 tags
                    if ($total_tags > $max_display) {
                        $remaining_count = $total_tags - $max_display;
                        $tags_html .= '<span class="custom-tag-count" data-total-tags="' . esc_html($remaining_count) . '">+' . esc_html($remaining_count) . '</span>';
                    }

                    // Display remaining hidden tags with CSS display:none
                    if ($total_tags > $max_display) {
                        for ($i = $max_display; $i < $total_tags; $i++) {
                            $tags_html .= '<span class="custom-tag-link hidden-tag" data-tag-id="' . esc_attr($post_tags[$i]->term_id) . '">' . esc_html($post_tags[$i]->name) . '</span>';
                        }
                    }

                    // Output all tag-related HTML at once
                    echo $tags_html;
                }
                ?>
            </div>

        <h3 class="post-para">
            <?php echo esc_html(wp_strip_all_tags(get_field('article_heading'))); ?>
        </h3>

        <div class="post-client-data">
            <div class="post-client-data-left">
                <?php 
                $author_id = get_the_author_meta('ID');
                $author_image = get_field('author_image', 'user_' . $author_id);
                if ($author_image): ?>
                    <div class="author-pic">
                        <img src="<?php echo esc_url($author_image); ?>" alt="Author Image" width="36" height="36" loading="lazy" decoding="async">
                    </div>
                <?php endif; ?>
                <?php //the_author(); ?>Mikael Kayanian
            </div>
            <div class="post-client-data-right">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo esc_html(get_the_date()); ?>
                </time>
            </div>
        </div>
    </a>
</div>
