import { defineStore } from 'pinia'

export const useOrderStore = defineStore('orders', {
    state: () => ({
        orders: [],
    }),
    actions: {
        setOrders(val) {
            this.orders = val
        },
    },
})
