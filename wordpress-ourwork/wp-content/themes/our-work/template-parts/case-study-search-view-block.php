<div>
<div class="breadcrumb-container">
    <?php
    $category = isset($_GET['casestudy_category']) ? sanitize_text_field($_GET['casestudy_category']) : '';
    $industry = isset($_GET['casestudy_industry']) ? sanitize_text_field($_GET['casestudy_industry']) : '';
    $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    // Start the breadcrumb with the Home link
    // $breadcrumbs = '<a href="' . home_url() . '">Home</a>';

    if ($category) {
        $category_term = get_term_by('slug', $category, 'casestudy_category');
        if ($category_term) {
            $breadcrumbs .= ' > <a href="' . esc_url(home_url('?casestudy_category=' . $category)) . '">' . esc_html($category_term->name) . '</a>';
        }
    }

    if ($industry) {
        $industry_term = get_term_by('slug', $industry, 'casestudy_industry');
        if ($industry_term) {
            $breadcrumbs .= ' > <a href="' . esc_url(home_url('?casestudy_industry=' . $industry)) . '">' . esc_html($industry_term->name) . '</a>';
        }
    }

    if ($search) {
        $breadcrumbs .= ' > <span>' . esc_html($search) . '</span>';
    }

    echo '<div class="breadcrumbs">' . $breadcrumbs . '</div>';
    ?>
</div>
    <div class="grid-item post-card mt-24">
        <a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
                <div class="post-img">
                    <?php if (has_post_thumbnail()) { 
                        the_post_thumbnail('full'); 
                    } ?>
                </div>
                <div class="cat-tag">
                    <?php
                    $post_tags = get_the_tags(); // Get tags
                    if ($post_tags && !is_wp_error($post_tags)) {
                        $max_display = 3; // Maximum tags to display
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
                        // Display the third tag with ellipsis if needed
                        if (isset($display_tags[2])) {
                            $tags_html .= '<span class="custom-tag-link full-tag" data-tag-id="' . esc_attr($display_tags[2]->term_id) . '">' . esc_html($display_tags[2]->name) . '</span>';
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
                <h2 class="post-para mb-16"><?php the_title(); ?></h2>
                <div class="case-study-post-para">
                    <?php the_field('case_study_description'); ?>
                </div>
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
                <div class="case-study-link">
                    <span class="read-mo-button">Read More</span>
                    <span class="case-study-view">
                        <img src="https://cdn.electricoctopus.agency/ourwork/g-eye.png" alt="view" loading="lazy"/>
                        06
                    </span>
                </div>
        </a>
    </div>
</div>