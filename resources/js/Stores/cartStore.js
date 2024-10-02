import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
    state: () => ({
        cart: { total_items: 0 },
    }),
    actions: {
        setCart(val) {
            this.cart = val
        },
    },
})
