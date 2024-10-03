import {defineStore} from "pinia";
import {usePage} from "@inertiajs/vue3";

export const cartCounterStore = defineStore('cartCount', {
    state: () => ({
        count: usePage().props.cartCount
    }),
    actions: {
        increment() {
            this.count++
        },
        decrement() {
            this.count--
        },
        decrementBy(amount) {
            this.count -= amount
        },
        reset() {
            this.count = 0
        }
    }
})
