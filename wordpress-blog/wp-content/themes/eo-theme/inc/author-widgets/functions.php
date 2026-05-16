<?php
function get_authors_by_role($role, $limit = 6) {
    $args = [
        'role' => $role,
        'number' => $limit,
        'orderby' => 'display_name',
        'order' => 'ASC'
    ];
    return get_users($args);
}