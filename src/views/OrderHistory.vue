<template>
  <div v-if="show" class="m-4 container mx-auto">
    <div class="flex justify-between mx-2 mb-1">
      <h1 class="text-2xl font-bold mb-2">Order History</h1>
      <router-link
        to="/"
        class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1.5 px-4 border border-blue-500 hover:border-transparent rounded-full"
      >
        &lt; Back
      </router-link>
    </div>
    <div class="flex flex-col-reverse">
      <div
        v-for="item in orderHistory.product"
        :key="item"
        class="container mx-auto rounded-2xl p-4 pb-1 m-2 border-2 border-gray-300 hover:border-gray-500"
      >
        <OrderHistoryItem :item="item" />
      </div>
    </div>
  </div>
  <div v-else class="m-4">
    <h1 class="mx-2 my-2 text-2xl font-bold mb-5">
      Your Order History is empty
    </h1>
    <router-link
      to="/"
      class="mx-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >Add items now</router-link
    >
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
      orderHistory: {},
      show: false,
    };
  },
  async created() {
    if (this.token) {
      this.orderHistory = await this.getOrderHistory();
      if (this.orderHistory.product.length) {
        this.show = true;
      }
    } else {
      this.$router.push("/");
    }
  },
  methods: {
    async getOrderHistory() {
      const userId = jwt_decode(this.token).sub;
      const res = await fetch(
        `http://localhost:5000/600/orderHistory/${userId}`,
        {
          method: "GET",
          headers: new Headers({
            Authorization: "Bearer " + this.token,
          }),
        }
      );
      const data = await res.json();
      if (res.ok) {
        return data;
      } else {
        localStorage.removeItem("token");
        this.$router.push("/");
      }
    },
  },
};
</script>
