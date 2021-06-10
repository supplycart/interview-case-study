<template>
  <div class="flex justify-center text-xs md:text-sm w-full">
    <div v-if="$store.state.showGradient" class="bg-gradient-to-b from-blue-300 fixed top-0 left-0 h-full w-full z-back"></div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  components: {
  },
  data: function() {
    return {
      path: ''
    }
  },
  props: {
  },
  methods: {
  },
  mounted() {
    this.path = this.$route.path;
  }
};
</script>

<style scoped>
</style>