<template>
    <div class="flex justify-between p-4 bg-green-100 align-center">
        <div class="flex">
            <h1 class="text-3xl mr-8"><router-link :to="{ name: 'Home' }">Welcome</router-link>, {{ name }}</h1>
            <button class="logout self-center px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2" @click="Logout">Logout</button>
        </div>
        <div class="flex items-center">
            <router-link class="flex-shrink-0 mr-8" :to="{ name: 'History' }" >Order History</router-link>
            <Cart v-on:placeOrder="orderedProducts($event)" :cartNumber="cartNumber" :carts="cart" />
        </div>
    </div>
</template>

<script>
import { ref, onBeforeMount } from 'vue'
import firebase from 'firebase'
import Cart from './Cart'

export default {
    props: ['Logout', 'name', 'orderedProducts', 'cart', 'cartNumber'],
    components: {
        Cart
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

<style>

</style>