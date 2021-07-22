<template>
  <TopBar />
  <h1 class="ml-5 mt-5 text-2xl">Welcome back, User</h1>
  <div class="flex ">
    <div class="flex-none w-16 h-16 mx-9 mt-5"></div>

    <div class="border-2 flex-grow bg-gray-100 mx-9 my-5">
      <div class="text-3xl text-center my-3">Products</div>
      <Products :products = "products"/>
    </div>

    <div class="flex-none w-16 h-16 mx-9 mt-5"></div>
  </div>
</template>

<script>
import TopBar from './TopBar.vue'
import Products from './Products.vue'

export default {
    name: 'Main',
    components: {
        TopBar, Products
    },
  data() {
    return {
      products: [],
      signIn: true
    }
  },
  created() {
    this.products = [
      {
        id: 1,
        name: "Chair",
        price: 39,
        img: "https://www.ikea.com/my/en/images/products/adde-chair-white__0728280_pe736170_s5.jpg",
        desc: "With stackable chairs you'll always have a way to seat all your guests. And you can easily keep many chairs on hand, since several chairs stacked on top of one another don't take more room than a single chair. Stacking things and building vertically saves floor space. Practical in both small homes and large ones."
      },
      {
        id: 2,
        name: "Table",
        price: 59,
        img: "https://www.ikea.com/my/en/images/products/linnmon-adils-table-white__0737165_pe740925_s5.jpg",
        desc:"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
      },
      {
        id: 3,
        name: "Another chair",
        price: 138,
        img: "https://www.ikea.com/my/en/images/products/renberget-swivel-chair-bomstad-black__0724701_pe734583_s5.jpg?f=s",
        desc: "Another lorem ipsum"
      },
      {
        id: 4,
        name: "Lamp",
        price: 69,
        img: "https://www.ikea.com/my/en/images/products/lersta-floor-reading-lamp-aluminium__0606034_pe681992_s5.jpg?f=s",
        desc: "Standing lamp"
      }

    ]
      
    }
}
</script>

<style>

</style>