import { defineStore } from 'pinia';
import apiClient from '@/services/api';

export const useProductStore = defineStore('product', {
  state: () => ({
    products: [],
    pagination: {},
    isLoading: false,
    error: null,
    filters: {
        search: '',
        // Use slugs as expected by the backend
        category_slug: '',
        brand_slug: '',
        // Dynamic attribute filtering will be managed differently
        // For now, we'll store selected attribute value IDs directly
        attribute_value_ids: [], // Array of selected attribute value IDs
        sort_by: 'created_at',
        sort_direction: 'desc',
    },
    availableFilters: { // Stores options for all filter types fetched from API
        categories: [],
        brands: [],
        attributes: [], // Array of attribute objects, each with an array of values
    }
  }),
  getters: {
    productList: (state) => state.products,
    productPagination: (state) => state.pagination,
    isProductLoading: (state) => state.isLoading,
    currentFilters: (state) => state.filters,
    // Expose available filter options
    availableFilterOptions: (state) => state.availableFilters,
  },
  actions: {
    async fetchProducts(page = 1) {
      this.isLoading = true;
      this.error = null;
      try {
        const params = {
            page,
            // Ensure filter params match backend names
            search: this.filters.search || undefined, // Use undefined to omit empty params
            category_slug: this.filters.category_slug || undefined,
            brand_slug: this.filters.brand_slug || undefined,
            // Send attribute_value_ids as an array if not empty
            attribute_value_ids: this.filters.attribute_value_ids.length > 0 ? this.filters.attribute_value_ids : undefined,
            sort_by: this.filters.sort_by,
            sort_direction: this.filters.sort_direction,
        };

        // Remove undefined values
         Object.keys(params).forEach(key => params[key] === undefined && delete params[key]);


        const response = await apiClient.get('/products', { params });
        this.products = response.data.data;
        this.pagination = {
            currentPage: response.data.meta.current_page,
            totalPages: response.data.meta.last_page,
            totalItems: response.data.meta.total,
            perPage: response.data.meta.per_page,
        };
      } catch (err) {
        console.error('Error fetching products:', err);
        this.error = err.response?.data?.message || 'Failed to fetch products.';
        this.products = [];
        this.pagination = {};
      } finally {
        this.isLoading = false;
      }
    },
    setFilter(filterName, value) {
        // Handle setting specific filters like search, category, brand, sort
        if (['search', 'category_slug', 'brand_slug', 'sort_by', 'sort_direction'].includes(filterName)) {
            this.filters[filterName] = value;
        }
        // Attribute filtering is handled by toggleAttributeValue
        // Trigger refetch after setting filter
        this.fetchProducts(1); // Refetch products with new filter, reset to page 1
    },
    // New action to handle toggling attribute value selection
    toggleAttributeValue(attributeValueId) {
        const index = this.filters.attribute_value_ids.indexOf(attributeValueId);
        if (index === -1) {
            // Add value if not present
            this.filters.attribute_value_ids.push(attributeValueId);
        } else {
            // Remove value if present
            this.filters.attribute_value_ids.splice(index, 1);
        }
        this.fetchProducts(1); // Refetch after changing attribute filters
    },
    clearFilters() {
        // Keep sort default, clear others
        this.filters = {
            search: '',
            category_slug: '',
            brand_slug: '',
            attribute_value_ids: [],
            sort_by: this.filters.sort_by || 'created_at', // Keep current sort preference
            sort_direction: this.filters.sort_direction || 'desc',
        };
        this.fetchProducts(1); // Refetch
    },
    // Action to fetch filter options (categories, brands, attributes)
    async fetchFilterOptions() {
        // Use separate endpoints if available, or a single endpoint that returns all options
        try {
             const response = await apiClient.get('/product-filter-options');
             this.availableFilters.categories = response.data.categories;
             this.availableFilters.brands = response.data.brands;
             this.availableFilters.attributes = response.data.attributes; // This structure is important
        } catch (err) {
            console.error('Failed to fetch filter options:', err);
            // Optionally set an error dedicated to filter options
        }
    }
  }
});