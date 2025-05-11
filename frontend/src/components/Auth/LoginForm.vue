<template>
  <form @submit.prevent="submitLogin" class="space-y-6 bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center text-gray-800">Login to Your Account</h2>

    <AlertMessage v-if="authStore.authError || authStore.emailVerificationRequired"
      :type="authStore.emailVerificationRequired ? 'warning' : 'error'"
      :message="authStore.authError || (authStore.emailVerificationRequired ? 'Please verify your email. ' : '')"
      :title="authStore.emailVerificationRequired ? 'Verification Required' : 'Login Failed'" dismissible
      @dismiss="clearAuthError" />
    <div v-if="authStore.emailVerificationRequired" class="mt-2 text-sm">
      Didn't receive an email?
      <AppButton type="button" variant="link" @click="resendVerification" :loading="isResending"
        class="text-blue-600 hover:text-blue-800 font-medium">
        Resend verification email
      </AppButton>
    </div>


    <AppInput id="login-email" v-model="credentials.email" type="email" label="Email Address"
      placeholder="you@example.com" required :error="validationErrors.email" />
    <AppInput id="login-password" v-model="credentials.password" type="password" label="Password" placeholder="••••••••"
      required :error="validationErrors.password" />
    <div>
      <AppButton type="submit" variant="primary" class="w-full" :loading="authStore.isAuthLoading">
        Sign In
      </AppButton>
    </div>
    <p class="text-sm text-center text-gray-600">
      Don't have an account?
      <router-link to="/register" class="font-medium text-blue-600 hover:text-blue-500">
        Sign up
      </router-link>
    </p>
  </form>
</template>

<script>
import { mapStores, mapActions } from 'pinia';
import { useAuthStore } from '@/stores/authStore';
import AppInput from '@/components/UI/AppInput.vue';
import AppButton from '@/components/UI/AppButton.vue';
import AlertMessage from '@/components/UI/AlertMessage.vue';
import { useToast } from 'vue-toastification';

export default {
  name: 'LoginForm',
  components: { AppInput, AppButton, AlertMessage },
  data() {
    return {
      credentials: {
        email: '',
        password: '',
      },
      validationErrors: {},
      isResending: false, // For resend button loading state
    };
  },
  computed: {
    ...mapStores(useAuthStore),
  },
  methods: {
    ...mapActions(useAuthStore, ['handleLogin', 'clearError', 'resendVerificationEmail']),
    validateForm() {
      this.validationErrors = {};
      let isValid = true;
      if (!this.credentials.email) {
        this.validationErrors.email = 'Email is required.';
        isValid = false;
      } else if (!/\S+@\S+\.\S+/.test(this.credentials.email)) {
        this.validationErrors.email = 'Email is invalid.';
        isValid = false;
      }
      if (!this.credentials.password) {
        this.validationErrors.password = 'Password is required.';
        isValid = false;
      }
      return isValid;
    },
    async submitLogin() {
      this.authStore.clearError(); // Clear previous errors
      if (!this.validateForm()) {
        return;
      }
      try {
        await this.authStore.handleLogin(this.credentials);
        // Navigation is handled by authStore or router guards
      } catch (error) {
        // Error is set in authStore and displayed by AlertMessage
        // Handle specific API validation errors if backend returns them in a structured way
        if (error.response && error.response.data && error.response.data.errors) {
          // this.validationErrors = error.response.data.errors; // Map backend validation errors
        }
      }
    },
    clearAuthError() {
      this.authStore.clearError();
      this.authStore.emailVerificationRequired = false; // Also clear this flag
    },
    async resendVerification() {
      this.isResending = true;
      const toast = useToast();
      try {
        await this.authStore.resendVerificationEmail();
        toast.success("Verification email resent. Please check your inbox.");
      } catch (error) {
        // Error is handled in store and likely shown in main alert
      } finally {
        this.isResending = false;
      }
    }
  },
  created() {
    this.authStore.clearError(); // Clear any stale errors on component creation
    this.authStore.emailVerificationRequired = false;
  }
};
</script>