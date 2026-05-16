// Global form state object with resume functionality
window.EO_FORM = {
  part: sessionStorage.getItem("eo_part") || "part1",
  answers: JSON.parse(sessionStorage.getItem("eo_answers") || "{}"),
  resumeToken: null,

  save() {
    sessionStorage.setItem("eo_part", this.part);
    sessionStorage.setItem("eo_answers", JSON.stringify(this.answers));
    // Generate resume token after saving
    this.generateResumeToken();
  },

  /**
   * Check if user is qualified based on their answers
   * Qualification criteria: Budget >= $10,000 AND has answered Part 2 or Part 3
   */
  isQualified() {
    // Check budget qualification from Part 1
    const part1Data = this.answers.part1 || {};
    const budget = part1Data.budget;
    
    // User must have selected budget >= $10,000 (not 'lt_10k')
    const hasBudgetQualification = budget && budget !== 'lt_10k';
    
    // User must have answered Part 2 or Part 3
    const hasPart2Data = this.answers.part2 && Object.keys(this.answers.part2).length > 0;
    const hasPart3Data = this.answers.part3 && Object.keys(this.answers.part3).length > 0;
    
    // Qualified only if both budget OK and has data in part2 or part3
    return hasBudgetQualification && (hasPart2Data || hasPart3Data);
  },

  /**
   * Generate a resume token that encodes form state
   * This token can be shared in URLs to resume form submission
   */
  generateResumeToken() {
    try {
      const token = btoa(JSON.stringify({
        part: this.part,
        answers: this.answers,
        timestamp: new Date().getTime()
      }));
      this.resumeToken = token;
      sessionStorage.setItem("eo_resume_token", token);
      return token;
    } catch (e) {
      console.error("Error generating resume token:", e);
      return null;
    }
  },

  /**
   * Decode and restore form state from resume token
   */
  restoreFromToken(token) {
    try {
      if (!token) return false;
      const decoded = JSON.parse(atob(token));
      this.part = decoded.part || "part1";
      this.answers = decoded.answers || {};
      this.save();
      return true;
    } catch (e) {
      console.error("Error decoding resume token:", e);
      return false;
    }
  },

  /**
   * Get shareable resume URL for qualified users
   */
  getResumeUrl() {
    if (!this.isQualified()) {
      return null;
    }
    const token = this.generateResumeToken();
    if (!token) return null;
    
    // Get current page URL and add resume token
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('eo_resume', token);
    return currentUrl.toString();
  },

  show(part) {
    this.part = part;
    this.save();

    // Hide all form parts
    document
      .querySelectorAll("[data-form-part]")
      .forEach(el => {
        el.classList.remove("active");
        el.style.display = "none";
      });

    // Show the requested part
    const el = document.querySelector(`[data-form-part="${part}"]`);
    if (el) {
      el.classList.add("active");
      el.style.display = "block";
      // Scroll to form
      el.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  }
};

// Expose answers globally for backward compatibility
window.answers = window.EO_FORM.answers;

document.addEventListener("DOMContentLoaded", () => {
  // Check for resume token in URL
  const urlParams = new URLSearchParams(window.location.search);
  const resumeToken = urlParams.get('eo_resume');
  
  if (resumeToken) {
    // Try to restore form from token
    if (EO_FORM.restoreFromToken(resumeToken)) {
      console.log('Form resumed from token at part:', EO_FORM.part);
    }
  }
  
  // Initialize form at correct part
  EO_FORM.show(EO_FORM.part);
  
  // Display resume link if user is qualified
  setTimeout(() => {
    EO_FORM.displayResumeLink();
  }, 500);
});

/**
 * Display resume link for qualified users who leave mid-submission
 */
window.EO_FORM.displayResumeLink = function() {
  if (!this.isQualified()) {
    return; // Don't show link if not qualified
  }
  
  // Check if resume link container exists
  let resumeContainer = document.getElementById('eo-resume-link-container');
  if (!resumeContainer) {
    resumeContainer = document.createElement('div');
    resumeContainer.id = 'eo-resume-link-container';
    resumeContainer.style.cssText = `
      margin-bottom: 20px;
      padding: 12px 16px;
      background: #f0f7ff;
      border-left: 4px solid #0073aa;
      border-radius: 3px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 15px;
    `;
    
    const formSection = document.querySelector('[data-form-part="part1"]');
    if (formSection && formSection.parentElement) {
      formSection.parentElement.insertBefore(resumeContainer, formSection);
    }
  }
  
  const resumeUrl = this.getResumeUrl();
  if (resumeUrl) {
    resumeContainer.innerHTML = `
      <div style="flex: 1;">
        <p style="margin: 0; color: #333; font-weight: 500;">
          💡 <strong>Save Your Progress:</strong> Share this link to resume your form later
        </p>
      </div>
      <button id="eo-copy-resume-link" style="
        padding: 8px 16px;
        background: #0073aa;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-weight: 500;
      ">Copy Link</button>
    `;
    
    document.getElementById('eo-copy-resume-link').addEventListener('click', (e) => {
      e.preventDefault();
      navigator.clipboard.writeText(resumeUrl).then(() => {
        const btn = e.target;
        const originalText = btn.textContent;
        btn.textContent = '✓ Copied!';
        setTimeout(() => {
          btn.textContent = originalText;
        }, 2000);
      });
    });
  }
};

/**
 * Send resume link via email to user
 */
window.EO_FORM.sendResumeLinkEmail = function() {
  // Get user email from form (Part 3)
  const emailField = document.querySelector('[data-form-part="part3"] input[name="email"]');
  const userEmail = emailField ? emailField.value : null;
  
  if (!userEmail) {
    console.log('No email found for resume link email');
    return;
  }
  
  const resumeUrl = this.getResumeUrl();
  if (!resumeUrl) {
    console.log('User not qualified for resume link');
    return;
  }
  
  // Send email via AJAX (non-blocking)
  const emailData = new FormData();
  emailData.append('action', 'eo_send_resume_link_email');
  emailData.append('nonce', eoFormVars.nonce);
  emailData.append('email', userEmail);
  emailData.append('resumeUrl', resumeUrl);
  emailData.append('formData', JSON.stringify(this.answers));
  
  fetch(eoFormVars.ajaxurl, {
    method: 'POST',
    body: emailData,
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        console.log('Resume link email sent successfully');
      } else {
        console.error('Failed to send resume link email:', data.data);
      }
    })
    .catch(error => {
      console.error('Error sending resume link email:', error);
    });
};
