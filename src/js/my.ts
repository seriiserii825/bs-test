import '../vue/vue-app.js';
import fixedHeader from './modules/header/fixed-header';
import { initOnPresence, TMounts } from './modules/helpers/mount.js';
import { mainMenu } from './modules/menu';
import homeIntroAnimation from '../../../modules/home-intro/homeIntroAnimation';

document.addEventListener('DOMContentLoaded', function () {
  mainMenu();
  fixedHeader();
  homeIntroAnimation();
  // streetMap();
  const mounts: TMounts[] = [
    // { selector: '.animation', callback: gsapAnimation, min_width: 992 },
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
