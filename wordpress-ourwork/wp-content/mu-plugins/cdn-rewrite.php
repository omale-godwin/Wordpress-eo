<?php
// Only modify uploads URLs, leave other content URLs intact
add_filter('upload_dir', function($uploads) {
    $uploads['baseurl'] = 'https://cdn.electricoctopus.agency/blogupload';
    $uploads['url'] = $uploads['baseurl'] . $uploads['subdir'];
    return $uploads;
});

// Rewrite existing media URLs
add_filter('wp_get_attachment_url', function($url) {
    return str_replace(
        'https://blog.electricoctopus.agency/wp-content/uploads/',
        'https://cdn.electricoctopus.agency/blogupload/',
        $url
    );
});
