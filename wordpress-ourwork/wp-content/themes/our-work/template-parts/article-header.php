<div>
        <div class="cat-selection">
                <?php
                // Get the custom taxonomy terms for 'casestudy_industry'
                $industry_terms = wp_get_post_terms(get_the_ID(), 'casestudy_industry');
                if (!empty($industry_terms)) {
                    $first_term = $industry_terms[0];
                    echo '<span class="industry-cat"><a href="' . esc_url(get_term_link($first_term->term_id)) . '">' . esc_html($first_term->name) . '</a></span>';
                }

                // Get the custom taxonomy terms for 'casestudy_category'
                $category_terms = wp_get_post_terms(get_the_ID(), 'casestudy_category');
                if (!empty($category_terms)) {
                    $first_term = $category_terms[0];
                    echo '<span class="category-cat"><a href="' . esc_url(get_term_link($first_term->term_id)) . '">' . esc_html($first_term->name) . '</a></span>';
                }
                ?>
            </div>
            
            <h1 class="article-hd"><?php the_field('article_heading'); ?></h1>
            <?php
                $args = array(
                'post_type'      => 'case_studies',
                'posts_per_page' => 1,
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                ?>
            
            <?php
                endwhile;
                wp_reset_postdata();
                endif;
            ?>
            <div class="article-sub-hd"><?php the_field('article_sub_heading'); ?></div>
            <?php
                $args = array(
                'post_type'      => 'case_studies',
                'posts_per_page' => 1,
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                ?>
            <div class="author-detail-block">
                <div class="flex align-item-center gap-16">
                    <div class="flex align-item-center client-data gap-8 author-data">
                        <?php 
                
                    $author_id = get_the_author_meta('ID');
                    $author_image = get_field('author_image', 'user_' . $author_id);
                    $author_name = get_field('author_name', 'user_' . $author_id);?>
                    <?php if ($author_image): ?>
                        <img src="<?php echo esc_url($author_image); ?>" alt="Author Image" loading="lazy">
                    <?php endif; ?>
                    <?php if ($author_name): ?>
                        <span>By</span><?php echo esc_html($author_name); ?>
                    <?php endif; ?>
                           
                    </div>
                    <span class="dash-cls"></span>
                    <span class="detail-date client-data"><?php echo get_the_date('F j, Y'); ?></span>
                </div>
                <div class="post-view-detail">
                    <div class="post-commnt"><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/comment-fill.png" alt="comment"/> 13</div>
                    <div class="post-commnt"><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/eye-line.png" alt="view"/> 110K</div>
                    <div class="post-commnt"><img src="https://cdn.electricoctopus.agency/electric-octopus/blog/read-time.png" alt="read"/> 10 Min Read</div>
                </div>
            </div>
           
            <?php
                endwhile;
                wp_reset_postdata();
                endif;
            ?>
</div>