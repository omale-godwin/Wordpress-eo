<?php
/**
 * our work functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package our_work
 */
ob_start();
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
@ini_set('upload_max_filesize', '528M');       // Max file size for uploads
@ini_set('post_max_size', '528M');             // Max size of POST data (should be >= upload_max_filesize)
@ini_set('memory_limit', '556M');              // Max amount of memory a script can consume
@ini_set('max_execution_time', '3000');        // Max time (in seconds) a script is allowed to run
@ini_set('max_input_time', '3000');            // Max time a script waits for input (e.g., file upload)

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function our_work_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on our work, use a find and replace
		* to change 'our-work' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'our-work', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'our-work' ),
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
			'our_work_custom_background_args',
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
add_action( 'after_setup_theme', 'our_work_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function our_work_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'our_work_content_width', 640 );
}
add_action( 'after_setup_theme', 'our_work_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function our_work_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'our-work' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'our-work' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'our_work_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function our_work_scripts() {
	wp_enqueue_style( 'our-work-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'our-work-style', 'rtl', 'replace' );

	wp_enqueue_script( 'our-work-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'our_work_scripts' );

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

//custom script added for scroll
function theme_enqueue_scripts() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
// Enable theme support for menus
function theme_setup() {
    add_theme_support('menus');
}
add_action('after_setup_theme', 'theme_setup');



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
                $output .= '<img alt="icon" src="' . esc_url($icon_url) . '" class="chakra-image css-0">';
            }
            $output .= '<div class="css-1u0wnaw">';
            $output .= '<h3 class="chakra-heading css-1ia2u5u">' . esc_html($item->title) . '</h3>';
            if ($description) {
                $output .= '<p class="chakra-text css-14u2thu">' . $description . '</p>';
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

//slick slider
function enqueue_slick_slider() {
    // Enqueue Slick CSS files
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/slick/slick.css');
    wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/slick/slick-theme.css');
    wp_enqueue_style('slick-font-override', get_template_directory_uri() . '/css/slick-font-override.css', array('slick-theme-css'), null);

    
    // Enqueue Slick JS file
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/slick/slick.min.js', array('jquery'), null, true);

    // Initialize Slick Slider
    wp_add_inline_script('slick-js', 'jQuery(document).ready(function($){ $(".img-slider").slick({ autoplay: true, dots: false, arrows: false, slidesToShow: 5, slidesToScroll: 1,pauseOnHover: false,pauseOnFocus: false,autoplaySpeed: 2000,speed: 500 ,responsive: 
				[          
					{
					breakpoint: 600,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
					},
            	] }); });');
    wp_add_inline_script('slick-js', 'jQuery(document).ready(function($){ $(".services-slider").slick({ autoplay: true, dots: true, arrows: false, slidesToShow: 3,slidesToScroll: 3,responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
        ]}); });');
        wp_add_inline_script('slick-js', 'jQuery(document).ready(function($){ $(".recent-post-slider").slick({ autoplay: false, dots: false, arrows: true, slidesToShow: 2, slidesToScroll: 1,pauseOnHover: false,pauseOnFocus: false,autoplaySpeed: 2000,speed: 500 ,responsive: 
				[          
					{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
					},
            	] }); });');
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider');
//script for scroll button
function custom_scroll_scripts() {
    wp_enqueue_script('jquery'); // Ensure jQuery is loaded
    wp_enqueue_script('scroll-down', get_template_directory_uri() . '/js/scroll-down.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'custom_scroll_scripts');
//ajax filter load post
require get_template_directory() . '/ajax-handlers/ajax-load-posts.php';
// Add the action hooks for AJAX requests
add_action('wp_ajax_load_posts', 'ajax_load_posts');
add_action('wp_ajax_nopriv_load_posts', 'ajax_load_posts');
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
                'taxonomy' => 'casestudy_industry',
                'field'    => 'slug',
                'terms'    => $industry_slug,
            );
        }

        // Handle Category Filter
        if ( isset($filter_params[1]) && !empty($filter_params[1]) ) {
            $category_slug = $filter_params[1];
            $tax_query[] = array(
                'taxonomy' => 'casestudy_category',
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
add_filter('embed_oembed_discover', '__return_true');
add_filter('wp_embed_defaults', '__return_true');
add_filter('wp_oembed_add_discovery_links', '__return_true');
add_filter('oembed_result', 'wptexturize');

function enqueue_audio_player_assets() {
    wp_enqueue_script('audio-player-script', get_template_directory_uri() . '/js/audio-player.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_audio_player_assets');

// Fetch recent custom posts using REST API with caching
function fetch_recent_custom_posts_from_rest() {
    $cache_key = 'recent_custom_posts_cache';
    $cached = get_transient($cache_key);
    if ($cached !== false) return $cached;

    $response = wp_remote_get('https://blog.electricoctopus.agency/wp-json/wp/v2/articles?per_page=3&_embed=true', [
        'timeout' => 5,
    ]);

    if (is_wp_error($response)) {
        return '<p>Error fetching posts: ' . esc_html($response->get_error_message()) . '</p>';
    }       

    $posts = json_decode(wp_remote_retrieve_body($response), true);

    if (empty($posts)) {
        return '<p>No recent posts found.</p>';
    }

    ob_start(); ?>
    <div class="recent-post-cls mt-24">
        <?php foreach ($posts as $post):
            $featured_img = !empty($post['_embedded']['wp:featuredmedia'][0]['source_url']) 
                ? '<img src="' . esc_url($post['_embedded']['wp:featuredmedia'][0]['source_url']) . '" alt="' . esc_attr($post['title']['rendered']) . '">' 
                : '';

            $article_heading = !empty($post['acf']['article_heading']) ? $post['acf']['article_heading'] : $post['title']['rendered'];

            $tags = [];
            if (!empty($post['_embedded']['wp:term'])) {
                foreach ($post['_embedded']['wp:term'] as $term_group) {
                    foreach ($term_group as $term) {
                        if ($term['taxonomy'] === 'post_tag') {
                            $tags[] = $term;
                        }
                    }
                }
            }

            $tag_html = '';
            if (!empty($tags)) {
                $tag_html .= '<span data-tag-id="' . esc_attr($tags[0]['id']) . '">' . esc_html($tags[0]['name']) . '</span>';
                if (count($tags) > 1) {
                    $tag_html .= '<span>+' . (count($tags) - 1) . '</span>';
                }
            }

            $date = strtotime($post['date']);
            $day_and_weekday = date('d, l', $date);
            $month_and_year = date('M Y', $date);
        ?>
            <a href="<?= esc_url($post['link']) ?>" class="recent-post-block" style="text-decoration: none; color: inherit;">
                <div class="recent-post-img"><?= $featured_img ?></div>
                <div class="post-left-content">
                    <p class="clamp-2"><?= esc_html($article_heading) ?></p>
                    <div class="recenttag"><div class="viewd-tag"><?= $tag_html ?></div></div>
                    <div class="recent-dateg">
                        <span class="date-white"><?= esc_html($day_and_weekday) ?></span>
                        <span class="date-gray"><?= esc_html($month_and_year) ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <?php
    $output = ob_get_clean();
    set_transient($cache_key, $output, 10 * MINUTE_IN_SECONDS);
    return $output;
}
add_shortcode('fetch_custom_posts', 'fetch_recent_custom_posts_from_rest');


// Fetch most viewed articles from custom REST endpoint with caching
function fetch_most_viewed_articles_from_blog() {
    $cache_key = 'most_viewed_articles_cache';
    $cached = get_transient($cache_key);
    if ($cached !== false) return $cached;

    $response = wp_remote_get('https://blog.electricoctopus.agency/wp-json/custom/v1/most-viewed', [
        'timeout' => 5,
    ]);

    if (is_wp_error($response)) {
        return '<p>Error fetching most viewed articles.</p>';
    }

    $articles = json_decode(wp_remote_retrieve_body($response), true);
    if (empty($articles)) return '<p>No articles found.</p>';

    ob_start(); ?>
    <div class="most-viewed-post mt-24">
        <?php foreach ($articles as $post):
            $date = strtotime($post['date']);
            $day_and_weekday = date('d, l', $date);
            $month_and_year = date('M Y', $date);
        ?>
            <div class="grid-item mt-24">
                <a href="<?= esc_url($post['link']) ?>" class="post-card-link" target="_blank">
                    <div class="most-viewed">
                        <?php if (!empty($post['thumbnail'])): ?>
                            <div class="recent-post-img">
                                <img src="<?= esc_url($post['thumbnail']) ?>" alt="<?= esc_attr($post['title']) ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
                        <div class="post-left-content">
                            <p class="article-para clamp-2"><?= esc_html($post['article_heading'] ?: $post['title']) ?></p>
                            <div class="cat-tag viewd-tag">
                                <?php if (!empty($post['tags'])):
                                    $max_display = 1;
                                    for ($i = 0; $i < min($max_display, count($post['tags'])); $i++):
                                        echo '<span>' . esc_html($post['tags'][$i]) . '</span>';
                                    endfor;
                                    if (count($post['tags']) > $max_display):
                                        echo '<span>+' . (count($post['tags']) - $max_display) . '</span>';
                                    endif;
                                endif; ?>
                            </div>
                            <div class="post-client-data">
                                <div class="post-client-data-right">
                                    <span class="date-white"><?= esc_html($day_and_weekday) ?></span>
                                    <span class="date-gray"><?= esc_html($month_and_year) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    $output = ob_get_clean();
    set_transient($cache_key, $output, 10 * MINUTE_IN_SECONDS);
    return $output;
}
add_shortcode('most_viewed_articles', 'fetch_most_viewed_articles_from_blog');
// Search filter functionality for case study
function enqueue_article_search_scripts() {
    if ( is_post_type_archive('case_studies') || is_singular('case_studies') ) {
        wp_enqueue_script('ajax-search-filter', get_template_directory_uri() . '/js/ajax-search-filter.js', array('jquery'), null, true);

        wp_localize_script('ajax-search-filter', 'ajax_search_filter_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_article_search_scripts');
// Handle AJAX for article search
require get_template_directory() . '/ajax-handlers/filter-search-casestudy.php';
add_action('wp_ajax_filter_search_casestudy', 'filter_search_casestudy');
add_action('wp_ajax_nopriv_filter_search_casestudy', 'filter_search_casestudy');

// Sidebar library
// if (function_exists('acf_add_options_page')) {
//     acf_add_options_page(array(
//         'page_title' => 'Sidebar Library',
//         'menu_title' => 'Sidebar Library',
//         'menu_slug'  => 'sidebar-library',
//         'capability' => 'edit_posts',
//         'redirect'   => false,
//     ));
// }

// preview red banner template
add_action('acf/render_field/name=red_banner_template', 'acf_red_banner_template_preview', 20, 1);

function acf_red_banner_template_preview($field) {
    // Map each template to its image
    $template_images = [
        'template1' => get_template_directory_uri() . '/assets/images/red-banner/red-banner1.webp',
        'template2' => get_template_directory_uri() . '/assets/images/red-banner/red-banner2.webp',
        'template3' => get_template_directory_uri() . '/assets/images/red-banner/red-banner3.webp',
        'template4' => get_template_directory_uri() . '/assets/images/red-banner/red-banner4.webp',
    ];

    // Output HTML container
    echo '<div class="acf-red-template-preview" style="margin-top:10px;">';
    foreach ($template_images as $key => $url) {
        $active = ($field['value'] === $key) ? '' : 'style="display:none;"';
        echo '<img 
            src="' . esc_url($url) . '" 
            class="red-template-image" 
            data-template="' . esc_attr($key) . '" 
            ' . $active . ' 
            width="200" 
        />';
    }
    echo '</div>';
}
add_action('acf/input/admin_footer', 'acf_red_template_preview_js');
function acf_red_template_preview_js() {
    ?>
    <script>
        (function($) {
            acf.addAction('ready', function() {
                const $select = $('#acf-field_6866d7df5e63e-field_686780851e0e5-field_68681ecbd813d');
                const $images = $('.acf-red-template-preview img');

                $select.on('change', function() {
                    const selected = $(this).val();
                    $images.hide();
                    $images.filter('[data-template="' + selected + '"]').show();
                });
            });
        })(jQuery);
    </script>
    <?php
}
// gtag
add_filter('acf/prepare_field/name=cta_banner_field', function($field) {
    if (!current_user_can('administrator')) {
        $field['disabled'] = true;
    }
    return $field;
});


add_action('acf/input/admin_footer', function () {
    ?>
    <script>
    (function($) {
        acf.addAction('ready', function() {
            // Get all instances of the group field
            const $groups = $('[data-key="field_6873b3a5a5746"]');

            if ($groups.length < 2) return;

            const $sourceGroup = $groups.eq(0); // First instance with image
            const $targetGroup = $groups.eq(1); // Second instance (target)

            // Get source image ID and src
            const $sourceInput = $sourceGroup.find('input[name$="[field_687794de72fa8]"]');
            const sourceImageID = $sourceInput.val();
            const sourceImageURL = $sourceGroup.find('img[data-name="image"]').attr('src');

            if (!sourceImageID || !sourceImageURL) return;

            // Get target image input and wrapper
            const $targetInput = $targetGroup.find('input[name$="[field_687794de72fa8]"]');
            const $targetUploader = $targetGroup.find('.acf-image-uploader');
            const $targetImage = $targetUploader.find('img[data-name="image"]');

            // Set target values
            $targetInput.val(sourceImageID);
            $targetImage.attr('src', sourceImageURL);
            $targetUploader.addClass('has-value');
            $targetUploader.find('.show-if-value').show();
            $targetUploader.find('.hide-if-value').hide();
        });
    })(jQuery);
    </script>
    <?php
});

// cta banner group
add_action('acf/input/admin_footer', function () {
    ?>
    <script>
    (function($) {
        acf.addAction('ready append', function($el) {
            const $groups = $('[data-key="field_6877a13f73b69"]');

            if ($groups.length < 2) return;

            const $sourceGroup = $groups.eq(0);
            const $targetGroup = $groups.eq(1);

            // Avoid reapplying
            if ($targetGroup.hasClass('acf-duplicated')) return;
            $targetGroup.addClass('acf-duplicated');

            // 1. Text Fields
            $sourceGroup.find('input[type="text"]').each(function () {
                const name = $(this).attr('name');
                const value = $(this).val();
                const $target = $targetGroup.find(`input[name="${name}"]`);
                $target.val(value).trigger('change');
            });

            // 2. Textareas
            $sourceGroup.find('textarea').each(function () {
                const name = $(this).attr('name');
                const value = $(this).val();
                const $target = $targetGroup.find(`textarea[name="${name}"]`);
                $target.val(value).trigger('change');
            });

            // 3. Select/Radio
            $sourceGroup.find('select, input[type="radio"]').each(function () {
                const name = $(this).attr('name');
                const value = $(this).val();
                const $target = $targetGroup.find(`[name="${name}"]`);
                $target.val(value).trigger('change');
            });

            // 4. Checkboxes
            $sourceGroup.find('input[type="checkbox"]').each(function () {
                const name = $(this).attr('name');
                const isChecked = $(this).prop('checked');
                const $target = $targetGroup.find(`input[name="${name}"]`);
                $target.prop('checked', isChecked).trigger('change');
            });

            // 5. Image Field
            const $sourceInput = $sourceGroup.find('input[name$="[field_687794de72fa8]"]');
            const sourceImageID = $sourceInput.val();
            const sourceImageURL = $sourceGroup.find('img[data-name="image"]').attr('src');

            if (sourceImageID && sourceImageURL) {
                const $targetInput = $targetGroup.find('input[name$="[field_687794de72fa8]"]');
                const $targetUploader = $targetGroup.find('.acf-image-uploader');
                const $targetImage = $targetUploader.find('img[data-name="image"]');

                $targetInput.val(sourceImageID);
                $targetImage.attr('src', sourceImageURL);
                $targetUploader.addClass('has-value');
                $targetUploader.find('.show-if-value').show();
                $targetUploader.find('.hide-if-value').hide();
            }

            console.log('✅ CTA banner fields duplicated from first to second instance');
        });
    })(jQuery);
    </script>
    <?php
});
// preeload image
function preload_lcp_image_dynamic() {
    // Only run on front page or specific template if needed
    if (is_front_page()) {
        $image_id = get_field('hero_image');
        if ($image_id) {
            $image_url = wp_get_attachment_image_url($image_id, 'full');
            if ($image_url) {
                echo '<link rel="preload" as="image" href="' . esc_url($image_url) . '" />' . "\n";
            }
        }
    }
}
add_action('wp_head', 'preload_lcp_image_dynamic', 1); // Priority 1 = as early as possible
ob_end_clean();

// function restrict_editor_delete_published_posts() {
//     $role = get_role( 'editor' );
//     if ( $role && $role->has_cap( 'delete_published_posts' ) ) {
//         $role->remove_cap( 'delete_published_posts' );
//     }
// }
// add_action( 'init', 'restrict_editor_delete_published_posts' );
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
                <span class="reply-icon"><img src="https://cdn.electricoctopus.agency/electric-octopus/reply-arow-pink.png" alt="reply" width="24" height="24"></span> Reply
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
   FORCE COMMENTS FOR case_studies POST TYPE
-------------------------------------------------- */
add_filter('comments_open', function ($open, $post_id) {
    $post = get_post($post_id);

    if ($post && $post->post_type === 'case_studies') {
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

