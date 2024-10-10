import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import axios from '@/utils/axios';
import { defineStore } from 'pinia'; // Make sure to import defineStore

export const useCartStore = defineStore('cart', () => { // Export as useCartStore
  const cartItems = ref([]);
  const loading = ref(false);
  const error = ref(null);
  const authStore = useAuthStore();
  const router = useRouter();

  const isAuthenticated = computed(() => authStore.isLoggedIn);

  // Fetch cart items from the backend
  const fetchCartItems = async () => {
    try {
      loading.value = true;
      const response = await axios.get('/api/cart');
      cartItems.value = response.data.items;
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

  // Calculate total price
  const totalCartPrice = computed(() => {
    return cartItems.value.reduce((total, item) => total + item.product.price * item.quantity, 0);
  });

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
    loading,
    error,
    addToCart,
    removeFromCart,
    totalCartPrice,
    checkAuthentication,
    isAuthenticated,
  };
});
