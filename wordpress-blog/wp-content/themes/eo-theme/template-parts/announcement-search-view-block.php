<div class="breadcrumb-container">
    <?php
    $category = isset($_GET['news_category']) ? sanitize_text_field($_GET['news_category']) : '';
    $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    // $breadcrumbs = '<a href="' . esc_url(home_url()) . '">Home</a>';

    if ($category) {
        $category_term = get_term_by('slug', $category, 'news_category');
        if ($category_term && !is_wp_error($category_term)) {
            $breadcrumbs .= ' &gt; <a href="' . esc_url(home_url('?news_category=' . $category)) . '">' . esc_html($category_term->name) . '</a>';
        }
    }

    if ($search) {
        $breadcrumbs .= ' &gt; <span>' . esc_html($search) . '</span>';
    }

    // echo '<div class="breadcrumbs">' . $breadcrumbs . '</div>';
    ?>
</div>

<div class="grid-item mt-24">
    <a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
        <div class="post-card">
            
            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-img">
                    <?php the_post_thumbnail('full', ['loading' => 'lazy', 'alt' => get_the_title()]); ?>
                </div>
            <?php endif; ?>

            <!-- Tags -->
            <div class="cat-tag">
                <?php
                $news_tags = get_the_terms(get_the_ID(), 'news_tags');

                if ($news_tags && !is_wp_error($news_tags)) {
                    $max_display = 3;
                    $display_tags = array_slice($news_tags, 0, $max_display);
                    $tags_html = '';

                    foreach ($display_tags as $i => $tag) {
                        $class = ($i === 1) ? 'ellipsis-tag' : 'full-tag';
                        $tags_html .= '<span class="custom-tag-link ' . esc_attr($class) . '" data-tag-id="' . esc_attr($tag->term_id) . '">' . esc_html($tag->name) . '</span>';
                    }

                    $remaining_tags = array_slice($news_tags, $max_display);
                    $remaining_count = count($remaining_tags);

                    if ($remaining_count > 0) {
                        $tags_html .= '<span class="custom-tag-count" data-total-tags="' . esc_attr($remaining_count) . '">+' . esc_html($remaining_count) . '</span>';
                        foreach ($remaining_tags as $hidden_tag) {
                            $tags_html .= '<span class="custom-tag-link hidden-tag" style="display:none;" data-tag-id="' . esc_attr($hidden_tag->term_id) . '">' . esc_html($hidden_tag->name) . '</span>';
                        }
                    }

                    echo $tags_html;
                }
                ?>
            </div>

            <!-- Headline -->
            <?php if (get_field('announcement_heading')) : ?>
                <p class="post-para"><?php echo esc_html(get_field('announcement_heading')); ?></p>
            <?php elseif (get_field('news_heading')) : ?>
                <p class="post-para"><?php echo esc_html(get_field('news_heading')); ?></p>
            <?php endif; ?>

            <!-- Author & Date -->
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
                <span>Mikael Kayanian<?php //echo esc_html($author_name); ?></span>
            </div>

                <div class="post-client-data-right">
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                        <?php echo esc_html(get_the_date()); ?>
                    </time>
                </div>
            </div>

        </div>
    </a>
</div>