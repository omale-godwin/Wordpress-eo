export function requiredField(field, errorBox) {
  if (!field.value || !field.value.trim()) {
    field.classList.add('error');
    if (errorBox) errorBox.textContent = 'Please complete this required field.';
    return false;
  }
  return true;
}
