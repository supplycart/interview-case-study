<template>
  <div>
    <h2>{{ details.name }}</h2>
    <p>Quantity: {{ details.quantity }}</p>
    <p>Price: {{ details.price }}</p>
    <button @click="$emit('remove-cart', product)">Remove</button>
  </div>
</template>

<script>
export default {
  name: "CartItem",
  props: {
    product: {
      type: String,
      required: true,
    },
    details: {
      type: Object,
      required: true,
    },
  },
  emits: ["remove-cart"]
};
</script>
