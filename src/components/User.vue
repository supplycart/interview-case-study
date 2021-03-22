<template>
  <div class="m-4">
    <router-link
      to="/orderhistory"
      class="mx-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >Order History</router-link
    >
    <router-link
      to="/cart"
      class="mx-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >Cart</router-link
    >
    <button
      class="mx-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1.5 px-4 border border-blue-500 hover:border-transparent rounded"
      @click="logOut"
    >
      Log Out
    </button>
    <h1 class="mx-2 my-2 text-2xl font-bold">List of products:</h1>
    <div class="flex flex-wrap">
      <Products :products="products" :token="token" @add-cart="addCart" />
    </div>
  </div>
</template>

<script>
import Products from "./Products";
import jwt_decode from "jwt-decode";

export default {
  name: "User",
  components: {
    Products,
  },
  props: {
    token: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      products: [],
      cart: {},
    };
  },
  async created() {
    this.products = await this.getProducts();
    this.cart = await this.getCart();
  },
  methods: {
    async getProducts() {
      const res = await fetch("http://localhost:5000/660/products", {
        method: "GET",
        headers: {
          Authorization: "Bearer " + this.token,
        },
      });
      if (res.ok) {
        const data = await res.json();
        return data;
      } else {
        localStorage.removeItem("token");
        window.location.reload();
      }
    },
    async getCart() {
      const userId = jwt_decode(this.token).sub;
      const res = await fetch(`http://localhost:5000/660/carts/${userId}`, {
        method: "GET",
        headers: new Headers({
          Authorization: "Bearer " + this.token,
        }),
      });
      const data = await res.json();
      return data;
    },
    logOut() {
      localStorage.removeItem("token");
      window.location.reload();
    },
    async addCart(id, price) {
      const updatedProducts = [...this.cart.product, id];
      const updatedPrices = [...this.cart.price, price];
      const userId = this.cart.id;

      await fetch(`http://localhost:5000/660/carts/${userId}`, {
        method: "PATCH",
        headers: {
          Authorization: "Bearer " + this.token,
          "Content-type": "application/json",
        },
        body: JSON.stringify({
          product: updatedProducts,
          price: updatedPrices,
        }),
      });

      this.cart = {
        id: userId,
        product: updatedProducts,
        price: updatedPrices,
      };
    },
  },
};
</script>
