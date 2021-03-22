<template>
  <div v-for="(details, id, index) in item" :key="index">
    <OrderHistoryProduct :details="details" />
  </div>
  <p class="my-2 font-semibold mb-3">Total: RM{{ total }}</p>
</template>

<script>
import OrderHistoryProduct from "./OrderHistoryProduct";

export default {
  name: "OrderHistoryItem",
  components: {
    OrderHistoryProduct,
  },
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  data() {
    return{
      total: 0
    }
  },
  created() {
    let tmpTotal = 0;
    let product;
    for (product in this.item) {
      tmpTotal += parseInt(this.item[product].quantity) * parseInt(this.item[product].price);
    }
    this.total = tmpTotal;
  },
};
</script>
