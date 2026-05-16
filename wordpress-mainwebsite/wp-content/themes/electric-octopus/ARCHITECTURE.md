# Talk to Expert Backend - Architecture Overview

## System Flow Diagram

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                          FRONTEND - USER SIDE                               │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│  Talk to Expert Form Pages:                                                │
│  • template-talk-to-expert2.php                                            │
│  • template-talk-to-expert-3.php                                           │
│                          ▼                                                   │
│              Multi-Part Assessment Form                                     │
│              (Part 1 → Part 2 → Part 3)                                     │
│                          ▼                                                   │
│     JavaScript Form Handler (assessment-3.js)                              │
│     • Collects form data                                                   │
│     • Stores in sessionStorage                                             │
│                          ▼                                                   │
│         User Clicks "Submit" Button                                         │
│                          ▼                                                   │
│      submitEOForm() Function Called                                         │
│      (js/eo-form/submission.js)                                             │
│                          ▼                                                   │
│   ┌─────────────────────────────────────┐                                  │
│   │    Prepare AJAX Request             │                                  │
│   │ • Add nonce verification            │                                  │
│   │ • Include form data                 │                                  │
│   │ • Add b2b_stage from sessionStorage │                                  │
│   └─────────────────────────────────────┘                                  │
│                          ▼                                                   │
│         AJAX POST to /wp-admin/admin-ajax.php                             │
│         (action=eo_submit_form)                                            │
│                                                                              │
└──────────────────────────────────────┬───────────────────────────────────────┘
                                       │
                                       │ HTTP Request
                                       ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│                         BACKEND - SERVER SIDE                               │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│         WordPress AJAX Handler                                              │
│         wp_ajax_eo_submit_form Hook                                         │
│                          ▼                                                   │
│    ┌─────────────────────────────────────────┐                             │
│    │  Verify Nonce                           │                             │
│    │  (Security Check)                       │                             │
│    └─────────────────────────────────────────┘                             │
│                          ▼                                                   │
│    ┌─────────────────────────────────────────┐                             │
│    │  Sanitize & Validate Input              │                             │
│    │  • Email validation                     │                             │
│    │  • Text field sanitization              │                             │
│    └─────────────────────────────────────────┘                             │
│                          ▼                                                   │
│    ┌─────────────────────────────────────────┐                             │
│    │  Create WordPress Post                  │                             │
│    │  Post Type: eo_form_submission          │                             │
│    │  Post Title: Company Name or Email      │                             │
│    └─────────────────────────────────────────┘                             │
│                          ▼                                                   │
│    ┌─────────────────────────────────────────┐                             │
│    │  Save Post Meta Data                    │                             │
│    │  • eo_form_data (all answers)           │                             │
│    │  • eo_form_email                        │                             │
│    │  • eo_form_phone                        │                             │
│    │  • eo_form_company                      │                             │
│    │  • eo_b2b_stage                         │                             │
│    └─────────────────────────────────────────┘                             │
│                          ▼                                                   │
│    ┌─────────────────────────────────────────┐                             │
│    │  Fire WordPress Action Hook             │                             │
│    │  do_action('eo_form_submitted')         │                             │
│    └─────────────────────────────────────────┘                             │
│                          ▼                                                   │
│    ┌─────────────────────────────────────────┐                             │
│    │  Send Email Notification                │                             │
│    │  • To: Admin Email                      │                             │
│    │  • Includes: Company, Email, Phone      │                             │
│    │  • Includes: Link to view submission    │                             │
│    └─────────────────────────────────────────┘                             │
│                          ▼                                                   │
│    ┌─────────────────────────────────────────┐                             │
│    │  Return JSON Response                   │                             │
│    │  • success: true                        │                             │
│    │  • post_id: [ID]                        │                             │
│    │  • message: "Success"                   │                             │
│    └─────────────────────────────────────────┘                             │
│                                                                              │
└──────────────────────────────────────┬───────────────────────────────────────┘
                                       │
                                       │ JSON Response
                                       ▼
┌─────────────────────────────────────────────────────────────────────────────┐
│                         FRONTEND - RESPONSE                                 │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│     JavaScript Receives Response                                            │
│                          ▼                                                   │
│     Check Response.success                                                  │
│            ├─ TRUE:  Redirect to Thank You Page                            │
│            └─ FALSE: Show Error Message                                    │
│                                                                              │
└─────────────────────────────────────────────────────────────────────────────┘
```

## Database Structure

```
WordPress Posts Table
└── Post Type: eo_form_submission
    ├── ID
    ├── post_title: "Company Name"
    ├── post_date: "2024-01-19 10:30:00"
    ├── post_type: "eo_form_submission"
    ├── post_status: "publish"
    └── Post Meta:
        ├── eo_form_data: {
        │   "part1": { ... },
        │   "part2": { ... },
        │   "part3": { ... }
        │ }
        ├── eo_form_email: "user@example.com"
        ├── eo_form_phone: "+1-555-0000"
        ├── eo_form_company: "Acme Corp"
        └── eo_b2b_stage: "launching"
```

## File Structure

```
wp-content/themes/electric-octopus/
│
├── functions.php
│   └── Includes handlers:
│       • require_once talk-to-expert-handler.php
│       • require_once talk-to-expert-admin.php (in admin)
│
├── inc/
│   ├── talk-to-expert-handler.php
│   │   ├── eo_register_form_submission_post_type()
│   │   ├── eo_handle_form_submission() [AJAX Handler]
│   │   ├── eo_send_form_notification()
│   │   ├── eo_customize_form_submission_columns()
│   │   ├── eo_populate_form_submission_columns()
│   │   └── eo_enqueue_form_scripts()
│   │
│   └── talk-to-expert-admin.php
│       ├── eo_add_admin_menu()
│       ├── eo_render_form_dashboard()
│       ├── eo_render_form_analytics()
│       └── eo_enqueue_admin_styles_scripts()
│
├── js/eo-form/
│   ├── eo-form-controller.js (existing)
│   ├── part1.js (existing)
│   ├── part2.js (existing)
│   ├── part3.js (existing)
│   └── submission.js [NEW]
│       └── submitEOForm(answers) [Main function]
│
├── css/
│   ├── custom-style.css
│   └── admin.css [NEW]
│
├── assets/js/
│   ├── assessment-2.js (existing)
│   └── assessment-3.js (existing)
│
└── Documentation:
    ├── SETUP-GUIDE.md [Quick start guide]
    ├── TALK-TO-EXPERT-BACKEND.md [Full documentation]
    └── IMPLEMENTATION-CHECKLIST.md [Verification checklist]
```

## Admin Dashboard Structure

```
WordPress Admin Dashboard
│
└── "Talk to Expert" Menu
    ├── All Submissions
    │   └── Displays:
    │       • Company Name
    │       • Email (mailto link)
    │       • Phone Number
    │       • B2B Stage
    │       • Submission Date
    │       • View Button
    │       
    ├── Individual Submission (Post Edit)
    │   └── Displays:
    │       • All form data by section
    │       • Part 1 answers
    │       • Part 2 answers
    │       • Part 3 answers
    │       • Post meta fields
    │
    └── Analytics
        └── Displays:
            • Total Submissions (metric)
            • Launching Stage Count (metric)
            • Growing Stage Count (metric)
            • Scaling Stage Count (metric)
            • Submissions Timeline (line chart - 30 days)
            • Stage Distribution (pie chart)
```

## Security Flow

```
Form Submission Security Layers
│
├── Layer 1: Frontend
│   └── Nonce Token Generated
│       └── (Using wp_create_nonce('eo_form_nonce'))
│
├── Layer 2: AJAX Transmission
│   └── POST request with nonce
│       └── Sent to /wp-admin/admin-ajax.php
│
├── Layer 3: Backend Verification
│   └── check_ajax_referer('eo_form_nonce', 'nonce')
│       ├── Verifies nonce is valid
│       └── Prevents CSRF attacks
│
├── Layer 4: Input Validation
│   ├── Email validation: is_email()
│   ├── Text sanitization: sanitize_text_field()
│   ├── Email sanitization: sanitize_email()
│   └── JSON parsing: json_decode with error checking
│
├── Layer 5: Data Storage
│   └── Uses wp_insert_post() and update_post_meta()
│       └── WordPress built-in functions
│
└── Layer 6: Admin Access
    └── current_user_can('manage_options')
        └── Only admins can view submissions
```

## Data Flow with Examples

```
Step 1: User fills form with data
├── part1: { business_stage: "growing", employees: "4-10", ... }
├── part2: { website: "example.com", b2b: true, ... }
└── part3: { 
    email: "john@example.com",
    phone: "+1-555-1234",
    company: "Tech Solutions Inc"
}

Step 2: JavaScript prepares AJAX request
├── Adds nonce: "a1b2c3d4e5f6g7h8"
├── Adds action: "eo_submit_form"
├── Adds formData: JSON.stringify(allAnswers)
└── Adds b2bStage: "scaling"

Step 3: Server receives request
├── Verifies nonce ✓
├── Validates email ✓
├── Sanitizes inputs ✓
└── Stores in database ✓

Step 4: Database saves
├── Creates post with:
│   ├── post_title: "Tech Solutions Inc"
│   ├── post_date: current timestamp
│   └── post_type: "eo_form_submission"
│
└── Creates post meta with:
    ├── eo_form_data: { complete form object }
    ├── eo_form_email: "john@example.com"
    ├── eo_form_phone: "+1-555-1234"
    ├── eo_form_company: "Tech Solutions Inc"
    └── eo_b2b_stage: "scaling"

Step 5: Admin dashboard displays
├── Shows in submissions list
├── Can search by email/company
├── Can view full details
└── Can see in analytics
```

## Performance Considerations

```
Query Optimization
├── Submissions List
│   └── Uses WP_Query with:
│       • posts_per_page: 50
│       • orderby: date
│       • order: DESC
│       └── Result: Fast, paginated display
│
├── Analytics Page
│   └── Uses multiple queries:
│       • Total count: 1 query
│       • Stage breakdown: 1 query per stage
│       • Date breakdown: 31 queries (one per day)
│       └── Result: Could be optimized with caching
│
└── Recommendations
    ├── Implement transient caching for analytics
    ├── Add pagination to large result sets
    ├── Consider database indexing on meta values
    └── Monitor query performance with Query Monitor
```

---

## Quick Reference

### AJAX Endpoint
```
POST /wp-admin/admin-ajax.php
action: eo_submit_form
nonce: (generated token)
formData: (JSON string)
b2bStage: (launching|growing|scaling)
```

### Post Type
```
Post Type: eo_form_submission
Taxonomies: None
Archive: No
Public: No
Show in Admin: Yes
REST Support: Yes
```

### Menu Structure
```
Dashboard
└── Talk to Expert
    ├── All Submissions (default)
    └── Analytics
```

### Email Recipients
```
To: get_option('admin_email')
Subject: "New Form Submission: [Company Name]"
Content: Text email with submission details
```

---

**Last Updated:** January 19, 2026  
**Architecture Version:** 1.0
