<template>
  <div v-if="Object.keys(cartView).length" class="m-4 container mx-auto">
    <div class="flex justify-between mx-2 mb-3">
      <h1 class="text-2xl font-bold mb-2">Cart</h1>
      <router-link
        to="/"
        class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1.5 px-4 border border-blue-500 hover:border-transparent rounded-full"
      >
        &lt; Back
      </router-link>
    </div>
    <div v-for="(details, id, index) in cartView" :key="index">
      <CartItem :product="id" :details="details" @remove-cart="removeCart" />
    </div>
    <p class="mb-2 ml-4 font-semibold text-lg">Total: RM{{ total }}</p>
    <button
      class="-mt-10 mr-2 float-right bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full"
      @click="order"
    >
      Place Order
    </button>
  </div>
  <div v-else class="m-4">
    <h1 class="mx-2 my-2 text-2xl font-bold mb-5">Your Cart is empty</h1>
    <router-link
      to="/"
      class="mx-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >Add items now</router-link
    >
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
      total: 0,
    };
  },
  watch: {
    cart() {
      if (Object.keys(this.cart).length) {
        console.log(this.cart);
        const tmp_products = {};
        let tmpTotal = 0;
        let productId;
        let productName;
        for (let i = 0; i < this.cart.product.length; i++) {
          tmpTotal += parseInt(this.cart.price[i]);
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
        this.total = tmpTotal;
        this.cartView = tmp_products;
      } else {
        this.cartView = {};
      }
    },
  },
  async created() {
    if (this.token) {
      this.products = await this.getProducts();
      this.cart = await this.getCart();
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
