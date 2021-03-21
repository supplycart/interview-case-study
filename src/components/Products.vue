<template>
  <div v-for="product in products" :key="product.id">
    <Product :product="product" :token="token" @add-cart="$emit('add-cart', product.id, product.price)"/>
  </div>
</template>

<script>
import Product from "./Product";

export default {
  name: "Products",
  components: {
    Product,
  },
  props: {
    products: {
      type: Array,
      required: true,
    },
    token: {
      type: String,
      required: true
    }
  },
  emits: ["add-cart"],
};
</script>
