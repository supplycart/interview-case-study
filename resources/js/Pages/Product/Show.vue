<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    product: Object,
});

function formatPrice(price) {
    return (Math.round(price * 100) / 100).toFixed(2);
}

const selectedVariation = ref(props.product.variations[0]);
const quantity = ref(1);
const addToCart = () => {
    console.log(
        'Product Id is ' +
            props.product.id +
            ' Variation Id is ' +
            selectedVariation.value.id +
            ' Quantity is: ' +
            quantity.value,
    );
};
</script>

<template>
    <Head title="Product Details" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Product Details
            </h2>
        </template>

        <div class="mx-auto max-w-7xl py-12 sm:px-6 lg:px-8">
            <div
                class="flex overflow-hidden bg-white px-4 py-8 shadow-sm sm:rounded-lg"
            >
                <img
                    :src="selectedVariation.image"
                    class="mr-8 aspect-square w-1/3 rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]"
                />
                <div class="flex w-2/3 flex-col justify-center gap-1">
                    <div class="flex-initial text-3xl font-bold">
                        {{ product.name }}
                    </div>
                    <div class="flex-inital text-lg font-semibold">
                        RM {{ formatPrice(selectedVariation.price) }}
                    </div>
                    <div>
                        <p class="text-sm">{{ product.description }}</p>
                    </div>
                    <label
                        class="flex-inital mt-4 text-lg font-normal"
                        for="quantity"
                        >Variation:
                    </label>
                    <select
                        name="variations"
                        id="variations"
                        class="flex-inital rounded-lg border-slate-400"
                        v-model="selectedVariation"
                    >
                        <option
                            v-for="variation in product.variations"
                            :key="variation.id"
                            :value="variation"
                        >
                            {{ variation.name }}
                        </option>
                    </select>
                    <label
                        class="flex-inital mt-4 text-lg font-normal"
                        for="quantity"
                        >Quantity:
                    </label>
                    <input
                        class="flex-inital rounded-lg border-slate-400"
                        type="number"
                        id="quality"
                        name="quantity"
                        min="1"
                        value="1"
                        v-model="quantity"
                    />
                    <button
                        type="submit"
                        @click="addToCart"
                        class="flex-inital rounded-lg bg-blue-600 p-2 text-white hover:bg-blue-800"
                    >
                        Add To Cart
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
