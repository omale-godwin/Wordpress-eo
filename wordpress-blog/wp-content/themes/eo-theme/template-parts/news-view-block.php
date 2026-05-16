<div class="grid-item news-post"> 
                            <a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
                                <div>
                                    <div class="news-img">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            // Display featured image
                                            the_post_thumbnail('full');
                                        }
                                        ?>
                                     
                                    </div>
                                    <div class="news-card">
                                    <div class="news-more"><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/go.png" alt="learn more" loading="lazy"></div>
                                        <h3><?php the_title(); ?></h3>
                                        <div class="cat-tag">
                                            <?php
                                                $news_tags = get_the_terms(get_the_ID(), 'news_tags'); // Get post tags
                                                if ($news_tags && !is_wp_error($news_tags)) {
                                                    $max_display = 3; // Maximum tags to display
                                                    $total_tags = count($news_tags);
                                                    $display_tags = array_slice($news_tags, 0, $max_display); // Get only the first 2 tags
                                
                                                    // Initialize HTML output
                                                    $tags_html = '';
                                
                                                    // Display the first tag fully
                                                    if (isset($display_tags[0])) {
                                                        $tags_html .= '<span class="tag-link full-tag" data-tag-id="' . esc_attr($display_tags[0]->term_id) . '">' . esc_html($display_tags[0]->name) . '</span>';
                                                    }
                                
                                                    // Display the second tag with ellipsis if needed
                                                    if (isset($display_tags[1])) {
                                                        $tags_html .= '<span class="tag-link ellipsis-tag" data-tag-id="' . esc_attr($display_tags[1]->term_id) . '">' . esc_html($display_tags[1]->name) . '</span>';
                                                    }
                                
                                                    // Display the remaining count if there are more than 2 tags
                                                    if ($total_tags > $max_display) {
                                                        $remaining_count = $total_tags - $max_display;
                                                        $tags_html .= '<span class="custom-tag-count" data-total-tags="' . esc_html($remaining_count) . '">+' . esc_html($remaining_count) . '</span>';
                                                    }
                                
                                                    // Display remaining hidden tags with CSS display:none
                                                    if ($total_tags > $max_display) {
                                                        for ($i = $max_display; $i < $total_tags; $i++) {
                                                            $tags_html .= '<span class="tag-link hidden-tag" data-tag-id="' . esc_attr($news_tags[$i]->term_id) . '">' . esc_html($news_tags[$i]->name) . '</span>';
                                                        }
                                                    }
                                
                                                    // Output all tag-related HTML at once
                                                    echo $tags_html;
                                                }
                                            ?>
                                        </div>
                                        <div class="post-client-data">
                                            <div class="post-client-data-left">
                                            <?php
                                                $author_id = get_the_author_meta('ID');
                                                $author_image = get_field('author_image', 'user_' . $author_id);
                                                $author_name = get_the_author();
                                                ?>
                                            <div class="author-pic">
                                                    <img src="<?php echo esc_url($author_image); ?>" alt="Author Image" width="36" height="36" loading="lazy">
                                                </div>
                                                <?php //the_author(); ?>Mikael Kayanian
                                            </div>
                                            <div class="post-client-data-right">
                                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                    <?php echo esc_html(get_the_date()); ?>
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>