// search filter

document.addEventListener('DOMContentLoaded', function() {
    const industryDropdown = document.getElementById('search-industry-dropdown');
    const categoryDropdown = document.getElementById('search-category-dropdown');
    const searchInput = document.getElementById('search-input');
    
    // Ensure the filter params are already populated from the URL on page load
    function updateDropdownsFromURL() {
        const params = new URLSearchParams(window.location.search);
        const filter = params.get('filter');
        if (filter) {
            const filterParams = filter.split('/');
            if (filterParams[0]) searchInput.value = filterParams[0];  // Set search term
            if (filterParams[2]) industryDropdown.value = filterParams[2];  // Set industry
            if (filterParams[1]) categoryDropdown.value = filterParams[1];  // Set category
        }
    }

    function updateUrl() {
        const industry = industryDropdown.value;
        const category = categoryDropdown.value;
        let search = searchInput.value;

        // Replace spaces with hyphens for URL compatibility
        search = search.replace(/\s+/g, '-');

        // Build the filter string: search/category/industry
        let filter = '';
        if ( search ) {
            filter += search;
        }
        if ( industry ) {
            filter += '/' + industry;
        }
        if ( category ) {
            filter += '/' + category;
        }
        

        // Update the URL path (modify the path if needed)
        if (filter) {
            window.history.pushState({}, '', '/case_studies?filter=' + filter);
        } else {
            window.history.pushState({}, '', '/case_studies');
        }
    }

    // Add event listeners to update URL when dropdown or input changes
    industryDropdown.addEventListener('change', updateUrl);
    categoryDropdown.addEventListener('change', updateUrl);
    searchInput.addEventListener('input', updateUrl);

    // On page load, make sure the dropdowns are initialized from the URL
    updateDropdownsFromURL();
});
document.addEventListener('DOMContentLoaded', function () {
    const industryDropdown = document.getElementById('search-industry-dropdown');
    const categoryDropdown = document.getElementById('search-category-dropdown');
    const searchInput = document.getElementById('search-input');
    const breadcrumbContainer = document.querySelector('.breadcrumb-container');

    // Get the post title from a hidden span or data attribute
    const postTitle = document.querySelector('.breadcrumb-container')?.dataset?.postTitle || '';

    function updateBreadcrumbs() {
        const homeUrl = window.location.origin;
        let html = `<a href="${homeUrl}">Our Work</a> 
                    <span class="dot-seperate"> </span> 
                    <span class="white-color">Case Studies</span>`;

        const searchVal = searchInput?.value.trim();
        const categorySlug = categoryDropdown?.value;
        const categoryText = categoryDropdown?.options[categoryDropdown.selectedIndex]?.text;
        const industrySlug = industryDropdown?.value;
        const industryText = industryDropdown?.options[industryDropdown.selectedIndex]?.text;

        const isFilterActive = searchVal || industrySlug || categorySlug;

        // If no filters, show post title
        if (!isFilterActive && postTitle) {
            html += ` <span class="dot-seperate"> </span> <span>${postTitle}</span>`;
        }

        // If filters are selected
        if (searchVal) {
            html += ` <span class="dot-seperate"> </span> <span>${searchVal}</span>`;
        }

        if (industrySlug) {
            html += ` <span class="dot-seperate"> </span> <span>${industryText}</span>`;
        }

        if (categorySlug) {
            html += ` <span class="dot-seperate"> </span> <span>${categoryText}</span>`;
        }

        breadcrumbContainer.innerHTML = html;
    }

    // Event listeners
    industryDropdown?.addEventListener('change', updateBreadcrumbs);
    categoryDropdown?.addEventListener('change', updateBreadcrumbs);
    searchInput?.addEventListener('input', updateBreadcrumbs);

    updateBreadcrumbs();
});