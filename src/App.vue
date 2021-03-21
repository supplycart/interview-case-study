<template>
  <h1>Supplycart Interview Case Study</h1>
  <User v-if="token" :token="token" />
  <Guest v-else />
</template>

<script>
import Guest from "./components/Guest";
import User from "./components/User";

export default {
  name: "App",
  components: {
    Guest,
    User,
  },
  data() {
    return {
      token: localStorage.getItem("token")
    };
  },
  methods: {
    setToken(data) {
      console.log(data);
      this.token = data;
    },
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
