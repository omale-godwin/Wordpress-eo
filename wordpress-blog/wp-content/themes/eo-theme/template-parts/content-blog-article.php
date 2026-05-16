<?php
/**
 * Template part for displaying Blog articles content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package OC-theme
 */
?>

<div class="portfolio-section">
    <div class="latest-article">
        <div class="portfolio-left">
            <h2>Blog</h2>
            <h3>Latest Articles</h3>
        </div>

        <div class="portfolio-right">
            <!-- Industry Dropdown -->
            <div class="cat-dropdown">
                <form id="industry-filter">
                    <select name="article_industry" id="custom-industry-dropdown" class="custom-select placeholder" aria-label="Select Industry">
                        <option value="">Industry</option>
                        <?php 
                        $industries = get_terms(['taxonomy' => 'article_industry', 'hide_empty' => false]);
                        foreach ($industries as $term) {
                            $selected = (isset($_GET['filter']) && strpos($_GET['filter'], $term->slug) !== false) ? 'selected' : '';
                            echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($term->name) . '</option>';
                        }
                        ?>
                    </select>
                </form>
            </div>

            <!-- Category Dropdown -->
            <div class="cat-dropdown">
                <form id="category-filter">
                    <select name="article_category" id="custom-category-dropdown" class="custom-select placeholder" aria-label="Select Category">
                        <option value="">Category</option>
                        <?php 
                        $categories = get_terms(['taxonomy' => 'article_category', 'hide_empty' => false]);
                        foreach ($categories as $term) {
                            $selected = (isset($_GET['filter']) && strpos($_GET['filter'], $term->slug) !== false) ? 'selected' : '';
                            echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($term->name) . '</option>';
                        }
                        ?>
                    </select>
                </form>
            </div>

            <!-- Search Bar -->
            <div class="search-post">
                <div class="cat-search">
                    <form id="search-form" class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input 
                            type="text" 
                            name="s" 
                            placeholder="Search article" 
                            value="<?php echo esc_attr(get_search_query()); ?>" 
                            id="search-input"
                            autocomplete="off"
                            maxlength="15"
                        />
                        <input type="hidden" name="post_type" value="articles">
                        <button type="submit" aria-label="Search">
                            <img 
                                loading="lazy"
                                src="https://cdn.electricoctopus.agency/electric-octopus/blog/search-2-fill.png" 
                                alt="Search icon" 
                                class="cursor-point"
                                width="24" height="24"
                            >
                        </button>
                    </form>
                </div>
                <p>Max 15 Characters</p>
            </div>
        </div>
    </div>

    <!-- Tag List -->
    <div class="articles-tags">
        <h2 class="all-tags mt-24">All Tags</h2>
        <div class="tag-list">
            <?php 
            $tags = get_terms([
                'taxonomy' => 'post_tag',
                'hide_empty' => false,
                'number' => 20,
                'orderby' => 'count',
                'order' => 'DESC'
            ]);

            if (!empty($tags) && !is_wp_error($tags)) {
                foreach ($tags as $tag) {
                    echo '<span class="custom-tag-link" data-tag-id="' . esc_attr($tag->term_id) . '" tabindex="0" role="button" aria-label="' . esc_attr($tag->name) . '">' . esc_html($tag->name) . '</span>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Post Blocks -->
    <div class="post-block">
        <div class="grid-container" id="filtered-posts">
        <?php

        $paged = get_query_var('paged') ? get_query_var('paged') : get_query_var('page');
        $paged = $paged ? $paged : 1;

        $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

        $args = [
            'post_type'      => 'articles',
            'posts_per_page' => 6,
            'paged'          => $paged,
            'post_status'    => 'publish',
            's'              => $search_query,
            'ignore_sticky_posts' => true,
            'suppress_filters'    => false,
        ];

        if (!empty($_GET['filter'])) {

            $filter = sanitize_text_field($_GET['filter']);
            $filter_params = explode('/', $filter);

            $tax_query = ['relation' => 'AND'];

            // Industry (first segment)
            if (!empty($filter_params[0])) {
                $tax_query[] = [
                    'taxonomy' => 'article_industry',
                    'field'    => 'slug',
                    'terms'    => $filter_params[0],
                ];
            }

            // Category (second segment)
            if (!empty($filter_params[1])) {
                $tax_query[] = [
                    'taxonomy' => 'article_category',
                    'field'    => 'slug',
                    'terms'    => $filter_params[1],
                ];
            }

            // Only add if not empty
            if (count($tax_query) > 1) {
                $args['tax_query'] = $tax_query;
            }
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/article-view-block');
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No articles found.</p>';
        endif;

        ?>
        </div>

    </div>

    <!-- Pagination with lazy-loaded icons -->
    <div class="post-pagination" role="navigation" aria-label="Pagination Navigation">
        <span data-page="first" aria-label="First Page">
            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/First.png" alt="First Page" class="first-page" loading="lazy">
        </span>
        <span data-page="prev" aria-label="Previous Page">
            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/Prev.png" alt="Previous Page" class="prev-page" loading="lazy">
        </span>

        <!-- These .page-number elements will be replaced dynamically -->
        <span class="page-number active" data-page="1">1</span>
        <span class="page-number" data-page="2">2</span>
        <span class="page-number" data-page="3">3</span>
        <span class="page-number" data-page="4">4</span>
        <span class="page-number" data-page="5">5</span>

        <span data-page="next" aria-label="Next Page">
            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/Next.png" alt="Next Page" class="next-page" loading="lazy">
        </span>
        <span data-page="last" aria-label="Last Page">
            <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/Last.png" alt="Last Page" class="last-page" loading="lazy">
        </span>
    </div>


</div>
<?php if ( isset($query) && $query instanceof WP_Query ) : ?>
    <script>
        const pagination_data = {
            ajax_url: "<?php echo admin_url('admin-ajax.php'); ?>",
            max_pages: <?php echo $query->max_num_pages; ?>
        };
    </script>
<?php endif; ?>
<script>
    
document.addEventListener("DOMContentLoaded", function () {
    const paginationContainer = document.querySelector(".post-pagination");
    const postsContainer = document.querySelector("#filtered-posts");
    const maxPages = parseInt(pagination_data.max_pages) || 1;
    let currentPage = 1;

    function renderPagination(currentPage) {
        // Remove old .page-number spans
        paginationContainer.querySelectorAll(".page-number").forEach(el => el.remove());

        const maxVisible = 5;
        let start = Math.max(1, currentPage - Math.floor(maxVisible / 2));
        let end = start + maxVisible - 1;

        if (end > maxPages) {
            end = maxPages;
            start = Math.max(1, end - maxVisible + 1);
        }

        // Insert before the next button
        const nextBtn = paginationContainer.querySelector("[data-page='next']");

        for (let i = start; i <= end; i++) {
            const span = document.createElement("span");
            span.classList.add("page-number");
            if (i === currentPage) span.classList.add("active");
            span.dataset.page = i;
            span.textContent = i;
            paginationContainer.insertBefore(span, nextBtn);
        }
    }

    function fetchPosts(page) {
        const category = document.querySelector("#custom-category-dropdown")?.value || "";
        const industry = document.querySelector("#custom-industry-dropdown")?.value || "";
        const searchQuery = document.querySelector("#search-input")?.value || "";

        const data = new FormData();
        data.append("action", "load_posts");
        data.append("page", page);
        data.append("search_query", searchQuery);
        data.append("category", category);
        data.append("industry", industry);

        fetch(pagination_data.ajax_url, {
            method: "POST",
            body: data,
        })
        .then((response) => response.text())
        .then((html) => {
            postsContainer.innerHTML = html;
            currentPage = page;
            renderPagination(currentPage);
        })
        .catch((error) => console.error("Fetch error:", error));
    }

    paginationContainer.addEventListener("click", function (e) {
        const target = e.target.closest("img, span");
        if (!target) return;

        let page = currentPage;

        if (target.classList.contains("next-page")) {
            page = Math.min(currentPage + 1, maxPages);
        } else if (target.classList.contains("prev-page")) {
            page = Math.max(currentPage - 1, 1);
        } else if (target.classList.contains("first-page")) {
            page = 1;
        } else if (target.classList.contains("last-page")) {
            page = maxPages;
        } else if (target.classList.contains("page-number")) {
            page = parseInt(target.dataset.page);
        }

        if (page !== currentPage) {
            fetchPosts(page);
        }
    });

    // Dropdown listeners
    document.querySelector("#custom-category-dropdown")?.addEventListener("change", () => fetchPosts(1));
    document.querySelector("#custom-industry-dropdown")?.addEventListener("change", () => fetchPosts(1));
    document.querySelector("#search-input")?.addEventListener("input", () => fetchPosts(1));

    // First render
    renderPagination(currentPage);
});

</script>
<!-- <script src="<?php //echo get_template_directory_uri(); ?>/js/pagination.js"></script> -->