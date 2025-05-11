import { defineStore } from 'pinia';
import apiClient, { fetchCsrfToken } from '@/services/api'; // CSRF for initial login
import router from '@/router'; // For navigation

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('token') || null,
    isAuthenticated: !!localStorage.getItem('token'),
    isLoading: false,
    error: null,
    emailVerificationRequired: false,
  }),
  getters: {
    currentUser: (state) => state.user,
    isLoggedIn: (state) => state.isAuthenticated,
    authError: (state) => state.error,
    isAuthLoading: (state) => state.isLoading,
  },
  actions: {
    async initializeAuth() {
      // This can be called on app load to try to fetch user if token exists
      if (this.token) {
        try {
          this.isLoading = true;
          const response = await apiClient.get('/user');
          this.user = response.data.data;
          this.isAuthenticated = true;
          localStorage.setItem('user', JSON.stringify(this.user));
        } catch (error) {
          console.error("Failed to fetch user with stored token", error);
          this.handleLogout(); // Token might be invalid
        } finally {
          this.isLoading = false;
        }
      }
    },
    async handleRegister(credentials) {
      this.isLoading = true;
      this.error = null;
      this.emailVerificationRequired = false;
      try {
        await fetchCsrfToken(); // For Sanctum SPA
        const response = await apiClient.post('/register', credentials);
        // Don't auto-login, user needs to verify email
        this.emailVerificationRequired = true; // Indicate verification is needed
        // No need to set token and user here if email verification is mandatory first.
        return response.data;
      } catch (err) {
        this.error = err.response?.data?.message || 'Registration failed';
        throw err;
      } finally {
        this.isLoading = false;
      }
    },
    async handleLogin(credentials) {
      this.isLoading = true;
      this.error = null;
      this.emailVerificationRequired = false;
      try {
        await fetchCsrfToken(); // For Sanctum SPA
        const response = await apiClient.post('/login', credentials);
        this.token = response.data.token;
        this.user = response.data.user;
        this.isAuthenticated = true;
        localStorage.setItem('token', this.token);
        localStorage.setItem('user', JSON.stringify(this.user));
        router.push('/');
        return response.data;
      } catch (err) {
        if (err.response?.data?.email_not_verified) {
          this.emailVerificationRequired = true;
          throw err;
        }
        this.error = err.response?.data?.message || 'Login failed';
        this.handleLogout(); // Clear any partial state
        throw err;
      } finally {
        this.isLoading = false;
      }
    },
    handleLogout() {
      this.isLoading = true; // Optional: set loading state

      // Only attempt API logout if there's a token, otherwise just clear local state
      if (this.token) {
        apiClient.post('/logout')
          .catch(error => console.error("Logout API call failed:", error))
          .finally(() => {
            this.user = null;
            this.token = null;
            this.isAuthenticated = false;
            this.emailVerificationRequired = false;
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            this.isLoading = false; // Reset loading state

            // Only redirect if the current route is not already the login route
            if (router.currentRoute.value.path !== '/login') {
              router.push('/login');
            }
          });
      } else {
        // If no token, just clear local state and redirect if not already on login page
        this.user = null;
        this.token = null;
        this.isAuthenticated = false;
        this.emailVerificationRequired = false;
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        this.isLoading = false; // Reset loading state
        if (router.currentRoute.value.path !== '/login') {
          router.push('/login');
        }
      }
    },
    async resendVerificationEmail() {
      this.isLoading = true;
      this.error = null;
      try {
        await apiClient.post('/email/verification-notification');
      } catch (err) {
        this.error = err.response?.data?.message || 'Failed to resend verification email.';
        throw err;
      } finally {
        this.isLoading = false;
      }
    },
    clearError() {
      this.error = null;
    }
  },
});
