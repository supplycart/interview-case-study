import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import axios from '@/utils/axios';
import { defineStore } from 'pinia'; 

export const useCartStore = defineStore('cart', () => { 
  const cartItems = ref([]);
  const totalPrice = ref(0);  
  const loading = ref(false);
  const error = ref(null);
  const authStore = useAuthStore();
  const router = useRouter();

  const isAuthenticated = computed(() => authStore.isLoggedIn);

  // Fetch cart items and total price from the backend
  const fetchCartItems = async () => {
    try {
      loading.value = true;
      const response = await axios.get('/api/cart');
      cartItems.value = response.data.items; // Set cart items
      totalPrice.value = response.data.total_price; // Set total price directly from backend
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
      const response = await axios.post('/api/cart', { product_id: productId, quantity });
      await fetchCartItems(); // Refresh cart after adding
      return response.data;
    } catch (err) {
      error.value = 'Error adding product to cart.';
      throw err;
    } finally {
      loading.value = false;
    }
  };

  // Remove a product from the cart
  const removeFromCart = async (productId) => {
    try {
      await axios.delete(`/api/cart/${productId}`);
      await fetchCartItems(); // Refresh cart after removal
    } catch (error) {
      console.error('Error removing item from cart:', error);
    }
  };

  // Ensure user is authenticated
  const checkAuthentication = () => {
    if (!isAuthenticated.value) {
      router.push({ name: 'login' });
    } else {
      fetchCartItems();
    }
  };

  return {
    cartItems,
    totalPrice, // We now return the total price directly from the backend
    loading,
    error,
    addToCart,
    removeFromCart,
    fetchCartItems,
    checkAuthentication,
    isAuthenticated,
  };
});
