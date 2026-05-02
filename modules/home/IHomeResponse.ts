export interface IHomeResponse {
  home_intro: IHomeIntro;
}
export interface IHomeIntro {
  title: string;
  text: string;
  image: Image;
}
export interface IAbout {
  title: string;
  text: string;
  items: IItem[];
  button_text: string;
}
export interface IItem {
  image: Image;
  subtitle: string;
  text: string;
}
export interface Image {
  url: string;
  alt: string;
}
