<template>
  <button @click="logOut">
    Log Out
  </button>
  <button>
    Cart
  </button>
  <h1>List of products:</h1>
  <Products :products="products" @add-cart="addCart" />
</template>

<script>
import Products from "./Products";

export default {
  name: "User",
  components: {
    Products,
  },
  props: {
    token: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      products: [],
    };
  },
  async created() {
    this.products = await this.getProducts();
  },
  methods: {
    async getProducts() {
      const res = await fetch("http://localhost:5000/660/products", {
        method: "GET",
        headers: new Headers({
          Authorization: "Bearer " + this.token,
        }),
      });
      if (res.ok) {
        const data = await res.json();
        return data;
      } else {
        localStorage.removeItem("token");
        window.location.reload();
      }
    },
    logOut() {
      localStorage.removeItem("token");
      window.location.reload();
    },
  },
};
</script>
