<template>
  <div class="login-page flex items-center justify-center min-h-[70vh]">
    <div class="w-full max-w-md">
      <RegisterForm />
    </div>
  </div>
</template>

<script>
import RegisterForm from '@/components/Auth/RegisterForm.vue';

export default {
  name: 'RegisterPage',
  components: {
    RegisterForm,
  },
};
</script>