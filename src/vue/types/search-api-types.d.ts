export interface SearchApi {
  pages: {
    id: number;
    title: string;
    url: string;
    img: boolean;
    slug: string;
    [k: string]: unknown;
  }[];
}
