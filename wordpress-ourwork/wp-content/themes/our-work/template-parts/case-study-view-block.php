<a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
<div class="case-study-post-block">
    <div class="case-study-post-block-left">
        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy"/>
        <?php else : ?>
            <p>No image found</p>
        <?php endif; ?>
    </div>

    <div class="case-study-post-block-right">
        <div class="case-study-post-sect">
            <div class="cat-selection">
                <?php
                // Industry term
                $industry_terms = wp_get_post_terms(get_the_ID(), 'casestudy_industry');
                if (!empty($industry_terms)) {
                    $term = $industry_terms[0];
                    echo '<span class="industry-cat">'.esc_html($term->name).'</span>';
                }

                // Category term
                $category_terms = wp_get_post_terms(get_the_ID(), 'casestudy_category');
                if (!empty($category_terms)) {
                    $term = $category_terms[0];
                    echo '<span class="category-cat">'.esc_html($term->name).'</span>';
                }
                ?>
            </div>

            <h2><?php the_title(); ?></h2>

            <div class="case-data flex align-item-center mb-16">
                <div class="flex align-item-center client-data gap-8 author-data">
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
                    <?php //echo get_avatar(get_the_author_meta('ID'), 32); ?>
                    <?php //the_author(); ?>
                </div>

                <div class="case-study-post-date">
                    &nbsp;|&nbsp;
                    <span class="date-white"><?php echo esc_html(get_the_date('d, l')); ?></span>
                    <span class="date-gray"><?php echo esc_html(get_the_date('M Y')); ?></span>
                    &nbsp;|&nbsp;
                </div>

                <span class="case-study-post-date">7 Min Read</span>
            </div>

            <div class="case-study-post-para">
                <?php the_field('article_sub_heading'); ?>
            </div>

            <div class="case-study-link">
                <span class="read-mo-button">View Case Study</span>
                <span class="case-study-view">
                    <img src="https://cdn.electricoctopus.agency/ourwork/g-eye.png" alt="view" loading="lazy"/>
                    06
                </span>
            </div>
        </div>    
        <div class="cat-tag">
            <?php
            $post_tags = get_the_tags();

            if ($post_tags && !is_wp_error($post_tags)) {
                $max_display = 3;
                $total_tags = count($post_tags);

                foreach ($post_tags as $index => $tag) {
                    $class = $index === 0 ? 'full-tag' : ($index < $max_display ? 'ellipsis-tag' : 'hidden-tag');
                    $style = $index < $max_display ? '' : ' style="display:none;"';
                    echo '<span class="custom-tag-link ' . esc_attr($class) . '" data-tag-id="' . esc_attr($tag->term_id) . '"' . $style . '>' . esc_html($tag->name) . '</span>';
                }

                if ($total_tags > $max_display) {
                    $remaining = $total_tags - $max_display;
                    echo '<span class="custom-tag-count" data-total-tags="' . esc_attr($remaining) . '">+' . esc_html($remaining) . '</span>';
                }
            }
            ?>
        </div>
    </div>
</div>
</a>
