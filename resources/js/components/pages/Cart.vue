<template>
  <div>
    <div class="ml-16 mt-4 filter h-16 flex">
      <h3 class="text-3xl font-semibold">Cart</h3>
      <!-- <button
        class="m-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded-full"
      >
        Nestle
      </button> -->
    </div>
    <template v-for="(cart, index) in carts">
      <the-list :isCart="true" :product_id="cart.product.id" :name="cart.product.name" :unit_price="cart.product.unit_price" :stock_count="cart.product.stock_count" :brand="cart.product.brand.name"></the-list>
    </template>
    <div class="ml-16 filter h-16 flex">
      <h3 class="text-3xl font-semibold">History</h3>
      <!-- <button
        class="m-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded-full"
      >
        Nestle
      </button> -->
    </div>
    <template v-for="(item, index) in histories">
      <the-list :history="true" :product_id="item.product.id" :name="item.product.name" :unit_price="item.product.unit_price" :stock_count="item.product.stock_count" :brand="item.product.brand.name"></the-list>
    </template>
  </div>
</template>

<script>
import Axios from 'axios'
export default {
  created() {
    this.fetchCart()
    this.fetchHistory()
  },

  data() {
    return {
      carts: [],
      histories: []
    }
  },

  methods: {
    async fetchCart() {
      const {data} = await Axios.get('/api/orders?status=1', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('currentUser')}`,
          'Accept': 'application/json'
        }
      })

      this.carts = data.data
    },

    async fetchHistory() {
      const {data} = await Axios.get('/api/orders?status=2', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('currentUser')}`,
          'Accept': 'application/json'
        }
      })

      this.histories = data.data
    }
  }
}
</script>