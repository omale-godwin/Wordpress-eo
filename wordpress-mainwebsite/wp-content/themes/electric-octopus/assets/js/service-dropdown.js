(function(){
  document.addEventListener('DOMContentLoaded', function() {
    // Wait a bit for step visibility to be set
    setTimeout(function() {
      const dropdown = document.getElementById('serviceDropdown');
      if (!dropdown) return;

      // Skip if already initialized by dropdowns.js module
      if (dropdown.dataset.initialized === 'true') return;

      const input = dropdown.querySelector('.service-input');
      const placeholder = input.querySelector('.placeholder');
      const checkboxes = dropdown.querySelectorAll('input[type="checkbox"]');

      if (!input || !placeholder) return;

      // Mark as initialized
      dropdown.dataset.initialized = 'true';

      input.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropdown.classList.toggle('open');
      });

      document.addEventListener('click', e => {
        if (!dropdown.contains(e.target)) {
          dropdown.classList.remove('open');
        }
      });

      checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
          const selected = Array.from(checkboxes)
            .filter(c => c.checked)
            .map(c => c.value);

          placeholder.textContent = selected.length
            ? selected.join(', ')
            : 'Select services';
        });
      });
    }, 200);
  });
})();