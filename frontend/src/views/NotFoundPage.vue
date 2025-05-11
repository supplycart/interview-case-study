<template>
    <div class="not-found-page flex flex-col items-center justify-center min-h-[70vh] text-center p-6">
      <div class="bg-white p-8 md:p-12 shadow-xl rounded-lg max-w-lg">
        <h1 class="text-6xl font-extrabold text-red-500 mb-4">404</h1>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Page Not Found</h2>
        <p class="text-gray-600 mb-8">
          Oops! The page you are looking for does not exist. It might have been moved or deleted.
        </p>
        <router-link to="/">
          <AppButton variant="primary" class="px-8">
            Go to Homepage
          </AppButton>
        </router-link>
      </div>
    </div>
  </template>
  
  <script>
  import AppButton from '@/components/UI/AppButton.vue';
  export default {
    name: 'NotFoundPage',
    components: { AppButton }
  };
  </script>
  