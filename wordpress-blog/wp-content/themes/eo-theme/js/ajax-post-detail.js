jQuery(document).ready(function ($) {
    // Click event for post links
    $('.recent-post-block a').on('click', function (e) {
        e.preventDefault(); // Prevent default link behavior
        
        var postURL = $(this).attr('href'); // Get the post URL
        
        $.ajax({
            url: postURL, // Use the post URL to fetch content
            type: 'GET',
            success: function (response) {
                // Extract the post content from the response
                var newContent = $(response).find('.main-body-container').html();

                // Replace the current content
                $('.main-body-container').html(newContent);
                window.history.pushState(null, '', postURL); // Update the browser's URL
            },
            error: function () {
                alert('Failed to load the post. Please try again.');
            }
        });
    });
});
