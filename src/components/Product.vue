<template>
  <div
    class="flex flex-col max-w-sm rounded-2xl p-5 w-productBox h-productBox m-2 border-2 border-gray-300 hover:border-gray-500"
  >
    <h2 class="font-bold text-xl mb-2">{{ product.name }}</h2>
    <p class="text-gray-700 text-base my-1 flex-grow overflow-auto mb-2">
      {{ product.description }}
    </p>
    <p class="text-base font-semibold text-gray-700 mb-2">
      Price: RM{{ product.price }}
    </p>
    <button
      class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1.5 px-4 rounded-full"
      @click="$emit('add-cart', product.id, product.price)"
    >
      Add to cart
    </button>
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
    },
  },
  emits: ["add-cart"],
};
</script>
