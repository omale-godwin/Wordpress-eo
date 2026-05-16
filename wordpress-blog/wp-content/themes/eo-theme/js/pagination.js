
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
