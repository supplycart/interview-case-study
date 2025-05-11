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

      <!-- Category Filter (using slug) -->
      <div>
        <label for="category_slug" class="block text-sm font-medium text-gray-700">Category</label>
        <select id="category_slug" v-model="localFilters.category_slug" @change="applyFilters"
          class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          <option value="">All Categories</option>
          <option v-for="cat in availableFilterOptions.categories" :key="cat.slug" :value="cat.slug">
            {{ cat.name }}
          </option>
        </select>
      </div>

      <!-- Brand Filter (using slug) -->
      <div>
        <label for="brand_slug" class="block text-sm font-medium text-gray-700">Brand</label>
        <select id="brand_slug" v-model="localFilters.brand_slug" @change="applyFilters"
          class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
          <option value="">All Brands</option>
          <option v-for="brand in availableFilterOptions.brands" :key="brand.slug" :value="brand.slug">
            {{ brand.name }}
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

      <div class="lg:col-start-4 flex items-end"> <!-- Position clear button -->
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
import { debounce } from 'lodash-es';

export default {
  name: 'ProductFilter',
  data() {
    return {
      localFilters: {
        search: '',
        // Use slugs locally
        category_slug: '',
        brand_slug: '',
        // Attribute value IDs as an array
        attribute_value_ids: [],
        sort_by: 'created_at',
        sort_direction: 'desc',
      }
    };
  },
  computed: {
    ...mapState(useProductStore, ['currentFilters', 'availableFilterOptions']), // Renamed availableAttributes
  },
  watch: {
    currentFilters: {
      handler(newFilters) {
        // Sync localFilters from store, including attribute_value_ids
        this.localFilters = { ...newFilters };
      },
      deep: true,
      immediate: true,
    }
  },
  methods: {
    ...mapActions(useProductStore, ['setFilter', 'clearFilters', 'toggleAttributeValue', 'fetchFilterOptions']), // Added toggleAttributeValue, renamed fetchFilterOptions
    applyFilters() {
      // Apply all filters *EXCEPT* attribute_value_ids
      // Attribute value toggles are handled directly by toggleAttributeValue action
      this.setFilter('search', this.localFilters.search);
      this.setFilter('category_slug', this.localFilters.category_slug);
      this.setFilter('brand_slug', this.localFilters.brand_slug);
      this.setFilter('sort_by', this.localFilters.sort_by);
      this.setFilter('sort_direction', this.localFilters.sort_direction);
      // setFilter action already triggers fetchProducts
    },
    // Debounced version for search input
    debouncedApplyFilters: debounce(function (event) {
      this.applyFilters();
    }, 500),

    resetAllFilters() {
      this.clearFilters(); // This action in store should reset filters and fetch
      // Local filters will be updated by the watcher
    }
  },
  created() {
    // Initialize localFilters from store's currentFilters on creation
    // This ensures that if the page is revisited and filters are in the store, they are reflected.
    this.localFilters = { ...this.currentFilters };

    // Fetch filter options if not already available
    if (!this.availableFilterOptions.categories.length && !this.availableFilterOptions.brands.length && !this.availableFilterOptions.attributes.length) {
      this.fetchFilterOptions();
    }
  }
};
</script>

<style scoped>
/* Add any necessary styling here */
</style>