export function validateURL(field, errorBox) {
  let url;
  const value = field.value.trim();
  const normalized = value.match(/^https?:\/\//i) ? value : 'https://' + value;

  try {
    url = new URL(normalized);
  } catch {
    field.classList.add('error');
    if (errorBox) errorBox.textContent = 'Enter a valid URL';
    return false;
  }

  if (field.name === 'website') {
    const pattern = /^(?!localhost)(?!\d+\.\d+)/;
    if (!pattern.test(url.hostname)) {
      field.classList.add('error');
      if (errorBox) errorBox.textContent = 'Enter a valid company website';
      return false;
    }
  }

  if (field.name === 'linkedin') {
    if (!url.hostname.includes('linkedin.com') || !/^\/in\//.test(url.pathname)) {
      field.classList.add('error');
      if (errorBox) errorBox.textContent = 'Enter a valid LinkedIn profile';
      return false;
    }
  }

  return true;
}
