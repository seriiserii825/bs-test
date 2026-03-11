export default function fixedHeader() {
  const header = document.querySelector('.main-header');
  let ticking = false;

  window.addEventListener('scroll', () => {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
      header?.classList.toggle('active', window.scrollY > 300);
      ticking = false;
    });
  });
}
