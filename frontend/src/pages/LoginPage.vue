<template>
  <Form title="Login to your account" class="m-3">
    <label for="">User ID</label>
    <input type="text" placeholder="User ID" v-model="userid">
    <label for="">Password</label>
    <input type="password" placeholder="********" v-model="password">
    <div v-if="loginError" class=" text-red-700">{{ loginError }}</div>
    <button class="mt-2 w-full" @click="loginClicked" :disabled="loading">Login</button>
    <div v-if="loading" class="flex items-center justify-center mt-3">
      <div class="border-spin rounded-full border-2 h-5 w-5 sm:h-7 sm:w-7 animate-spin"></div>
      <div class="sm:text-sm font-bold ml-3">Logging in</div>
    </div>
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

      loginError: '',
      loading: false
    }
  },
  props: {
  },
  methods: {
    loginClicked: async function() {
      this.loginError = '';
      if (!this.userid || !this.password) {
        this.loginError = 'Please enter your user id and password!';
      } else {
        this.loading = true;
        let login = await this.$axios.post('/Users/Login', {
          'userID': this.userid,
          'password': this.password
        });
        this.loading = false;

        if (login.data) {
          this.$cookies.set('user', login.data);
          this.$activity.send('Login');
          this.$router.push('/Home');
        } else {
          this.loginError = 'User ID or Password is incorrect';
        }
      }
    },
    registerClicked: function() {
      this.$router.push('/Register');
    }
  },
  mounted() {
    if (this.$cookies.isKey('user')) {
      this.$router.push('/Home');
    }
  }
};
</script>

<style scoped>
</style>