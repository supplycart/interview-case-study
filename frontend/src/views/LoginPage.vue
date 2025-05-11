<template>
    <div class="login-page flex items-center justify-center min-h-[70vh]">
      <div class="w-full max-w-md">
        <LoginForm />
      </div>
    </div>
  </template>
  
  <script>
  import LoginForm from '@/components/Auth/LoginForm.vue';
  
  export default {
    name: 'LoginPage',
    components: {
      LoginForm,
    },
  };
  </script>
  