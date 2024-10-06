import { ref } from 'vue';
import type { Ref } from 'vue';
import type { Order, CartItem } from '@/utils/types';

export const useOrderStore = () => {
  const orders: Ref<Order[]> = ref([]); 

  const placeOrder = (cart: CartItem[]): void => {
    const newOrder: Order = {
      items: [...cart],
      date: new Date().toISOString(), 
    };
    orders.value.push(newOrder);
  };

  return { orders, placeOrder };
};
