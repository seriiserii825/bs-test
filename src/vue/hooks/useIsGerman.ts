export const useIsGerman = () => {
  const html = document.querySelector('html') as HTMLElement;
  const lang = html.lang;
  return lang === 'de_DE';
};
