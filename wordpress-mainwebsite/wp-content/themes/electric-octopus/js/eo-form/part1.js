/**
 * Part 1 - Initial Form Logic
 * Handles the first part of the Talk to Expert form
 */

document.addEventListener('DOMContentLoaded', function() {
  // Get all inputs in part 1
  const part1Section = document.querySelector('[data-form-part="part1"]');
  if (!part1Section) return;

  const inputs = part1Section.querySelectorAll('input, select, textarea');
  const nextButton = document.getElementById('next-step');

  // Load any previously saved answers for part1
  if (EO_FORM.answers.part1) {
    Object.keys(EO_FORM.answers.part1).forEach(key => {
      const input = part1Section.querySelector(`[name="${key}"]`);
      if (input) {
        input.value = EO_FORM.answers.part1[key];
      }
    });
  }

  // Attach event listeners to capture answers
  inputs.forEach(input => {
    input.addEventListener('change', function() {
      if (!EO_FORM.answers.part1) {
        EO_FORM.answers.part1 = {};
      }
      EO_FORM.answers.part1[this.name] = this.value;
      EO_FORM.save();
    });

    input.addEventListener('input', function() {
      if (!EO_FORM.answers.part1) {
        EO_FORM.answers.part1 = {};
      }
      EO_FORM.answers.part1[this.name] = this.value;
      EO_FORM.save();
    });
  });

  // Handle next button click for part 1
  if (nextButton) {
    nextButton.addEventListener('click', function() {
      const currentPart = document.querySelector('[data-form-part].active');
      if (!currentPart || !currentPart.getAttribute('data-form-part').includes('part1')) {
        return;
      }
      EO_FORM.show('part2');
    });
  }
});
