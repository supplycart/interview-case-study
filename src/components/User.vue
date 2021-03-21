<template>
  <button @click="logOut">Log Out</button>
  <button>Cart</button>
  <h1>List of products:</h1>
  <Products :products="products" :token="token" @add-cart="addCart" />
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
      const userId = this.cart.id

      const res = await fetch(`http://localhost:5000/660/carts/${userId}`, {
        method: "PATCH",
        headers: {
          "Authorization": "Bearer " + this.token,
          "Content-type": "application/json",
        },
        body: JSON.stringify({
          "product": updatedProducts,
          "price": updatedPrices
        }),
      });

      this.cart = {
        "id": userId,
        "product": updatedProducts,
        "price": updatedPrices
      }

      const data = await res.json();
      console.log(data);
      console.log(this.cart);
    },
  },
};
</script>
