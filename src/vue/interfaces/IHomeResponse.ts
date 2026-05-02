export interface IHomeResponse {
  home_intro: IHomeIntro;
}
export interface IHomeIntro {
  title: string;
  text: string;
  image: Image;
}
export interface Image {
  url: string;
  alt: string;
}
