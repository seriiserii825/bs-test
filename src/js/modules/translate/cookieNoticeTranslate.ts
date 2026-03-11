export default function cookieNoticeTranslate() {
  const cookie_notice_text = document.querySelector('#cn-notice-text');
  const cookie_notice_btn = document.querySelector('#cn-more-info');
  const html_text = document.querySelector(
    '#cookie-notice-text'
  ) as HTMLElement;
  const html_btn = document.querySelector(
    '#cookie-notice-button-text'
  ) as HTMLElement;
  const html_lang = document.querySelector('html')?.getAttribute('lang');

  if (cookie_notice_text === null || cookie_notice_btn === null) return;
  if (html_lang !== 'it-IT') {
    cookie_notice_text.innerHTML = html_text.innerHTML;
    cookie_notice_btn.innerHTML = html_btn.innerHTML;
  }
}
