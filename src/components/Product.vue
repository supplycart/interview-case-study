<template>
  <div>
    <h2>{{ product.name }}</h2>
    <p>{{ product.description }}</p>
    <p>Price: RM{{ product.price }}</p>
    <button @click="$emit('add-cart', product.id, product.price)" >Add to cart</button>
  </div>
</template>

<script>
export default {
  name: "Product",
  props: {
    product: {
      type: Object,
      required: true,
    },
    token: {
      type: String,
      required: true,
    }
  },
  emits: ["add-cart"]
};
</script>
