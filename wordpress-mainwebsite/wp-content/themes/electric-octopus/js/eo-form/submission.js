/**
 * Form Submission Handler
 * Handles submitting the Talk to Expert form data to the backend
 * Also includes resume link functionality for qualified users
 */

function submitEOForm(answers) {
  // Get B2B stage from sessionStorage
  const b2bStage = sessionStorage.getItem('b2b_stage') || 'launching';

  // Prepare form data
  const formData = new FormData();
  formData.append('action', 'eo_submit_form');
  formData.append('nonce', eoFormVars.nonce);
  formData.append('formData', JSON.stringify(answers));
  formData.append('b2bStage', b2bStage);
  
  // Include resume token and qualification status for backend tracking
  formData.append('isQualified', EO_FORM.isQualified() ? 'yes' : 'no');
  formData.append('resumeToken', EO_FORM.generateResumeToken() || '');

  // Send AJAX request
  fetch(eoFormVars.ajaxurl, {
    method: 'POST',
    body: formData,
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        console.log('Form submitted successfully:', data.data);
        // Clear session storage on successful submission
        sessionStorage.removeItem('eo_part');
        sessionStorage.removeItem('eo_answers');
        sessionStorage.removeItem('eo_resume_token');
        // Redirect after successful submission
        window.location.href = 'http://localhost/electric-octopus-wp/?page_id=86';
      } else {
        console.error('Form submission failed:', data.data);
        alert('Error submitting form. Please try again.');
      }
    })
    .catch(error => {
      console.error('Fetch error:', error);
      alert('Error submitting form. Please try again.');
    });
}
