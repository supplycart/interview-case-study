<template>
  <!-- <img alt="Vue logo" src="./assets/logo.png"> -->
  <!-- <HelloWorld msg="Welcome to Your Vue.js App"/> -->
  <div id="app">
  <router-view/>
  <!-- <SignIn /> -->
  </div>
  

  <!-- <TopBar />
  <Header />
  <Products :products = "products"/> -->
</template>

<script>
// import Header from './components/Header.vue'
// import Products from './components/Products.vue'
// import TopBar from './components/TopBar.vue'
// import SignIn from './components/SignIn.vue'

export default {
  name: 'App',
  components: {
    // HelloWorld
    // Header, Products, TopBar
    // SignIn
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
/* #app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
} */

/* *{
  outline: red solid 1px;
} */

/* * {
    margin: 0;
} */
</style>
