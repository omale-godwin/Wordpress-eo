<div class="post-meta-section">

    <!-- Category -->
    <div class="cat-selection">
        <?php
        $industry_terms = wp_get_post_terms(get_the_ID(), 'news_category');
        if (!empty($industry_terms)) {
            $first_term = $industry_terms[0];
            $term_link = get_term_link($first_term->term_id);
            if (!is_wp_error($term_link)) {
                echo '<span class="industry-cat"><a href="' . esc_url($term_link) . '">' . esc_html($first_term->name) . '</a></span>';
            }
        }
        ?>
    </div>

    <!-- Dynamic Heading/Subheading -->
    <?php
    $announcement_heading = get_field('announcement_heading');
    $announcement_sub_heading = get_field('announcement_sub_heading');
    $news_heading = get_field('news_heading');
    $news_sub_heading = get_field('news_sub_heading');

    if ($announcement_heading) {
        echo '<h1 class="article-hd">' . esc_html($announcement_heading) . '</h1>';
    }

    if ($announcement_sub_heading) {
        echo '<p class="article-sub-hd">' . esc_html($announcement_sub_heading) . '</p>';
    }

    if ($news_heading) {
        echo '<h1 class="article-hd">' . esc_html($news_heading) . '</h1>';
    }

    if ($news_sub_heading) {
        echo '<p class="article-sub-hd">' . esc_html($news_sub_heading) . '</p>';
    }
    ?>

    <!-- Author & Meta -->
    <div class="author-detail-block">
        <div class="flex align-item-center gap-16">
            <div class="flex align-item-center client-data gap-8 author-data">
            <?php 
                            $author_id = get_the_author_meta('ID');
                            $author_image = get_field('author_image', 'user_' . $author_id);
                            if ($author_image): ?>
                                <div class="author-pic">
                                    <img src="<?php echo esc_url($author_image); ?>" alt="Author Image" width="36" height="36" loading="lazy">
                                </div>
                            <?php endif; ?>

                <span>By</span>
                <span class="author-name"><?php the_author(); ?></span>
            </div>
            <span class="dash-line" aria-hidden="true"></span>
            <span class="detail-date client-data">
                <?php echo esc_html(get_the_date('F j, Y')); ?>
            </span>
        </div>

        <!-- Post Stats (Consider making dynamic in the future) -->
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

</div>