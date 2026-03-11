export default function scrollToBlock() {
  const data_scroll_all = document.querySelectorAll("[data-scroll]");

  data_scroll_all.forEach((data_scroll) => {
    data_scroll.addEventListener("click", (e) => {
      e.preventDefault();
      const target = data_scroll.getAttribute("href");
      if (!target) {
        return;
      }
      const block = document.querySelector(target);
      if (block) {
        const headerHeight = document.querySelector(".main-header")?.clientHeight || 0;
        const blockOffset = block.getBoundingClientRect().top + window.pageYOffset - headerHeight;
        const offset = blockOffset - headerHeight;
        window.scrollTo({
          top: offset + 160,
          behavior: "smooth",
        });
      }
    });
  });
}
