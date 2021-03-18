<template>
  <input type="button" value="Log Out" @click="logOut" />
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
          Authorization : "Bearer "+this.token
        }),
      });
      const data = await res.json();
      console.log(data)
      return data;
    },
    logOut() {
      localStorage.removeItem("token");
      window.location.reload();
    },
  },
};
</script>
