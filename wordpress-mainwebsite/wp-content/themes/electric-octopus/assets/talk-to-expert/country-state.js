export function initCountryState(map) {
  const country = document.getElementById('country');
  const state = document.getElementById('state');
  if (!country || !state) return;

  country.onchange = () => {
    state.innerHTML = '<option value="">Please Select</option>';
    const states = map[country.value] || [];

    if (!states.length) {
      state.innerHTML += '<option value="N/A">Not Applicable</option>';
      return;
    }

    states.forEach(s => {
      const opt = document.createElement('option');
      opt.value = s;
      opt.textContent = s;
      state.appendChild(opt);
    });
  };
}
