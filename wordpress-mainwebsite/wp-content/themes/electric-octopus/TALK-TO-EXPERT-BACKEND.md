# Talk to Expert Form Backend Documentation

## Overview
This backend system handles all form submissions from the "Talk to Expert" forms (template-talk-to-expert2.php and template-talk-to-expert-3.php). It provides:

1. **Custom Post Type** for storing form submissions
2. **AJAX Handler** for form submission processing
3. **Admin Dashboard** for viewing and managing submissions
4. **Analytics Dashboard** with charts and statistics
5. **Email Notifications** to admin on each submission

## Files Created

### Backend Files
- **`inc/talk-to-expert-handler.php`** - Main backend handler
  - Registers custom post type `eo_form_submission`
  - Handles AJAX form submissions
  - Manages email notifications
  - Customizes admin columns

- **`inc/talk-to-expert-admin.php`** - Admin dashboard
  - Main submissions list page
  - Analytics dashboard with charts
  - Search functionality

- **`js/eo-form/submission.js`** - Frontend submission script
  - Handles form data collection
  - Sends AJAX request to backend
  - Manages form submission flow

## Features

### 1. Custom Post Type: `eo_form_submission`
- Stores each form submission as a WordPress post
- Non-public, only visible in admin dashboard
- Supports:
  - Post meta for form data
  - Custom admin columns
  - Search and filtering
  - Email notifications

### 2. Form Data Captured
Each submission stores:
- **Basic Info**
  - Email (required)
  - Phone number
  - Company name
  - B2B Stage (Launching, Growing, Scaling)

- **Full Assessment Data**
  - All answers from assessment forms
  - Complete form responses
  - Stored as JSON in post meta

### 3. Admin Dashboard Features

#### Submissions List (`Talk to Expert` menu)
- View all form submissions
- Search by email or company name
- Sort by date, email, company, phone, B2B stage
- Quick view button to see full submission details
- Displays submission date and time

#### Submission Details
- View complete form data in organized sections
- Pretty-printed JSON display
- Section-by-section breakdown
- Easy-to-read format

#### Analytics Dashboard (`Analytics` submenu)
- Total submissions count
- B2B stage breakdown
- Submissions timeline (last 30 days)
- Stage distribution chart
- Visual charts using Chart.js

### 4. Email Notifications
Admin receives email when form is submitted with:
- Company name
- Email address
- Phone number
- B2B stage
- Link to view submission in admin

## How It Works

### Frontend Flow
1. User fills out the Talk to Expert form
2. Form data is collected in JavaScript (sessionStorage)
3. When submit button is clicked, `submitEOForm()` is called
4. Data is sent via AJAX to backend
5. User is redirected to thank you page

### Backend Flow
1. AJAX request received at `wp-admin/admin-ajax.php`
2. Nonce verified for security
3. Form data is sanitized and validated
4. New post created of type `eo_form_submission`
5. Post meta saved with form data
6. Email notification sent to admin
7. Success response sent back to frontend

## Usage

### For Users
1. Navigate to the Talk to Expert page
2. Fill out the multi-part form
3. Click "Submit" or "Continue" button
4. Form data is automatically saved to the admin dashboard

### For Admin
1. Go to WordPress Dashboard
2. Click on "Talk to Expert" in left sidebar
3. View all submissions or search for specific ones
4. Click "View" to see full form submission details
5. Check "Analytics" tab for insights and statistics

### For Developers

#### Extending Functionality
The system includes a WordPress action hook for developers:

```php
// In your plugin or theme
add_action( 'eo_form_submitted', function( $post_id, $form_data ) {
    // Your custom code here
    // $post_id - the ID of the created post
    // $form_data - the complete form data array
}, 10, 2 );
```

#### Customizing Email Notifications
Edit the `eo_send_form_notification()` function in `inc/talk-to-expert-handler.php`:

```php
function eo_send_form_notification( $post_id, $form_data ) {
    // Customize email content, recipients, etc.
}
```

#### Adding Custom Meta Fields
Register additional post meta in `eo_register_form_submission_post_type()`:

```php
register_post_meta( 'eo_form_submission', 'your_meta_key', array(
    'type'          => 'string',
    'single'        => true,
    'show_in_rest'  => true,
) );
```

## Database Structure

### Post Type: `eo_form_submission`
```
Post Type: eo_form_submission
├── post_title (Company Name or Email)
├── post_date (Submission timestamp)
├── post_status (publish)
└── Post Meta:
    ├── eo_form_data (JSON - all form answers)
    ├── eo_form_email (string - contact email)
    ├── eo_form_phone (string - phone number)
    ├── eo_form_company (string - company name)
    └── eo_b2b_stage (string - business stage)
```

## Security

### Implemented Security Measures
1. **Nonce Verification** - AJAX requests are verified with WordPress nonces
2. **Input Sanitization** - All user inputs are sanitized using WordPress functions
3. **Capability Checking** - Admin pages require `manage_options` capability
4. **Email Validation** - Email addresses are validated before saving
5. **SQL Injection Prevention** - Uses WordPress prepared queries

## Troubleshooting

### Form Not Submitting
1. Check browser console for JavaScript errors
2. Verify nonce is properly generated in `eo_enqueue_form_scripts()`
3. Check AJAX URL is correct: `admin_url( 'admin-ajax.php' )`
4. Ensure `submitEOForm()` function is called on form submit

### Submissions Not Appearing
1. Check that custom post type is registered: `wp-admin/edit.php?post_type=eo_form_submission`
2. Verify post type registered in `functions.php`
3. Check database for posts with post_type = 'eo_form_submission'

### Email Notifications Not Received
1. Check WordPress mail function is working
2. Verify admin email in WordPress settings
3. Check spam folder
4. Test with `wp_mail()` function

### Analytics Not Loading
1. Ensure Chart.js library is loading (check source)
2. Verify submissions exist in database
3. Check browser console for JavaScript errors
4. Ensure PHP execution is not timing out

## Performance Considerations

1. **Database Queries** - Analytics page queries all submissions, may be slow with 1000+ submissions
   - Consider adding WP-CLI commands for bulk operations
   - Implement pagination for large datasets

2. **Email Sending** - Emails are sent synchronously during form submission
   - Consider using a queue system for high volume
   - Use async email plugin in production

3. **Caching** - Analytics data could be cached
   - Implement transient caching for statistics
   - Clear cache on new submission

## Future Enhancements

1. Export submissions to CSV
2. Bulk delete submissions
3. Email templates customization
4. Advanced filtering and sorting
5. Integration with CRM systems
6. Webhook support for external services
7. Custom field builder for form customization
8. Automated follow-up emails

## Support

For issues or questions about the Talk to Expert form backend:
1. Check this documentation
2. Review the code comments
3. Test in a staging environment first
4. Check WordPress debug logs
