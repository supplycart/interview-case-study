<template>
  <div :class="{ dark: isDark }">
    <div class="bg-gray-200 dark:bg-gray-900 min-h-screen pb-1">
      <NavBar />

      <!-- component -->
      <!-- This is an example component -->
      <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-center">
          <div class="w-full lg:w-6/12 px-4">
            <h2 class="text-4xl font-semibold mt-4 text-black dark:text-white">
              Order History
            </h2>
          </div>
        </div>
        <div class="flex flex-col-reverse justify-center md:w-1/2 mx-auto my-8">
          <OrderHistoryItem
            v-for="order in orderHistory"
            :key="order.id"
            :order="order"
          />
          <div
            class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 xl:grid-cols-6 gap-4"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import OrderHistoryItem from "@/components/OrderHistoryItem";

import { getUserFromCookie } from "@/helpers";
import firebase from "firebase/app";
import "firebase/database";
import Cookies from "js-cookie";

export default {
  data: () => ({
    orderHistory: [
      // {
      //   date: "2020-12-08",
      //   total: 2408.0,
      //   products: [
      //     {
      //       title: "PS5 PlayStation 5",
      //       imgLink:
      //         "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-LKeg-nUxA-HzxwFtOFKm1GjRrmLRWuo0DQ&usqp=CAU",
      //       price: 2299.0,
      //       wishlist: false,
      //       brand: "Sony",
      //       category: "console",
      //     },
      //   ],
      // },
    ],
  }),
  computed: {
    isDark() {
      return this.$store.state.darkMode.isDark;
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
  },
  components: {
    OrderHistoryItem,
  },
  mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start();

      var email = Cookies.get("email");

      console.log("firebase fetch once");

      var i = 0;
      firebase
        .database()
        .ref("users/" + email + "/history")
        .once("value")
        .then((data) => {
          const obj = data.val();
          console.log(obj);

          for (let key in obj) {
            this.orderHistory.push({
              date: obj[key].date,
              total: obj[key].total,
              products: obj[key].products,
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });

      setTimeout(() => this.$nuxt.$loading.finish(), 500);
    });
  },
};
</script>