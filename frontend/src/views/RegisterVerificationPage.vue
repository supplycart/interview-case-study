<template>
    <div class="request-verification-page flex flex-col items-center justify-center min-h-[70vh] text-center p-6">
      <div class="bg-white p-8 md:p-12 shadow-xl rounded-lg max-w-lg">
        <svg class="w-16 h-16 mx-auto mb-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Verify Your Email</h1>
        <p class="text-gray-600 mb-6">
          Hello {{ authStore.currentUser?.name }}! Your account registration is almost complete.
          We've sent a verification link to <strong>{{ authStore.currentUser?.email }}</strong>.
          Please check your inbox (and spam folder) and click the link to activate your account.
        </p>
        <AlertMessage v-if="resendError" type="error" :message="resendError" title="Error" dismissible @dismiss="resendError = null" />
        <AlertMessage v-if="resendSuccess" type="success" :message="resendSuccess" title="Success!" dismissible @dismiss="resendSuccess = null" />
  
        <AppButton
          @click="resendVerification"
          :loading="isResending"
          variant="primary"
          class="w-full sm:w-auto px-6"
        >
          Resend Verification Email
        </AppButton>
        <p class="mt-6 text-sm text-gray-500">
          If you continue to have issues, please contact support.
        </p>
         <p class="mt-4">
          <AppButton @click="logoutAndGoHome" variant="secondary" customClass="text-sm">
            Logout and go to Homepage
          </AppButton>
        </p>
      </div>
    </div>
  </template>
  
  <script>
  import { mapStores } from 'pinia';
  import { useAuthStore } from '@/stores/authStore';
  import AppButton from '@/components/UI/AppButton.vue';
  import AlertMessage from '@/components/UI/AlertMessage.vue';
  import { useToast } from 'vue-toastification';
  
  export default {
    name: 'RegisterVerificationPage',
    components: { AppButton, AlertMessage },
    data() {
      return {
        isResending: false,
        resendError: null,
        resendSuccess: null,
      };
    },
    computed: {
      ...mapStores(useAuthStore),
    },
    methods: {
      async resendVerification() {
        this.isResending = true;
        this.resendError = null;
        this.resendSuccess = null;
        const toast = useToast();
        try {
          await this.authStore.resendVerificationEmail();
          this.resendSuccess = "A new verification link has been sent to your email address.";
          toast.success(this.resendSuccess);
        } catch (error) {
          this.resendError = error.response?.data?.message || "Failed to resend verification email. Please try again.";
          toast.error(this.resendError);
        } finally {
          this.isResending = false;
        }
      },
       logoutAndGoHome() {
        this.authStore.handleLogout(); // This store action will redirect to login or home
        this.$router.push('/');
      }
    },
     created() {
      // Redirect if user is somehow already verified or not logged in
      if (!this.authStore.isLoggedIn || (this.authStore.currentUser && this.authStore.currentUser.email_verified_at)) {
        this.$router.push('/');
      }
    }
  };
  </script>
  