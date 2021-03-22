<template>
  <User v-if="token" :token="token" />
  <Guest v-else />
</template>

<script>
import Guest from "../components/Guest";
import User from "../components/User";

export default {
  name: "App",
  components: {
    Guest,
    User,
  },
  data() {
    return {
      token: localStorage.getItem("token"),
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
