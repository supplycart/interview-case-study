import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.xsrfCookieName = 'XSRF-TOKEN';
axios.defaults.xsrfHeaderName = 'X-XSRF-TOKEN';

const api = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_URL + '/api', // Use Vite's env variables
  headers: {
    Accept: 'application/json',
  },
});

api.interceptors.request.use(async (config) => {
  // If this is a non-get request, get the CSRF cookie
  if (config.method !== 'get') {
    try {
      // Send a GET request to the /sanctum/csrf-cookie endpoint
      await axios.get(import.meta.env.VITE_BACKEND_URL + '/sanctum/csrf-cookie');
    } catch (err) {
      console.error('CSRF cookie has not been set: ', err);
    }
  }
  const token = localStorage.getItem('access_token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
}, (error) => {
  return Promise.reject(error);
});

export default api;
