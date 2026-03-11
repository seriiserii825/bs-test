export type TMounts = {
  selector: string;
  callback: (el?: Element) => void;
  min_width?: number;
};

export function initOnPresence(maps: TMounts[]) {
  for (const { selector, callback, min_width } of maps) {
    const node = document.querySelector(selector);
    if (!node) continue;
    if (min_width && window.innerWidth < min_width) {
        continue;
    }
    callback();
  }
}
