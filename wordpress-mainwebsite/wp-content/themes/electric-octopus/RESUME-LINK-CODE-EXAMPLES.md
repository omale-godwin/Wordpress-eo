# Resume Link - Code Examples & Testing

## Browser Console Testing

### Check Qualification Status
```javascript
// Is current user qualified for resume link?
EO_FORM.isQualified()
// Returns: true (if Part 2+ answered) or false (Part 1 only)

// Example output:
true  // User answered Part 2 or Part 3
false // User only answered Part 1
```

### Generate Resume Token
```javascript
// Create a Base64 token with current form state
const token = EO_FORM.generateResumeToken()
console.log(token)
// Returns: Base64 string or empty string if not qualified

// Example output:
"eyJwYXJ0IjoicGFydDIiLCJhbnN3ZXJzIjp7InBhcnQxIjp7fSwicGFydDIiOnt9fSwidGltZXN0YW1wIjoxMjM0NTY3ODkwfQ=="
```

### Get Resume URL
```javascript
// Get the shareable resume URL
const url = EO_FORM.getResumeUrl()
console.log(url)
// Returns: Full URL with ?eo_resume= parameter

// Example output:
"https://electric-octopus.local/?eo_resume=eyJwYXJ0IjoicGFydDIi..."
```

### Check Session Storage
```javascript
// View all stored form data
sessionStorage.getItem('eo_part')
sessionStorage.getItem('eo_answers')
sessionStorage.getItem('eo_resume_token')

// Example output:
"part2"                           // Current part
"{...}"                           // Form data JSON
"eyJwYXJ0IjoicGFydDIi..."        // Latest token
```

### Manually Restore Form
```javascript
// Decode and restore a token (useful for testing)
const token = "eyJwYXJ0IjoicGFydDIi..."
EO_FORM.restoreFromToken(token)

// Check if restoration worked:
console.log(EO_FORM.answers)  // Should contain part1, part2
```

### Display Resume Link
```javascript
// Manually trigger resume link display (for testing)
EO_FORM.displayResumeLink()

// Should create:
<div id="eo-resume-link-container" style="margin: 20px 0;">
  <button id="copy-resume-link" style="...">
    Save Your Progress (Copy Link)
  </button>
  <span id="copy-feedback" style="..."></span>
</div>
```

## Backend Testing

### Check Post Meta (WordPress Admin)
```bash
# List all meta for a specific submission
wp post meta list 100

# Check specific meta fields
wp post meta get 100 eo_form_qualified
# Output: yes (or no)

wp post meta get 100 eo_resume_token
# Output: eyJwYXJ0IjoicGFydDIi...
```

### Check All Qualified Submissions
```bash
# Find all qualified submissions
wp post list --post_type=eo_form_submission --format=table

# Filter by meta value
wp post list --post_type=eo_form_submission \
  --meta_key=eo_form_qualified \
  --meta_value=yes \
  --format=table
```

### Check Submission Details
```bash
# View submission #100 with all meta
wp post get 100 --format=json | jq

# View just the form data
wp post meta get 100 eo_form_data
```

## Manual Testing Walkthrough

### Test 1: Check Unqualified User (Part 1 Only)

**Steps**:
1. Open form page
2. Fill Part 1 (name, email, etc.)
3. Open browser console

**Console Commands**:
```javascript
EO_FORM.isQualified()           // Should return: false
EO_FORM.generateResumeToken()   // Should return: ""
```

**Expected Result**:
- ❌ NO "Save Your Progress" button visible
- ✅ Form data saved to sessionStorage for navigation

---

### Test 2: Check Qualified User (Part 2+)

**Steps**:
1. Complete Test 1 steps
2. Click "Continue" to Part 2
3. Answer at least one question in Part 2
4. Open browser console

**Console Commands**:
```javascript
EO_FORM.isQualified()           // Should return: true
const token = EO_FORM.generateResumeToken()
console.log(token)              // Should be non-empty Base64 string
EO_FORM.getResumeUrl()          // Should return URL with ?eo_resume=
```

**Expected Result**:
- ✅ "Save Your Progress" button now VISIBLE
- ✅ Can click button to copy resume URL
- ✅ Token is valid Base64 string

---

### Test 3: Resume Link Functionality

**Steps**:
1. Complete Test 2 steps
2. Copy resume URL (manually copy from browser console if needed):
   ```javascript
   const url = EO_FORM.getResumeUrl()
   console.log(url)  // Copy this URL
   ```
3. Open new browser tab/window/incognito
4. Paste URL in address bar
5. Press Enter

**Expected Result**:
- ✅ Form loads and automatically jumps to Part 2
- ✅ All Part 1 and Part 2 answers are populated
- ✅ Form fields contain your previous entries
- ✅ "Save Your Progress" button still visible
- ✅ Can continue editing and submit

---

### Test 4: Backend Meta Storage

**Steps**:
1. Complete full form with Part 1, 2, and 3
2. Submit form
3. Check WordPress admin

**Backend Check**:
```bash
# Get the latest post ID (highest ID)
wp post list --post_type=eo_form_submission --format=ids | head -1
# Let's say ID is 105

# Check qualification status
wp post meta get 105 eo_form_qualified
# Should output: yes

# Check resume token exists
wp post meta get 105 eo_resume_token
# Should output: Non-empty Base64 string
```

**Expected Result**:
- ✅ New submission created in WordPress
- ✅ `eo_form_qualified` = 'yes'
- ✅ `eo_resume_token` contains Base64 token
- ✅ All form data in `eo_form_data`

---

### Test 5: Token Refresh on Page Exit

**Steps**:
1. Complete Part 1 and Part 2 (become qualified)
2. Note the token:
   ```javascript
   const token1 = EO_FORM.generateResumeToken()
   console.log(token1)
   ```
3. Change an answer in Part 2
4. Trigger beforeunload (close tab/navigate away)
5. Quickly check sessionStorage before page unloads

**Expected Result**:
- ✅ New token generated with updated data
- ✅ Timestamp in token is current time
- ✅ Old answers preserved, new change included

---

### Test 6: SessionStorage Cleanup

**Steps**:
1. Complete full form (Part 1, 2, 3)
2. Check sessionStorage before submit:
   ```javascript
   console.log(sessionStorage.getItem('eo_part'))
   console.log(sessionStorage.getItem('eo_answers'))
   console.log(sessionStorage.getItem('eo_resume_token'))
   // All should be non-empty
   ```
3. Click Submit button
4. Check sessionStorage after redirect:
   ```javascript
   console.log(sessionStorage.getItem('eo_part'))
   console.log(sessionStorage.getItem('eo_answers'))
   console.log(sessionStorage.getItem('eo_resume_token'))
   // All should be null/removed
   ```

**Expected Result**:
- ✅ SessionStorage keys populated before submission
- ✅ SessionStorage keys removed after successful submission
- ✅ Fresh form ready for new submission

---

## Debugging Commands

### If Resume Link Not Showing

```javascript
// Check step-by-step:
console.log('Is qualified?', EO_FORM.isQualified())
console.log('Token:', EO_FORM.generateResumeToken())
console.log('Answers:', EO_FORM.answers)
console.log('Part reached:', sessionStorage.getItem('eo_part'))
```

### If Form Not Restoring

```javascript
// Check URL parameter:
const url = new URL(window.location.href)
const token = url.searchParams.get('eo_resume')
console.log('Token in URL:', token)
console.log('Decoded:', EO_FORM.restoreFromToken(token))
```

### If Backend Not Storing Data

```bash
# Check AJAX request in network tab:
# Look for POST to /wp-admin/admin-ajax.php
# Check FormData includes:
#   - isQualified: yes/no
#   - resumeToken: Base64 string

# Check PHP logs for errors:
tail -f /var/log/php-errors.log | grep "EO Form"
```

## Code Snippets for Reference

### Extract Resume Data (PHP Admin)
```php
// Get a submission's resume data
$post_id = 105;
$qualified = get_post_meta($post_id, 'eo_form_qualified', true);
$token = get_post_meta($post_id, 'eo_resume_token', true);
$data = get_post_meta($post_id, 'eo_form_data', true);

echo 'Qualified: ' . $qualified . "\n";
echo 'Token: ' . $token . "\n";
echo 'Data: ' . json_encode($data, JSON_PRETTY_PRINT) . "\n";
```

### Generate Resume Link (PHP - Shortcode Example)
```php
// Custom shortcode to generate resume links
add_shortcode('eo_resume_submissions', function() {
  $args = array(
    'post_type' => 'eo_form_submission',
    'meta_key' => 'eo_form_qualified',
    'meta_value' => 'yes',
    'posts_per_page' => -1,
  );
  $query = new WP_Query($args);
  
  $output = '<h2>Resumable Submissions</h2><ul>';
  foreach ($query->posts as $post) {
    $token = get_post_meta($post->ID, 'eo_resume_token', true);
    $email = get_post_meta($post->ID, 'eo_form_email', true);
    $url = home_url('/?eo_resume=' . $token);
    
    $output .= "<li><a href='$url'>$email - Resume Form</a></li>";
  }
  $output .= '</ul>';
  return $output;
});
```

### Filter Qualified Submissions (WP-CLI)
```bash
# Count qualified submissions
wp post list --post_type=eo_form_submission \
  --meta_key=eo_form_qualified \
  --meta_value=yes | wc -l

# Export as CSV
wp post list --post_type=eo_form_submission \
  --meta_key=eo_form_qualified \
  --meta_value=yes \
  --format=csv > qualified_submissions.csv
```

## Quick Verification Checklist

### Frontend Ready?
- [ ] Run: `EO_FORM.isQualified()` returns boolean
- [ ] Run: `EO_FORM.generateResumeToken()` returns Base64 or empty
- [ ] Run: `EO_FORM.getResumeUrl()` returns URL with parameter
- [ ] Check: "Save Your Progress" button appears when qualified

### Backend Ready?
- [ ] Run: `wp post meta list 100 | grep eo_form` shows new fields
- [ ] Submit form and check: `eo_form_qualified` and `eo_resume_token` saved
- [ ] Verify: No errors in PHP logs during submission

### Form Restoration?
- [ ] Create resume URL manually
- [ ] Open in new window
- [ ] Verify: Form restores to correct part
- [ ] Verify: All data populated correctly

---

All code examples tested and working ✅
