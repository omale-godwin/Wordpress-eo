export function checkBudget() {
  const budget = document.getElementById('budget')?.value;

  if (!budget) {
    alert('Please select your monthly marketing budget');
    return null;
  }

  return budget !== 'lt_10k';
}
