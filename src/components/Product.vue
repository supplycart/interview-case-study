<template>
  <div>
    <h2>{{ product.name }}</h2>
    <p>{{ product.description }}</p>
    <input value="Add to cart" type="button" @click="$emit('add-cart', product.id)" />
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
  },
  emits: ["add-cart"]
};
</script>
