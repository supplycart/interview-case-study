<template>
    <div class="product-filters bg-gray-50 p-4 rounded-md shadow">
      <h3 class="text-lg font-semibold mb-3 text-gray-700">Filter Products</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Search -->
        <div>
          <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
          <input type="text" id="search" v-model="localFilters.search" @input="debouncedApplyFilters"
                 class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                 placeholder="Product name or description...">
        </div>
  
        <!-- Category Filter -->
        <div>
          <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
          <select id="category" v-model="localFilters.category" @change="applyFilters"
                  class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option value="">All Categories</option>
            <option v-for="cat in availableAttributes.categories" :key="cat.value" :value="cat.value">
              {{ cat.text }}
            </option>
          </select>
        </div>
  
        <!-- Brand Filter -->
        <div>
          <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
          <select id="brand" v-model="localFilters.brand" @change="applyFilters"
                  class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option value="">All Brands</option>
             <option v-for="brand in availableAttributes.brands" :key="brand.value" :value="brand.value">
              {{ brand.text }}
            </option>
          </select>
        </div>
  
        <!-- Sort By -->
        <div>
            <label for="sort_by" class="block text-sm font-medium text-gray-700">Sort By</label>
            <select id="sort_by" v-model="localFilters.sort_by" @change="applyFilters"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="created_at">Date Added</option>
                <option value="price_in_cents">Price</option>
                <option value="name">Name</option>
            </select>
        </div>
        <div>
            <label for="sort_direction" class="block text-sm font-medium text-gray-700">Order</label>
            <select id="sort_direction" v-model="localFilters.sort_direction" @change="applyFilters"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="desc">Descending</option>
                <option value="asc">Ascending</option>
            </select>
        </div>
  
        <div class="md:col-span-1 lg:col-span-1 flex items-end">
          <button @click="resetAllFilters"
                  class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
            Clear Filters
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { mapActions, mapState } from 'pinia';
  import { useProductStore } from '@/stores/productStore';
  import { debounce } from 'lodash-es'; // npm install lodash-es
  
  export default {
    name: 'ProductFilter',
    data() {
      return {
        localFilters: { // Local copy to avoid direct mutation of store state during input
          search: '',
          category: '',
          brand: '',
          sort_by: 'created_at',
          sort_direction: 'desc',
        }
      };
    },
    computed: {
      ...mapState(useProductStore, ['currentFilters', 'availableAttributes']),
    },
    watch: {
      currentFilters: { // Sync localFilters if storeFilters change externally
          handler(newFilters) {
              this.localFilters = { ...newFilters };
          },
          deep: true,
          immediate: true, // Sync on component creation
      }
    },
    methods: {
      ...mapActions(useProductStore, ['setFilter', 'clearFilters', 'fetchAttributeOptions']),
      applyFilters() {
        // Apply all filters from local state to the store
        for (const key in this.localFilters) {
          this.setFilter(key, this.localFilters[key]);
        }
        // Note: setFilter already triggers fetchProducts in the store.
        // If you want to batch updates, modify setFilter or create a new action.
      },
      debouncedApplyFilters: debounce(function() {
          this.applyFilters();
      }, 500), // 500ms debounce for search input
  
      resetAllFilters() {
          this.clearFilters(); // This action in store should reset filters and fetch
          // Local filters will be updated by the watcher
      }
    },
    created() {
      // If attribute options are not already loaded by parent
      if (!this.availableAttributes.categories.length && !this.availableAttributes.brands.length) {
           this.fetchAttributeOptions();
      }
      // Initialize localFilters from store's currentFilters
       this.localFilters = { ...this.currentFilters };
    }
  };
  </script>
  