<?php
/**
 * Archive Template for Case Studies
 * Template File: archive-case_studies.php
 */

get_header();
?>
<div class="main-body-container custom-maxW">

    <?php get_template_part('template-parts/social-share'); ?>

    <div class="detail-content">
        <div class="detail-content-left">

            <!-- Breadcrumbs -->
            <nav class="breadcrumb-container breadcrumbs detail-cat-tag flex align-item-center gap-16" aria-label="breadcrumb">
                <a href="<?php echo esc_url(home_url()); ?>">Our Work</a>
                <span class="dot-seperate" aria-hidden="true"></span>
                <span class="post-title">Case Studies</span>

                <?php
                $category = sanitize_text_field($_GET['casestudy_category'] ?? '');
                $industry = sanitize_text_field($_GET['casestudy_industry'] ?? '');
                $search   = sanitize_text_field($_GET['s'] ?? '');

                if ($category) {
                    $term = get_term_by('slug', $category, 'casestudy_category');
                    if ($term) {
                        echo '<span class="dot-seperate" aria-hidden="true"></span>';
                        echo '<span>' . esc_html($term->name) . '</span>';
                    }
                }

                if ($industry) {
                    $term = get_term_by('slug', $industry, 'casestudy_industry');
                    if ($term) {
                        echo '<span class="dot-seperate" aria-hidden="true"></span>';
                        echo '<span>' . esc_html($term->name) . '</span>';
                    }
                }

                if ($search) {
                    echo '<span class="dot-seperate" aria-hidden="true"></span>';
                    echo '<span>' . esc_html($search) . '</span>';
                }
                ?>
            </nav>

            <?php
            // Query setup
            $paged = max(1, get_query_var('paged'));
            $tax_query = [];

            if ($category) {
                $tax_query[] = [
                    'taxonomy' => 'casestudy_category',
                    'field'    => 'slug',
                    'terms'    => $category,
                ];
            }

            if ($industry) {
                $tax_query[] = [
                    'taxonomy' => 'casestudy_industry',
                    'field'    => 'slug',
                    'terms'    => $industry,
                ];
            }

            $args = [
                'post_type'      => 'case_studies',
                'post_status'    => 'publish',
                'posts_per_page' => 10,
                'paged'          => $paged,
                's'              => $search,
            ];

            if (!empty($tax_query)) {
                $args['tax_query'] = array_merge(['relation' => 'AND'], $tax_query);
            }

            $query = new WP_Query($args);
            ?>

            <div id="search-filtered-posts">
                <div class="case-study-results">
                    <?php if ($query->have_posts()): ?>
                        <?php while ($query->have_posts()): $query->the_post(); ?>
                            <div class="grid-item post-card mt-24">
                                <a href="<?php the_permalink(); ?>" class="post-card-link" aria-label="Read more about <?php the_title_attribute(); ?>">
                                    <div class="post-img">
                                        <?php if (has_post_thumbnail()) the_post_thumbnail('full'); ?>
                                    </div>

                                    <div class="cat-tag">
                                        <?php
                                        $post_tags = get_the_tags();
                                        if ($post_tags && !is_wp_error($post_tags)) {
                                            $max_display = 3;
                                            $total_tags = count($post_tags);
                                            $display_tags = array_slice($post_tags, 0, $max_display);
                                            $tags_html = '';

                                            foreach ($display_tags as $i => $tag) {
                                                $tag_class = ($i === 1) ? 'ellipsis-tag' : 'full-tag';
                                                $tags_html .= '<span class="custom-tag-link ' . $tag_class . '" data-tag-id="' . esc_attr($tag->term_id) . '">' . esc_html($tag->name) . '</span>';
                                            }

                                            if ($total_tags > $max_display) {
                                                $remaining_count = $total_tags - $max_display;
                                                $tags_html .= '<span class="custom-tag-count" data-total-tags="' . esc_attr($remaining_count) . '">+' . esc_html($remaining_count) . '</span>';
                                                for ($i = $max_display; $i < $total_tags; $i++) {
                                                    $tags_html .= '<span class="custom-tag-link hidden-tag" data-tag-id="' . esc_attr($post_tags[$i]->term_id) . '">' . esc_html($post_tags[$i]->name) . '</span>';
                                                }
                                            }

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
                                            <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                            <?php the_author(); ?>
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
                        <?php endwhile; ?>

                        <div class="pagination">
                            <?php
                            echo paginate_links([
                                'total'   => $query->max_num_pages,
                                'current' => $paged,
                            ]);
                            ?>
                        </div>

                    <?php else: ?>
                        <p>No case studies found.</p>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="custom-sidebar">
            <?php if (is_active_sidebar('custom-sidebar')) : ?>
                <?php dynamic_sidebar('custom-sidebar'); ?>
            <?php else : ?>
                <?php get_template_part('sidebar', 'custom'); ?>
            <?php endif; ?>
        </aside>
    </div>

    <!-- Common Section -->
    <?php get_template_part('template-parts/content', 'common-section'); ?>

</div>

<?php get_footer(); ?>
