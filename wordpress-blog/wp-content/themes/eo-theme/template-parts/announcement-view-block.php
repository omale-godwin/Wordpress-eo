<?php
 // WP Query to get the latest announcements
$args = array(
    'post_type'      => 'announcements_news',
    'meta_key'       => 'is_announcement',
    'meta_value'     => '1',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<div class="announcement-slider">';  // Start the Slick wrapper
    while ($query->have_posts()) : $query->the_post();
    ?>
    <article>
        <a href="<?php the_permalink(); ?>" aria-label="Read more about <?php the_title_attribute(); ?>" tabindex="0">
            <div class="grid-block">
                <!-- Left side content -->
                <div class="grid-block-item announce-left">
                    <div class="maxw-153 mb-16 mt-32">
                        <button class="custom-button" aria-label="Learn more about <?php the_title_attribute(); ?>">Learn more</button>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <div class="post-client-data anc-data">
                        <div class="post-client-data-left">
                            <?php
                            $author_id = get_the_author_meta('ID');
                            $author_image = get_field('author_image', 'user_' . $author_id);
                            $author_name = get_the_author();
                            ?>
                            <div class="author-pic">
                                <img src="<?php echo esc_url($author_image); ?>" alt="Author image of <?php echo esc_attr($author_name); ?>" width="36" height="36" loading="lazy">
                            </div>
                            <span>Mikael Kayanian<?php //echo esc_html($author_name); ?></span>
                        </div>
                        <div class="post-client-data-right">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo esc_html(get_the_date()); ?>
                            </time>
                        </div>
                    </div>
                    
                    <!-- Tags Section -->
                    <div class="cat-tag">
                        <?php
                        $news_tags = get_the_terms(get_the_ID(), 'news_tags');
                        if ($news_tags && !is_wp_error($news_tags)) {
                            $max_display = 3;
                            $total_tags = count($news_tags);
                            $display_tags = array_slice($news_tags, 0, $max_display);

                            $tags_html = '';
                            if (isset($display_tags[0])) {
                                $tags_html .= '<span class="tag-link full-tag" data-tag-id="' . esc_attr($display_tags[0]->term_id) . '">' . esc_html($display_tags[0]->name) . '</span>';
                            }
                            if (isset($display_tags[1])) {
                                $tags_html .= '<span class="tag-link ellipsis-tag" data-tag-id="' . esc_attr($display_tags[1]->term_id) . '">' . esc_html($display_tags[1]->name) . '</span>';
                            }
                            if ($total_tags > $max_display) {
                                $remaining_count = $total_tags - $max_display;
                                $tags_html .= '<span class="custom-tag-count" data-total-tags="' . esc_html($remaining_count) . '">+' . esc_html($remaining_count) . '</span>';
                            }

                            if ($total_tags > $max_display) {
                                for ($i = $max_display; $i < $total_tags; $i++) {
                                    $tags_html .= '<span class="tag-link hidden-tag" data-tag-id="' . esc_attr($news_tags[$i]->term_id) . '">' . esc_html($news_tags[$i]->name) . '</span>';
                                }
                            }

                            echo $tags_html;
                        }
                        ?>
                    </div>

                   <div class="announce-content"><?php the_content(); ?></div>
                </div>

                <!-- Right side image -->
                <div class="grid-block-item announce-img">
                    <?php if (has_post_thumbnail()) { the_post_thumbnail('full', ['alt' => 'Featured image for ' . get_the_title()]); } ?>
                </div>
            </div>
        </a>
    </article>
 
<?php
    endwhile;
    echo '</div>';  // End the Slick wrapper
    wp_reset_postdata();
else :
    echo '<p>No announcements found at the moment.</p>';
endif;