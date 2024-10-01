<template>
    <div class="flex items-start justify-start p-4">
        <div>
            <h3 class="mb-3 text-2xl font-medium text-gray-900">
                Categories
            </h3>
            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                <li class="flex items-center" v-for="category in categories">
                    <Checkbox :name="category.name" :checked="selectedCategories.includes(category.name)" @change="setCategory(category.name)"/>
                    <span class="ms-2 text-sm text-gray-600">{{ category.name }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
    import Checkbox from "@/Components/Checkbox.vue";
    import {router} from "@inertiajs/vue3";

    const props = defineProps({
        categories: Object,
        selectedCategories: Array
    });

    function setCategory(categoryName) {
        const searchParams = new URLSearchParams((new URL(window.location.href)).search);
        const paramsStore = {};
        for (let searchParam of searchParams) {
            paramsStore[searchParam[0]] = searchParam[1];
        }

        router.visit(
            route('products.index', {
            ...paramsStore,
            categories: props.selectedCategories.includes(categoryName)
                ? props.selectedCategories.filter(category => category !== categoryName)
                : [...props.selectedCategories, categoryName] })
        )
    }
</script>
