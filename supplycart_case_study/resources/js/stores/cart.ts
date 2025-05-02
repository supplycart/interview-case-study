import { defineStore } from 'pinia'
import axios from 'axios'

interface CartItem {
  product_id: number
  quantity: number
  product?: {
    name: string
    price: number
    image_url: string
  }
}

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [] as CartItem[],
    pendingUpdates: new Set<number>(), 
  }),

  actions: {
    add(product_id: number, quantity = 1) {
      const existing = this.items.find(i => i.product_id === product_id);
      if (existing) {
        existing.quantity += quantity;
      } else {
        this.items.push({ product_id, quantity });
      }

      axios.post('/carts', { product_id, qty: quantity }).catch(() => {});
    },
    remove(product_id: number) {
      this.items = this.items.filter(i => i.product_id !== product_id)
      axios.delete(`/carts/${product_id}`).catch(() => {});
    },
    clear() {
        this.items.forEach(item => {
            axios.delete(`/carts/${item.product_id}`).catch(() => {})
        });
        this.items = [];
    },
    totalItems() {
        if (!Array.isArray(this.items)) return 0
        return this.items.reduce((sum, i) => sum + i.quantity, 0)
    },
    async loadFromBackend() {
        try {
          const { data } = await axios.get('/carts/show')
      
          // ✅ Ensure data is an array
          if (Array.isArray(data)) {
            this.items = data.map(item => ({
              product_id: item.product_id,
              quantity: item.quantity,
              product: item.product, // includes name, price, image_url
            }))
          } else {
            this.items = []
            console.warn('[Cart] Invalid response format')
          }
        } catch (error) {
          console.error('[Cart] Failed to load from backend', error)
          this.items = []
        }
      },
    async syncToBackend() {
        if (!this.items.length) {
          console.log('[Cart] Nothing to sync.')
          return
        }
      
        await axios.post('/carts/sync', {
          items: this.items.map(i => ({
            product_id: i.product_id,
            quantity: i.quantity,
          })),
        })
      }
  },

  persist: true,
})
