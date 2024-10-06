import {defineStore} from "pinia";
import {usePage} from "@inertiajs/vue3";

export const cartCounterStore = defineStore('cartCount', {
    state: () => ({
        count: parseInt(usePage().props.cartCount ?? 0)
    }),
    actions: {
        increment() {
            this.count++
        },
        decrement() {
            this.count--
        },
        incrementBy(amount) {
            this.count += parseInt(amount)
        },
        decrementBy(amount) {
            this.count -= parseInt(amount)
        },
        reset() {
            this.count = 0
        }
    }
})
