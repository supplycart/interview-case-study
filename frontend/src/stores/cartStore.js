import { defineStore } from 'pinia';
import apiClient from '@/services/api';
import { useToast } from 'vue-toastification'; // Example for notifications

const toast = useToast();

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: JSON.parse(localStorage.getItem('cartItems')) || [], // { product, quantity }
    isLoading: false,
    error: null,
  }),
  getters: {
    cartItems: (state) => state.items,
    itemCount: (state) => state.items.reduce((count, item) => count + item.quantity, 0),
    totalPriceInCents: (state) => {
      return state.items.reduce((total, item) => {
        return total + (item.product.price_in_cents * item.quantity);
      }, 0);
    },
    formattedTotalPrice: (state, getters) => {
      return '$' + (getters.totalPriceInCents / 100).toFixed(2);
    },
    isCartLoading: (state) => state.isLoading,
  },
  actions: {
    _saveCartToLocalStorage() {
        localStorage.setItem('cartItems', JSON.stringify(this.items));
    },
    addItem(product, quantity = 1) {
      const existingItem = this.items.find(item => item.product.id === product.id);
      if (existingItem) {
        if (existingItem.quantity + quantity <= product.stock_quantity) {
            existingItem.quantity += quantity;
            toast.success(`${product.name} quantity updated in cart!`);
        } else {
            toast.error(`Cannot add more ${product.name}. Max stock reached.`);
            return; // Do not add if exceeding stock
        }
      } else {
        if (quantity <= product.stock_quantity) {
            this.items.push({ product, quantity });
            toast.success(`${product.name} added to cart!`);
        } else {
            toast.error(`Not enough stock for ${product.name}. Available: ${product.stock_quantity}`);
            return;
        }
      }
      this._saveCartToLocalStorage();
    },
    removeItem(productId) {
      this.items = this.items.filter(item => item.product.id !== productId);
      this._saveCartToLocalStorage();
      toast.info(`Item removed from cart.`);
    },
    updateQuantity(productId, quantity) {
      const item = this.items.find(item => item.product.id === productId);
      if (item) {
        if (quantity > 0 && quantity <= item.product.stock_quantity) {
          item.quantity = quantity;
          this._saveCartToLocalStorage();
          toast.info(`Quantity updated for ${item.product.name}.`);
        } else if (quantity <= 0) {
          this.removeItem(productId);
        } else {
            toast.error(`Not enough stock for ${item.product.name}. Available: ${item.product.stock_quantity}`);
        }
      }
    },
    async placeOrder() {
      if (this.items.length === 0) {
        toast.error("Your cart is empty.");
        return null;
      }
      this.isLoading = true;
      this.error = null;
      const orderPayload = {
        items: this.items.map(item => ({
          product_id: item.product.id,
          quantity: item.quantity,
        })),
      };
      try {
        const response = await apiClient.post('/orders', orderPayload);
        this.clearCart(); // Clear cart on successful order
        toast.success("Order placed successfully!");
        return response.data.data; // The order object
      } catch (err) {
        this.error = err.response?.data?.message || 'Failed to place order.';
        toast.error(this.error);
        throw err; // Re-throw to be caught by component
      } finally {
        this.isLoading = false;
      }
    },
    clearCart() {
      this.items = [];
      this._saveCartToLocalStorage();
      // toast.info("Cart cleared."); // Optional: notify if cleared explicitly vs after order
    },
  }
});
