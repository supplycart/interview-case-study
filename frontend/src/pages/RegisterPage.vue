<template>
  <Form title="Create your account">
    <label for="">User ID</label>
    <input type="text" placeholder="User ID" v-model="userid">
    <label for="">Email Address</label>
    <input type="text" placeholder="User ID" v-model="userid">
    <label for="">Full Name</label>
    <input type="text" placeholder="User ID" v-model="userid">
    <label for="">User Type</label>
    <select v-model="userType">
      <option disabled>Select User Type</option>
      <option>Basic</option>
      <option>Advanced</option>
    </select>
    <label for="">Password</label>
    <input type="password" placeholder="*********" v-model="userid">
    <label for="">Re-enter password</label>
    <input type="password" placeholder="*********" v-model="userid">
    <button class="w-full">Register</button>
    <button class="w-full mt-10" @click="$router.go('-1')">Back to Login</button>
  </Form>
</template>

<script>
export default {
  components: {
  },
  props: {
  },
  methods: {
  }
};
</script>

<style lang="scss" scoped>

</style>