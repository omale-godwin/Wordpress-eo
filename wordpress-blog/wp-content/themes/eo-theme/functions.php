<?php
/**
 * OC-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OC-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function oc_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on OC-theme, use a find and replace
		* to change 'oc-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'oc-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'oc-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'oc_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'oc_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function oc_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'oc_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'oc_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function oc_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => __('Custom Sidebar', 'textdomain'),
            'id'            => 'custom-sidebar',
            'description'   => __('A custom sidebar for blog widgets.', 'textdomain'),
            'before_widget' => '<div class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'oc_theme_widgets_init' );
function custom_sidebar_customizer($wp_customize) {
    $wp_customize->add_section('custom_sidebar_section', array(
        'title'    => __('Author Sidebar', 'textdomain'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('author_image_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'author_image_url', array(
        'label'    => __('Author Image', 'textdomain'),
        'section'  => 'custom_sidebar_section',
        'settings' => 'author_image_url',
    )));
    $wp_customize->add_setting('linkedin_image_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'linkedin_image_url', array(
        'label'    => __('LinkedIn Image', 'textdomain'),
        'section'  => 'custom_sidebar_section',
        'settings' => 'linkedin_image_url',
    )));
    
    $wp_customize->add_setting('linkedin_profile_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('linkedin_profile_url', array(
        'label'    => __('LinkedIn Profile URL', 'textdomain'),
        'section'  => 'custom_sidebar_section',
        'type'     => 'url',
    ));
    

    $wp_customize->add_setting('author_name', array(
        'default' => 'Default Author',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('author_name', array(
        'label'    => __('Author Name', 'textdomain'),
        'section'  => 'custom_sidebar_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('author_title', array(
        'default' => 'Default Title',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('author_title', array(
        'label'    => __('Author Title', 'textdomain'),
        'section'  => 'custom_sidebar_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('author_description', array(
        'default' => 'Default description here.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('author_description', array(
        'label'    => __('Author Description', 'textdomain'),
        'section'  => 'custom_sidebar_section',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'custom_sidebar_customizer');

/**
 * Enqueue scripts and styles.
 */
function oc_theme_scripts() {
	wp_enqueue_style( 'oc-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'oc-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'oc-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'oc_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Enable theme support for menus
function theme_setup() {
    add_theme_support('menus');
}
add_action('after_setup_theme', 'theme_setup');

add_filter( 'body_class', function( $classes ) {
    // Keep only specific classes you want
    $allowed = [
        'home',       // keep home page class
        'page-template-template-home', // example: keep layout info
    ];
    return array_intersect( $classes, $allowed );
});


// Register a custom menu location

function register_custom_menu() {
    register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'register_custom_menu');
//registermenu buttons     
function register_custom_menu_button() {
    register_nav_menu('header-buttons', __('Header Buttons'));
}
add_action('after_setup_theme', 'register_custom_menu_button');


function enqueue_theme_styles() {
    // Get the theme directory URI
    $theme_dir = get_template_directory_uri();

    // Array of stylesheets to enqueue
    $stylesheets = array(
        'header-style'    => '/css/header.css',
        'custom-style'    => '/css/custom-style.css',
        'detail-style'    => '/css/detail-page.css',
        'footer-style'    => '/css/foot.css',
        'responsive-style'=> '/css/responsive.css',
        'sidebar-style'   => '/css/sidebar.css',
    );

    // Enqueue each stylesheet
    foreach ($stylesheets as $handle => $path) {
        wp_enqueue_style($handle, $theme_dir . $path, array(), '1.0', 'all');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

//slick slider
function enqueue_slick_slider() {
    // Enqueue Slick CSS files
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/slick/slick.css');
    wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/slick/slick-theme.css');
    wp_enqueue_style('slick-font-override', get_template_directory_uri() . '/css/slick-font-override.css', array('slick-theme-css'), null);

    
    // Enqueue Slick JS file
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/slick/slick.min.js', array('jquery'), null, true);

    // Initialize Slick Slider
    wp_add_inline_script('slick-js', 'jQuery(document).ready(function($){ $(".featured-post-slider").slick({ autoplay: false, dots: true, arrows: true, slidesToShow: 1 }); });');
    wp_add_inline_script('slick-js', 'jQuery(document).ready(function($){ $(".announcement-slider").slick({ autoplay: false, dots: true, arrows: true, slidesToShow: 1 }); });');
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider');
// accept webp file
function allow_webp_uploads( $mime_types ) {
    $mime_types['webp'] = 'image/webp';
    return $mime_types;
}
add_filter( 'mime_types', 'allow_webp_uploads' );
//footer menu
// Register Footer Menus
function register_footer_menus() {
    register_nav_menus(array(
        'footer-agency' => __('Footer Agency Menu'),
        'footer-platform' => __('Footer Platform Menu'),
        'footer-client-management' => __('Footer client Management Menu'),
        'footer-resources' => __('Footer Resources Menu'),
        'footer-solutions' => __('Footer Solutions Menu'),
        'footer-hubs' => __('Footer Hubs Menu'),
        'footer-support' => __('Footer Support Menu'),
    ));
}
add_action('init', 'register_footer_menus');

// Register Footer Widget Area
function footer_widgets_init() {
    register_sidebar(array(
        'name' => 'Footer Left Section',
        'id' => 'footer-left',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'footer_widgets_init');
// Register Footer Widget Area
function footer_social_media_init() {
    register_sidebar(array(
        'name' => 'Footer Social Media  Section',
        'id' => 'sicial-media',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'footer_social_media_init');


//custom script add
function theme_enqueue_scripts() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
//add featued post option
// Add Featured column to articles list in admin
function add_featured_column($columns) {
    $columns['is_featured'] = 'Featured';
    return $columns;
}
add_filter('manage_articles_posts_columns', 'add_featured_column');

// Display content in Featured column
function display_featured_column($column, $post_id) {
    if ($column === 'is_featured') {
        $is_featured = get_post_meta($post_id, 'is_featured', true);
        echo $is_featured == '1' ? 'Yes' : 'No';
    }
}
add_action('manage_articles_posts_custom_column', 'display_featured_column', 10, 2);

// Make Featured column sortable
function make_featured_column_sortable($columns) {
    $columns['is_featured'] = 'is_featured';
    return $columns;
}
add_filter('manage_edit-articles_sortable_columns', 'make_featured_column_sortable');

// Sorting behavior for Featured column
function sort_featured_column($query) {
    if (!is_admin()) return;

    $orderby = $query->get('orderby');
    if ($orderby == 'is_featured') {
        $query->set('meta_key', 'is_featured');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'sort_featured_column');

// Display content in announcement column
function order_latest_announcements_first($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('announce_news_post')) {
        $query->set('meta_key', 'is_latest_announcement');
        $query->set('orderby', array(
            'meta_value' => 'DESC',
            'date' => 'DESC'
        ));
    }
}
add_action('pre_get_posts', 'order_latest_announcements_first');

function display_announcement_column($column, $post_id) {
    if ($column === 'is_announcement') {
        $is_announcement = get_post_meta($post_id, 'is_announcement', true);
        echo $is_announcement == '1' ? 'Yes' : 'No';
    }
}
add_action('manage_articles_posts_custom_column', 'display_announcement_column', 10, 2);
//fliter fuctionality for articles
function custom_enqueue_scripts() {
    wp_enqueue_script( 'ajax-filter', get_template_directory_uri() . '/js/ajax-filter.js', array('jquery'), null, true );

    wp_localize_script( 'ajax-filter', 'ajax_filter_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ));
}
add_action( 'wp_enqueue_scripts', 'custom_enqueue_scripts' );

require get_template_directory() . '/ajax-handlers/filter-articles.php';
add_action( 'wp_ajax_filter_articles', 'filter_articles' );
add_action( 'wp_ajax_nopriv_filter_articles', 'filter_articles' );
// filter article end

// Search filter functionality for articles
function enqueue_article_search_scripts() {
    if ( is_post_type_archive('articles') || is_singular('articles') ) {
        wp_enqueue_script('ajax-search-filter', get_template_directory_uri() . '/js/ajax-search-filter.js', array('jquery'), null, true);

        wp_localize_script('ajax-search-filter', 'ajax_search_filter_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_article_search_scripts');

// Handle AJAX for article search
require get_template_directory() . '/ajax-handlers/filter-search-articles.php';
add_action('wp_ajax_filter_search_articles', 'filter_search_articles');
add_action('wp_ajax_nopriv_filter_search_articles', 'filter_search_articles');

// Handle AJAX for announcement/news search
require get_template_directory() . '/ajax-handlers/filter-search-announcement-news.php';
add_action('wp_ajax_filter_search_news', 'filter_search_news');
add_action('wp_ajax_nopriv_filter_search_news', 'filter_search_news');
function enqueue_announcement_news_scripts() {
    wp_enqueue_script('announcement-news-filter', get_template_directory_uri() . '/custom-scripts/serch-announcement-news-filter.js', array(), '1.0', true);

    wp_localize_script('announcement-news-filter', 'ajax_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_announcement_news_scripts');

// filter announcements & news end
// Create the AJAX Handler for announcement
require get_template_directory() . '/ajax-handlers/filter-announcements-news.php';
add_action('wp_ajax_filter_announcements_news', 'filter_announcements_news');
add_action('wp_ajax_nopriv_filter_announcements_news', 'filter_announcements_news');

//fliter fuctionality for category dropdown
function enqueue_filter_script() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('announcement-filter', get_template_directory_uri() . '/js/announcement-filter.js', array('jquery'), null, true);

    // Localize AJAX URL for WordPress
    wp_localize_script('announcement-filter', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_filter_script');

//ajax post detail
function enqueue_ajax_post_detail_script() {
    wp_enqueue_script('ajax-post-detail', get_template_directory_uri() . '/js/ajax-post-detail.js', array('jquery'), null, true);

    // Localize script to pass Ajax URL to JavaScript
    wp_localize_script('ajax-post-detail', 'ajaxPostDetail', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_post_detail_script');
//script for dropdown menu
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $icon_url = get_field('menu_icon', $item); // Get ACF Image URL
        $description = !empty($item->description) ? esc_html($item->description) : '';

        $output .= '<li class="menu-item ' . implode(" ", $item->classes) . '">';

        $output .= '<a href="' . esc_url($item->url) . '">';

        if ($depth > 0) { // Only apply custom structure for submenu items
            $output .= '<div class="css-1pk539k">';
            if ($icon_url) {
                $output .= '<img alt="menu icon" src="' . esc_url($icon_url) . '" class="chakra-image css-0">';
            }
            $output .= '<div class="css-1u0wnaw">';
            $output .= '<h3>' . esc_html($item->title) . '</h3>';
            if ($description) {
                $output .= '<p class="css-14u2thu">' . $description . '</p>';
            }
            $output .= '</div></div>';
        } else {
            $output .= esc_html($item->title);
        }

        $output .= '</a>';
    }
}
function custom_dropdown_scripts() {
    wp_enqueue_script('jquery'); // Ensure jQuery is loaded
    wp_enqueue_script('dropdown-menu', get_template_directory_uri() . '/js/dropdown-menu.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'custom_dropdown_scripts');
// newsletter form validation
function enqueue_custom_scripts() {
    wp_enqueue_script('jquery'); // Ensure jQuery is loaded
    wp_enqueue_script('newsletter-validation', get_template_directory_uri() . '/js/newsletter-validation.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
//zapier
// Define the AJAX function for pagination
require get_template_directory() . '/ajax-handlers/ajax-load-posts.php';
// Add the action hooks for AJAX requests
add_action('wp_ajax_load_posts', 'ajax_load_posts');
add_action('wp_ajax_nopriv_load_posts', 'ajax_load_posts');
require get_template_directory() . '/ajax-handlers/ajax-load-news-posts.php';
// Add the action hooks for AJAX requests
add_action('wp_ajax_load_news_posts', 'ajax_load_news_posts');
add_action('wp_ajax_nopriv_load_news_posts', 'ajax_load_news_posts');
// dynamic url
function custom_filter_articles_by_url_params($query) {
    // Only modify query on the front page for the 'articles' post type
    if ( !is_admin() && $query->is_main_query() && is_front_page() && isset($_GET['filter']) ) {
        
        // Parse the filter parameter from the URL
        $filter = sanitize_text_field($_GET['filter']);
        $filter_params = explode('/', $filter);  // Split filter string (industry/category/search)

        $tax_query = array('relation' => 'OR');

        // Handle Industry Filter
        if ( isset($filter_params[0]) && !empty($filter_params[0]) ) {
            $industry_slug = $filter_params[0];
            $tax_query[] = array(
                'taxonomy' => 'article_industry',
                'field'    => 'slug',
                'terms'    => $industry_slug,
            );
        }

        // Handle Category Filter
        if ( isset($filter_params[1]) && !empty($filter_params[1]) ) {
            $category_slug = $filter_params[1];
            $tax_query[] = array(
                'taxonomy' => 'article_category',
                'field'    => 'slug',
                'terms'    => $category_slug,
            );
        }

        // If tax query is built, apply it
        if ( count($tax_query) > 1 ) {
            $query->set('tax_query', $tax_query);
        }

        // Handle Search Filter (if present)
        if ( isset($filter_params[2]) && !empty($filter_params[2]) ) {
            $search_term = sanitize_text_field($filter_params[2]);
            $query->set('s', $search_term);
        }
    }
}
add_action('pre_get_posts', 'custom_filter_articles_by_url_params');

function register_query_vars($vars) {
    $vars[] = 'article_industry';
    $vars[] = 'category';
    return $vars;
}
add_filter('query_vars', 'register_query_vars');
// announcement & news
function custom_news_permalink($post_link, $post) {
    if ($post->post_type === 'news') {
        $is_announcement = get_post_meta($post->ID, 'is_announcement', true);
        
        if ($is_announcement == '1') {
            return home_url('/announcements/' . $post->post_name . '/');
        } else {
            return home_url('/news/' . $post->post_name . '/');
        }
    }
    return $post_link;
}
add_filter('post_type_link', 'custom_news_permalink', 10, 2);
function custom_news_rewrite_rules() {
    add_rewrite_rule('announcements/([^/]+)/?$', 'index.php?announcements_news=$matches[1]', 'top');
    add_rewrite_rule('news/([^/]+)/?$', 'index.php?announcements_news=$matches[1]', 'top');
}
add_action('init', 'custom_news_rewrite_rules');
// Option page for sidebar
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Sidebar Settings',
        'menu_title'    => 'Sidebar Settings',
        'menu_slug'     => 'sidebar-settings',
        'capability'    => 'edit_pages', // Only admins can access this
        'redirect'      => false
    ));
}
// most viewed articles
// Function to count views
function set_post_view_count($postID) {
    $key = 'post_views_count';
    $count = get_post_meta($postID, $key, true);
    $count = ($count == '') ? 0 : intval($count);
    $count++;
    update_post_meta($postID, $key, $count);
}
// Function to get views
function get_post_view_count($postID) {
    $key = 'post_views_count';
    $count = get_post_meta($postID, $key, true);
    return ($count == '') ? '0' : $count;
}
// Hook into single post views
function track_post_views() {
    if (is_singular('articles')) {
        global $post;
        set_post_view_count($post->ID);
    }
}
add_action('wp_head', 'track_post_views');

// require_once get_template_directory() . '/inc/author-widgets/roles.php';
// require_once get_template_directory() . '/inc/author-widgets/capabilities.php';
// require_once get_template_directory() . '/inc/author-widgets/functions.php';
// require_once get_template_directory() . '/inc/author-widgets/widgets.php';
// profile access restriction
function remove_profile_from_menu() {
    if (!current_user_can('administrator')) {
        remove_menu_page('profile.php'); // Sidebar
        remove_submenu_page('users.php', 'profile.php'); // Users > Profile
    }
}
add_action('admin_menu', 'remove_profile_from_menu', 999);
// grant to upload media files
function eo_limit_media_library_access($query) {
    if (is_admin() && !current_user_can('manage_options') && isset($_POST['action']) && $_POST['action'] === 'query-attachments') {
        $query['author'] = get_current_user_id();
    }
    return $query;
}
add_filter('ajax_query_attachments_args', 'eo_limit_media_library_access');
// REST API article post
function register_article_posts() {
    register_post_type('articles', [
        'labels' => [
            'name' => 'Articles',
            'singular_name' => 'Article',
        ],
        'public' => true,
        'rewrite' => ['slug' => 'articles'],  // This will make sure your custom post type appears under /articles URL
        'has_archive' => true, // Archive page support
        'show_in_rest' => true, // Enables REST API for this post type
        'supports' => ['title', 'editor', 'excerpt', 'custom-fields'], // Add the fields you need
    ]);
}
add_action('init', 'register_article_posts');
// Most Viewed Articles via REST API
function register_custom_most_viewed_route() {
    register_rest_route('custom/v1', '/most-viewed/', array(
        'methods'  => 'GET',
        'callback' => 'get_most_viewed_articles',
        'permission_callback' => '__return_true', // Allow public access
    ));
}
add_action('rest_api_init', 'register_custom_most_viewed_route');

function get_most_viewed_articles($request) {
    $args = array(
        'post_type'      => 'articles', // change this if your post type is different
        'posts_per_page' => 2,
        'meta_key'       => 'post_views_count',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);
    $data = [];

    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();

        $data[] = [
            'id'         => $post_id,
            'title'      => get_the_title(),
            'link'       => get_permalink(),
            'thumbnail'  => get_the_post_thumbnail_url($post_id, 'full'),
            'article_heading' => get_field('article_heading', $post_id),
            'tags'       => wp_get_post_terms($post_id, 'post_tag', ['fields' => 'names']),
            'date'       => get_the_date('c', $post_id),
            'author'     => get_the_author(),
            'author_img' => get_field('author_image', 'user_' . get_the_author_meta('ID')),
        ];
    }

    wp_reset_postdata();
    return $data;
}
// Google Tag

// Increment views on single post load
function eo_set_post_views($postID) {
    $count = get_post_meta($postID, 'post_views_count', true);
    $count = $count ? $count + 1 : 1;
    update_post_meta($postID, 'post_views_count', $count);
}

// Display views
function eo_get_post_views($postID) {
    $count = get_post_meta($postID, 'post_views_count', true);
    return $count ? $count : 0;
}

// Hook for single articles
add_action('wp', function() {
    if (is_singular('articles')) {
        eo_set_post_views(get_the_ID());
    }
});
function eo_get_reading_time($postID) {
    $content = get_post_field('post_content', $postID);
    $word_count = str_word_count(strip_tags($content));
    $minutes = ceil($word_count / 200);
    return $minutes;
}
// cutom reply
function eo_comment_layout($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>

    <article <?php comment_class($comment->comment_parent ? 'comment-item reply mt-24 mb-24' : ''); ?> id="comment-<?php comment_ID(); ?>">

      <div class="comment-item">
        <div class="comment-avatar">
          <?php
          if ($comment->user_id) {
              echo '<img src="https://cdn.electricoctopus.agency/blogupload/uploads/2025/09/mikael-2.webp" alt="admin" width="44" height="44">';
          } else {
              echo '<img src="https://cdn.electricoctopus.agency/electric-octopus/reply-user.png" alt="Guest" width="48" height="48">';
          }
          ?>
        </div>

        <div class="comment-body">
          <div class="comment-header">
            <div class="comment-header-right">
              <h4 class="comment-author"><?php comment_author(); ?></h4>
              <span class="comment-date"><?php echo get_comment_date('d M, Y'); ?></span>
            </div>

            <?php if ($depth < $args['max_depth']) : ?>
              <a href="<?php echo esc_url(get_comment_reply_link([
                  'depth' => $depth,
                  'max_depth' => $args['max_depth']
              ])); ?>" class="comment-reply-link">
                <span class="reply-icon"><img src="https://cdn.electricoctopus.agency/electric-octopus/reply-arow.png" alt="reply" width="24" height="24"></span> Reply
              </a>
            <?php endif; ?>

          </div>
        </div>
      </div>

      <p class="comment-text">
        <?php
        if ($comment->comment_approved == '0') {
            echo '<em class="comment-awaiting">Your comment is awaiting moderation.</em>';
        }
        comment_text();
        ?>
      </p>

    </article>

    <?php
}


/* -------------------------------------------------
   FORCE COMMENTS FOR ARTICLES POST TYPE
-------------------------------------------------- */
add_filter('comments_open', function ($open, $post_id) {
    $post = get_post($post_id);

    if ($post && $post->post_type === 'articles') {
        return true;
    }

    return $open;
}, 10, 2);


/* -------------------------------------------------
   COMMENT NONCE VALIDATION (SERVER SIDE)
-------------------------------------------------- */
add_filter('preprocess_comment', function ($commentdata) {

    /**
     * ✅ Allow admin / dashboard comments
     */
    if (is_admin()) {
        return $commentdata;
    }

    /**
     * ✅ Allow logged-in users (optional but recommended)
     */
    if (is_user_logged_in()) {
        return $commentdata;
    }

    /**
     * 🔐 Frontend guest security check
     */
    if (
        !isset($_POST['comment_nonce']) ||
        !wp_verify_nonce($_POST['comment_nonce'], 'comment_nonce_action')
    ) {
        wp_die('Security check failed.');
    }

    return $commentdata;
});

add_action('wp_enqueue_scripts', function () {
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});
