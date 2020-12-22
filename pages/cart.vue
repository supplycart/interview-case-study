<template>
  <div :class="{ dark: isDark }">
    <div class="bg-gray-200 dark:bg-gray-900 pb-2 min-h-screen">
      <NavBar />

      <!-- Heroicon name: refresh -->
      <div v-if="loading">
        <svg
          class="w-16 h-16 animate-spin text-indigo-600 m-auto mt-48"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
          />
        </svg>
      </div>

      <div v-else>
        <div
          v-if="itemLength === 0"
          class="flex justify-center items-center h-screen"
        >
          <div class="flex flex-col text-center dark:text-gray-200">
            <span class="text-lg">Your cart is empty</span>
            <NuxtLink to="/home">
              <button
                class="flex justify-center w-auto md:w-96 px-4 py-3 mt-6 text-white dark:text-black uppercase rounded-lg bg-yellow-500 dark:bg-yellow-600 shadow item-center hover:bg-yellow-600 focus:shadow-outline focus:outline-none"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  class="w-6"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                  />
                </svg>
                <span class="ml-2 mt-5px"> Go Shopping Now </span>
              </button>
            </NuxtLink>
            <div class="h-24"></div>
          </div>
        </div>

        <div v-else class="flex justify-center my-6">
          <div
            class="flex flex-col w-full p-8 text-gray-800 bg-white dark:text-white dark:bg-gray-800 shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5"
          >
            <div class="flex-1">
              <table class="w-full text-sm lg:text-base" cellspacing="0">
                <thead>
                  <tr class="h-12 uppercase">
                    <th class="table-cell"></th>
                    <th class="text-left">Product</th>
                    <th class="lg:text-right text-left pl-5 lg:pl-0">
                      <span class="lg:hidden" title="Quantity">Qtd</span>
                      <span class="hidden lg:inline">Quantity</span>
                    </th>
                    <th class="hidden text-right md:table-cell">
                      Unit price (RM)
                    </th>
                    <th class="text-right">Total price (RM)</th>
                  </tr>
                </thead>

                <tbody>
                  <CartItem
                    v-for="product in productsInCart"
                    :key="product.id"
                    :product="product"
                  />
                </tbody>
              </table>

              <hr class="pb-6 mt-6" />
              <div class="my-4 mt-6 -mx-2 lg:flex">
                <div class="lg:px-2 lg:w-1/2"></div>
                <div class="lg:px-2 lg:w-1/2">
                  <div
                    class="p-4 bg-gray-100 dark:text-white dark:bg-gray-700 rounded-full"
                  >
                    <h1 class="ml-2 font-bold uppercase">Order Details</h1>
                  </div>
                  <div class="p-4">
                    <p class="mb-6 italic">
                      Shipping and additionnal costs are calculated based on
                      values you have entered
                    </p>
                    <div class="flex justify-between pt-4 border-b">
                      <div
                        class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800 dark:text-white"
                      >
                        Total
                      </div>
                      <div
                        class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900 dark:text-white"
                      >
                        {{ "RM " + total.toFixed(2) }}
                      </div>
                    </div>
                    <a href="#">
                      <button
                        class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white dark:text-gray-700 uppercase bg-gray-800 dark:bg-gray-100 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none"
                        @click="placeOrder"
                      >
                        <svg
                          aria-hidden="true"
                          data-prefix="far"
                          data-icon="credit-card"
                          class="w-8"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 576 512"
                        >
                          <path
                            fill="currentColor"
                            d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"
                          />
                        </svg>
                        <span class="ml-2 mt-5px">Place Order</span>
                      </button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CartItem from "@/components/CartItem";

import { getUserFromCookie } from "@/helpers";
import firebase from "firebase/app";
import "firebase/database";
import Cookies from "js-cookie";

export default {
  data: () => ({
    loading: true,
    key: "",
    productsInCart: [
      // {
      //   title: "HDD 2TB",
      //   imgLink:
      //     "https://cdn.shopify.com/s/files/1/1974/9033/products/2_3b4c0257-3347-4f13-92b6-0eda17dd0a40_1024x1024.jpg",
      //   price: 108.0,
      //   wishlist: false,
      //   brand: "Seagate",
      //   category: "storage",
      //   quantity: 1,
      // },
    ],
  }),
  methods: {
    placeOrder() {
      var email = Cookies.get("email");

      console.log("upload cart to order history");
      console.log(JSON.stringify(this.productsInCart));

      firebase
        .database()
        .ref("users/" + email + "/history")
        .push({
          date: Date.now(),
          total: this.total,
          products: this.productsInCart,
        })
        .then((data) => {
          console.log(data.key);
          this.key = data.key;
        });

      this.productsInCart = [];

      firebase
        .database()
        .ref("users/" + email + "/cart")
        .remove();
    },
  },
  computed: {
    isDark() {
      return this.$store.state.darkMode.isDark;
    },
    total: function () {
      if (!this.productsInCart) {
        return 0;
      }

      return this.productsInCart.reduce(function (total, value) {
        return total + Number(value.price) * Number(value.quantity);
      }, 0);
    },
    itemLength: function () {
      return this.productsInCart.length;
    },
  },
  asyncData({ req, redirect }) {
    if (process.server) {
      const user = getUserFromCookie(req);
      console.log(user);
      if (!user) {
        redirect("/login");
      }
    } else {
      let user = firebase.auth().currentUser;
      if (!user) {
        redirect("/login");
      }
    }
  },
  components: {
    CartItem,
  },
  mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start();

      var email = Cookies.get("email");

      console.log("firebase fetch once");

      var i = 0;
      firebase
        .database()
        .ref("users/" + email + "/cart")
        .once("value")
        .then((data) => {
          const cart = [];
          const obj = data.val();
          for (let key in obj) {
            this.productsInCart.push({
              title: obj[key].title,
              imgLink: obj[key].imgLink,
              quantity: obj[key].quantity,
              price: obj[key].price,
              quantity: 1,
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });

      setTimeout(() => {
        this.$nuxt.$loading.finish();
        this.loading = false;
      }, 300);
    });
  },
};
</script>