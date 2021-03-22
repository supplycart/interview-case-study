<template>
  <div
    class="container mx-auto rounded-2xl p-4 m-2 mb-4 border-2 border-gray-300 hover:border-gray-500"
  >
    <h2 class="font-bold text-xl mb-2">{{ details.name }}</h2>
    <p>Quantity: {{ details.quantity }}</p>
    <p>Price: RM{{ details.price }}</p>
    <button
      class="-mt-10 float-right bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-1.5 px-4 border border-red-500 hover:border-transparent rounded"
      @click="$emit('remove-cart', product)"
    >
      Remove
    </button>
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
  emits: ["remove-cart"],
};
</script>
