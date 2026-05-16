<?php
/**
 * Template part for displaying announcement-news content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OC-theme
 */

?>

<div class="portfolio-section">
        <div class="latest-article" id="announcements">
            <div class="anc-left">
                <h2>announcements & news</h2>
                <h3>Latest Breakthroughs & Agency Milestone</h3>
            </div>
            <div class="portfolio-right filter-section">
                <!-- Category Dropdown -->
                <div class="cat-dropdown">
                    <form id="announcement-news-category-filter">
                        <select name="news-article_category" id="news-category-dropdown" class="custom-select placeholder" aria-label="Select Category">
                            <option value="" selected>Category</option>
                            <?php 
                                $terms = get_terms(array(
                                    'taxonomy' => 'news_category',
                                    'hide_empty' => false,
                                ));
                                foreach ($terms as $term) {
                                    echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
                                }
                            ?>
                        </select>
                    </form>
                </div>
                <!-- Search Bar -->
                <div class="search-post">
                    <div class="cat-search">
                        <form id="announcement-search-form" class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <input type="text" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>" id="announcement-search-input" autocomplete="off" maxlength="15"/>
                            <input type="hidden" name="post_type" value="news_posts">
                            <button type="submit">
                                <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/search-2-fill.png" alt="search" class="cursor-point" loading="lazy" width="24" height="24">
                            </button>
                        </form>
                    </div>
                    <p>Max 15 Characters</p>
                </div>
            </div>
        </div>
        <!-- Tag List (Dynamic Tags) -->
         <div class="news-tags">
            <h2 class="all-tags mt-24">All Tags</h2> 
            <div class="tag-list">
                <?php 
                // Fetch all tags related to 'news'
                $tags = get_terms( array(
                    'taxonomy' => 'news_tags', // If you're using a custom taxonomy, replace 'post_tag' with the custom taxonomy name
                    'hide_empty' => false,  // Show all tags, even if they have no posts
                ) );

                if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
                    foreach ( $tags as $tag ) {
                        // Display each tag as a link with a data attribute
                        echo '<span class="tag-link" data-tag-id="' . esc_attr($tag->term_id) . '" tabindex="0" role="button" aria-label="' . esc_attr($tag->name) . '">' . esc_html($tag->name) . '</span>';
                        
                    }
                }
                ?>
            </div>
        </div>
        <!-- Announcements Section -->
    <div class="post-spesialist" id="news">
        <h2 class="announce-head">Latest Announcements</h2>   
        <div id="announcement-section">
            <!-- AJAX results for announcements will load here -->
        </div>
    </div>

    <!-- News Section -->
    <div class="post-block mt-24" id="news">
        <h2>Latest News</h2>
        <h3>Latest innovations in lead capture, segmentation, and relationship-building automation</h3>
        <div class="grid-container" id="news-section">
            <!-- AJAX results for news will load here -->
        </div>
    </div>     
    <!-- Pagination with lazy-loaded icons -->
    <div class="news-post-pagination" role="navigation" aria-label="Pagination Navigation">
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
    const paginationContainer = document.querySelector(".news-post-pagination");
    const postsContainer = document.querySelector("#news-section");
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
        const searchQuery = document.querySelector("#search-input")?.value || "";

        const data = new FormData();
        data.append("action", "load_news_posts");
        data.append("page", page);
        data.append("search_query", searchQuery);
        data.append("category", category);

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
    document.querySelector("#search-input")?.addEventListener("input", () => fetchPosts(1));

    // First render
    renderPagination(currentPage);
});
</script>
