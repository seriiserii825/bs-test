export interface IHomeResponse {
  home_intro: IHomeIntro;
  about: IAbout;
  banner: IBanner;
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
export interface IBanner {
  image: Image;
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
