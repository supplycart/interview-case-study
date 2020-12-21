<template>
  <!-- <NuxtLink to="/product"> -->
    <div
      class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden bg-white dark:bg-gray-800"
    >
      <div
        class="flex items-end justify-end h-40 sm:h-44 w-full bg-cover"
        :style="{ backgroundImage: 'url(' + product.imgLink + ')' }"
      >
        <button
          class="p-2 rounded-full bg-indigo-600 dark:bg-indigo-800 text-white mx-5 -mb-4 hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500"
        >
          <NuxtLink to="/home">
            <!-- Heroicon name: cart -->
            <svg
              class="h-5 w-5"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor"
              @click="sentToFirebase"
            >
              <path
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
              ></path>
            </svg>
          </NuxtLink>
        </button>
      </div>
      <div class="px-5 py-3 flex flex-col justify-between h-24">
        <h3 class="text-gray-700 prod-name dark:text-gray-200">
          {{ product.title }}
        </h3>

        <div class="flex justify-between">
          <span class="text-gray-500 dark:text-gray-400"
            >RM{{ product.price.toFixed(2) }}</span
          >

          <NuxtLink to="/home">
            <div class="flex justify-end">
              <!-- Heroicon name: heart -->
              <svg
                class="h-5 w-5 dark:text-gray-200"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                v-show="!product.wishlist"
                @click="product.wishlist = !product.wishlist"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                />
              </svg>
              <!-- Heroicon name: heart -->
              <svg
                class="h-5 w-5 text-pink-500"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                v-show="product.wishlist"
                @click="product.wishlist = !product.wishlist"
              >
                <path
                  fill-rule="evenodd"
                  d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                  clip-rule="evenodd"
                />
              </svg>
            </div>
          </NuxtLink>
        </div>
      </div>
    </div>
  <!-- </NuxtLink> -->
</template>


<script>
import firebase from "firebase/app";
import "firebase/database";
import Cookies from "js-cookie";

export default {
  data: () => ({
    key: "",
  }),
  props: ["product"],
  methods: {
    sentToFirebase() {
      console.log("sending stuff to firebase");
      console.log(JSON.stringify(this.$props.product));

      console.log(Cookies.get("email"));
      var email = Cookies.get("email");

      var reff = firebase
        .database()
        .ref("users/" + email + "/cart/" + this.$props.product.id);

      reff
        .set({
          title: this.$props.product.title,
          price: this.$props.product.price,
          imgLink: this.$props.product.imgLink,
          quantity: 1,
        })
        .then((data) => {
          console.log(data);
        });

      // ref
      //   .child("users")
      //   .orderByChild("ID")
      //   .equalTo("U1EL5623")
      //   .once("value", (snapshot) => {
      //     if (snapshot.exists()) {
      //       const userData = snapshot.val();
      //       console.log("exists!", userData);
      //     }
      //   });
    },
  },
};
</script>

<style>
.prod-name {
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2; /* number of lines to show */
  -webkit-box-orient: vertical;
}
</style>