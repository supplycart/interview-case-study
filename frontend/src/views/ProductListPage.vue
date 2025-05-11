<template>
    <div class="product-list-page">
      <h1 class="text-3xl font-bold mb-6 text-gray-800">Our Products</h1>
  
      <!-- Bonus: Product Filters -->
      <ProductFilter v-if="showFilters" class="mb-8 p-4 bg-white shadow rounded-lg" />
  
      <div v-if="isProductLoading" class="text-center py-10">
        <p class="text-xl text-gray-600">Loading products...</p>
        <!-- Add a spinner or loading animation component here -->
      </div>
      <div v-else-if="productError" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ productError }}</span>
      </div>
      <div v-else-if="productList.length === 0" class="text-center py-10">
        <p class="text-xl text-gray-500">No products found. Try adjusting your filters!</p>
      </div>
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <ProductCard v-for="product in productList" :key="product.id" :product="product" />
      </div>
  
      <!-- Pagination -->
      <div v-if="productPagination && productPagination.totalPages > 1" class="mt-8 flex justify-center items-center space-x-2">
        <button
          @click="changePage(productPagination.currentPage - 1)"
          :disabled="productPagination.currentPage === 1"
          class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
        >
          Previous
        </button>
        <span class="text-gray-700">
          Page {{ productPagination.currentPage }} of {{ productPagination.totalPages }}
        </span>
        <button
          @click="changePage(productPagination.currentPage + 1)"
          :disabled="productPagination.currentPage === productPagination.totalPages"
          class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
        >
          Next
        </button>
      </div>
    </div>
  </template>
  
  <script>
  import { mapState, mapActions } from 'pinia';
  import { useProductStore } from '@/stores/productStore';
  import ProductCard from '@/components/Products/ProductCard.vue';
  import ProductFilter from '@/components/Products/ProductFilter.vue'; // Bonus
  
  export default {
    name: 'ProductListPage',
    components: {
      ProductCard,
      ProductFilter, // Bonus
    },
    data() {
      return {
        showFilters: true, // Can be toggled
      };
    },
    computed: {
      ...mapState(useProductStore, ['productList', 'isProductLoading', 'productError', 'productPagination']),
    },
    methods: {
      ...mapActions(useProductStore, ['fetchProducts', 'fetchAttributeOptions']), // fetchAttributeOptions for bonus
      changePage(page) {
        if (page > 0 && page <= this.productPagination.totalPages) {
          this.fetchProducts(page);
        }
      }
    },
    created() {
      this.fetchProducts(); // Fetch initial products
      this.fetchAttributeOptions(); // Bonus: Fetch filter options
    }
  };
  </script>
  