/**
 * Part 3 - Contact Details & B2B Stage Selection
 * Handles the final part of the Talk to Expert form and submission
 */

document.addEventListener('DOMContentLoaded', function() {
  // Get all inputs in part 3
  const part3Section = document.querySelector('[data-form-part="part3"]');
  if (!part3Section) return;

  const inputs = part3Section.querySelectorAll('input, select, textarea');
  const nextButton = document.getElementById('next-step');
  const submitButton = part3Section.querySelector('button[type="submit"]');

  // Load any previously saved answers for part3
  if (EO_FORM.answers.part3) {
    Object.keys(EO_FORM.answers.part3).forEach(key => {
      const input = part3Section.querySelector(`[name="${key}"]`);
      if (input) {
        input.value = EO_FORM.answers.part3[key];
      }
    });
  }

  // Attach event listeners to capture answers
  inputs.forEach(input => {
    input.addEventListener('change', function() {
      if (!EO_FORM.answers.part3) {
        EO_FORM.answers.part3 = {};
      }
      EO_FORM.answers.part3[this.name] = this.value;
      EO_FORM.save();
    });

    input.addEventListener('input', function() {
      if (!EO_FORM.answers.part3) {
        EO_FORM.answers.part3 = {};
      }
      EO_FORM.answers.part3[this.name] = this.value;
      EO_FORM.save();
    });
  });

  // Handle B2B stage selection
  const stageButtons = part3Section.querySelectorAll('[data-stage]');
  stageButtons.forEach(button => {
    button.addEventListener('click', function() {
      const stage = this.getAttribute('data-stage');
      sessionStorage.setItem('b2b_stage', stage);
      if (!EO_FORM.answers.part3) {
        EO_FORM.answers.part3 = {};
      }
      EO_FORM.answers.part3.b2b_stage = stage;
      EO_FORM.save();
    });
  });

  // Handle submit button click
  if (submitButton) {
    submitButton.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Validate required fields
      const email = part3Section.querySelector('input[name="email"]');
      if (!email || !email.value) {
        alert('Please enter a valid email address');
        return;
      }

      // Submit form
      submitEOForm(EO_FORM.answers);
    });
  }

  // Handle next button for navigation within part 3 (if needed)
  if (nextButton) {
    nextButton.addEventListener('click', function() {
      const currentPart = document.querySelector('[data-form-part].active');
      if (currentPart && currentPart.getAttribute('data-form-part').includes('part3')) {
        // Validate email before proceeding
        const email = part3Section.querySelector('input[name="email"]');
        if (!email || !email.value) {
          alert('Please enter a valid email address');
          return;
        }
        // Submit the form
        submitEOForm(EO_FORM.answers);
      }
    });
  }

  // Generate fresh resume token before user leaves page (for qualified users)
  // Also send resume link via email
  window.addEventListener('beforeunload', function() {
    if (EO_FORM.isQualified()) {
      const freshToken = EO_FORM.generateResumeToken();
      sessionStorage.setItem('eo_resume_token', freshToken);
      
      // Send email with resume link (non-blocking, no await)
      EO_FORM.sendResumeLinkEmail();
    }
  });
});