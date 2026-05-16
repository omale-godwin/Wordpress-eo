export function validatePhone(field, errorBox) {
  if (!/^\d{6,15}$/.test(field.value.replace(/\D/g,''))) {
    field.classList.add('error');
    if (errorBox) errorBox.textContent = 'Enter a valid phone number';
    return false;
  }
  return true;
}
