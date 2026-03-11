export const useIsEnglish = () => {
  const html = document.querySelector('html') as HTMLElement;
  const lang = html.lang;
  return lang === 'en_US';
};
