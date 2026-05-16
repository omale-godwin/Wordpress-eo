<?php
/**
 * Electric Octopus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Electric_Octopus
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
function electric_octopus_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Electric Octopus, use a find and replace
		* to change 'electric-octopus' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'electric-octopus', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'electric-octopus' ),
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
			'electric_octopus_custom_background_args',
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
add_action( 'after_setup_theme', 'electric_octopus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function electric_octopus_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'electric_octopus_content_width', 640 );
}
add_action( 'after_setup_theme', 'electric_octopus_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function electric_octopus_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'electric-octopus' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'electric-octopus' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'electric_octopus_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function electric_octopus_scripts() {
	wp_enqueue_style( 'electric-octopus-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'electric-octopus-style', 'rtl', 'replace' );

	wp_enqueue_script( 'electric-octopus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'electric_octopus_scripts' );

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

/**
 * Talk to Expert Form Handling & Admin Dashboard
 */
require get_template_directory() . '/inc/talk-to-expert-handler.php';
require get_template_directory() . '/inc/talk-to-expert-admin.php';

/**
 * Enqueue all EO Form-related JavaScript modules
 * These are loaded on pages with the 3-part form
 */
function eo_enqueue_form_modules() {
	$theme_uri = get_template_directory_uri();
	$ver = _S_VERSION;

	// Enqueue the form controller (manages state across parts)
	wp_enqueue_script( 'eo-form-controller', $theme_uri . '/js/eo-form/eo-form-controller.js', array(), $ver, true );

	// Enqueue Part 1 form script
	wp_enqueue_script( 'eo-form-part1', $theme_uri . '/js/eo-form/part1.js', array( 'eo-form-controller' ), $ver, true );

	// Enqueue Part 2 form script (depends on controller)
	wp_enqueue_script( 'eo-form-part2', $theme_uri . '/js/eo-form/part2.js', array( 'eo-form-controller' ), $ver, true );

	// Enqueue Part 3 form script (depends on controller)
	wp_enqueue_script( 'eo-form-part3', $theme_uri . '/js/eo-form/part3.js', array( 'eo-form-controller' ), $ver, true );

	// Enqueue submission script (sends data via AJAX) – this also localizes eoFormVars
	wp_enqueue_script( 'eo-submission', $theme_uri . '/js/eo-form/submission.js', array( 'eo-form-part3' ), $ver, true );

	// Localize submission script with nonce and AJAX URL
	wp_localize_script( 'eo-submission', 'eoFormVars', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'eo_form_nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'eo_enqueue_form_modules' );

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
    $theme_dir = get_template_directory_uri();
    $ver = wp_get_theme()->get('Version');

    $stylesheets = array(
        'eo-header'      => '/css/header.css',
        'eo-custom'      => '/css/custom-style.css',
        'eo-footer'      => '/css/foot.css',
        'eo-talk'        => '/css/talk-to-expert.css',
        'book-call'        => '/css/book-call.css',
        'eo-responsive'  => '/css/responsive.css',
    );

    foreach ($stylesheets as $handle => $path) {
        wp_enqueue_style($handle, $theme_dir . $path, array(), $ver);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

// css defer
// function eo_async_styles($html, $handle, $href, $media) {

//     $async_styles = array(
//         'eo-header',
//         'eo-custom',
//         'eo-footer',
//         'eo-talk',
//         'eo-responsive',
//     );

//     if (in_array($handle, $async_styles)) {
//         return str_replace(
//             "rel='stylesheet'",
//             "rel='stylesheet' media='print' onload=\"this.media='all'\"",
//             $html
//         );
//     }

//     return $html;
// }
// add_filter('style_loader_tag', 'eo_async_styles', 10, 4);
// talk-toexpert css enque
function eo_conditional_styles() {

    if (!is_page('talk-to-expert')) {
        wp_dequeue_style('eo-talk');
    }

}
add_action('wp_enqueue_scripts', 'eo_conditional_styles', 20);
// remove block library
// function eo_remove_block_css() {
//     if (!is_admin()) {
//         wp_dequeue_style('wp-block-library');
//         wp_dequeue_style('wp-block-library-theme');
//     }
// }
// add_action('wp_enqueue_scripts', 'eo_remove_block_css', 100);



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
//custom script add
function theme_enqueue_scripts() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
//slick slider
function enqueue_slick_slider() {
    // Enqueue Slick CSS files
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/slick/slick.css');
    wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/slick/slick-theme.css');
    wp_enqueue_style('slick-font-override', get_template_directory_uri() . '/css/slick-font-override.css', array('slick-theme-css'), null);

    
    // Enqueue Slick JS file
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/slick/slick.min.js', array('jquery'), null, true);

    // Initialize Slick Slider
    wp_add_inline_script('slick-js', '
jQuery(document).ready(function($){

    $(".tech-slick-slider").slick({
        autoplay: true,
        dots: false,
        arrows: false,
        slidesToShow: 5,
        responsive: [
            {
                breakpoint: 1024, // tablets
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 767, // mobile
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 480, // small mobile
                settings: {
                    slidesToShow: 3
                }
            }
        ]
    });

    $(".tech-logo-slider").slick({
        autoplay: true,
        dots: false,
        arrows: false,
        slidesToShow: 8,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 1024, // tablets
                settings: {
                    slidesToShow: 8,
                    variableWidth: false
                }
            },
            {
                breakpoint: 767, // mobile
                settings: {
                    slidesToShow: 5,
                    variableWidth: false
                }
            },
            {
                breakpoint: 480, // small mobile
                settings: {
                    slidesToShow: 3,
                    variableWidth: false
                }
            }
        ]
    });
    $(".testomonial-slick-slider").slick({
        autoplay: true,
        dots: true,
        arrows: false,
        slidesToShow: 1,
    });
$(".events-slider").slick({
        autoplay: true,
        dots: true,
        arrows: true,
        slidesToShow: 1,
        
    });
});

');

	// Custom JS
    wp_enqueue_script('industry-slider', get_template_directory_uri() . '/js/industry-slider.js', ['jquery', 'slick-js'], null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider');

// Rest API
function fetch_case_studies() {

    // Fetch from subsite REST API
    $response = wp_remote_get("https://ourwork.electricoctopus.agency/wp-json/wp/v2/case_studies?per_page=4&_embed");

    if (is_wp_error($response)) {
        return 'Error fetching case studies.';
    }

    $posts = json_decode(wp_remote_retrieve_body($response));
    if (!$posts) return 'No posts found.';

    ob_start();

    foreach ($posts as $post) {

        // Case Study Title
        $title = wp_strip_all_tags($post->title->rendered ?? '');

        // Featured Image
        $featured_image = $post->_embedded->{'wp:featuredmedia'}[0]->source_url ?? '';

        // Taxonomies
        $industry = '';
        $industries = [];
        $tags = [];

        if (!empty($post->_embedded->{'wp:term'})) {
            foreach ($post->_embedded->{'wp:term'} as $group) {
                foreach ($group as $term) {

                    // INDUSTRY (your custom taxonomy)
                    if ($term->taxonomy === 'casestudy_industry') {
                        $industries[] = $term->name;
                    }

                    // TAGS (default WordPress tags)
                    if ($term->taxonomy === 'post_tag') {
                        $tags[] = $term->name;
                    }
                }
            }
        }

        // Pick first industry
        $industry = $industries[0] ?? '';

        // Extra tags count
        $extra_count = 0;
        if (count($tags) > 3) {
            $extra_count = count($tags) - 3;
        }
        ?>

        <!-- Portfolio Card -->
        <a href="<?php echo esc_url($post->link); ?>" class="portfolio-card" target="_blank">

            <div class="portfolio-image">
                <img src="<?php echo esc_url($featured_image); ?>" alt="Portfolio Image">
            </div>

            <div class="portfolio-content">

                <div class="portfolio-left">
                    <h3 class="portfolio-title">
                        <?php echo esc_html($industry); ?>
                    </h3>

                    <p class="portfolio-para">
                        <?php echo esc_html($title); ?>
                    </p>
                </div>

                <div class="portfolio-link">
                    <img src="https://cdn.electricoctopus.agency/electric-octopus/industry-link.png" alt="Open Project">
                </div>

            </div>

            <!-- TAGS SECTION -->
            <div class="portfolio-tags">

                <?php
                // Show first 3 tags
                foreach (array_slice($tags, 0, 3) as $tag) {
                    echo '<span>' . esc_html($tag) . '</span>';
                }

                // More tags: show "3+" or "2+" etc
                if ($extra_count > 0) {
                    echo '<span>' . esc_html($extra_count) . '+</span>';
                }
                ?>

            </div>

        </a>

        <?php
    }

    return ob_get_clean();
}

add_shortcode('external_case_studies', 'fetch_case_studies');

// Rest API - Case Study Slider
// Rest API - Case Study Slider
function fetch_case_studies_slider() {

    $response = wp_remote_get("https://ourwork.electricoctopus.agency/wp-json/wp/v2/case_studies?per_page=4&_embed");

    if (is_wp_error($response)) {
        return 'Error fetching case studies.';
    }

    $posts = json_decode(wp_remote_retrieve_body($response));
    if (!$posts) return 'No posts found.';

    ob_start();
    ?>

    <div class="case-wrapper">
        <div class="case-slider">

            <?php foreach ($posts as $post):

                $title = wp_strip_all_tags($post->title->rendered ?? '');
                $link  = $post->link ?? '#';

                // Featured Image
                $featured_image = $post->_embedded->{'wp:featuredmedia'}[0]->source_url ?? '';

                // Industry, Category & Tags
                $industries = [];
                $categories = [];
                $tags = [];

                if (!empty($post->_embedded->{'wp:term'})) {
                    foreach ($post->_embedded->{'wp:term'} as $group) {
                        foreach ($group as $term) {
                            // INDUSTRY (casestudy_industry taxonomy)
                            if ($term->taxonomy === 'casestudy_industry') {
                                $industries[] = $term->name;
                            }

                            // CATEGORY (casestudy_category taxonomy)
                            if ($term->taxonomy === 'casestudy_category') {
                                $categories[] = $term->name;
                            }

                            // TAGS (default WordPress tags)
                            if ($term->taxonomy === 'post_tag') {
                                $tags[] = $term->name;
                            }
                        }
                    }
                }

                // Use the first industry/category or fallback to empty
                $industry = $industries[0] ?? '';
                $category = $categories[0] ?? '';

                // Show extra tags count if more than 3
                $extra_count = count($tags) > 3 ? count($tags) - 3 : 0;
            ?>

            <div class="case-slide">

                <div class="case-left">
                    <div class="case-content">

                        <!-- Logo / Static icon -->
                        <img src="https://cdn.electricoctopus.agency/electric-octopus/scribe-note.png"
                             class="brand-logo"
                             alt="Logo" loading="lazy">

                        <p class="case-text">
                            <?php echo esc_html($title); ?>
                        </p>

                        <!-- Display Industry and Category -->
                        <p class="case-meta">
                            <?php if ($industry): ?>
                                <span class="case-industry"><?php echo esc_html($industry); ?></span>
                            <?php endif; ?>

                            <?php if ($category): ?>
                                <span class="case-category"><?php echo esc_html($category); ?></span>
                            <?php endif; ?>
                        </p>

                    </div>

                    <a href="<?php echo esc_url($link); ?>" class="case-btn" target="_blank">
                        Read Case Study
                        <span>
                            <img src="https://cdn.electricoctopus.agency/electric-octopus/industry-link.png"
                                 alt="industry"
                                 loading="lazy" width="32" height="32">
                        </span>
                    </a>
                </div>

                <div class="case-right">
                    <div class="case-img">
                        <img src="<?php echo esc_url($featured_image); ?>"
                             alt="Case Study" loading="lazy">
                    </div>
                </div>

            </div>

            <?php endforeach; ?>

        </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('external_case_slider', 'fetch_case_studies_slider');


// assessment
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'assessment-css',
    get_stylesheet_directory_uri() . '/assets/css/assessment.css'
  );

//   wp_enqueue_script(
//     'assessment-js',
//     get_stylesheet_directory_uri() . '/assets/js/assessment-2.js',
//     [],
//     null,
//     true
//   );
});
// book a call
// function enqueue_part3_script() {
//   if (is_page('assessment-part-3')) {
//     wp_enqueue_script(
//       'assessment-part3',
//       get_stylesheet_directory_uri() . '/assets/js/assessment-3.js',
//       [],
//       '1.0',
//       true
//     );
//   }
// }
// add_action('wp_enqueue_scripts', 'enqueue_part3_script');
// international telephone
add_action('wp_enqueue_scripts', function() {
  if (is_page('talk-to-expert')) {
    wp_enqueue_style(
      'iti-css',
      'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css'
    );

    wp_enqueue_script(
      'iti-js',
      'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js',
      [],
      null,
      true
    );

    wp_enqueue_script(
      'iti-utils',
      'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js',
      [],
      null,
      true
    );
  }
});
// defer jquery
function eo_defer_jquery($tag, $handle) {
    if (in_array($handle, ['jquery', 'jquery-migrate'])) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'eo_defer_jquery', 10, 2);

// Enqueue assessment and talk-to-expert scripts
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script('assessment-2', get_template_directory_uri().'/assets/js/assessment-2.js', [], _S_VERSION, true);
  wp_enqueue_script('assessment-3', get_template_directory_uri().'/assets/js/assessment-3.js', [], _S_VERSION, true);

  wp_localize_script('assessment-3', 'tte_ajax', [
    'ajax_url' => admin_url('admin-ajax.php')
  ]);

  wp_enqueue_script(
    'talk-to-expert-init',
    get_template_directory_uri() . '/assets/talk-to-expert/init.js',
    [],
    null,
    true // 👈 footer (IMPORTANT)
  );

  // Localize talk-to-expert scripts with AJAX URL
  wp_localize_script('talk-to-expert-init', 'eoFormVars', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
  ));
  
  // Enqueue service dropdown script on talk-to-expert pages
  $is_talk_to_expert = is_page_template('template-talk-to-expert1.php') || 
                       is_page_template('template-talk-to-expert2.php') ||
                       is_page_template('template-talk-to-expert-3.php') ||
                       is_page('talk-to-expert');
  
  if ($is_talk_to_expert) {
    wp_enqueue_script(
      'service-dropdown',
      get_template_directory_uri() . '/assets/js/service-dropdown.js',
      [],
      null,
      true
    );
  }
});

// Add type="module" to the talk-to-expert-init script tag
add_filter('script_loader_tag', function($tag, $handle) {
  if ($handle === 'talk-to-expert-init') {
    return str_replace('<script ', '<script type="module" ', $tag);
  }
  return $tag;
}, 10, 2);


