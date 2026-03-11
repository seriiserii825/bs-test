export default function showAbsoluteHiddenFiles() {
  const elems = document.querySelectorAll('*') as NodeListOf<HTMLElement>;
  elems.forEach((el) => {
    if (getComputedStyle(el).position === 'absolute') {
      el.style.border = '1px solid red';
      el.style.display = 'block';
      el.style.visibility = 'visible';
      el.style.zIndex = '9999';
    }
  });
}
