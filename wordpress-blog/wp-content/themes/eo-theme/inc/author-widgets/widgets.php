<?php
function render_author_widget($atts) {
    ob_start();
    $staff_authors = get_authors_by_role('staff');
    $contributor_authors = get_authors_by_role('contributor_custom');
    include get_template_directory() . '/inc/author-widgets/template-author-widget.php';
    return ob_get_clean();
}
add_shortcode('author_widget', 'render_author_widget');