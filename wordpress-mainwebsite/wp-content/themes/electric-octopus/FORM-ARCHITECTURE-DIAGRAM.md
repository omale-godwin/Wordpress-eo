# Form Submission Architecture Diagram

## System Overview

```
┌──────────────────────────────────────────────────────────────────────────┐
│                          FRONTEND (User-Facing)                          │
├──────────────────────────────────────────────────────────────────────────┤
│                                                                          │
│  ┌─────────────┐    ┌─────────────┐    ┌──────────────┐               │
│  │   PART 1    │    │   PART 2    │    │   PART 3     │               │
│  │   Template  │───▶│   Template  │───▶│   Template   │               │
│  └─────────────┘    └─────────────┘    └──────────────┘               │
│        ▲                   ▲                    ▲                       │
│        │                   │                    │                       │
│        └───────────────────┴────────────────────┘                       │
│                      eo-form-controller.js                              │
│                      (State Management)                                 │
│                   EO_FORM = { answers: {} }                            │
│                                                                          │
│  ┌──────────────────────────────────────────────────────────────────┐  │
│  │  sessionStorage                                                  │  │
│  ├──────────────────────────────────────────────────────────────────┤  │
│  │ • eo_part = "part1|part2|part3"                                │  │
│  │ • eo_answers = { "1": {...}, "2": {...}, "3": {...} }         │  │
│  │ • b2b_stage = "launching|growing|scaling"                     │  │
│  └──────────────────────────────────────────────────────────────────┘  │
│                                                                          │
│                           ▼ SUBMIT                                       │
│                                                                          │
│                    submission.js (AJAX)                                 │
│              POST /wp-admin/admin-ajax.php                             │
│              action=eo_submit_form&nonce=...&formData=[...]          │
│                                                                          │
└──────────────────────────────────────────────────────────────────────────┘
                                 │
                                 │ AJAX Request
                                 ▼
┌──────────────────────────────────────────────────────────────────────────┐
│                         BACKEND (WordPress)                              │
├──────────────────────────────────────────────────────────────────────────┤
│                                                                          │
│  talk-to-expert-handler.php                                            │
│  └─ eo_handle_form_submission() [AJAX Action]                         │
│     │                                                                   │
│     ├─ Verify Nonce ✓                                                 │
│     │                                                                   │
│     ├─ Parse Form Data                                                │
│     │  └─ Decode JSON from all 3 parts                               │
│     │                                                                   │
│     ├─ Extract Fields                                                 │
│     │  ├─ Email (required, validated)                               │
│     │  ├─ Phone                                                      │
│     │  ├─ Company                                                    │
│     │  ├─ First Name / Last Name                                    │
│     │  └─ B2B Stage (launching|growing|scaling)                     │
│     │                                                                   │
│     ├─ Create Post                                                   │
│     │  └─ Post Type: eo_form_submission                             │
│     │     Post Title: Company or Email                              │
│     │     Post Status: publish                                      │
│     │                                                                   │
│     ├─ Save Meta Data                                                │
│     │  ├─ eo_form_data = [...entire JSON...]                       │
│     │  ├─ eo_form_email = "..."                                     │
│     │  ├─ eo_form_phone = "..."                                     │
│     │  ├─ eo_form_company = "..."                                   │
│     │  ├─ eo_form_first_name = "..."                               │
│     │  ├─ eo_form_last_name = "..."                                │
│     │  └─ eo_b2b_stage = "..."                                      │
│     │                                                                   │
│     ├─ Send Admin Email Notification                                │
│     │  └─ eo_send_form_notification()                              │
│     │                                                                   │
│     ├─ Trigger Action Hook                                          │
│     │  └─ do_action('eo_form_submitted', $post_id, $form_data)     │
│     │                                                                   │
│     └─ Return JSON Response                                          │
│        └─ { success: true, data: { post_id: 123 } }                 │
│                                                                          │
└──────────────────────────────────────────────────────────────────────────┘
                                 │
                    Response sent to frontend
                                 │
                                 ▼
                        Redirect to thank you page
```

---

## Admin Dashboard Architecture

```
┌─────────────────────────────────────────────────────────────────────────┐
│                    WordPress Admin Dashboard                            │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                         │
│  ┌────────────────────────────────────────────────────────────────┐   │
│  │  Left Menu: "Talk to Expert"  (talk-to-expert-admin.php)      │   │
│  ├────────────────────────────────────────────────────────────────┤   │
│  │                                                                │   │
│  │  Main Menu (page=eo-form-dashboard)                          │   │
│  │  └─ All Submissions [DEFAULT]                               │   │
│  │     │                                                         │   │
│  │     ├─ Search Box: [Search by email or company]             │   │
│  │     │                                                         │   │
│  │     ├─ Display Counter: "N submissions"                     │   │
│  │     │                                                         │   │
│  │     └─ Submissions Table:                                   │   │
│  │        ┌────────────────────────────────────────────────┐   │   │
│  │        │ Company │ Email │ Phone │ Stage │ Submitted │    │   │
│  │        ├────────────────────────────────────────────────┤   │   │
│  │        │ Acme   │email@. │+1234  │Scaling│Jan 15 10:30│ [VIEW]
│  │        │        │        │       │       │            │    │   │
│  │        │ XYZ    │test@.. │+5678  │Growing│Jan 14 09:15│ [VIEW]
│  │        │        │        │       │       │            │    │   │
│  │        └────────────────────────────────────────────────┘   │   │
│  │        Each [VIEW] button opens post edit screen            │   │
│  │                                                                │   │
│  │  ├─ Analytics (page=eo-form-analytics)                      │   │
│  │     │                                                         │   │
│  │     ├─ Total Submissions: [123]                             │   │
│  │     │                                                         │   │
│  │     ├─ B2B Stage Breakdown:                                 │   │
│  │     │  ├─ Launching: [45]                                  │   │
│  │     │  ├─ Growing:   [38]                                  │   │
│  │     │  └─ Scaling:   [40]                                  │   │
│  │     │                                                         │   │
│  │     └─ 30-Day Submission Trend: [Chart Data]              │   │
│  │                                                                │   │
│  └────────────────────────────────────────────────────────────────┘   │
│                                                                         │
└─────────────────────────────────────────────────────────────────────────┘
```

---

## Database Schema

```
WordPress wp_posts Table
┌─────────────────────────────────────────┐
│ post_id     │ post_type              │ ID (auto-increment)
│ post_title  │ Company or Email       │ Unique identifier for form
│ post_content│ Empty                  │ Not used
│ post_status │ publish                │ Always published
│ post_date   │ current_time('mysql')  │ Submission timestamp
├─────────────────────────────────────────┤
│ post_type: eo_form_submission           │
└─────────────────────────────────────────┘

WordPress wp_postmeta Table
┌──────────────────────────────────────────────────────────┐
│ meta_id        │ post_id   │ meta_key        │ meta_value
├──────────────────────────────────────────────────────────┤
│ 1              │ 123       │ eo_form_data    │ {...JSON...}
│ 2              │ 123       │ eo_form_email   │ user@example.com
│ 3              │ 123       │ eo_form_phone   │ +1-234-567-8900
│ 4              │ 123       │ eo_form_company │ Acme Corp
│ 5              │ 123       │ eo_form_first_name│ John
│ 6              │ 123       │ eo_form_last_name │ Doe
│ 7              │ 123       │ eo_b2b_stage    │ scaling
└──────────────────────────────────────────────────────────┘

eo_form_data Structure (JSON Object)
{
  "1": {
    "fieldName1": "value1",
    "fieldName2": "value2",
    ...
  },
  "2": {
    "fieldName3": "value3",
    ...
  },
  "3": {
    "email": "user@example.com",
    "phone": "+1-234-567-8900",
    "company": "Acme Corp",
    ...
  }
}
```

---

## Form Data Collection Timeline

```
User Flow:
═════════════════════════════════════════════════════════════════════════

Step 1: PART 1 FORM
─────────────────────────────────────────────────────────────────────────
User fills out Part 1 questions
        │
        ├─ JS: part1.js
        │  └─ EO_FORM.answers.part1 = {...}
        │     EO_FORM.part = "part1"
        │     EO_FORM.save()  ◀─ Stored to sessionStorage
        │
        └─ JS: eo-form-controller.js
           └─ Display Part 2 Form
              EO_FORM.show("part2")

Step 2: PART 2 FORM
─────────────────────────────────────────────────────────────────────────
User fills out Part 2 questions
        │
        ├─ JS: part2.js
        │  └─ EO_FORM.answers.part2 = {...}
        │     EO_FORM.part = "part2"
        │     EO_FORM.save()  ◀─ Stored to sessionStorage
        │
        └─ JS: eo-form-controller.js
           └─ Display Part 3 Form
              EO_FORM.show("part3")

Step 3: PART 3 FORM
─────────────────────────────────────────────────────────────────────────
User fills out Part 3 questions
User selects B2B Stage (Launching|Growing|Scaling)
        │
        ├─ JS: part3.js
        │  └─ EO_FORM.answers.part3 = {...}
        │     EO_FORM.part = "part3"
        │     EO_FORM.save()  ◀─ Stored to sessionStorage
        │
        └─ JS: part3.js (Submit)
           └─ submitEOForm(EO_FORM.answers)
              Calls: JS: submission.js

Step 4: AJAX SUBMISSION
─────────────────────────────────────────────────────────────────────────
AJAX request sent to backend
        │
        └─ POST: /wp-admin/admin-ajax.php?action=eo_submit_form
           Body: {
             action: "eo_submit_form",
             nonce: "xyz123",
             formData: JSON.stringify(EO_FORM.answers),
             b2bStage: "scaling"
           }

Step 5: BACKEND PROCESSING
─────────────────────────────────────────────────────────────────────────
Backend receives AJAX request
        │
        ├─ Function: eo_handle_form_submission()
        │  ├─ Verify nonce ✓
        │  ├─ Parse formData from all 3 parts
        │  ├─ Validate email
        │  ├─ Extract fields:
        │  │  ├─ email (required)
        │  │  ├─ phone
        │  │  ├─ company
        │  │  ├─ firstName
        │  │  └─ lastName
        │  ├─ Create WordPress post
        │  │  └─ Post Type: eo_form_submission
        │  │     Title: company or email
        │  ├─ Save all meta fields
        │  ├─ Send admin email notification
        │  ├─ Trigger action hook
        │  └─ Return JSON success
        │
        └─ Response: { success: true, post_id: 123 }

Step 6: REDIRECT
─────────────────────────────────────────────────────────────────────────
Frontend receives success response
        │
        └─ Redirect to thank you page
           window.location.href = "thank-you-page"

═════════════════════════════════════════════════════════════════════════
```

---

## Admin Dashboard Workflow

```
Admin Access:
═════════════════════════════════════════════════════════════════════════

1. Open WordPress Admin
   └─ Left Menu → "Talk to Expert"

2. View All Submissions (Default Page)
   ├─ Load function: eo_render_form_dashboard()
   ├─ Query all eo_form_submission posts
   ├─ Display in table format:
   │  ├─ Company
   │  ├─ Email
   │  ├─ Phone
   │  ├─ B2B Stage
   │  ├─ Submitted (date/time)
   │  └─ Action (View button)
   │
   ├─ Search Functionality:
   │  ├─ Form field: [Search box]
   │  ├─ Filter by: email or company
   │  └─ POST parameter: ?s=search_term
   │
   └─ Click [VIEW] button
      └─ Opens: /wp-admin/post.php?post=123&action=edit
         Displays full post with all meta fields

3. View Analytics
   ├─ Load function: eo_render_form_analytics()
   ├─ Display Statistics:
   │  ├─ Total Submissions (count)
   │  ├─ Launching Stage (count)
   │  ├─ Growing Stage (count)
   │  ├─ Scaling Stage (count)
   │  └─ 30-Day Trend Data (for charts)
   │
   └─ Use data for reporting/decision-making

═════════════════════════════════════════════════════════════════════════
```

---

## Security & Data Flow

```
┌─────────────────────────────────────────────────────────────┐
│                  SECURITY LAYERS                             │
├─────────────────────────────────────────────────────────────┤
│                                                              │
│  Frontend (submission.js)                                   │
│  └─ CSRF Protection                                         │
│     ├─ Nonce generated: eoFormVars.nonce                   │
│     └─ Included in AJAX: formData.append('nonce', ...)     │
│                                                              │
│  Backend (talk-to-expert-handler.php)                      │
│  ├─ Nonce Verification                                      │
│  │  └─ wp_verify_nonce($_POST['nonce'], 'eo_form_nonce')  │
│  │                                                           │
│  ├─ Capability Check (for admin views)                     │
│  │  └─ current_user_can('manage_options')                  │
│  │                                                           │
│  ├─ Input Sanitization                                      │
│  │  ├─ Email: sanitize_email()                             │
│  │  ├─ Phone: sanitize_text_field()                        │
│  │  └─ Search: sanitize_text_field() + wp_unslash()       │
│  │                                                           │
│  ├─ Validation                                              │
│  │  ├─ Email: is_email()                                   │
│  │  └─ Required: empty() check                             │
│  │                                                           │
│  └─ Output Escaping (in admin pages)                       │
│     ├─ HTML: esc_html()                                    │
│     ├─ Attributes: esc_attr()                              │
│     └─ URLs: esc_url()                                     │
│                                                              │
└─────────────────────────────────────────────────────────────┘
```
