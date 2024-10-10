import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import axios from '@/utils/axios';

export const useCart = () => {
  const cartItems = ref([]);
  const authStore = useAuthStore();
  const router = useRouter();

  const isAuthenticated = computed(() => authStore.isLoggedIn);

  const fetchCartItems = async () => {
    try {
      const response = await axios.get('/api/cart');
      cartItems.value = response.data.items;
    } catch (error) {
      console.error('Error fetching cart items:', error);
    }
  };

  const removeFromCart = async (productId) => {
    try {
      await axios.delete(`/api/cart/${productId}`);
      await fetchCartItems(); // Refresh cart after removing an item
    } catch (error) {
      console.error('Error removing item from cart:', error);
    }
  };

  const totalCartPrice = computed(() => {
    return cartItems.value.reduce((total, item) => total + item.product.price * item.quantity, 0);
  });

  const checkAuthentication = () => {
    if (!isAuthenticated.value) {
      router.push({ name: 'login' });
    } else {
      fetchCartItems();
    }
  };

  return {
    cartItems,
    fetchCartItems,
    removeFromCart,
    totalCartPrice,
    checkAuthentication,
    isAuthenticated,
  };
};
