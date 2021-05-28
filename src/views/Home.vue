<template>
  <div class="home text-gray-600">
    <div class="flex justify-between p-4 bg-green-100 align-center">
      <div class="flex">
        <h1 class="text-3xl mr-8">Welcome, {{ name }}</h1>
        <button class="logout self-center px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2" @click="Logout">Logout</button>
      </div>
      <div class="flex items-center">
        <router-link class="flex-shrink-0 mr-8" :to="{ name: 'History' }" :newItem="orderedItems">Order History</router-link>
        <Cart v-on:placeOrder="orderedProducts($event)" :cartNumber="cartNumber" :carts="cart" />
      </div>
    </div>
    <Products v-on:addToCart="cartAdded($event)" :items="products" />
  </div>
</template>

<script>
import { ref, onBeforeMount } from 'vue'
import firebase from 'firebase'
import Cart from '../components/Cart'
import Products from '../components/Products'

export default {
  name: 'Home',
  props: ['cartOrder'],
  data() {
    return {
      products: [
        { id: 1, title: 'Sword Art Online', author: 'Reki Kawahara', review: 2 },
        { id: 2, title: 'Attack on Titan', author: 'Hajime Isayama', review: 4 },
        { id: 3, title: 'Horimiya', author: 'HERO', review: 5 },
        { id: 4, title: 'Kaguya-sama: Love Is War', author: 'Aka Akasaka', review: 5 },
        { id: 5, title: 'Gokushufudou', author: 'Kousuke Oono', review: 2 },
      ],
      cart: [],
      orderedItems: null,
      cartNumber: 0
    }
  },
  components: {
    Products,
    Cart
  },
  methods: {
    cartAdded(product) {
      const items = {
        id: product.id,
        title: product.title,
        author: product.author,
        review: product.review
      }
      this.cart.push(items)
      this.cartNumber++
    },
    orderedProducts(ordered) {
      const newObj = ordered.map((item) => {
        return {
          id: item.id,
          title: item.title,
          author: item.author,
          review: item.review
        }
      })

      this.orderedItems = newObj
    }
  },
  setup() {
    const name = ref('')
    
    onBeforeMount(() => {
      firebase.auth().onAuthStateChanged((user) => {
        if(user) {
          name.value = user.email.split('@')[0]
        }
      })
    })

    const Logout = () => {
      firebase.auth().signOut().then(() => {
        console.log('signed out')
      }).catch((err) => {
        alert(err.message)
      })
    }

    return { name, Logout }
  }
}
</script>
