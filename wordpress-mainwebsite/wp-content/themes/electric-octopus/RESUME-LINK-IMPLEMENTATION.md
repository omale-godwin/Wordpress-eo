# Resume Link Implementation Guide

## Overview
This document describes the resume link functionality implemented for mid-form submissions. Users who are "qualified" (have answered part 2 or part 3) can generate a shareable link to resume their form submission later.

## Qualification Criteria
A user is considered **qualified** when they have provided meaningful form data, specifically:
- **Answered Part 2** (Industry & Services assessment), OR
- **Answered Part 3** (Contact Details & B2B Stage)

Users who only answered **Part 1** (Basic Information) are **NOT qualified** and will NOT see a resume link.

## How Resume Links Work

### 1. Token Generation (Frontend - `js/eo-form/eo-form-controller.js`)
When a qualified user navigates away from the form:

```javascript
// Token is automatically generated when:
- User answers part 2 or part 3 (becomes qualified)
- User leaves the page (beforeunload event)
- User clicks "Save Your Progress" button

// Token format:
Token = Base64(JSON stringify({
  part: 'part3',           // Last part user reached
  answers: {...},          // All form answers
  timestamp: 1234567890    // When token was generated
}))
```

### 2. Resume Link Display (UI)
For qualified users, a "Save Your Progress" button appears above Part 1:
- Click button → Copies resume URL to clipboard
- Shows "✓ Copied!" confirmation
- URL format: `https://example.com/?eo_resume=[BASE64_TOKEN]`

### 3. Form Restoration (Frontend - `js/eo-form/eo-form-controller.js`)
When user clicks the resume link:

```javascript
// Checks URL for ?eo_resume parameter
if (url contains eo_resume) {
  1. Decode token (Base64 → JSON)
  2. Restore answers to sessionStorage
  3. Populate form fields
  4. Skip to last part user reached
  5. Display resume link again
}
```

### 4. Backend Storage (PHP - `inc/talk-to-expert-handler.php`)
When form is submitted:

```php
// Stored meta fields:
eo_form_qualified  // 'yes' or 'no'
eo_resume_token    // Base64-encoded token (audit trail)

// Allows admin to:
- See which submissions came from resumed users
- Track qualification status
- Generate analytics on resume rate
```

## Implementation Files

### Frontend Files
1. **`js/eo-form/eo-form-controller.js`**
   - `EO_FORM.isQualified()` - Check qualification status
   - `EO_FORM.generateResumeToken()` - Create Base64 token
   - `EO_FORM.restoreFromToken(token)` - Decode and restore state
   - `EO_FORM.getResumeUrl()` - Generate shareable URL
   - `EO_FORM.displayResumeLink()` - Show copy button UI
   - DOMContentLoaded hook - Restore from URL param

2. **`js/eo-form/part1.js`, `part2.js`, `part3.js`**
   - Capture answers into `EO_FORM.answers.partX`
   - Save to sessionStorage on change

3. **`js/eo-form/submission.js`**
   - `submitEOForm()` - Send form + resume data to backend
   - Clears sessionStorage on success
   - Includes: isQualified flag, resumeToken

### Backend Files
1. **`inc/talk-to-expert-handler.php`**
   - Registers meta fields: `eo_form_qualified`, `eo_resume_token`
   - AJAX handler accepts: `isQualified`, `resumeToken` POST params
   - Stores qualification status for analytics

2. **`functions.php`**
   - Enqueues form scripts: controller → part1/2/3 → submission
   - Localizes nonce and AJAX URL

## Testing Scenarios

### Test 1: Unqualified User (Part 1 Only)
```
1. Start form
2. Fill Part 1 (name, email, etc.)
3. Look above Part 1 - NO resume link button should appear
4. Refresh page - form data restored from sessionStorage
✓ PASS: No link for unqualified users
```

### Test 2: Qualified User (Part 2+)
```
1. Start form, complete Part 1
2. Continue to Part 2 (Industry assessment)
3. Answer at least one question in Part 2
4. Look above Part 1 - "Save Your Progress" button should appear
5. Right-click button → "Copy Link Address" (or click to copy)
6. Check browser console: `EO_FORM.generateResumeToken()` should return token
✓ PASS: Link appears when qualified
```

### Test 3: Resume Link Functionality
```
1. Complete steps 1-3 from Test 2
2. Copy resume link: https://domain.com/?eo_resume=[TOKEN]
3. Open link in new tab/window/incognito
4. Form should restore to Part 2 (where you left off)
5. All previously entered data should be visible
6. Resume link button should appear again
✓ PASS: Form fully restored and operational
```

### Test 4: Submit with Qualified Status
```
1. Complete Part 1, 2, 3 of form
2. Submit form
3. Go to WordPress Admin → Forms → Submissions
4. Click submission to view details
5. Check post meta: eo_form_qualified should be "yes"
6. Check post meta: eo_resume_token should contain Base64 string
✓ PASS: Metadata stored correctly
```

### Test 5: Mid-Form Abandonment
```
1. Start form, complete Part 1, 2 (become qualified)
2. Open browser console
3. Before unload event:
   - window.addEventListener('beforeunload') should trigger
   - eo_resume_token updated in sessionStorage
4. Close browser / navigate away
5. Return and use resume link
✓ PASS: Token refreshed on page exit
```

## Database Structure

### Meta Fields (Post Meta)
| Meta Key | Type | Purpose |
|----------|------|---------|
| `eo_form_data` | JSON object | Full form answers (parts 1-3) |
| `eo_form_email` | string | Extracted email |
| `eo_form_phone` | string | Extracted phone |
| `eo_form_company` | string | Extracted company |
| `eo_form_first_name` | string | Extracted first name |
| `eo_form_last_name` | string | Extracted last name |
| `eo_b2b_stage` | string | B2B stage (launching/growing/scaling) |
| `eo_form_qualified` | string | 'yes' or 'no' |
| `eo_resume_token` | string | Base64-encoded token (audit) |

## Security Considerations

### Token Security
- Tokens are Base64-encoded (not encrypted)
- Contains form state, not sensitive auth data
- Suitable for public sharing (users intend to share URL)
- No server-side token storage needed

### NONCE Protection
- All AJAX submissions include nonce verification
- Prevents CSRF attacks
- Works with resumed forms

### Input Sanitization
```php
// All inputs sanitized:
$email = sanitize_email($_POST['email']);
$phone = sanitize_text_field($_POST['phone']);
$token = sanitize_text_field($_POST['resumeToken']);
```

## Admin Dashboard Integration

### Viewing Submitted Data
1. WordPress Admin → Forms → Submissions
2. Click any submission row
3. Form Details show:
   - Qualified: Yes/No
   - Resume Token: (token value)
   - Full form data with all parts

### Analytics
- Filter submissions by `eo_form_qualified`
- Track resume rate: submissions with `eo_resume_token` vs total
- Identify popular abandonment points

## Troubleshooting

### Resume Link Not Appearing
**Problem**: "Save Your Progress" button not visible
**Solution**: 
1. Check browser console for errors
2. Verify user answered Part 2 or Part 3
3. Check `EO_FORM.isQualified()` in console returns `true`
4. Verify `js/eo-form/eo-form-controller.js` loaded properly

### Form Not Restoring from Link
**Problem**: Click resume link but form shows Part 1
**Solution**:
1. Check URL contains `?eo_resume=[TOKEN]`
2. Verify token is valid Base64
3. Check browser sessionStorage cleared (no leftover data)
4. Open new incognito window and try link
5. Check browser console for decode errors

### Token Not Generating
**Problem**: `generateResumeToken()` returns null/empty
**Solution**:
1. Verify user is qualified: `EO_FORM.isQualified()` returns `true`
2. Check `EO_FORM.answers` has part2 or part3 data
3. Verify JavaScript doesn't have syntax errors
4. Check browser console for errors

### Backend Not Storing Metadata
**Problem**: `eo_form_qualified` always empty
**Solution**:
1. Check `submitEOForm()` including `isQualified` in POST
2. Verify `eo_handle_form_submission()` receiving POST param
3. Check nonce verification passing
4. Look in PHP error logs for submission handler errors

## Performance Considerations

- Token size: ~500-2000 bytes (depends on form complexity)
- Encoding/decoding: < 1ms (negligible)
- SessionStorage limit: ~5-10MB (sufficient for many forms)
- No server-side token storage needed (stateless design)

## Browser Compatibility

| Browser | Resume Functionality | Notes |
|---------|-------------------|-------|
| Chrome | ✓ Full support | All features work |
| Firefox | ✓ Full support | All features work |
| Safari | ✓ Full support | All features work |
| Edge | ✓ Full support | All features work |
| IE 11 | Partial | Base64 encode works, but copy-to-clipboard may not |

## Future Enhancements

1. **Email Resume Links**: Send resume link via email to user
2. **Expiration Dates**: Tokens expire after 30 days
3. **Analytics Dashboard**: Show resume conversion rates
4. **A/B Testing**: Test resume link placement/messaging
5. **Encrypted Tokens**: Use proper encryption for sensitive data
6. **Server-Side State**: Store tokens on server for better control

---

**Last Updated**: Implementation Phase  
**Status**: Production Ready  
**Version**: 1.0
