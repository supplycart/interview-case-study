<template>
  <div>
    <div class="ml-16 filter h-16 flex">
        <button
          @click="fetchProducts"
          class="m-2 bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded-full"
        >
          Reset Filter
        </button>
      <template v-for="(brand, index) in brands" >
        <button
          @click="filterByBrand(brand.id)"
          class="m-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded-full"
        >
          {{brand.name}}
        </button>
      </template>
      <template v-for="(category, index) in categories" >
        <button
          @click="filterByCategory(category.id)"
          class="m-2 bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-4 border border-yellow-500 hover:border-transparent rounded-full"
        >
          {{category.name}}
        </button>
      </template>
    </div>
    <template v-for="(product, index) in products">
      <the-list v-on:productRequireReloading="productRefetch" :product_id="product.id" :name="product.name" :unit_price="product.unit_price" :stock_count="product.stock_count" :brand="product.brand.name"></the-list>
    </template>
  </div>
</template>

<script>
import Axios from 'axios'
export default {
  props: {
    isRegistrationCallback: {
      type:Boolean,
      default: false
    }
  },
  created() {
    if (this.isRegistrationCallback === true) {
      console.log('hereee')
      this.$router.go()
    }
    this.fetchProducts();
    this.fetchBrands();
    this.fetchCategories();
  },

  data() {
    return {
      brands: [],
      categories: [],
      products: []
    }
  },

  methods: {
    async fetchProducts() {
      const {data} = await Axios.get('/api/products', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('currentUser')}`,
          'Accept': 'application/json'
        }
      })
      this.products = data.data
    },

    async fetchBrands() {
      const {data} = await Axios.get('/api/brands', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('currentUser')}`,
          'Accept': 'application/json'
        }
      })
      this.brands = data
    },

    async fetchCategories() {
      const {data} = await Axios.get('/api/categories', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('currentUser')}`,
          'Accept': 'application/json'
        }
      })
      this.categories = data
    },

    async filterByBrand(target) {
      const {data} = await Axios.get(`/api/products?brand=${target}`, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('currentUser')}`,
          'Accept': 'application/json'
        }
      })
      this.products = data.data
    },

    async filterByCategory(target) {
      const {data} = await Axios.get(`/api/products?category=${target}`, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('currentUser')}`,
          'Accept': 'application/json'
        }
      })
      this.products = data.data
    },

    productRefetch() {
      this.fetchProducts()
    }
  }
}
</script>