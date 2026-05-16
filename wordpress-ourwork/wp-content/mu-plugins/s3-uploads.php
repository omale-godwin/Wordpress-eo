<?php
/*
Plugin Name: DigitalOcean Spaces Uploads Integration
Description: Custom implementation for uploading media to DigitalOcean Spaces
*/

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

// Define DigitalOcean Spaces settings from environment variables
define('S3_UPLOADS_BUCKET', getenv('S3_BUCKET_NAME'));
define('S3_UPLOADS_REGION', getenv('AWS_REGION'));
define('S3_UPLOADS_KEY', getenv('AWS_ACCESS_KEY_ID'));
define('S3_UPLOADS_SECRET', getenv('AWS_SECRET_ACCESS_KEY'));
define('S3_UPLOADS_PREFIX', 'ourwork/uploads' ?: 'ourwork/uploads');
define('S3_UPLOADS_ENDPOINT', getenv('SPACES_ENDPOINT') ?: 'https://lon1.digitaloceanspaces.com/');
define('CDN_DOMAIN', getenv('CLOUDFRONT_DOMAIN'));

// Initialize the S3 client for DigitalOcean Spaces
function s3_uploads_init_s3_client() {
    if (!class_exists('Aws\S3\S3Client')) {
        require_once '/bitnami/wordpress/wp-content/vendor/autoload.php';
    }

    return new Aws\S3\S3Client([
        'version' => 'latest',
        'region'  => S3_UPLOADS_REGION,
        'endpoint' => S3_UPLOADS_ENDPOINT,
        'credentials' => [
            'key'    => S3_UPLOADS_KEY,
            'secret' => S3_UPLOADS_SECRET,
        ],
        'bucket_endpoint' => false,
        'use_path_style_endpoint' => true,
        'http' => [
            'timeout' => 30,
            'connect_timeout' => 10
        ]
    ]);
}

// Upload files to DigitalOcean Spaces
function s3_uploads_upload_to_s3($file, $new_file, $type) {
    $s3 = s3_uploads_init_s3_client();
    
    try {
        $s3->putObject([
            'Bucket' => S3_UPLOADS_BUCKET,
            'Key'    => S3_UPLOADS_PREFIX . '/' . $new_file,
            'Body'   => fopen($file['file'], 'rb'),
            'ACL'    => 'public-read',
            'ContentType' => $type,
        ]);
        
        // Clean up local file after successful upload
        @unlink($file['file']);
        
        return true;
    } catch (Exception $e) {
        error_log('DigitalOcean Spaces Upload Error: ' . $e->getMessage());
        return false;
    }
}

// SIMPLE AND RELIABLE DETECTION: Check if this is a plugin/theme upload
function s3_uploads_should_handle_upload() {
    // Check if we're on the plugin or theme install pages
    if (isset($_GET['action']) && in_array($_GET['action'], ['upload-plugin', 'upload-theme'])) {
        return false;
    }
    
    // Check if the current screen is plugin/theme installation
    if (function_exists('get_current_screen')) {
        $screen = get_current_screen();
        if ($screen && in_array($screen->id, ['plugin-install', 'theme-install'])) {
            return false;
        }
    }
    
    // Check POST data for plugin/theme upload actions
    if (isset($_POST['action']) && in_array($_POST['action'], ['upload-plugin', 'upload-theme'])) {
        return false;
    }
    
    // Check the referrer URL
    if (isset($_SERVER['HTTP_REFERER'])) {
        if (strpos($_SERVER['HTTP_REFERER'], 'theme-install.php') !== false || 
            strpos($_SERVER['HTTP_REFERER'], 'plugin-install.php') !== false) {
            return false;
        }
    }
    
    // Check if this is an update process
    if (doing_action('upgrader_process_complete') || 
        doing_action('upgrader_pre_install') ||
        doing_action('upgrader_post_install')) {
        return false;
    }
    
    return true;
}

// Handle image upload and all generated thumbnails - ONLY for media
add_filter('wp_generate_attachment_metadata', 's3_uploads_handle_attachment_metadata', 10, 2);

function s3_uploads_handle_attachment_metadata($metadata, $attachment_id) {
    // Only process if this should be handled by our plugin
    if (!s3_uploads_should_handle_upload()) {
        return $metadata;
    }
    
    // Additional safety: ensure this is an attachment
    $post = get_post($attachment_id);
    if (!$post || $post->post_type !== 'attachment') {
        return $metadata;
    }

    $upload_dir = wp_upload_dir();
    $file = get_attached_file($attachment_id);
    
    // Upload original file if it exists locally
    if (file_exists($file)) {
        $relative_path = str_replace($upload_dir['basedir'] . '/', '', $file);
        s3_uploads_upload_to_s3([
            'file' => $file,
            'type' => get_post_mime_type($attachment_id)
        ], $relative_path, get_post_mime_type($attachment_id));
    }

    // Upload all generated thumbnails
    if (!empty($metadata['sizes'])) {
        foreach ($metadata['sizes'] as $size => $size_data) {
            $thumbnail_path = $upload_dir['basedir'] . '/' . dirname($metadata['file']) . '/' . $size_data['file'];
            
            if (file_exists($thumbnail_path)) {
                $relative_thumb_path = str_replace($upload_dir['basedir'] . '/', '', $thumbnail_path);
                s3_uploads_upload_to_s3([
                    'file' => $thumbnail_path,
                    'type' => $size_data['mime-type']
                ], $relative_thumb_path, $size_data['mime-type']);
                
                // Clean up local thumbnail file
                @unlink($thumbnail_path);
            }
        }
    }
    
    return $metadata;
}

// Hook into WordPress upload process - WITH PRIORITY CHANGE
add_filter('wp_handle_upload', 's3_uploads_handle_upload', 5, 2); // Lower priority

function s3_uploads_handle_upload($file, $context) {
    // Only process uploads (not other contexts) and only if we should handle them
    if ($context !== 'upload' || !s3_uploads_should_handle_upload()) {
        return $file;
    }
    
    // Additional safety: check if this looks like a media file, not a plugin/theme zip
    $file_info = wp_check_filetype($file['file']);
    if (!$file_info['type'] || in_array($file_info['ext'], ['zip', 'gz', 'tar'])) {
        // This might be a plugin/theme file, don't process
        return $file;
    }
    
    $new_file = str_replace(wp_upload_dir()['basedir'] . '/', '', $file['file']);
    if (s3_uploads_upload_to_s3($file, $new_file, $file['type'])) {
        $file['url'] = str_replace(
            wp_upload_dir()['baseurl'],
            CDN_DOMAIN . '/' . S3_UPLOADS_PREFIX,
            $file['url']
        );
    }
    
    return $file;
}

// ALTERNATIVE APPROACH: Remove filters during plugin/theme uploads
add_action('load-plugin-install.php', 's3_uploads_remove_filters');
add_action('load-theme-install.php', 's3_uploads_remove_filters');
add_action('load-update.php', 's3_uploads_remove_filters');

function s3_uploads_remove_filters() {
    remove_filter('wp_handle_upload', 's3_uploads_handle_upload', 5);
    remove_filter('wp_generate_attachment_metadata', 's3_uploads_handle_attachment_metadata', 10);
}

// Re-add filters after plugin/theme upload pages
add_action('admin_head', 's3_uploads_maybe_readd_filters');

function s3_uploads_maybe_readd_filters() {
    $screen = get_current_screen();
    if (!$screen || !in_array($screen->id, ['plugin-install', 'theme-install', 'update'])) {
        // Only add if not already added
        if (!has_filter('wp_handle_upload', 's3_uploads_handle_upload')) {
            add_filter('wp_handle_upload', 's3_uploads_handle_upload', 5, 2);
        }
        if (!has_filter('wp_generate_attachment_metadata', 's3_uploads_handle_attachment_metadata')) {
            add_filter('wp_generate_attachment_metadata', 's3_uploads_handle_attachment_metadata', 10, 2);
        }
    }
}

// Filter URLs to use CDN - These are safe as they only affect media display
add_filter('wp_get_attachment_url', 's3_uploads_attachment_url', 9, 2);
add_filter('wp_calculate_image_srcset', 's3_uploads_attachment_srcset', 10, 5);
add_filter('attachment_link', 's3_uploads_attachment_url', 10, 2);

function s3_uploads_attachment_url($url, $post_id) {
    // Only modify URLs for actual attachments
    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'attachment') {
        return $url;
    }
    
    $upload_dir = wp_upload_dir();
    $pattern = '#^' . preg_quote($upload_dir['baseurl'], '#') . '#';
    return preg_replace($pattern, CDN_DOMAIN . '/' . S3_UPLOADS_PREFIX, $url);
}

function s3_uploads_attachment_srcset($sources, $size_array, $image_src, $image_meta, $attachment_id) {
    // Only modify sources for actual attachments
    $post = get_post($attachment_id);
    if (!$post || $post->post_type !== 'attachment') {
        return $sources;
    }
    
    foreach ($sources as &$source) {
        $source['url'] = s3_uploads_attachment_url($source['url'], $attachment_id);
    }
    return $sources;
}

// Clean up Spaces files when attachments are deleted
add_action('delete_attachment', 's3_uploads_delete_attachment');

function s3_uploads_delete_attachment($post_id) {
    // Only process if this is actually an attachment
    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'attachment') {
        return;
    }
    
    $s3 = s3_uploads_init_s3_client();
    $metadata = wp_get_attachment_metadata($post_id);
    $upload_dir = wp_upload_dir();
    
    // Delete original file
    $file = get_attached_file($post_id);
    if ($file) {
        $relative_path = str_replace($upload_dir['basedir'] . '/', '', $file);
        try {
            $s3->deleteObject([
                'Bucket' => S3_UPLOADS_BUCKET,
                'Key'    => S3_UPLOADS_PREFIX . '/' . $relative_path
            ]);
        } catch (Exception $e) {
            error_log('DigitalOcean Spaces Delete Error: ' . $e->getMessage());
        }
    }
    
    // Delete all thumbnails
    if (!empty($metadata['sizes'])) {
        foreach ($metadata['sizes'] as $size => $size_data) {
            $thumbnail_path = $upload_dir['basedir'] . '/' . dirname($metadata['file']) . '/' . $size_data['file'];
            $relative_thumb_path = str_replace($upload_dir['basedir'] . '/', '', $thumbnail_path);
            
            try {
                $s3->deleteObject([
                    'Bucket' => S3_UPLOADS_BUCKET,
                    'Key'    => S3_UPLOADS_PREFIX . '/' . $relative_thumb_path
                ]);
            } catch (Exception $e) {
                error_log('DigitalOcean Spaces Thumbnail Delete Error: ' . $e->getMessage());
            }
        }
    }
}