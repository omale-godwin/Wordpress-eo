<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OC-theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php //dynamic_sidebar( 'sidebar-1' ); ?>
	<div class="cat-search">
                    <form id="sidebar-search-form" class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input 
                            type="text" 
                            name="s" 
                            placeholder="Search article" 
                            value="<?php echo get_search_query(); ?>" 
                            id="search-input"
                            autocomplete="off"
                        />
                        <input type="hidden" name="post_type" value="articles"> <!-- Ensure it only searches articles -->
                        <button type="submit">
                            <img 
                                src="https://cdn.electricoctopus.agency/electric-octopus/blog/search-2-fill.png" 
                                alt="search" 
                                class="cursor-point" 
                                loading="lazy"
                                width="24" height="24"
                            >
                        </button>
                    </form>
                </div>
</aside><!-- #secondary -->