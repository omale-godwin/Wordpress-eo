jQuery(document).ready(function ($) {
    let selectedTags = [];

    function fetchFilters(paged = 1) {
        const category = $("#news-category-dropdown").val();
        const search = $("#announcement-search-input").val().trim();

        // 🔔 Fetch Announcements
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: "POST",
            data: {
                action: "filter_announcements",
                category_slug: category,
                search: search,
            },
            beforeSend: function () {
                $("#announcement-section").html("<p class='mt-24 white'>Loading announcements...</p>");
            },
            success: function (response) {
                $("#announcement-section").html(response);
                reinitializeAnnouncementSlider();
                updateTags(); // 👈 Update tag availability
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error (announcements):", status, error);
                $("#announcement-section").html("<p class='mt-24'>An error occurred while fetching announcements.</p>");
            },
        });

        // 📰 Fetch News
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: "POST",
            data: {
                action: "filter_news",
                category_slug: category,
                search: search,
                paged: paged,
            },
            beforeSend: function () {
                $("#news-section").html("<p class='mt-24'>Loading news...</p>");
            },
            success: function (response) {
                $("#news-section").html(response);
                updateTags(); // 👈 Update tag availability
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error (news):", status, error);
                $("#news-section").html("<p class='mt-24'>An error occurred while fetching news.</p>");
            },
        });
    }

    // ✅ Reinitialize Slick slider after AJAX loads new announcements
    function reinitializeAnnouncementSlider() {
        const $slider = $(".announcement-slider");

        if ($slider.hasClass("slick-initialized")) {
            $slider.slick("unslick");
        }

        $slider.slick({
            dots: true,
            infinite: true,
            arrows: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
        });
    }

    // 🧠 Enable only visible tags based on current filters
    function updateTags() {
        let selectedCategory = $("#news-category-dropdown").val();
        let searchQuery = $("#announcement-search-input").val().trim().toLowerCase();

        $(".tag-link").removeClass("enabled").addClass("disabled-tag");

        const visibleTags = new Set();

        if (selectedCategory || searchQuery.length > 0) {
            $(".announcement-post, .news-post").each(function () {
                $(this).find(".tag-link").each(function () {
                    const tagID = $(this).data("tag-id");
                    visibleTags.add(tagID);
                });
            });

            $(".news-tags .tag-link").each(function () {
                const tagID = $(this).data("tag-id");
                if (visibleTags.has(tagID)) {
                    $(this).removeClass("disabled-tag").addClass("enabled");
                }
            });
        }
    }

    // ✳️ Tag selection (limit 7)
    $(document).on("click", ".tag-link.enabled", function () {
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

        // Highlight matching tags
        $(".tag-link").each(function () {
            const tagLinkID = $(this).data("tag-id");
            $(this).toggleClass("selected-tag", selectedTags.includes(tagLinkID));
        });

        // Highlight tag count
        $(".custom-tag-count").toggleClass("highlighted-tag", selectedTags.length > 2);
    });

    // 🎯 Auto-submit filter on input change
    $("#news-category-dropdown, #announcement-search-input").on("change input", function () {
        fetchFilters();
    });
    // 🧾 Form submit triggers fetchFilters (for Enter key or button click)
    $("#announcement-search-form").on("submit", function (e) {
        e.preventDefault();
        fetchFilters();
    });

    // 🔁 AJAX Pagination
    $(document).on("click", ".news-pagination a", function (e) {
        e.preventDefault();
        const paged = $(this).data("page");
        fetchFilters(paged);
    });

    // 🏁 First Load
    fetchFilters();
});
