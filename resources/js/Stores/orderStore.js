import { defineStore } from 'pinia'

export const useOrderStore = defineStore('orders', {
    state: () => ({
        orders: [],
    }),
    actions: {
        setOrders(newOrders) {
            this.orders = newOrders
        },
    },
})
