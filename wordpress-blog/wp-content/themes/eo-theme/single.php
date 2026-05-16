<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OC-theme
 */

get_header();
?>

<?php
// Check if a specific template is selected, else use the default.
$template = get_page_template_slug();
if ($template) {
    include locate_template($template);
} else {
    get_header();
}
    ?>
	
<?php
get_footer();