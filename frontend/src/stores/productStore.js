import { defineStore } from 'pinia';
import apiClient from '@/services/api';

export const useProductStore = defineStore('product', {
  state: () => ({
    products: [],
    pagination: {}, // For total pages, current page etc.
    isLoading: false,
    error: null,
    filters: { // Bonus: For product filtering
        category: '',
        brand: '',
        search: '',
        sort_by: 'created_at',
        sort_direction: 'desc',
        // Add more filterable attributes here
    },
    // Bonus: For attribute dropdowns
    availableAttributes: {
        categories: [], // e.g., [{value: 'electronics', text: 'Electronics'}]
        brands: [],
    }
  }),
  getters: {
    productList: (state) => state.products,
    productPagination: (state) => state.pagination,
    isProductLoading: (state) => state.isLoading,
    currentFilters: (state) => state.filters,
  },
  actions: {
    async fetchProducts(page = 1) {
      this.isLoading = true;
      this.error = null;
      try {
        const params = { page, ...this.filters };
        // Remove empty filter values before sending
        Object.keys(params).forEach(key => {
            if (params[key] === '' || params[key] === null) {
                delete params[key];
            }
        });

        const response = await apiClient.get('/products', { params });
        this.products = response.data.data;
        this.pagination = {
            currentPage: response.data.meta.current_page,
            totalPages: response.data.meta.last_page,
            totalItems: response.data.meta.total,
            perPage: response.data.meta.per_page,
        };
      } catch (err) {
        this.error = err.response?.data?.message || 'Failed to fetch products.';
        this.products = []; // Clear products on error
        this.pagination = {};
      } finally {
        this.isLoading = false;
      }
    },
    setFilter(filterName, value) {
        if (this.filters.hasOwnProperty(filterName)) {
            this.filters[filterName] = value;
            this.fetchProducts(1); // Refetch products with new filter, reset to page 1
        }
    },
    clearFilters() {
        this.filters = {
            category: '',
            brand: '',
            search: '',
            sort_by: 'created_at',
            sort_direction: 'desc',
        };
        this.fetchProducts(1); // Refetch
    },
    // Bonus: Action to fetch filter options (categories, brands)
    // This would typically hit separate API endpoints or be derived from product data
    async fetchAttributeOptions() {
        // Example:
        // const categoriesResponse = await apiClient.get('/attributes/categories');
        // this.availableAttributes.categories = categoriesResponse.data;
        // const brandsResponse = await apiClient.get('/attributes/brands');
        // this.availableAttributes.brands = brandsResponse.data;
        // For now, using placeholders if API is not ready for this
        this.availableAttributes.categories = [
            { value: 'electronics', text: 'Electronics' }, { value: 'books', text: 'Books' }, { value: 'clothing', text: 'Clothing' }
        ];
        this.availableAttributes.brands = [
            { value: 'apple', text: 'Apple' }, { value: 'samsung', text: 'Samsung' }, { value: 'randomhouse', text: 'Random House' }
        ];
    }
  }
});
