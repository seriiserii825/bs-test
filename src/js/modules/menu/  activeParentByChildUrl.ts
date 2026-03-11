export default function activeParentByChildUrl() {
  const mainMenu = document.querySelector('#js-main-menu') as HTMLElement;
  const menu_links = mainMenu.querySelectorAll('a');

  menu_links.forEach(() => {
    const segments = getSegmentsFromUrl(window.location.pathname);
    if (segments.length > 0) {
      const first_segment = segments[0];
      const li = getLiByLinkSegment(first_segment);
      if (li) {
        li.classList.add('current-menu-item');
      }
    }

    function getSegmentsFromUrl(url: string) {
      if (url.includes('/')) {
        return url.split('/').filter((segment) => segment.length > 0);
      }
      return [url];
    }

    function getLiByLinkSegment(segment: string): HTMLLIElement | null {
      let foundLi: HTMLLIElement | null = null;
      menu_links.forEach((link) => {
        const url = link.getAttribute('href');
        const url_segments = getSegmentsFromUrl(url || '');
        if (url_segments.length > 0 && url_segments.includes(segment)) {
          foundLi = link.closest('li');
        }
      });
      return foundLi;
    }
  });
}
