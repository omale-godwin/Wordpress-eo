# Resume Link Email - Testing Guide (Budget-Based Qualification)

## How to Test

### Test 1: Budget < $10K → DISQUALIFIED ❌

**Steps**:
1. Open form
2. Fill **Part 1** with:
   - Budget: **"Less than $10K"** ← Key!
   - Other required fields
3. Click Continue
4. Try to proceed to Part 2

**Expected Result**:
- ❌ Should NOT see Part 2
- ❌ No resume link button will ever appear
- ❌ No email will be sent if you leave
- Form ends / shows disqualified message

**Verification**:
```javascript
EO_FORM.isQualified()  // Returns: false
```

---

### Test 2: Budget >= $10K + Part 2 → QUALIFIED ✅

**Steps**:
1. Open form
2. Fill **Part 1** with:
   - Budget: **"$10K-$50K"** (or higher) ← Key!
   - Other required fields
3. Click Continue
4. **In Part 2**: Answer at least one question
5. Look for button

**Expected Result**:
- ✅ "Save Your Progress" button appears above Part 2
- ✅ Can click to copy resume link
- ✅ Email ready to send if you leave

**Verification**:
```javascript
EO_FORM.isQualified()  // Returns: true
const url = EO_FORM.getResumeUrl()
console.log(url)  // Shows resume URL with token
```

---

### Test 3: Email Send on Page Leave

**Steps**:
1. Complete Test 2 steps (qualified + in Part 2)
2. **Fill Part 3** with email address
3. Close browser tab / navigate away
4. Check email immediately

**Expected Result**:
- ✅ Email received within 1-2 minutes
- ✅ Subject: "Resume Your Talk to Expert Form"
- ✅ Contains resume link with button

**Verification**:
```bash
# Check PHP logs for confirmation
tail -50 /var/log/php-errors.log | grep "EO Resume Email"
# Should show: "EO Resume Email - Email sent to: user@example.com"
```

---

### Test 4: No Email After Submit

**Steps**:
1. Complete Test 2 steps (qualified + in Part 2)
2. Continue to Part 3
3. Fill all fields including email
4. **SUBMIT form** (don't leave mid-form)
5. Watch for email

**Expected Result**:
- ❌ NO email sent (form was completed successfully)
- ✅ Form submission confirmation page shown
- ✅ SessionStorage cleared

---

### Test 5: Budget Selection Variations

| Budget Selected | Qualified? | Resume Link? |
|---|---|---|
| Less than $10K | ❌ NO | ❌ NO |
| $10K - $50K | ✅ YES | ✅ YES* |
| $50K - $100K | ✅ YES | ✅ YES* |
| $100K+ | ✅ YES | ✅ YES* |

*Only if also answered Part 2 or Part 3

---

## Debugging Checks

### Check 1: Budget Value Stored?

```javascript
console.log(EO_FORM.answers.part1)
// Should show: {budget: "$10k_50k", ...other fields}
```

### Check 2: Is Qualified?

```javascript
console.log(EO_FORM.isQualified())
// If false → Check:
// 1. Budget is 'lt_10k'? → User is disqualified
// 2. Part 2/3 has no data? → Not yet qualified
```

### Check 3: Budget Logic Breakdown

```javascript
// Manual check of qualification logic
const part1Data = EO_FORM.answers.part1 || {}
const budget = part1Data.budget
console.log('Budget value:', budget)
console.log('Budget OK?', budget && budget !== 'lt_10k')

const hasPart2 = EO_FORM.answers.part2 && Object.keys(EO_FORM.answers.part2).length > 0
const hasPart3 = EO_FORM.answers.part3 && Object.keys(EO_FORM.answers.part3).length > 0
console.log('Has Part 2?', hasPart2)
console.log('Has Part 3?', hasPart3)

console.log('QUALIFIED?', (budget && budget !== 'lt_10k') && (hasPart2 || hasPart3))
```

### Check 4: Email Address

```javascript
const email = document.querySelector('[data-form-part="part3"] input[name="email"]')
console.log('Email value:', email.value)
console.log('Email valid?', email.value.includes('@'))
```

---

## Common Issues & Fixes

| Issue | Cause | Fix |
|-------|-------|-----|
| No resume button appears in Part 2 | Budget was < $10K | Select $10K-$50K or higher in Part 1 |
| Qualified but no email | Email missing in Part 3 | Fill email field before leaving |
| isQualified() returns false | Budget is 'lt_10k' OR no Part 2/3 data | Check budget selection and Part 2 answers |
| Email not received | Not leaving page (submitting instead) | Close tab without submitting to trigger email |

---

## Budget Field Values

The budget field stores these values:

```javascript
// In Part 1, budget field options:
"lt_10k"     // Less than $10K → DISQUALIFIED
"10k_50k"    // $10K-$50K → QUALIFIED
"50k_100k"   // $50K-$100K → QUALIFIED  
"100k_plus"  // $100K+ → QUALIFIED
```

---

## Quick Test Checklist

- [ ] Budget < $10K → Form ends, no Part 2/3
- [ ] Budget >= $10K → Can see Part 2/3
- [ ] In Part 2/3 → Resume button appears
- [ ] Leave page → Email sent within 1-2 min
- [ ] Email has resume link → Can click to restore
- [ ] Submit form → No email sent, form clears
- [ ] Console check: `EO_FORM.isQualified()` returns true/false correctly

---

**All tests passing?** ✅ Feature is working correctly!
