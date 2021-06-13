<template>
  <div class="w-full max-w-md border border-gray-300 bg-blue-50 p-3 rounded-md">
    <div class="mb-6 text-lg md:text-xl font-bold text-left w-full">{{ title }}</div>
    <slot></slot>
  </div>
</template>

<script>
export default {
  components: {
  },
  props: {
    title: { type: String, default: 'Title Here' }
  },
  methods: {
  }
};
</script>

<style lang="scss" scoped>

</style>