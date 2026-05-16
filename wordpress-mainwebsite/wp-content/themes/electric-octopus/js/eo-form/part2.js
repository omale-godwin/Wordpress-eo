/**
 * Part 2 - Service Selection Logic
 * Handles the second part of the Talk to Expert form
 */

document.addEventListener('DOMContentLoaded', function() {
  // Get all inputs in part 2
  const part2Section = document.querySelector('[data-form-part="part2"]');
  if (!part2Section) return;

  const inputs = part2Section.querySelectorAll('input, select, textarea');
  const nextButton = document.getElementById('next-step');

  // Load any previously saved answers for part2
  if (EO_FORM.answers.part2) {
    Object.keys(EO_FORM.answers.part2).forEach(key => {
      const input = part2Section.querySelector(`[name="${key}"]`);
      if (input) {
        if (input.type === 'checkbox' || input.type === 'radio') {
          input.checked = EO_FORM.answers.part2[key];
        } else {
          input.value = EO_FORM.answers.part2[key];
        }
      }
    });
  }

  // Attach event listeners to capture answers
  inputs.forEach(input => {
    input.addEventListener('change', function() {
      if (!EO_FORM.answers.part2) {
        EO_FORM.answers.part2 = {};
      }
      if (this.type === 'checkbox' || this.type === 'radio') {
        EO_FORM.answers.part2[this.name] = this.checked;
      } else {
        EO_FORM.answers.part2[this.name] = this.value;
      }
      EO_FORM.save();
    });

    input.addEventListener('input', function() {
      if (!EO_FORM.answers.part2) {
        EO_FORM.answers.part2 = {};
      }
      EO_FORM.answers.part2[this.name] = this.value;
      EO_FORM.save();
    });
  });

  // Handle next button click for part 2
  if (nextButton) {
    nextButton.addEventListener('click', function() {
      const currentPart = document.querySelector('[data-form-part].active');
      if (!currentPart || !currentPart.getAttribute('data-form-part').includes('part2')) {
        return;
      }
      EO_FORM.show('part3');
    });
  }
});
