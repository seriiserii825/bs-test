import homeIntroAnimation from '@/modules/home-intro/homeIntroAnimation.js';
import '../vue/vue-app.js';
import fixedHeader from './modules/header/fixed-header';
import { initOnPresence, TMounts } from './modules/helpers/mount.js';
import { mainMenu } from './modules/menu';
import whoWeAreAnimation from '@/modules/who-we-are/whoWeAreAnimation.js';

document.addEventListener('DOMContentLoaded', function () {
  mainMenu();
  fixedHeader();
  // streetMap();
  const mounts: TMounts[] = [
    { selector: '.home-intro', callback: homeIntroAnimation, min_width: 992 },
    { selector: '.who-we-are', callback: whoWeAreAnimation, min_width: 992 }
  ];

  initOnPresence(mounts);
});

// function isChromeOnAppleDevice() {
//   const userAgent = navigator.userAgent;
//   const isChrome = /Chrome|CriOS/.test(userAgent);
//   const isApple = /Mac|iPhone|iPad|iPod/.test(navigator.platform);
//
//   return isChrome && isApple;
// }
//
// function isAppleDevice() {
//   return /Mac|iPhone|iPad|iPod/.test(navigator.platform);
// }
