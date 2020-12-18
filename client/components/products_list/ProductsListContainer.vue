<template>
  <div id="productItems" class="columns is-centered is-multiline">
    <div class="card column is-one-quarter" v-for="product in products" :key="product.id">
      <VmProducts :product="product"></VmProducts>
    </div>
    <div class="section" v-if="products.length === 0">
      <p>{{ noProductLabel }}</p>
    </div>
  </div>
</template>

<script>
import VmProducts from '../Products';
import { getByTitle } from '@/assets/filters';

export default {
  name: 'productsList',
  components: { VmProducts },
  data () {
    return {
      id: '',
      noProductLabel: 'No product found',
      productsFiltered: [],
      products: []
    };
  },

  created() {
    this.$store.commit('setLoading', true)
    this.getProducts()
    this.$store.commit('setLoading', false)
  },

  methods: {
    getProductByTitle () {
      let listOfProducts = this.$store.state.products,
          titleSearched = this.$store.state.userInfo.productTitleSearched;
      return this.productsFiltered = getByTitle(listOfProducts, titleSearched);
    },
    async getProducts () {
      if (this.$store.state.userInfo.hasSearched) {
        return this.getProductByTitle();
      } else {
        await this.$store.dispatch('getProducts')
        this.products = this.$store.state.products;
      }
    }
  }

};
</script>

<style lang="scss" scoped>
  .card {
    margin: 10px;
  }
  #productItems {
    margin-bottom: 35px;
  }
</style>
