<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>

export default {
  name: 'App',
  components: {
  },
  data() {
    return {
      products: [],
      signIn: true
    }
  },
  created() {
    this.products = [
      {
        id: 1,
        name: "Chair",
        price: "RM39"
      },
      {
        id: 2,
        name: "Table",
        price: "RM59"
      }

    ]
    }
  }

</script>

<style>
</style>
