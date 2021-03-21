<template>
  <h1>Order History</h1>
  <div v-for="item in orderHistory.product" :key="item">
      <OrderHistoryItem :item="item"/>
  </div>
</template>

<script>
import jwt_decode from "jwt-decode";
import OrderHistoryItem from "../components/OrderHistoryItem";

export default {
  name: "OrderHistory",
  components: {
    OrderHistoryItem,
  },
  data() {
    return {
      token: localStorage.getItem("token"),
      orderHistory: {}
    };
  },
  async created() {
    if (this.token) {
      this.orderHistory = await this.getOrderHistory();
      console.log(this.orderHistory)
    } else {
      this.$router.push("/");
    }
  },
  methods: {
    async getOrderHistory() {
      const userId = jwt_decode(this.token).sub;
      const res = await fetch(`http://localhost:5000/600/orderHistory/${userId}`, {
        method: "GET",
        headers: new Headers({
          Authorization: "Bearer " + this.token,
        }),
      });
      const data = await res.json();
      if (res.ok) {
        return data;
      } else {
        localStorage.removeItem("token");
        this.$router.push("/");
      }
    },
  }
};
</script>
