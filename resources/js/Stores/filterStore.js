import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useFilterStore = defineStore('filter', {
    state: () => ({
        selectedBrand: ref('all'),
        selectedCategory: ref('all'),
    }),
    actions: {
        setSelectedBrand(val) {
            this.selectedBrand = val
        },
        setSelectedCategory(val) {
            this.selectedCategory = val
        },
    },
})
