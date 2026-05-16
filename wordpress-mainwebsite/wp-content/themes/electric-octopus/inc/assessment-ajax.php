<?php
if (!defined('ABSPATH')) exit;

add_action('wp_ajax_submit_assessment', 'eo_submit_assessment');
add_action('wp_ajax_nopriv_submit_assessment', 'eo_submit_assessment');

function eo_submit_assessment() {

    if (empty($_POST['payload'])) {
        wp_send_json_error('Missing payload');
    }

    $data = json_decode(stripslashes($_POST['payload']), true);

    $post_id = wp_insert_post([
        'post_type' => 'eo_assessment',
        'post_status' => 'publish',
        'post_title' => 'Assessment - ' . current_time('Y-m-d H:i:s')
    ]);

    if (is_wp_error($post_id)) {
        wp_send_json_error('Save failed');
    }

    update_post_meta($post_id, '_assessment_data', $data);

    if (!empty($data['b2b_stage'])) {
        update_post_meta($post_id, '_b2b_stage', sanitize_text_field($data['b2b_stage']));
    }

    wp_send_json_success(['id' => $post_id]);
}
