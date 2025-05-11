<template>
    <div class="email-verified-page flex flex-col items-center justify-center min-h-[70vh] text-center p-6">
      <div class="bg-white p-8 md:p-12 shadow-xl rounded-lg max-w-lg">
        <svg class="w-20 h-20 mx-auto mb-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Email Verified!</h1>
        <p v-if="successMessage" class="text-gray-600 mb-6">{{ successMessage }}</p>
        <p v-else class="text-gray-600 mb-6">
          Your email address has been successfully verified. You can now fully access your account.
        </p>
        <router-link to="/login" v-if="!authStore.isLoggedIn">
          <AppButton variant="primary" class="w-full sm:w-auto px-6">
            Proceed to Login
          </AppButton>
        </router-link>
         <router-link to="/" v-else>
          <AppButton variant="primary" class="w-full sm:w-auto px-6">
            Go to Homepage
          </AppButton>
        </router-link>
      </div>
    </div>
  </template>
  
  <script>
  import { mapStores } from 'pinia';
  import AppButton from '@/components/UI/AppButton.vue';
  import { useAuthStore } from '@/stores/authStore';
  
  export default {
    name: 'EmailVerifiedPage',
    components: { AppButton },
    data() {
        return {
            successMessage: '',
        }
    },
    computed: {
        ...mapStores(useAuthStore),
    },
    created() {
        // Check query params from backend redirect (if any)
        if (this.$route.query.success === 'true') {
            this.successMessage = "Your email has been verified. Welcome!";
        } else if (this.$route.query.already_verified === 'true') {
            this.successMessage = "Your email was already verified. You're good to go!";
        }
  
        // If user is logged in and their state wasn't updated immediately, re-fetch user
        if (this.authStore.isLoggedIn && (!this.authStore.currentUser || !this.authStore.currentUser.email_verified_at)) {
            this.authStore.initializeAuth(); // This will fetch user data again
        }
    }
  };
  </script>
  