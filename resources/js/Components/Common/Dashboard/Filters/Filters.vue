<script setup>
import BrandsFilter from './BrandsFilter.vue'
import CategoryFilter from './CategoryFilter.vue'

// Define Props
const props = defineProps({
    brands: Array,
    categories: Array,
})

const { brands, categories } = props
</script>

<template>
    <div class="flex flex-row gap-4">
        <BrandsFilter :brands="brands" />
        <CategoryFilter :categories="categories" />
    </div>
</template>
