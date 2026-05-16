# Form Submission Management - Implementation Examples

This document provides code examples for common tasks when working with the Electric Octopus form submission system.

---

## 📌 Table of Contents

1. [Querying Submissions](#querying-submissions)
2. [Filtering & Searching](#filtering--searching)
3. [Admin Customizations](#admin-customizations)
4. [Extending with Hooks](#extending-with-hooks)
5. [Integration Examples](#integration-examples)
6. [Debugging & Logging](#debugging--logging)

---

## Querying Submissions

### Get All Submissions

```php
<?php
$args = array(
    'post_type'      => 'eo_form_submission',
    'posts_per_page' => -1,  // Get all
    'orderby'        => 'date',
    'order'          => 'DESC',  // Most recent first
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        $post_id = get_the_ID();
        
        echo get_the_title() . '<br>';
        echo get_post_meta( $post_id, 'eo_form_email', true ) . '<br>';
        echo get_post_meta( $post_id, 'eo_form_company', true ) . '<br>';
    }
    wp_reset_postdata();
}
?>
```

### Get Single Submission

```php
<?php
$post_id = 123;  // Replace with actual post ID

// Get basic post info
$post = get_post( $post_id );
$title = $post->post_title;
$date = $post->post_date;

// Get form meta data
$email       = get_post_meta( $post_id, 'eo_form_email', true );
$phone       = get_post_meta( $post_id, 'eo_form_phone', true );
$company     = get_post_meta( $post_id, 'eo_form_company', true );
$first_name  = get_post_meta( $post_id, 'eo_form_first_name', true );
$last_name   = get_post_meta( $post_id, 'eo_form_last_name', true );
$b2b_stage   = get_post_meta( $post_id, 'eo_b2b_stage', true );
$form_data   = get_post_meta( $post_id, 'eo_form_data', true );

// Display info
echo "Name: $first_name $last_name\n";
echo "Company: $company\n";
echo "Email: $email\n";
echo "Phone: $phone\n";
echo "B2B Stage: " . ucfirst( $b2b_stage ) . "\n";

// Full form data is an array with keys 1, 2, 3 for each part
echo "Full Form Data: " . json_encode( $form_data, JSON_PRETTY_PRINT ) . "\n";
?>
```

---

## Filtering & Searching

### Get Submissions by B2B Stage

```php
<?php
$stage = 'scaling';  // Options: launching, growing, scaling

$args = array(
    'post_type'      => 'eo_form_submission',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'   => 'eo_b2b_stage',
            'value' => $stage,
            'compare' => '=',
        ),
    ),
);

$query = new WP_Query( $args );
echo $query->found_posts . ' submissions in ' . $stage . ' stage';
?>
```

### Get Submissions by Date Range

```php
<?php
$start_date = '2025-01-01';
$end_date   = '2025-01-31';

$args = array(
    'post_type'      => 'eo_form_submission',
    'posts_per_page' => -1,
    'date_query'     => array(
        array(
            'after'     => $start_date,
            'before'    => $end_date,
            'inclusive' => true,
        ),
    ),
);

$query = new WP_Query( $args );
echo $query->found_posts . ' submissions in January 2025';
?>
```

### Get Submissions by Company

```php
<?php
$company = 'Acme Corp';

$args = array(
    'post_type'      => 'eo_form_submission',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'   => 'eo_form_company',
            'value' => $company,
            'compare' => '=',
        ),
    ),
);

$query = new WP_Query( $args );
echo $query->found_posts . ' submissions from ' . $company;
?>
```

### Get Submissions by Email (Search)

```php
<?php
$email_search = 'example.com';

$args = array(
    'post_type'      => 'eo_form_submission',
    'posts_per_page' => -1,
    's'              => $email_search,  // Search term
    'fields'         => 'ids',  // Return only IDs for performance
);

$query = new WP_Query( $args );

// Note: 's' searches in post content & title
// For better email search, use meta_query with LIKE:

$args_better = array(
    'post_type'      => 'eo_form_submission',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'     => 'eo_form_email',
            'value'   => $email_search,
            'compare' => 'LIKE',
        ),
    ),
);

$query = new WP_Query( $args_better );
?>
```

### Count Submissions by Stage

```php
<?php
$stages = array( 'launching', 'growing', 'scaling' );
$results = array();

foreach ( $stages as $stage ) {
    $args = array(
        'post_type'      => 'eo_form_submission',
        'posts_per_page' => 1,
        'fields'         => 'ids',
        'meta_query'     => array(
            array(
                'key'   => 'eo_b2b_stage',
                'value' => $stage,
            ),
        ),
    );
    
    $query = new WP_Query( $args );
    $results[ $stage ] = $query->found_posts;
}

echo 'Stage Breakdown:' . "\n";
echo 'Launching: ' . $results['launching'] . "\n";
echo 'Growing: ' . $results['growing'] . "\n";
echo 'Scaling: ' . $results['scaling'] . "\n";
?>
```

---

## Admin Customizations

### Add Custom Column to Admin Table

```php
<?php
// Add custom column to dashboard table
add_filter( 'manage_eo_form_submission_posts_columns', function( $columns ) {
    // Add new column after 'company'
    $new_columns = array();
    
    foreach ( $columns as $key => $label ) {
        $new_columns[ $key ] = $label;
        
        if ( $key === 'company' ) {
            $new_columns['source'] = 'Source';  // Add custom column
        }
    }
    
    return $new_columns;
} );

// Populate custom column
add_action( 'manage_eo_form_submission_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'source' ) {
        $form_data = get_post_meta( $post_id, 'eo_form_data', true );
        
        // Check which source this came from (e.g., check part1 data)
        $source = isset( $form_data[1]['source'] ) ? $form_data[1]['source'] : 'Unknown';
        echo esc_html( $source );
    }
}, 10, 2 );
?>
```

### Add Status Badge

```php
<?php
add_action( 'manage_eo_form_submission_posts_custom_column', function( $column, $post_id ) {
    if ( $column === 'b2b_stage' ) {
        $stage = get_post_meta( $post_id, 'eo_b2b_stage', true );
        
        // Define colors for each stage
        $colors = array(
            'launching' => '#0073aa',  // Blue
            'growing'   => '#00a32a',  // Green
            'scaling'   => '#dc3545',  // Red
        );
        
        $color = $colors[ $stage ] ?? '#666';
        
        echo '<span style="color: ' . esc_attr( $color ) . '; font-weight: bold;">';
        echo esc_html( ucfirst( $stage ) );
        echo '</span>';
    }
}, 10, 2 );
?>
```

### Make Columns Sortable

```php
<?php
add_filter( 'manage_edit-eo_form_submission_sortable_columns', function( $columns ) {
    $columns['eo_form_email'] = 'eo_form_email';
    $columns['eo_b2b_stage']  = 'eo_b2b_stage';
    
    return $columns;
} );

// Handle sorting
add_filter( 'posts_clauses', function( $clauses, $query ) {
    global $wpdb;
    
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return $clauses;
    }
    
    $orderby = $query->get( 'orderby' );
    
    if ( $orderby === 'eo_form_email' ) {
        $clauses .= ' INNER JOIN ' . $wpdb->postmeta . ' ON (' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id AND ' . $wpdb->postmeta . '.meta_key = "eo_form_email")';
        $clauses = str_replace( 'ORDER BY', 'ORDER BY ' . $wpdb->postmeta . '.meta_value', $clauses );
    }
    
    return $clauses;
}, 10, 2 );
?>
```

---

## Extending with Hooks

### Hook into Form Submission

```php
<?php
/**
 * Send to CRM when form is submitted
 */
add_action( 'eo_form_submitted', function( $post_id, $form_data ) {
    $email       = get_post_meta( $post_id, 'eo_form_email', true );
    $company     = get_post_meta( $post_id, 'eo_form_company', true );
    $first_name  = get_post_meta( $post_id, 'eo_form_first_name', true );
    $last_name   = get_post_meta( $post_id, 'eo_form_last_name', true );
    $phone       = get_post_meta( $post_id, 'eo_form_phone', true );
    $b2b_stage   = get_post_meta( $post_id, 'eo_b2b_stage', true );
    
    // Send to external CRM (example: HubSpot, Pipedrive, etc.)
    $payload = array(
        'email'     => $email,
        'firstName' => $first_name,
        'lastName'  => $last_name,
        'company'   => $company,
        'phone'     => $phone,
        'stage'     => $b2b_stage,
    );
    
    wp_remote_post( 'https://api.crm.example.com/contacts', array(
        'method'      => 'POST',
        'headers'     => array(
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . SOME_API_KEY,
        ),
        'body'        => wp_json_encode( $payload ),
    ) );
    
}, 10, 2 );
?>
```

### Add Custom Meta on Submission

```php
<?php
add_action( 'eo_form_submitted', function( $post_id, $form_data ) {
    // Add custom data not already captured
    update_post_meta( $post_id, 'eo_submission_ip', $_SERVER['REMOTE_ADDR'] ?? '' );
    update_post_meta( $post_id, 'eo_submission_source', sanitize_text_field( $_GET['utm_source'] ?? 'direct' ) );
    update_post_meta( $post_id, 'eo_submission_device', wp_is_mobile() ? 'mobile' : 'desktop' );
    update_post_meta( $post_id, 'eo_submission_status', 'new' );
}, 10, 2 );
?>
```

### Send Custom Email Notification

```php
<?php
add_action( 'eo_form_submitted', function( $post_id, $form_data ) {
    $email       = get_post_meta( $post_id, 'eo_form_email', true );
    $first_name  = get_post_meta( $post_id, 'eo_form_first_name', true );
    $company     = get_post_meta( $post_id, 'eo_form_company', true );
    
    // Send personalized email to user
    $to      = $email;
    $subject = 'Thank you for reaching out, ' . $first_name . '!';
    
    $message = "Hi $first_name,\n\n";
    $message .= "Thank you for submitting your information. ";
    $message .= "Our team at Electric Octopus will review your submission and contact you within 24 hours.\n\n";
    $message .= "Company: $company\n";
    $message .= "Submission ID: $post_id\n\n";
    $message .= "Best regards,\n";
    $message .= "Electric Octopus Team";
    
    wp_mail( $to, $subject, $message );
    
}, 10, 2 );
?>
```

### Create Slack Notification

```php
<?php
add_action( 'eo_form_submitted', function( $post_id, $form_data ) {
    $email       = get_post_meta( $post_id, 'eo_form_email', true );
    $company     = get_post_meta( $post_id, 'eo_form_company', true );
    $first_name  = get_post_meta( $post_id, 'eo_form_first_name', true );
    $b2b_stage   = get_post_meta( $post_id, 'eo_b2b_stage', true );
    
    $slack_webhook = 'https://hooks.slack.com/services/YOUR/WEBHOOK/URL';
    
    $message = array(
        'text' => '📝 New Form Submission',
        'blocks' => array(
            array(
                'type' => 'section',
                'text' => array(
                    'type' => 'mrkdwn',
                    'text' => "*New Submission from $first_name*\n" .
                             "*Company:* $company\n" .
                             "*Email:* $email\n" .
                             "*Stage:* $b2b_stage",
                ),
            ),
            array(
                'type' => 'actions',
                'elements' => array(
                    array(
                        'type' => 'button',
                        'text' => array(
                            'type' => 'plain_text',
                            'text' => 'View in Dashboard',
                        ),
                        'url' => admin_url( 'post.php?post=' . $post_id . '&action=edit' ),
                    ),
                ),
            ),
        ),
    );
    
    wp_remote_post( $slack_webhook, array(
        'method'  => 'POST',
        'body'    => wp_json_encode( $message ),
    ) );
    
}, 10, 2 );
?>
```

---

## Integration Examples

### Export Submissions as CSV

```php
<?php
function eo_export_submissions_csv() {
    // Check capability
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized' );
    }
    
    // Set headers for download
    header( 'Content-Disposition: attachment; filename="submissions.csv"' );
    header( 'Content-Type: text/csv' );
    
    $output = fopen( 'php://output', 'w' );
    
    // Write header row
    fputcsv( $output, array( 'Date', 'Company', 'First Name', 'Last Name', 'Email', 'Phone', 'Stage' ) );
    
    // Query submissions
    $args = array(
        'post_type'      => 'eo_form_submission',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    $query = new WP_Query( $args );
    
    while ( $query->have_posts() ) {
        $query->the_post();
        $post_id = get_the_ID();
        
        fputcsv( $output, array(
            get_the_date( 'Y-m-d H:i' ),
            get_post_meta( $post_id, 'eo_form_company', true ),
            get_post_meta( $post_id, 'eo_form_first_name', true ),
            get_post_meta( $post_id, 'eo_form_last_name', true ),
            get_post_meta( $post_id, 'eo_form_email', true ),
            get_post_meta( $post_id, 'eo_form_phone', true ),
            get_post_meta( $post_id, 'eo_b2b_stage', true ),
        ) );
    }
    
    fclose( $output );
    exit;
}

// Register hook for export button
if ( isset( $_GET['eo_export'] ) && $_GET['eo_export'] === '1' ) {
    eo_export_submissions_csv();
}
?>
```

### Generate PDF from Submission

```php
<?php
function eo_generate_submission_pdf( $post_id ) {
    // Requires dompdf library
    // composer require dompdf/dompdf
    
    require_once( get_template_directory() . '/vendor/autoload.php' );
    
    use Dompdf\Dompdf;
    
    $post = get_post( $post_id );
    
    // Get all submission data
    $email       = get_post_meta( $post_id, 'eo_form_email', true );
    $company     = get_post_meta( $post_id, 'eo_form_company', true );
    $first_name  = get_post_meta( $post_id, 'eo_form_first_name', true );
    $last_name   = get_post_meta( $post_id, 'eo_form_last_name', true );
    $phone       = get_post_meta( $post_id, 'eo_form_phone', true );
    $b2b_stage   = get_post_meta( $post_id, 'eo_b2b_stage', true );
    $form_data   = get_post_meta( $post_id, 'eo_form_data', true );
    
    // Create HTML content
    $html = '<h1>Form Submission Details</h1>';
    $html .= '<p><strong>Company:</strong> ' . esc_html( $company ) . '</p>';
    $html .= '<p><strong>Name:</strong> ' . esc_html( $first_name . ' ' . $last_name ) . '</p>';
    $html .= '<p><strong>Email:</strong> ' . esc_html( $email ) . '</p>';
    $html .= '<p><strong>Phone:</strong> ' . esc_html( $phone ) . '</p>';
    $html .= '<p><strong>Stage:</strong> ' . esc_html( ucfirst( $b2b_stage ) ) . '</p>';
    
    // Initialize dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml( $html );
    $dompdf->render();
    
    // Output PDF
    $dompdf->stream( "submission_$post_id.pdf" );
}
?>
```

---

## Debugging & Logging

### Log All Form Submissions

```php
<?php
add_action( 'eo_form_submitted', function( $post_id, $form_data ) {
    $log_file = WP_CONTENT_DIR . '/form-submissions.log';
    
    $log_entry = sprintf(
        "[%s] Post ID: %d | Email: %s | Company: %s | Stage: %s\n",
        date( 'Y-m-d H:i:s' ),
        $post_id,
        get_post_meta( $post_id, 'eo_form_email', true ),
        get_post_meta( $post_id, 'eo_form_company', true ),
        get_post_meta( $post_id, 'eo_b2b_stage', true )
    );
    
    file_put_contents( $log_file, $log_entry, FILE_APPEND );
}, 10, 2 );
?>
```

### Debug Form Data Structure

```php
<?php
add_action( 'eo_form_submitted', function( $post_id, $form_data ) {
    error_log( '=== Form Submission Debug ===' );
    error_log( 'Post ID: ' . $post_id );
    error_log( 'Form Data Structure: ' . print_r( $form_data, true ) );
    error_log( 'Meta Fields: ' . print_r( array(
        'email' => get_post_meta( $post_id, 'eo_form_email', true ),
        'phone' => get_post_meta( $post_id, 'eo_form_phone', true ),
        'company' => get_post_meta( $post_id, 'eo_form_company', true ),
        'firstName' => get_post_meta( $post_id, 'eo_form_first_name', true ),
        'lastName' => get_post_meta( $post_id, 'eo_form_last_name', true ),
        'stage' => get_post_meta( $post_id, 'eo_b2b_stage', true ),
    ), true ) );
    error_log( '=== End Debug ===' );
}, 10, 2 );
?>
```

### Check Submission in Dashboard

```php
<?php
// Get any submission and display all data
$post_id = 123;  // Replace with actual ID

echo '<pre>';
echo "POST ID: $post_id\n";
echo "Title: " . get_the_title( $post_id ) . "\n";
echo "Date: " . get_the_date( 'Y-m-d H:i:s', $post_id ) . "\n";
echo "\nMeta Data:\n";
echo "Email: " . get_post_meta( $post_id, 'eo_form_email', true ) . "\n";
echo "Phone: " . get_post_meta( $post_id, 'eo_form_phone', true ) . "\n";
echo "Company: " . get_post_meta( $post_id, 'eo_form_company', true ) . "\n";
echo "First Name: " . get_post_meta( $post_id, 'eo_form_first_name', true ) . "\n";
echo "Last Name: " . get_post_meta( $post_id, 'eo_form_last_name', true ) . "\n";
echo "B2B Stage: " . get_post_meta( $post_id, 'eo_b2b_stage', true ) . "\n";

$form_data = get_post_meta( $post_id, 'eo_form_data', true );
echo "\nFull Form Data:\n";
print_r( $form_data );
echo '</pre>';
?>
```

---

## Template Shortcode Example

```php
<?php
/**
 * Create a shortcode to display submission count
 * Usage: [eo_submission_count stage="scaling"]
 */
add_shortcode( 'eo_submission_count', function( $atts ) {
    $atts = shortcode_atts( array(
        'stage' => '',  // Optional: filter by stage
    ), $atts );
    
    $args = array(
        'post_type'      => 'eo_form_submission',
        'posts_per_page' => 1,
        'fields'         => 'ids',
    );
    
    if ( ! empty( $atts['stage'] ) ) {
        $args['meta_query'] = array(
            array(
                'key'   => 'eo_b2b_stage',
                'value' => $atts['stage'],
            ),
        );
    }
    
    $query = new WP_Query( $args );
    
    return '<strong>' . $query->found_posts . '</strong> submissions' . 
           ( ! empty( $atts['stage'] ) ? ' in ' . $atts['stage'] . ' stage' : '' );
} );
?>
```

---

## Performance Considerations

### Optimize Queries with Meta Indexes

```php
<?php
/**
 * Add database indexes for faster queries
 * Run this once during plugin activation
 */
function eo_add_meta_indexes() {
    global $wpdb;
    
    // These queries should only be run once
    // Add them to plugin activation hook
    
    $wpdb->query( "
        ALTER TABLE {$wpdb->postmeta}
        ADD INDEX eo_form_email (meta_key(10), meta_value(20))
        WHERE meta_key = 'eo_form_email'
    " );
    
    $wpdb->query( "
        ALTER TABLE {$wpdb->postmeta}
        ADD INDEX eo_b2b_stage (meta_key(15))
        WHERE meta_key = 'eo_b2b_stage'
    " );
}
?>
```

### Paginate Large Result Sets

```php
<?php
$current_page = isset( $_GET['paged'] ) ? intval( $_GET['paged'] ) : 1;
$per_page     = 50;

$args = array(
    'post_type'      => 'eo_form_submission',
    'posts_per_page' => $per_page,
    'paged'          => $current_page,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$query = new WP_Query( $args );

// Display pagination
echo paginate_links( array(
    'total' => $query->max_num_pages,
    'current' => $current_page,
) );
?>
```
