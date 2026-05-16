jQuery(document).ready(function ($) {
    const $scrollButton = $('#scroll-button');
    const $sections = $('.section'); // Update with the class of your sections
    let currentSectionIndex = 0;

    const scrollToSection = (index) => {
        $('html, body').animate({
            scrollTop: $sections.eq(index).offset().top
        }, 800);
        currentSectionIndex = index;
    };

    const checkScrollButton = () => {
        if (currentSectionIndex >= $sections.length - 1) {
            $scrollButton.fadeOut(); // Hide button when at the last section
        } else {
            $scrollButton.fadeIn(); // Show button otherwise
        }
    };

    $scrollButton.on('click', function () {
        if (currentSectionIndex < $sections.length - 1) {
            scrollToSection(currentSectionIndex + 1);
        }
    });

    $(window).on('scroll', function () {
        const scrollY = $(this).scrollTop() + $(this).height() / 2;
        $sections.each(function (index) {
            const $section = $(this);
            if (scrollY >= $section.offset().top && scrollY < $section.offset().top + $section.outerHeight()) {
                currentSectionIndex = index;
                checkScrollButton();
            }
        });
    });

    // Initial check
    checkScrollButton();
});
