<template>
  <div :key="product.id" v-for="product in products">
    <Product :product = "product"/>
  </div>
</template>

<script>
import Product from './Product.vue'

export default {
    name: "Products",
    props: {
        products:Array
    },
    components:{
      Product
    }

}
</script>

<style>
  h3{
    color: black;
  }
</style>