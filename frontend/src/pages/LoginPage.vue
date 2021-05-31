<template>
  <div class="w-full max-w-md border border-gray-300 bg-blue-50 p-3 rounded-md mt-10">
    <div class="mb-6 text-lg md:text-xl font-bold text-left w-full">Login to your account</div>
    <label for="">User ID</label>
    <input class="w-full" type="text" placeholder="User ID" v-model="userid">
    <label for="">Password</label>
    <input class="w-full" type="password" placeholder="Password" v-model="password">
    <div v-if="loginError" class=" text-red-700">{{ loginError }}</div>
    <button class="mt-2 w-full" @click="buttonClicked">Login</button>
    <div class="mt-4 text-center w-full">
      Don't have an account?
      <span @click="registerClicked" class="cursor-pointer underline text-blue-400 select-none">Register</span>
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  data: function() {
    return {
      userid: '',
      password: '',

      loginError: ''
    }
  },
  props: {
  },
  methods: {
    buttonClicked: function() {
      this.loginError = '';
      if (!this.userid || !this.password) {
        this.loginError = 'Please enter your user id and password!';
      } else {
        console.log(`Send to API, user id: ${this.userid} and pass: ${this.password}`);
      }
    },
    registerClicked: function() {
      console.log('abc');
    }
  }
};
</script>

<style scoped>
</style>