import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useOrderStore = defineStore('orders', {
    state: () => ({
        orders: ref({}),
        loading: ref(true),
    }),
    actions: {
        setOrders(val) {
            this.orders = val
        },
        setLoading(val) {
            this.loading = val
        },
    },
})
