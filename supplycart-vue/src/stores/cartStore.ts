import { ref } from 'vue';
import type { Ref } from 'vue';
import type { CartItem, Product } from '@/utils/types';

export const useCartStore = () => {
  const cart: Ref<CartItem[]> = ref([]); // Ref for an array of CartItem

  const addProductToCart = (product: Product): void => {
    cart.value.push(product);
  };

  const clearCart = (): void => {
    cart.value = [];
  };

  return { cart, addProductToCart, clearCart };
};
