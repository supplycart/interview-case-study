<template>
  <div class="flex p-6">
    <h1 class="text-xl font-medium text-black">Supplycart Interview Case Study</h1>
    <User v-if="token" :token="token" />
    <Guest v-else />
  </div>
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
