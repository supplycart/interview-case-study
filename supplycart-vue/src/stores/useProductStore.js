import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from '@/utils/axios';
import { useToast } from 'vue-toastification';

export const useProductsStore = defineStore('products', () => {
  const products = ref([]);
  const brands = ref([]);
  const categories = ref([]);
  const loading = ref(false);
  const error = ref(null);
  const toast = useToast();

  const fetchProducts = async () => {
    loading.value = true;
    error.value = null;
    try {
      const response = await axios.get('/api/products');
      products.value = response.data.products;
      brands.value = response.data.brands; 
      categories.value = response.data.categories;
    } catch (err) {
      error.value = 'Error fetching products.';
      toast.error(err.response?.data?.message || 'Error fetching products.');
    } finally {
      loading.value = false;
    }
  };

  return {
    products,
    brands, 
    categories,
    loading,
    error,
    fetchProducts,
  };
});
