<template>
    <div class="bg-white rounded-lg flex items-start justify-start p-4">
        <div>
            <h3 class="mb-3 text-2xl font-medium text-gray-900">
                {{
                    filterName
                        .toLowerCase()
                        .replace(/\b[a-z]/g, (letter) => letter.toUpperCase())
                }}
            </h3>
            <TextInput
                class="mt-1 block w-full"
                placeholder="Search products"
                v-model="search"
                v-if="filterType === 'text'"
                @change="setFilter(search)"
            />
            <ul v-else class="space-y-2 text-sm">
                <li class="flex items-center" v-for="item in items">
                    <Checkbox :name="item.name" :checked="selectedItems.includes(item.name)" @change="setFilter(item.name)"/>
                    <span class="ms-2 text-sm text-gray-600">{{ item.name }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
    import Checkbox from "@/Components/Checkbox.vue";
    import {router} from "@inertiajs/vue3";
    import {ref} from "vue";
    import TextInput from "@/Components/TextInput.vue";

    const props = defineProps({
        search: String,
        items: Object,
        selectedItems: Array,
        filterName: String,
        filterType: String
    });

    const search = ref(props.search);

    function setFilter(name) {
        const searchParams = new URLSearchParams((new URL(window.location.href)).search);
        const paramsStore = {};
        for (let searchParam of searchParams) {
            paramsStore[searchParam[0]] = searchParam[1];
        }

        if (props.filterType === 'text') {
            paramsStore[props.filterName] = name;
        } else {
            paramsStore[props.filterName] = props.selectedItems.includes(name)
                ? props.selectedItems.filter(category => category !== name)
                : [...props.selectedItems, name];
        }

        router.visit(
            route('products.index', {
            ...paramsStore
            })
        )
    }
</script>
