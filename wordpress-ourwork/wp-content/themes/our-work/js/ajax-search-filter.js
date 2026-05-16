jQuery(document).ready(function ($) {
    const industryDropdown = document.getElementById('search-industry-dropdown');
    const categoryDropdown = document.getElementById('search-category-dropdown');
    const searchInput = document.getElementById('search-input');
    const breadcrumbContainer = document.querySelector('.breadcrumb-container');
    const postTitle = breadcrumbContainer?.dataset?.postTitle || '';
    let selectedTags = [];

    // --- Read filters from URL on page load ---
function updateDropdownsFromURL() {
    const params = new URLSearchParams(window.location.search);
    const filter = params.get('filter');

    if (!filter) return;

    const parts = filter.split('/').map(p => p.trim()).filter(Boolean);

    // Reset values
    document.getElementById('search-input').value = '';
    document.getElementById('search-industry-dropdown').value = '';
    document.getElementById('search-category-dropdown').value = '';

    // Assign parts based on position
    if (parts.length === 1) {
        // Could be search OR industry OR category → infer using taxonomies if needed
        assignToField(parts[0], 1);
    } else if (parts.length === 2) {
        assignToField(parts[0], 1); // search or industry
        assignToField(parts[1], 2); // industry or category
    } else if (parts.length >= 3) {
        assignToField(parts[0], 0); // search
        assignToField(parts[1], 1); // industry
        assignToField(parts[2], 2); // category
    }

    function assignToField(val, position) {
        if (!val) return;
        switch (position) {
            case 0:
                document.getElementById('search-input').value = val.replace(/-/g, ' ');
                break;
            case 1:
                document.getElementById('search-industry-dropdown').value = val;
                break;
            case 2:
                document.getElementById('search-category-dropdown').value = val;
                break;
        }
    }
}
function fetchPostsAfterURLPrefill() {
    const industry = industryDropdown.value;
    const category = categoryDropdown.value;
    const search = searchInput.value.trim();

    const hasFilter = industry || category || search;

    if (!hasFilter) return;

    const data = {
        action: "filter_search_articles",
        industry_slug: industry,
        category_slug: category,
        search: search
    };

    $.ajax({
        url: ajax_search_filter_params.ajax_url,
        type: "POST",
        data: data,
        beforeSend: function () {
            $("#search-filtered-posts").html("<p class='white-color'>Loading...</p>");
        },
        success: function (response) {
            $("#search-filtered-posts").html(response);
            updateTags();
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            $("#search-filtered-posts").html("<p>An error occurred while fetching posts.</p>");
        },
    });
}

    // --- Update browser URL dynamically ---
    function updateUrl() {
        const industry = industryDropdown.value;
        const category = categoryDropdown.value;
        let search = searchInput.value.trim().replace(/\s+/g, '-');

        const filterParts = [];
        if (search) filterParts.push(search);
        if (industry) filterParts.push(industry);
        if (category) filterParts.push(category);

        const newUrl = filterParts.length > 0
            ? `/case_studies?filter=${filterParts.join('/')}`
            : `/case_studies`;

        window.history.pushState({}, '', newUrl);
    }

    // --- Update Breadcrumbs ---
    function updateBreadcrumbs() {
        const searchVal = searchInput?.value.trim();
        const categorySlug = categoryDropdown?.value;
        const categoryText = categoryDropdown?.options[categoryDropdown.selectedIndex]?.text;
        const industrySlug = industryDropdown?.value;
        const industryText = industryDropdown?.options[industryDropdown.selectedIndex]?.text;

        const isFilterActive = searchVal || categorySlug || industrySlug;

        // If no filters are applied, don't change the default breadcrumb
        if (!isFilterActive) return;

        let html = `<a href="${window.location.origin}">Our Work</a> 
                    <span class="dot-seperate" aria-hidden="true"></span> 
                    <span class="white-color">Case Studies</span>`;

        if (searchVal) {
            html += ` <span class="dot-seperate" aria-hidden="true"></span> <span>${searchVal}</span>`;
        }
        if (industrySlug) {
            html += ` <span class="dot-seperate" aria-hidden="true"></span> <span>${industryText}</span>`;
        }
        if (categorySlug) {
            html += ` <span class="dot-seperate" aria-hidden="true"></span> <span>${categoryText}</span>`;
        }

        if (breadcrumbContainer) {
            breadcrumbContainer.innerHTML = html;
        }
    }


    // --- AJAX Fetch ---
    function fetchPosts() {
        const filters = {
            action: "filter_search_articles",
            category_slug: $("#search-category-dropdown").val(),
            industry_slug: $("#search-industry-dropdown").val(),
            search: $("#search-input").val().trim(),
        };

        $.ajax({
            url: ajax_search_filter_params.ajax_url,
            type: "POST",
            data: filters,
            beforeSend: function () {
                $("#search-filtered-posts").html("<p class='white-color'>Loading...</p>");
            },
            success: function (response) {
                $("#search-filtered-posts").html(response);
                updateTags();
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                $("#search-filtered-posts").html("<p>An error occurred while fetching posts.</p>");
            },
        });
    }

    // --- Update enabled/disabled tags based on result ---
    function updateTags() {
        let visibleTags = new Set();
        $(".custom-tag-link").removeClass("enabled").addClass("disabled-tag");

        $("#search-filtered-posts .grid-item:visible").each(function () {
            $(this).find(".custom-tag-link").each(function () {
                let tagID = $(this).data("tag-id");
                visibleTags.add(tagID);
            });
        });

        $(".articles-tags .custom-tag-link").each(function () {
            let tagID = $(this).data("tag-id");
            if (visibleTags.has(tagID)) {
                $(this).removeClass("disabled-tag").addClass("enabled");
            }
        });
    }

    // --- Tag selection logic ---
    $(document).on("click", ".custom-tag-link.enabled", function () {
        const tagID = $(this).data("tag-id");

        if (selectedTags.includes(tagID)) {
            selectedTags = selectedTags.filter(id => id !== tagID);
            $(this).removeClass("selected-tag");
        } else {
            if (selectedTags.length < 7) {
                selectedTags.push(tagID);
                $(this).addClass("selected-tag");
            } else {
                alert("You can only select up to 7 tags.");
            }
        }

        $(".grid-item .custom-tag-link").each(function () {
            const tagLinkID = $(this).data("tag-id");
            $(this).toggleClass("selected-tag", selectedTags.includes(tagLinkID));
        });

        $(".custom-tag-count").toggleClass("highlighted-tag", selectedTags.length > 2);
    });

    // --- Fetch on page load if filters are present ---
    // function fetchFilteredPostsOnLoad() {
    //     const industry = industryDropdown.value;
    //     const category = categoryDropdown.value;
    //     const search = searchInput.value;

    //     if (search || industry || category) {
    //         const data = new FormData();
    //         data.append('action', 'filter_search_articles');
    //         data.append('search', search);
    //         data.append('industry_slug', industry);
    //         data.append('category_slug', category);

    //         fetch(ajax_search_filter_params.ajax_url, {
    //             method: 'POST',
    //             body: data
    //         })
    //         .then(response => response.text())
    //         .then(result => {
    //             document.getElementById('search-filtered-posts').innerHTML = result;
    //             updateTags();
    //         })
    //         .catch(error => {
    //             console.error('Error fetching posts:', error);
    //             $("#search-filtered-posts").html("<p>An error occurred while fetching posts.</p>");
    //         });
    //     }
    // }

    // --- Bind filter input change events ---
    $("#search-category-dropdown, #search-industry-dropdown").on("change", () => {
        updateUrl();
        fetchPosts();
        updateBreadcrumbs();
    });

    $("#search-input").on("input", () => {
        updateUrl();
        fetchPosts();
        updateBreadcrumbs();
    });

    $("#search-input").on("keypress", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            updateUrl();
            fetchPosts();
            updateBreadcrumbs();
        }
    });

    // --- On page load ---
    updateDropdownsFromURL();
    fetchPostsAfterURLPrefill();
    updateBreadcrumbs();

});
