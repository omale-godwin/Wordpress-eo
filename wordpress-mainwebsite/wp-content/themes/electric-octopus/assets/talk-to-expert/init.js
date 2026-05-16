import { initSteps } from './steps.js';
import { initDropdowns } from './dropdowns.js';
import { initCountryState } from './country-state.js';

document.addEventListener('DOMContentLoaded', () => {
  initSteps();
  initDropdowns();

  if (window.countryStateMap) {
    initCountryState(window.countryStateMap);
  }
});
