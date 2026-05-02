import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export default function whoWeAreAnimation() {
  gsap.registerPlugin(ScrollTrigger);

  const section = document.querySelector('.who-we-are');
  if (!section) return;

  const title = section.querySelector('.who-we-are__title');
  const text = section.querySelector('.who-we-are__text');

  const tl = gsap.timeline({
    defaults: { ease: 'power3.out' },
    scrollTrigger: {
      trigger: section,
      start: 'top 80%',
    },
  });

  tl.from(title, { y: 30, opacity: 0, duration: 0.7 })
    .from(text,  { y: 20, opacity: 0, duration: 0.7 }, '-=0.4');
}
