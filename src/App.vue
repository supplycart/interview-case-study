<template>
  <keep-alive>
    <router-view :products="products" :cart="cart" :cartNumber="cartNumber" :cartAdded="cartAdded" :orderedProducts="orderedProducts" :orderedItems="orderedItems" />
  </keep-alive>
</template>

<script>
import { onBeforeMount } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import firebase from 'firebase'

export default {
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
      this.cartNumber = 0
      this.cart.length = 0
    }
  },
  setup() {
    const router = useRouter()
    const route = useRoute()

    onBeforeMount(() => {
      firebase.auth().onAuthStateChanged((user) => {
        if(!user) {
          router.replace('/login')
        }else if(route.path == '/login' || route.path == '/register') {
          router.replace('/')
        }
      })
    })
  }
}
</script>

<style>

</style>
