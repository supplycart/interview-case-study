<template>
  <div class="home text-gray-600">
    <Header :orderedProducts="orderedProducts" :cart="cart" :cartNumber="cartNumber" />
    <Products v-on:addToCart="cartAdded($event)" :items="products" />
  </div>
</template>

<script>
import Header from '../components/Header'
import Products from '../components/Products'

export default {
  name: 'Home',
  props: ['products', 'cartAdded' , 'orderedProducts', 'cart', 'cartNumber'],
  components: {
    Products,
    Header
  },
}
</script>
