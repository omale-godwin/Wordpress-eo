<?php
function custom_setup_owner_role_capabilities() {
    $role = get_role('owner');
    if ($role) {
        $role->add_cap('promote_users');
        $role->add_cap('list_users');
        $role->add_cap('edit_users');
        $role->add_cap('create_users');
    }
}
add_action('admin_init', 'custom_setup_owner_role_capabilities');