<template>
  <Form title="Login to your account">
    <label for="">User ID</label>
    <input type="text" placeholder="User ID" v-model="userid">
    <label for="">Password</label>
    <input type="password" placeholder="Password" v-model="password">
    <div v-if="loginError" class=" text-red-700">{{ loginError }}</div>
    <button class="mt-2 w-full" @click="buttonClicked">Login</button>
    <div class="mt-4 text-center w-full">
      Don't have an account?
      <span @click="registerClicked" class="cursor-pointer underline text-blue-400 select-none">Register</span>
    </div>
  </Form>
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
      this.$router.push('/Register');
    }
  }
};
</script>

<style scoped>
</style>