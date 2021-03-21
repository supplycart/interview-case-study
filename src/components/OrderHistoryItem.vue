<template>
  <div v-for="(details, id, index) in item" :key="index">
    <OrderHistoryProduct :details="details"/>
  </div>
</template>

<script>
import OrderHistoryProduct from "./OrderHistoryProduct";

export default {
  name: "OrderHistoryItem",
  components: {
    OrderHistoryProduct
  },
  props: {
    item: {
      type: Object,
      required: true
    }
  }
};
</script>