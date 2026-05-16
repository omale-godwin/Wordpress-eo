const STORAGE_KEY = 'leadFormData';

export function restoreForm(form) {
  const saved = sessionStorage.getItem(STORAGE_KEY);
  if (!saved) return;

  try {
    const data = JSON.parse(saved);
    Object.keys(data).forEach(k => {
      const el = form.elements[k];
      if (!el) return;
      el.type === 'checkbox' ? el.checked = data[k] : el.value = data[k];
    });
  } catch (e) {
    console.warn(e);
  }
}

export function saveForm(form) {
  const data = {};
  Array.from(form.elements).forEach(el => {
    if (!el.name) return;
    data[el.name] = el.type === 'checkbox' ? el.checked : el.value;
  });
  sessionStorage.setItem(STORAGE_KEY, JSON.stringify(data));
}
