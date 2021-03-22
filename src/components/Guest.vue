<template>
  <div class="flex flex.col m-20">
    <div class="m-auto">
      <h1 class="text-2xl font-bold max-w-login">
        Supplycart Interview Case Study
      </h1>
      <Register />
      <Login />
    </div>
  </div>
  3
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
};
</script>
