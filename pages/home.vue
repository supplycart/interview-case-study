<template>
  <div :class="{ dark: isDark }">
    <div class="bg-gray-200 dark:bg-gray-900 pb-2 min-h-screen">
      <NavBar :isDark="isDark" />

      <main>
        <!-- <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8"> -->
        <div>
          <div
            class="mx-auto md:w-full container px-4 md:px-12 pt-6 md:flex md:flex-row"
          >
            <!-- search bar -->
            <div class="text-gray-600 md:w-1/2 md:pr-2 w-full mb-2">
              <div class="relative">
                <input
                  class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none dark:text-white dark:bg-gray-800"
                  type="search"
                  placeholder="Search"
                  v-model="search"
                />
                <button class="absolute right-0 top-0 my-3 mr-4">
                  <svg
                    class="text-gray-600 h-4 w-4 fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    version="1.1"
                    id="Capa_1"
                    x="0px"
                    y="0px"
                    viewBox="0 0 56.966 56.966"
                    style="enable-background: new 0 0 56.966 56.966"
                    xml:space="preserve"
                    width="512px"
                    height="512px"
                  >
                    <path
                      d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"
                    />
                  </svg>
                </button>
              </div>
            </div>
            <!-- search bar -->
            <div class="flex flex-row md:w-1/2 mb-2">
              <DropdownBrand :brand="brand" />
              <DropdownCategory :category="category" />
            </div>
          </div>

          <div class="container mb-8 mx-auto px-4 md:px-12">
            <div class="flex flex-wrap -mx-1 lg:-mx-4"></div>
            <div
              class="grid gap-3 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-6"
            >
              <ProductItem
                v-for="product in filteredList"
                :key="product.id"
                :product="product"
              />
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import NavBar from "@/components/NavBar";
import ProductItem from "@/components/ProductItem";
import DropdownBrand from "@/components/DropdownBrand";
import DropdownCategory from "@/components/DropdownCategory";

import { getUserFromCookie } from "@/helpers";
import firebase from "firebase/app";
import "firebase/auth";
import Cookies from "js-cookie";

export default {
  data: () => ({
    products: [
      // {
      //   title: "HDD 2TB",
      //   imgLink:
      //     "https://cdn.shopify.com/s/files/1/1974/9033/products/2_3b4c0257-3347-4f13-92b6-0eda17dd0a40_1024x1024.jpg",
      //   price: 108.0,
      //   brand: "Seagate",
      //   category: "storage",
      // },
    ],
    search: "",
    brand: "",
    category: "",
  }),
  components: {
    NavBar,
    DropdownBrand,
  },
  computed: {
    isDark() {
      return this.$store.state.darkMode.isDark;
    },
    filteredList() {
      return this.products.filter((prod) => {
        if (
          prod.title.toLowerCase().includes(this.search.toLowerCase()) &&
          prod.brand.toLowerCase().includes(this.brand.toLowerCase()) &&
          prod.category.toLowerCase().includes(this.category.toLowerCase())
        ) {
          return true;
        }
        return false;
      });
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
  mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start();

      console.log("firebase fetch once");

      firebase
        .database()
        .ref("products")
        .once("value")
        .then((data) => {
          const obj = data.val();
          for (let key in obj) {
            this.products.push({
              id: key,
              title: obj[key].title,
              imgLink: obj[key].imgLink,
              price: obj[key].price,
              category: obj[key].category,
              brand: obj[key].brand,
              wishlist: false,
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

<style>
</style>
