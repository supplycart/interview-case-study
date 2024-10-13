import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from '@/utils/axios';
import { useToast } from 'vue-toastification';

export const useCartStore = defineStore('cart', () => { 
  const cartItems = ref([]);
  const totalPrice = ref(0);
  const loading = ref(false);
  const error = ref(null);
  const toast = useToast();

  const fetchCartItems = async (selectedItemIds = []) => {
    try {
      loading.value = true;
      const response = await axios.get('/api/cart', { params: { selected_items: selectedItemIds } });
      cartItems.value = response.data.items;
      totalPrice.value = response.data.total_price;
    } catch (err) {
      toast.error(err.response?.data?.message || 'Error fetching cart items.');
    } finally {
      loading.value = false;
    }
  };

  const addToCart = async (productId, quantity = 1) => {
    try {
      loading.value = true;
      const response = await axios.post('/api/cart', { product_id: productId, quantity });
  
      const successMessage = response.data?.message || 'Product added to cart successfully!';
      toast.success(successMessage);
    } catch (err) {
      const errorMessage = err.response?.data?.message || 'Error adding product to cart.';
      toast.error(errorMessage);
    } finally {
      loading.value = false;
    }
  };

  const checkout = async (selectedItems) => {
    try {
      const response = await axios.post('/api/orders', { items: selectedItems });
      await fetchCartItems();
      toast.success('Order placed successfully!');
      return response.data;
    } catch (err) {
      toast.error(err.response?.data?.message || 'Failed to place order.');
      throw new Error('Failed to place order.');
    }
  };

  return {
    cartItems,
    totalPrice,
    loading,
    error,
    fetchCartItems,
    addToCart,
    checkout,
  };
});
