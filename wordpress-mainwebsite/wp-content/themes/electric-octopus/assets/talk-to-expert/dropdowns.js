let dropdownInitialized = false;

export function initDropdowns() {
  const dropdown = document.getElementById('serviceDropdown');
  if (!dropdown) return;

  // Prevent duplicate initialization
  if (dropdown.dataset.initialized === 'true') return;

  const input = dropdown.querySelector('.service-input');
  const placeholder = input.querySelector('.placeholder');
  const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]');

  if (!input || !placeholder) return;

  // Mark as initialized
  dropdown.dataset.initialized = 'true';

  // Click handler for dropdown toggle
  input.addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    dropdown.classList.toggle('open');
  });
  
  // Click outside to close (only add once)
  if (!dropdownInitialized) {
    document.addEventListener('click', (e) => {
      const dropdownEl = document.getElementById('serviceDropdown');
      if (dropdownEl && !dropdownEl.contains(e.target)) {
        dropdownEl.classList.remove('open');
      }
    });
    dropdownInitialized = true;
  }

  // Checkbox change handlers
  checkboxes.forEach(cb => {
    cb.addEventListener('change', () => {
      const selected = Array.from(checkboxes)
        .filter(c => c.checked)
        .map(c => c.value);
      if (placeholder) {
        placeholder.textContent = selected.length ? selected.join(', ') : 'Select services';
      }
    });
  });
}
