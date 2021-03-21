<template>
  <div v-if="Object.keys(cartView).length">
    <div v-for="(details, id, index) in cartView" :key="index">
      <CartItem :product="id" :details="details" @remove-cart="removeCart" />
    </div>
    <button @click="order">Place Order</button>
  </div>
  <div v-else>
    <p>Your Cart is empty</p>
    <router-link to="/">Add items now</router-link>
  </div>
</template>

<script>
import jwt_decode from "jwt-decode";
import CartItem from "../components/CartItem";

export default {
  name: "Cart",
  components: {
    CartItem,
  },
  data() {
    return {
      token: localStorage.getItem("token"),
      cart: {},
      products: {},
      cartView: {},
    };
  },
  watch: {
    cart() {
      if (Object.keys(this.cart).length) {
        const tmp_products = {};
        let productId;
        let productName;
        for (let i = 0; i < this.cart.product.length; i++) {
          productId = this.cart.product[i];
          if (productId in tmp_products) {
            tmp_products[productId].quantity++;
          } else {
            for (let j = 0; j < this.products.length; j++) {
              if (this.products[j].id == productId) {
                productName = this.products[j].name;
              }
            }
            tmp_products[productId] = {
              name: productName,
              quantity: 1,
              price: this.cart.price[i],
            };
          }
        }
        this.cartView = tmp_products;
      } else {
        this.cartView = {};
      }
    },
  },
  async created() {
    if (this.token) {
      this.cart = await this.getCart();
      this.product = await this.getProducts();
    } else {
      this.$router.push("/");
    }
  },
  methods: {
    async getCart() {
      const userId = jwt_decode(this.token).sub;
      const res = await fetch(`http://localhost:5000/600/carts/${userId}`, {
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
    async getProducts() {
      const res = await fetch("http://localhost:5000/660/products", {
        method: "GET",
        headers: {
          Authorization: "Bearer " + this.token,
        },
      });
      const data = await res.json();
      return data;
    },
    async removeCart(id) {
      const removeIndex = this.cart.product.indexOf(id);
      const updatedProducts = [...this.cart.product];
      const updatedPrices = [...this.cart.price];
      updatedProducts.splice(removeIndex, 1);
      updatedPrices.splice(removeIndex, 1);
      const userId = this.cart.id;

      const res = await fetch(`http://localhost:5000/600/carts/${userId}`, {
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
    async order() {
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
      const orderHistory = await res.json();
      orderHistory.product.push(JSON.parse(JSON.stringify(this.cartView)));
      await fetch(`http://localhost:5000/600/orderHistory/${userId}`, {
        method: "PATCH",
        headers: {
          Authorization: "Bearer " + this.token,
          "Content-type": "application/json",
        },
        body: JSON.stringify({
          product: orderHistory.product,
        }),
      });
      await fetch(`http://localhost:5000/660/carts/${userId}`, {
        method: "PATCH",
        headers: {
          Authorization: "Bearer " + this.token,
          "Content-type": "application/json",
        },
        body: JSON.stringify({
          product: [],
          price: [],
        }),
      });
      this.cart = {};
    },
  },
};
</script>
