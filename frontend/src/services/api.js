import axios from 'axios';
import { useAuthStore } from '@/stores/authStore'; // Adjust path as needed

const apiClient = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL || '<http://localhost/api>', // Use env var
  withCredentials: true, // Important for Sanctum SPA auth if using cookies
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }
});

apiClient.interceptors.request.use(config => {
  const authStore = useAuthStore();
  if (authStore.token) {
    config.headers.Authorization = `Bearer ${authStore.token}`;
  }
  return config;
}, error => {
  return Promise.reject(error);
});

apiClient.interceptors.response.use(response => {
  return response;
}, error => {
  if (error.response && error.response.status === 401) {
    const authStore = useAuthStore();
    authStore.handleLogout(); // Clear user data and token
    // Optionally redirect to login
    // router.push('/login'); // Make sure router is available here or emit an event
  }
  return Promise.reject(error);
});

// CSRF for Sanctum SPA (if not using Bearer Tokens exclusively)
// This is typically needed for the initial login/register if Sanctum expects CSRF cookie
export async function fetchCsrfToken() {
  try {
    await axios.get( (import.meta.env.VITE_APP_URL || '<http://localhost>') + '/sanctum/csrf-cookie', { withCredentials: true });
    // console.log('CSRF cookie fetched');
  } catch (error) {
    console.error('Error fetching CSRF cookie:', error);
  }
}

export default apiClient;
