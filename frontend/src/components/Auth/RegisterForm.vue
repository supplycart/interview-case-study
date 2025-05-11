<template>
  <form @submit.prevent="submitRegister" class="space-y-6 bg-white p-8 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center text-gray-800">Create Your Account</h2>
    
    <AlertMessage
      v-if="authStore.authError || registrationSuccess"
      :type="registrationSuccess ? 'success' : 'error'"
      :message="registrationSuccess ? 'Registration successful! Please check your email to verify your account.' : authStore.authError"
      :title="registrationSuccess ? 'Success!' : 'Registration Failed'"
      dismissible
      @dismiss="clearAuthErrorAndSuccess"
    />

    <AppInput
      id="register-name"
      v-model="userData.name"
      type="text"
      label="Full Name"
      placeholder="John Doe"
      required
      :error="validationErrors.name"
    />
    <AppInput
      id="register-email"
      v-model="userData.email"
      type="email"
      label="Email Address"
      placeholder="you@example.com"
      required
      :error="validationErrors.email"
    />
    <AppInput
      id="register-password"
      v-model="userData.password"
      type="password"
      label="Password"
      placeholder="••••••••"
      required
      :error="validationErrors.password"
    />
    <AppInput
      id="register-password-confirmation"
      v-model="userData.password_confirmation"
      type="password"
      label="Confirm Password"
      placeholder="••••••••"
      required
      :error="validationErrors.password_confirmation"
    />
    <div>
      <AppButton type="submit" variant="primary" class="w-full" :loading="authStore.isAuthLoading">
        Create Account
      </AppButton>
    </div>
    <p class="text-sm text-center text-gray-600">
      Already have an account?
      <router-link to="/login" class="font-medium text-blue-600 hover:text-blue-500">
        Sign in
      </router-link>
    </p>
  </form>
</template>

<script>
import { mapStores } from 'pinia';
import { useAuthStore } from '@/stores/authStore';
import AppInput from '@/components/UI/AppInput.vue';
import AppButton from '@/components/UI/AppButton.vue';
import AlertMessage from '@/components/UI/AlertMessage.vue';

export default {
  name: 'RegisterForm',
  components: { AppInput, AppButton, AlertMessage },
  data() {
    return {
      userData: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      validationErrors: {},
      registrationSuccess: false,
    };
  },
  computed: {
    ...mapStores(useAuthStore),
  },
  methods: {
    validateForm() {
      this.validationErrors = {};
      let isValid = true;
      if (!this.userData.name) {
        this.validationErrors.name = 'Name is required.'; isValid = false;
      }
      if (!this.userData.email) {
        this.validationErrors.email = 'Email is required.'; isValid = false;
      } else if (!/\S+@\S+\.\S+/.test(this.userData.email)) {
        this.validationErrors.email = 'Email is invalid.'; isValid = false;
      }
      if (!this.userData.password) {
        this.validationErrors.password = 'Password is required.'; isValid = false;
      } else if (this.userData.password.length < 8) {
        this.validationErrors.password = 'Password must be at least 8 characters.'; isValid = false;
      }
      if (this.userData.password !== this.userData.password_confirmation) {
        this.validationErrors.password_confirmation = 'Passwords do not match.'; isValid = false;
      }
      return isValid;
    },
    async submitRegister() {
      this.authStore.clearError();
      this.registrationSuccess = false;
      if (!this.validateForm()) {
        return;
      }
      try {
        await this.authStore.handleRegister(this.userData);
        this.registrationSuccess = true;
        this.userData = { name: '', email: '', password: '', password_confirmation: '' }; // Clear form
        // Message about email verification is typically shown by AlertMessage.
        // No automatic redirect, user needs to verify email.
      } catch (error) {
         if (error.response && error.response.data && error.response.data.errors) {
           // Map backend validation errors to local state
           const backendErrors = error.response.data.errors;
           for (const key in backendErrors) {
             if (this.validationErrors.hasOwnProperty(key)) {
               this.validationErrors[key] = backendErrors[key][0]; // Take the first error message
             } else if (key === 'email' && this.validationErrors.hasOwnProperty('email')) { // Backend might just return 'email'
                this.validationErrors_email = backendErrors.email[0];
             }
           }
         }
         // Generic error is set in authStore and displayed by AlertMessage
      }
    },
    clearAuthErrorAndSuccess() {
        this.authStore.clearError();
        this.registrationSuccess = false;
    }
  },
  created() {
      this.authStore.clearError();
  }
};
</script>
