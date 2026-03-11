export default function customSelect() {
  const selects = document.querySelectorAll('.select');

  selects.forEach((select) => {
    const current = select.querySelector('.select__current') as HTMLElement;
    const dropdown = select.querySelector('.select__dropdown') as HTMLElement;
    const input = select.querySelector('input') as HTMLInputElement;

    current.addEventListener('click', () => {
      select.classList.toggle('open');
    });

    dropdown.querySelectorAll('li').forEach((option) => {
      option.addEventListener('click', () => {
        const value = option.dataset.value;
        if (!value) return;

        current.textContent = value;
        input.value = value;

        select.classList.remove('open');
        select.classList.remove('error');
      });
    });
  });

  document.addEventListener('click', (e) => {
    const target = e.target as HTMLElement;

    if (!target.closest('.select')) {
      document
        .querySelectorAll('.select')
        .forEach((s) => s.classList.remove('open'));
    }
  });

  // VALIDATION
  document.querySelectorAll('.wpcf7-form').forEach((form) => {
    form.addEventListener('submit', (e) => {
      let valid = true;

      selects.forEach((select) => {
        if (!select.hasAttribute('data-required')) return;

        const input = select.querySelector('input') as HTMLInputElement;

        if (!input.value) {
          select.classList.add('error');
          valid = false;
        }
      });

      if (!valid) e.preventDefault();
    });
  });
}
