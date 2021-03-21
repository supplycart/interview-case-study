<template>
  <div>
    <h3>{{ details.name }}</h3>
    <p>Quantity purchased: {{ details.quantity }}</p>
    <p>Price: {{ details.price }}</p>
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
