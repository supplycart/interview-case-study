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
                placeholder="Search product name"
                v-model="search"
                v-if="filterType === 'text'"
                @change="setFilter($event)"
            />
            <ul v-else class="space-y-2 text-sm">
                <li class="flex items-center" v-for="item in items">
                    <Checkbox :value="item.id" v-model:checked="selectedItems" @change="setFilter"></Checkbox>
                    <span class="ms-2 text-sm text-gray-600">{{ item.name }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import {router} from "@inertiajs/vue3";
import {ref} from "vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps({
        items: [Object, String, null],
        selectedItems: Array,
        filterName: String,
        filterType: String
    });

    const search = ref(props.items);
    const selectedItems = ref(props.selectedItems);

    function setFilter(event) {
        const searchParams = new URLSearchParams((new URL(window.location.href)).search);
        const paramsStore = {};

        for (let searchParam of searchParams) {
            paramsStore[searchParam[0]] = searchParam[1];
        }

        paramsStore[props.filterName] = props.filterType === 'text'
            ? event.target.value
            : selectedItems.value.filter(item => item !== '').join(',');

        router.visit(
            route('products.index', {
            ...paramsStore
            }),
            {
                preserveScroll: true,
                preserveState: true,
                only: ['products']
            }
        )
    }
</script>
