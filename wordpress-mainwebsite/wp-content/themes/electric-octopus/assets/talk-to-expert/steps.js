import { restoreForm, saveForm } from './state.js';
import { requiredField } from './validation/common.js';
import { validateEmail } from './validation/email.js';
import { validateURL } from './validation/url.js';
import { validatePhone } from './validation/phone.js';
import { checkBudget } from './validation/budget.js';
import { initDropdowns } from './dropdowns.js';

export function initSteps() {
  const form = document.getElementById('leadForm');
  if (!form) return;

  const steps = [...form.querySelectorAll('fieldset.step')];
  let current = 0;

  const nextBtn = document.getElementById('nextBtn');
  const backBtn = document.getElementById('backBtn');
  const stepTitle = document.getElementById('step-title');
  const progressBars = document.querySelectorAll('.progress-lines span');

  restoreForm(form);

  /* ===============================
     STEP RENDER
  =============================== */
  function showStep(i) {
    // Toggle steps
    steps.forEach((step, idx) => {
      step.style.display = idx === i ? 'block' : 'none';
    });

    // Step titles
    const titles = [
      'Personal Information',
      'Company Information',
      'Interested In'
    ];
    if (stepTitle) {
      stepTitle.textContent = titles[i] || `Step ${i + 1}`;
    }

    // Progress lines
    progressBars.forEach(bar => {
      const stepIndex = Number(bar.dataset.step);
      bar.classList.remove('active', 'completed');

      if (stepIndex < i) {
        bar.classList.add('completed');
      } else if (stepIndex === i) {
        bar.classList.add('active');
      }
    });

    // Buttons
    backBtn.classList.toggle('hidden', i === 0);
    nextBtn.textContent =
      i === steps.length - 1
        ? 'REQUEST A MEETING'
        : 'CONTINUE';
    
    // Initialize service dropdown when step 3 is shown
    if (i === 2) {
      setTimeout(() => {
        initDropdowns();
      }, 100);
    }
  }

  /* ===============================
     STEP VALIDATION
  =============================== */
  function validateStep(i) {
    const fields = steps[i].querySelectorAll('[required]');
    let valid = true;

    fields.forEach(f => {
      const errorBox = steps[i].querySelector(
        `[data-error-for="${f.id}"]`
      );

      f.classList.remove('error');
      if (errorBox) errorBox.textContent = '';

      if (!requiredField(f, errorBox)) valid = false;
      if (f.type === 'email' && !validateEmail(f, errorBox)) valid = false;
      if (f.type === 'url' && !validateURL(f, errorBox)) valid = false;
      if (f.id === 'phone' && !validatePhone(f, errorBox)) valid = false;
    });

    return valid;
  }

  /* ===============================
     EVENTS
  =============================== */
  nextBtn.onclick = () => {
    if (!validateStep(current)) return;

    saveForm(form);

    if (current < steps.length - 1) {
      current++;
      showStep(current);
      return;
    }

    // Final step → qualification
    const qualified = checkBudget();
    if (qualified === null) return;

    // Hide the form container
    const talkExpertPage = document.querySelector('.talk-expert-page');
    if (talkExpertPage) {
      talkExpertPage.style.display = 'none';
    }

    // Hide both results first, then show the appropriate one
    const budgetPass = document.getElementById('budgetPass');
    const budgetFail = document.getElementById('budgetFail');
    const budgetPassWrapper = document.getElementById('budgetPassWrapper');
    
    if (budgetPass) {
      budgetPass.classList.add('hidden');
      budgetPass.style.display = 'none';
    }
    
    if (budgetPassWrapper) {
      budgetPassWrapper.classList.add('hidden');
      budgetPassWrapper.style.display = 'none';
    }
    
    if (budgetFail) {
      budgetFail.classList.add('hidden');
      budgetFail.style.display = 'none';
    }

    // Show the appropriate result
    if (qualified) {
      // Show budgetPass and its wrapper
      if (budgetPassWrapper) {
        budgetPassWrapper.classList.remove('hidden');
        budgetPassWrapper.style.display = 'block';
      }
      if (budgetPass) {
        budgetPass.classList.remove('hidden');
        budgetPass.style.display = 'block';
      }
    } else {
      // Show budgetFail
      if (budgetFail) {
        budgetFail.classList.remove('hidden');
        budgetFail.style.display = 'block';
      }
    }
  };

  backBtn.onclick = () => {
    if (current > 0) {
      current--;
      showStep(current);
    }
  };

  /* ===============================
     RESUME LINK EMAIL - SEND ON PAGE LEAVE
  =============================== */
  window.addEventListener('beforeunload', function() {
    console.log('🔄 beforeunload event triggered');
    
    // Only send if qualified (budget >= $10k) and not on final step
    const budget = document.getElementById('budget')?.value;
    console.log('Budget value:', budget);
    const isQualified = budget && budget !== 'lt_10k';
    console.log('Is qualified (budget not lt_10k):', isQualified);
    
    // Only send if we're past step 1 (has answered something)
    const hasAnswers = current > 0;
    console.log('Current step:', current, 'Has answers:', hasAnswers);
    
    if (isQualified && hasAnswers) {
      console.log('✅ Conditions met - calling sendResumeEmailForOldForm()');
      sendResumeEmailForOldForm();
    } else {
      console.log('❌ Conditions not met - Qualified:', isQualified, 'HasAnswers:', hasAnswers);
    }
  });

  /* ===============================
     INIT
  =============================== */
  showStep(current);
}

/**
 * Send resume link email for old Talk to Expert form
 * Called when user leaves mid-form if qualified
 */
function sendResumeEmailForOldForm() {
  console.log('📧 ==> SENDING RESUME EMAIL');
  
  const form = document.getElementById('leadForm');
  console.log('Form element:', form);
  if (!form) {
    console.log('❌ Form not found with id="leadForm"');
    return;
  }
  
  // Get email address
  const email = document.getElementById('email')?.value;
  console.log('Email field value:', email);
  if (!email || !email.includes('@')) {
    console.log('❌ No valid email found');
    return;
  }
  
  // Get first name for personalization
  const fname = document.getElementById('fname')?.value || 'there';
  console.log('First name:', fname);
  
  // Generate resume token from form data (simplified)
  const formData = new FormData(form);
  const formObj = Object.fromEntries(formData);
  console.log('Form data captured:', Object.keys(formObj).length, 'fields');
  
  const resumeToken = btoa(JSON.stringify({
    formData: formObj,
    timestamp: Date.now(),
    type: 'old_form'
  }));
  
  // Generate resume URL
  const resumeUrl = window.location.href + (window.location.href.includes('?') ? '&' : '?') + 
                    `eo_resume=${encodeURIComponent(resumeToken)}`;
  console.log('Resume URL generated:', resumeUrl.substring(0, 100) + '...');
  
  // Send email via AJAX (non-blocking)
  const emailData = new FormData();
  emailData.append('action', 'eo_send_resume_link_email');
  emailData.append('email', email);
  emailData.append('resumeUrl', resumeUrl);
  emailData.append('formData', JSON.stringify(formObj));
  emailData.append('firstName', fname);
  
  // Get AJAX URL
  const ajaxUrl = typeof eoFormVars !== 'undefined' ? eoFormVars.ajaxurl : '/wp-admin/admin-ajax.php';
  console.log('AJAX URL:', ajaxUrl);
  
  console.log('📤 Sending AJAX request...');
  
  fetch(ajaxUrl, {
    method: 'POST',
    body: emailData,
  })
    .then(response => {
      console.log('✅ Response received');
      console.log('Status:', response.status);
      console.log('Headers:', {
        'content-type': response.headers.get('content-type')
      });
      
      if (!response.ok) {
        console.error('HTTP Error:', response.status, response.statusText);
        return response.text().then(text => {
          console.error('Error response body:', text);
          throw new Error(`HTTP ${response.status}`);
        });
      }
      
      return response.text().then(text => {
        console.log('Raw response text:', text);
        try {
          const parsed = JSON.parse(text);
          console.log('Parsed JSON:', parsed);
          return parsed;
        } catch (e) {
          console.error('❌ Failed to parse JSON:', e);
          console.error('Text was:', text);
          return { success: false, data: text };
        }
      });
    })
    .then(data => {
      console.log('📊 Final data:', data);
      if (data.success) {
        console.log('✅ Resume link email sent to:', email);
      } else {
        console.log('⚠️ Email send failed:', data.data);
      }
    })
    .catch(error => {
      console.error('❌ Fetch error:', error);
      console.error('Error name:', error.name);
      console.error('Error message:', error.message);
      console.error('Error stack:', error.stack);
    });
}
