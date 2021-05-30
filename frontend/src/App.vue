<template>
  <div class="flex flex-col items-center justify-center mt-11 w-full p-2">
    <input class="w-full max-w-md" type="text" placeholder="User ID" v-model="userid">
    <input class="w-full max-w-md" type="password" placeholder="Password" v-model="password">
    <div v-if="loginError" class=" text-red-700">{{ loginError }}</div>
    <button class="mt-2" @click="buttonClicked">Login</button>
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
    }
  }
};
</script>

<style scoped>
</style>