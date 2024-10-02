import { defineStore } from 'pinia'

export const useProductsStore = defineStore('products', {
    state: () => ({
        products: [],
        quantities: [],
        brands: [],
        categories: [],
        loading: true,
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
