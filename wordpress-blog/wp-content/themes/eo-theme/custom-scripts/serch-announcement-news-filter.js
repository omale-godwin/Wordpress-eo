document.addEventListener('DOMContentLoaded', function () {
    const $ = jQuery;

    const categoryDropdown = $('#news-category-dropdown');
    const searchInput = $('#announcement-search-input');
    const resultsContainer = $('#search-news-filtered-posts');
    const breadcrumbContainer = $('.breadcrumb-container');
    const postTitle = breadcrumbContainer.data('postTitle') || '';
    let selectedTags = [];

    // --- Restore values from URL on page load ---
    function updateDropdownsFromURL() {
        const params = new URLSearchParams(window.location.search);
        const filter = params.get('filter');
    
        if (filter) {
            const parts = filter.split('/').filter(Boolean); // remove empty strings from splitting
    
            if (parts.length === 1) {
                // Only category is selected (e.g., ?filter=/news-cat1)
                categoryDropdown.val(parts[0]);
            } else if (parts.length === 2) {
                // Both search and category provided (e.g., ?filter=marketing/news-cat1)
                searchInput.val(parts[0].replace(/-/g, ' '));
                categoryDropdown.val(parts[1]);
            }
        }
    }
    

    // --- Update browser URL bar without reloading ---
    function updateUrl() {
        const category = categoryDropdown.val();
        let search = searchInput.val().trim().replace(/\s+/g, '-');
        let filter = '';

        if (search) filter += search;
        if (category) filter += '/' + category;

        // const newUrl = filter ? `/Announcements & News?filter=${filter}` : '/Announcements & News';
        const newUrl = filter 
        ? `${window.location.origin}/wordpress/announcements-news?filter=${filter}` 
        : `${window.location.origin}/wordpress/announcements-news`;


        window.history.pushState({}, '', newUrl);
    }

    // --- Update breadcrumbs ---
    function updateBreadcrumbs() {
        const homeUrl = window.location.origin;
        const searchVal = searchInput.val().trim();
        const categorySlug = categoryDropdown.val();
        const categoryText = categoryDropdown.find('option:selected').text();

        let html = `<a href="${homeUrl}">Blog</a> 
                    <span class="dot-separate"> </span> 
                    <span class="white">Announcements & News</span>`;

        const isFilterActive = searchVal || categorySlug;

        if (!isFilterActive && postTitle) {
            html += ` <span class="dot-separate"> </span> <span>${postTitle}</span>`;
        }

        if (searchVal) {
            html += ` <span class="dot-separate"> </span> <span>${searchVal}</span>`;
        }

        if (categorySlug) {
            html += ` <span class="dot-separate"> </span> <span>${categoryText}</span>`;
        }

        breadcrumbContainer.html(html);
    }

    // --- AJAX Fetch ---
    function fetchPosts() {
        const category = categoryDropdown.val();
        const search = searchInput.val().trim();

        // Avoid fetch if nothing is selected
        if (!category && !search) return;

        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_search_news',
                category_slug: category,
                search: search
            },
            beforeSend: function () {
                resultsContainer.html("<p class='white'>Loading...</p>");
            },
            success: function (response) {
                resultsContainer.html(response);
                updateTags();
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                resultsContainer.html("<p>An error occurred while fetching posts.</p>");
            }
        });
    }

    // --- Update Tags ---
    function updateTags() {
        const selectedCategory = categoryDropdown.val();
        const searchQuery = searchInput.val().trim().toLowerCase();

        // Reset all tags to disabled initially
        $('.custom-tag-link').removeClass('enabled').addClass('disabled-tag');
        const visibleTags = new Set();

        if (selectedCategory || searchQuery.length > 0) {
            // Collect tags from visible posts after filtering
            $('#search-news-filtered-posts .grid-item:visible').each(function () {
                $(this).find('.custom-tag-link').each(function () {
                    visibleTags.add($(this).data('tag-id')); // Add visible tags only
                });
            });

            // Enable only the tags that match visible posts
            $('.articles-tags .custom-tag-link').each(function () {
                const tagID = $(this).data('tag-id');
                if (visibleTags.has(tagID)) {
                    $(this).removeClass('disabled-tag').addClass('enabled');
                }
            });
        }
    }

    // --- Handle tag clicks ---
    $(document).on('click', '.custom-tag-link.enabled', function () {
        const tagID = $(this).data('tag-id');

        if (selectedTags.includes(tagID)) {
            selectedTags = selectedTags.filter(id => id !== tagID);
            $(this).removeClass('selected-tag');
        } else {
            if (selectedTags.length < 7) {
                selectedTags.push(tagID);
                $(this).addClass('selected-tag');
            } else {
                alert('You can only select up to 7 tags.');
            }
        }

        $('.grid-item .custom-tag-link').each(function () {
            const tagLinkID = $(this).data('tag-id');
            $(this).toggleClass('selected-tag', selectedTags.includes(tagLinkID));
        });

        $('#search-news-filtered-posts .custom-tag-count').toggleClass('highlighted-tag', selectedTags.length > 3);

    });
    function toggleBreadcrumbs() {
        const categoryVal = categoryDropdown.val();
        const searchVal = searchInput.val().trim();
    
        const defaultBreadcrumb = document.getElementById('default-breadcrumb');
        const filteredBreadcrumb = document.getElementById('filtered-breadcrumb');
    
        const isFilterApplied = categoryVal || searchVal;
    
        if (isFilterApplied) {
            if (defaultBreadcrumb) defaultBreadcrumb.style.display = 'none';
            if (filteredBreadcrumb) filteredBreadcrumb.style.display = 'flex'; // or 'block' depending on your layout
        } else {
            if (defaultBreadcrumb) defaultBreadcrumb.style.display = 'flex'; // or 'block'
            if (filteredBreadcrumb) filteredBreadcrumb.style.display = 'none';
        }
    }
    
    // --- Handle dropdown & search input ---
    function handleInputChange() {
        updateUrl();
        fetchPosts();
        updateBreadcrumbs();
        toggleBreadcrumbs();
    }

    categoryDropdown.on('change', handleInputChange);
    searchInput.on('input', handleInputChange);

   // --- Initial Setup ---
updateDropdownsFromURL();
updateBreadcrumbs();
toggleBreadcrumbs();

// 🟢 Fetch filtered posts if filter exists in URL
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('filter')) {
    fetchPosts(); // ← this ensures shared links load correct posts
}

});
