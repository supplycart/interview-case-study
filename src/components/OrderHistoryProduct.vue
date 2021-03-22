<template>
  <div class="mb-3">
    <h2 class="font-bold text-xl">{{ details.name }}</h2>
    <p>Quantity purchased: {{ details.quantity }}</p>
    <p>Price: RM{{ details.price }}</p>
  </div>
</template>

<script>
export default {
  name: "OrderHistoryItem",
  props: {
    details: {
      type: Object,
      required: true,
    },
  },
};
</script>
