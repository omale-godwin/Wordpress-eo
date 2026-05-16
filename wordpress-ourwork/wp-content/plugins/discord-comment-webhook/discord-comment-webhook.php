<?php
/*
Plugin Name: Discord Comment Webhook - Our Work (Instant Notify)
Description: Sends ALL new comments instantly to Discord (no approval required)
Version: 1.2
*/

add_action('comment_post', 'eo_discord_instant_comment_notify', 10, 2);

function eo_discord_instant_comment_notify($comment_ID, $comment_approved) {

    $comment = get_comment($comment_ID);
    eo_send_discord_comment_instant($comment);
}

function eo_send_discord_comment_instant($comment) {

    $webhook_url = "https://discord.com/api/webhooks/1456641205612970036/-pqjJLmhPC47QzORiAHTpjDOTEYouwxsXZfL5Gijmo1vjK2wk7LWXRIuC1cjhxRT4pFH";

    $post_id    = $comment->comment_post_ID;
    $post_title = get_the_title($post_id);
    $post_link  = get_permalink($post_id);

    // Detect status label
    $status_label = $comment->comment_approved == '0'
        ? "Pending Moderation"
        : "Approved";

    $message = [
        "content" => "**New Casestudy Comment Submitted!**",
        "embeds" => [[
            "title" => $post_title,
            "url" => $post_link,
            "color" => hexdec("e67e22"),
            "fields" => [
                ["name" => "Source", "value" => "Our Work", "inline" => true],
                ["name" => "Status", "value" => $status_label, "inline" => true],
                ["name" => "Name", "value" => $comment->comment_author ?: 'Guest', "inline" => true],
                ["name" => "Email", "value" => $comment->comment_author_email ?: 'N/A', "inline" => true],
                ["name" => "Comment", "value" => $comment->comment_content]
            ]
        ]]
    ];

    $response = wp_remote_post($webhook_url, [
        "headers" => ["Content-Type" => "application/json"],
        "body" => json_encode($message),
        "timeout" => 15,
        "sslverify" => false // helps if local server SSL issues
    ]);

    if (is_wp_error($response)) {
        error_log("Discord Webhook Error: " . $response->get_error_message());
    }
}
