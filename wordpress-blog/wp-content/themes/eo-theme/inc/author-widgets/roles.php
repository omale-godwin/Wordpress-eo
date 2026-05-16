<?php
// Register Staff and Contributor Roles
function custom_register_author_roles() {
    add_role('staff', 'Staff', [
        'read' => true,
        'edit_posts' => false,
    ]);

    add_role('contributor_custom', 'Contributor', [
        'read' => true,
        'edit_posts' => false,
    ]);
}
add_action('init', 'custom_register_author_roles');