<?php
// Check if a specific template is selected, else use the default.
$template = get_page_template_slug();
if ($template) {
    include locate_template($template);
} else {
    get_header();
   
    ?>
    
    <div class="default-article-template">
        <h1><?php the_title(); ?></h1>
        <div class="post-content">
            <?php the_content(); ?>
        </div>
    </div>
    <?php
    get_footer();
}
