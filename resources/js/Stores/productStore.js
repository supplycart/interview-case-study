import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useProductsStore = defineStore('products', {
    state: () => ({
        products: ref([]),
        quantities: ref([]),
        brands: ref([]),
        categories: ref([]),
        loading: ref(true),
    }),
    actions: {
        setProducts(val) {
            this.products = val
        },
        setQuantities(val) {
            this.quantities = val
        },
        setBrands(val) {
            this.brands = val
        },
        setCategories(val) {
            this.categories = val
        },
        setLoading(val) {
            this.loading = val
        },
    },
})
