<div>
    <div class="cat-selection">
        <?php
        // Get the custom taxonomy terms for 'article_industry'
        $industry_terms = wp_get_post_terms(get_the_ID(), 'article_industry');
        if (!empty($industry_terms)) {
            $first_term = $industry_terms[0];
            echo '<span class="industry-cat"><a href="' . esc_url(get_term_link($first_term->term_id)) . '">' . esc_html($first_term->name) . '</a></span>';
        }

        // Get the custom taxonomy terms for 'article_category'
        $category_terms = wp_get_post_terms(get_the_ID(), 'article_category');
        if (!empty($category_terms)) {
            $first_term = $category_terms[0];
            echo '<span class="category-cat"><a href="' . esc_url(get_term_link($first_term->term_id)) . '">' . esc_html($first_term->name) . '</a></span>';
        }
        ?>
    </div>          

    <h1 class="article-hd"><?php the_field('article_heading'); ?></h1>
    <div class="article-sub-hd">
        <?php echo wp_kses_post( wpautop( get_field('article_sub_heading') ) ); ?>
    </div>

    <?php
        $args = array(
        'post_type'      => 'articles',
        'posts_per_page' => 1,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
    <div class="author-detail-block">
        <div class="flex align-item-center gap-16">
        <div class="flex align-item-center client-data gap-8 author-data">
            <?php //echo get_avatar(get_the_author_meta('ID'), 32); ?> <!-- Author avatar -->
            <?php 
                $author_id = get_the_author_meta('ID');
                $author_image = get_field('author_image', 'user_' . $author_id);
                if ($author_image): ?>
                <div class="author-pic">
                    <img src="<?php echo esc_url($author_image); ?>" alt="Profile image of <?php the_author(); ?>" width="36" height="36" loading="lazy">
                </div>
            <?php endif; ?>
            <span>By</span> Mikael Kayanian<?php //echo get_the_author_meta('display_name'); ?> <!-- Author name -->
        </div>

        <span class="dash-line"></span>
            <span class="detail-date client-data"><?php echo get_the_date('F j, Y'); ?></span>
        </div>

        <div class="post-view-detail">
            <div class="post-commnt">
                <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/comment-fill.png" alt="comment"/> 
                <?php echo get_comments_number(get_the_ID()); ?>
            </div>

            <div class="post-commnt">
                <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/eye-line.png" alt="view"/> 
                <?php echo eo_get_post_views(get_the_ID()); ?>
            </div>

            <div class="post-commnt">
                <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/read-time.png" alt="read"/> 
                <?php echo eo_get_reading_time(get_the_ID()); ?> Min Read
            </div>
        </div>

    </div>
    <?php
        endwhile;
        wp_reset_postdata();
        endif;
    ?>
</div>