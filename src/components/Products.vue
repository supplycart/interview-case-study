<template>
  <div v-for="product in products" :key="product.id">
    <Product :product="product" @add-cart="$emit('add-cart', product.id)" />
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
  },
  emits: ["add-cart"]
};
</script>
