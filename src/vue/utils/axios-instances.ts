import axios from 'axios';

const url = window.location.origin;
export const axiosInstance = axios.create({
  baseURL: `${url}/wp-json`,
  headers: {
    contentType: 'application/json'
  }
});
