import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from '@/utils/axios';

export const useCartStore = defineStore('cart', () => { 
  const cartItems = ref([]);
  const totalPrice = ref(0);  // Track total price from the backend
  const loading = ref(false);
  const error = ref(null);

  // Fetch cart items and total price from the backend
  const fetchCartItems = async (selectedItemIds = []) => {
    try {
      loading.value = true;
      const response = await axios.get('/api/cart', { params: { selected_items: selectedItemIds } });
      cartItems.value = response.data.items; // Set cart items
      totalPrice.value = response.data.total_price; // Set total price from the backend
    } catch (error) {
      console.error('Error fetching cart items:', error);
    } finally {
      loading.value = false;
    }
  };

  // Add a product to the cart
  const addToCart = async (productId, quantity = 1) => {
    try {
      loading.value = true;
      await axios.post('/api/cart', { product_id: productId, quantity });
      await fetchCartItems(); // Refresh cart after adding or updating the quantity
    } catch (error) {
      console.error('Error adding product to cart:', error);
    } finally {
      loading.value = false;
    }
  };
  

  return {
    cartItems,
    totalPrice,  // Use total price from backend
    loading,
    error,
    fetchCartItems,
    addToCart,
  };
});
