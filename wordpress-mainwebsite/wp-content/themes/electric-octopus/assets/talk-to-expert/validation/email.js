const freeDomains = [
  'gmail.com','yahoo.com','outlook.com','hotmail.com',
  'icloud.com','protonmail.com','aol.com','zoho.com'
];

export function validateEmail(field, errorBox) {
  const value = field.value.trim().toLowerCase();
  const domain = value.split('@')[1];

  if (!/^\S+@\S+\.\S+$/.test(value) || freeDomains.includes(domain)) {
    field.classList.add('error');
    if (errorBox) errorBox.textContent = 'Please enter your work email';
    return false;
  }
  return true;
}
