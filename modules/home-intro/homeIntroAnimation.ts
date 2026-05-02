import gsap from 'gsap';

export default function homeIntroAnimation() {
  const section = document.querySelector('.js-home-intro');
  if (!section) return;

  const title = section.querySelector('.home-intro__title');
  const text = section.querySelector('.home-intro__text');
  const image = section.querySelector('.home-intro__image');

  const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

  tl.from(title, { y: 40, opacity: 0, duration: 0.8 })
    .from(text,  { y: 30, opacity: 0, duration: 0.7 }, '-=0.5')
    .from(image, { x: 40, opacity: 0, duration: 0.9 }, '-=0.6');
}
