export default function menuHoverTouch() {
  const mainMenu = document.querySelector("#js-main-menu") as HTMLElement;
  const menuItems = document.querySelectorAll("#js-main-menu > li.menu-item-has-children");
  // detect if device is touch-capable
  const isTouch = "ontouchstart" in window || navigator.maxTouchPoints > 0;

  menuItems.forEach((li) => {
    const has_children = li.querySelector("ul.sub-menu ul.sub-menu") as HTMLElement;
    if (has_children) {
      li.querySelector(".sub-menu")?.classList.add("sub-menu--has-children");
    }
  });

  menuItems.forEach((item) => {
    const link = item.querySelector("a") as HTMLElement;

    if (isTouch) {
      link.addEventListener("click", function (e) {
        // If submenu is not open → prevent navigation & open it
        if (!item.classList.contains("submenu-open")) {
          e.preventDefault();
          // close other open submenus at the same level
          item.parentElement
            ?.querySelectorAll(".submenu-open")
            .forEach((el) => el !== item && el.classList.remove("submenu-open"));

          item.classList.add("submenu-open");
        }
        // If already open → allow navigation (second tap goes to link)
      });
    } else {
      // Desktop → hover behavior
      item.addEventListener("mouseenter", () => {
        item.classList.add("submenu-open");
      });
      item.addEventListener("mouseleave", () => {
        item.classList.remove("submenu-open");
      });
    }
  });

  // click outside to close any open submenu
  // (only on touch devices, to avoid interference with hover on desktop)
  if (isTouch) {
    document.addEventListener("click", (e) => {
      if (!mainMenu.contains(e.target as Node)) {
        menuItems.forEach((item) => item.classList.remove("submenu-open"));
      }
    });
  }
}
