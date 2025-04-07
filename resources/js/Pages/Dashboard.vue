<script setup>
import { ref, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    products: {
        type: Array,
        required: true
    }
});

const selectedCategory = ref("All");
const selectedBrand = ref("All");
const searchQuery = ref("");

const categories = computed(() => [
    "All",
    ...new Set(props.products.map((product) => product.category)),
]);
const brands = computed(() => [
    "All",
    ...new Set(props.products.map((product) => product.brand)),
]);

const filteredProducts = computed(() => {
    return props.products.filter(
        (product) =>
            (selectedCategory.value === "All" ||
                product.category === selectedCategory.value) &&
            (selectedBrand.value === "All" ||
                product.brand === selectedBrand.value) &&
            (searchQuery.value === "" ||
                product.name
                    .toLowerCase()
                    .includes(searchQuery.value.toLowerCase()))
    );
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2
                        class="font-semibold text-xl text-gray-200 leading-tight"
                    >
                        Dashboard
                    </h2>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Product List</h3>
                        <div class="mb-6">
                            <label
                                for="search"
                                class="block text-sm font-medium text-gray-400"
                                >Search</label
                            >
                            <input
                                type="text"
                                id="search"
                                v-model="searchQuery"
                                placeholder="Search products..."
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md bg-gray-700 text-gray-200"
                            />
                        </div>
                        <div class="mb-6 flex space-x-4">
                            <div>
                                <label
                                    for="category"
                                    class="block text-sm font-medium text-gray-400"
                                    >Category</label
                                >
                                <select
                                    id="category"
                                    v-model="selectedCategory"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md bg-gray-700 text-gray-200"
                                >
                                    <option
                                        v-for="category in categories"
                                        :key="category"
                                    >
                                        {{ category }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label
                                    for="brand"
                                    class="block text-sm font-medium text-gray-400"
                                    >Brand</label
                                >
                                <select
                                    id="brand"
                                    v-model="selectedBrand"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md bg-gray-700 text-gray-200"
                                >
                                    <option
                                        v-for="brand in brands"
                                        :key="brand"
                                    >
                                        {{ brand }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
                        >
                            <div
                                v-for="product in filteredProducts"
                                :key="product.id"
                                class="bg-gray-700 rounded-lg overflow-hidden shadow-lg"
                            >
                                <Link
                                    :href="
                                        route('product.details', {
                                            id: product.id,
                                        })
                                    "
                                >
                                    <img
                                        :src="product.image"
                                        :alt="product.name"
                                        class="w-full h-48 object-cover"
                                    />
                                    <div class="p-4">
                                        <h4 class="text-lg font-semibold mb-2">
                                            {{ product.name }}
                                        </h4>
                                        <p class="text-gray-400 mb-2">
                                            {{ product.category }} |
                                            {{ product.brand }}
                                        </p>
                                        <p
                                            class="text-xl font-bold text-indigo-400"
                                        >
                                            ${{ product.price.toFixed(2) }}
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
