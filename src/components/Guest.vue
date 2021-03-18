<template>
  <Register />
  <Login :token="token" />
</template>

<script>
import Register from "./Register";
import Login from "./Login";

export default {
  name: "Guest",
  components: {
    Register,
    Login,
  },
  props: {
    token: {
      type: String,
      default: null,
    },
  },
};
</script>
