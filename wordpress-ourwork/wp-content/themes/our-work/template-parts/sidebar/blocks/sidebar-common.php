<div>
    <!-- Search Bar -->
    <div class="search-post w-100">
        <div class="cat-search w-100">
            <form id="search-form" class="search-form" method="get" action="">
                <input type="text" name="s" placeholder="Search" value="" id="search-input" autocomplete="off" maxlength="15" fdprocessedid="ls4o74">
                <input type="hidden" name="post_type" value="case_studies">
                <button type="submit" fdprocessedid="4zu9cn">
                    <img src="https://cdn.electricoctopus.agency/electric-octopus/blog/search-2-fill.png" alt="search" class="cursor-point" id="search-icon" data-default="https://cdn.electricoctopus.agency/electric-octopus/blog/search-2-fill.png" data-active="https://cdn.electricoctopus.agency/electric-octopus/blog/search-active-fill.png" loading="lazy" width="24" height="24">
                </button>
            </form>
            <p>Max 15 Characters</p>
        </div>
        <p>Max 15 Characters</p>
    </div>

    <!-- Industry Dropdown -->
    <div class="cat-dropdown portfolio-right mt-24">
        <select name="casestudy_industry" id="search-industry-dropdown" class="custom-select w-100">
            <option value="">Industry</option>
            <?php 
            $industries = get_terms(['taxonomy' => 'casestudy_industry', 'hide_empty' => false]);
            foreach ($industries as $term) {
                $selected = selected($_GET['casestudy_industry'] ?? '', $term->slug, false);
                echo "<option value='" . esc_attr($term->slug) . "' $selected>" . esc_html($term->name) . "</option>";
            }
            ?>
        </select>
    </div>

    <!-- Category Dropdown -->
    <div class="cat-dropdown portfolio-right mt-24">
        <select name="casestudy_category" id="search-category-dropdown" class="custom-select w-100">
            <option value="">Category</option>
            <?php 
            $categories = get_terms(['taxonomy' => 'casestudy_category', 'hide_empty' => false]);
            foreach ($categories as $term) {
                $selected = selected($_GET['casestudy_category'] ?? '', $term->slug, false);
                echo "<option value='" . esc_attr($term->slug) . "' $selected>" . esc_html($term->name) . "</option>";
            }
            ?>
        </select>
    </div>

    <!-- Tag List -->
    <div class="sidebar-tag-list mt-24">
        <h3>Popular Tags</h3>
        <div class="articles-tags tag-list">
            <?php 
            $tags = get_terms(['taxonomy' => 'post_tag', 'hide_empty' => false]);
            foreach ($tags as $i => $tag) {
                $hidden = $i >= 10 ? 'style="display:none !important;" class="custom-tag-link hidden-tags"' : 'class="custom-tag-link"';
                echo "<span $hidden data-tag-id='" . esc_attr($tag->term_id) . "'>" . esc_html($tag->name) . "</span>";
            }
            if (count($tags) > 10) {
                echo '<div class="show-more" id="toggle-tags">Show more <span>+</span></div>';
            }
            ?>
        </div>
    </div>

    <!-- Insights Section -->
    

    <!-- Place unique banner block after this in variant files -->
</div>
