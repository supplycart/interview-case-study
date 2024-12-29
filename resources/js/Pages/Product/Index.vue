<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    products: Object,
});

function isArrayNullOrEmpty(arr) {
    return arr === null || arr === undefined || arr.length === 0;
}

function formatPrice(price) {
    return (Math.round(price * 100) / 100).toFixed(2);
}
</script>

<template>
    <Head title="Product Listing" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white p-4 shadow-sm sm:rounded-lg"
                >
                    <h2 class="sr-only">Products</h2>

                    <div
                        class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
                    >
                        <a
                            v-for="product in products.data"
                            :key="product.id"
                            :href="route('products.show', product.id)"
                            class="group"
                        >
                            <img
                                :src="
                                    !isArrayNullOrEmpty(product.variations)
                                        ? product.variations[0].image
                                        : null
                                "
                                class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]"
                            />
                            <h3 class="mt-4 text-sm text-gray-700">
                                {{ product.name }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                {{
                                    !isArrayNullOrEmpty(product.variations)
                                        ? product.variations[0].name
                                        : null
                                }}
                            </p>
                            <p class="mt-1 text-lg font-medium text-gray-900">
                                RM
                                {{
                                    !isArrayNullOrEmpty(product.variations)
                                        ? formatPrice(
                                              product.variations[0].price,
                                          )
                                        : null
                                }}
                            </p>
                        </a>
                    </div>

                    <div class="my-4 flex justify-center gap-8">
                        <Link
                            v-for="link in products.links"
                            :key="link.label"
                            :href="link.url"
                            v-html="link.label"
                            :class="{
                                'text-slate-300': !link.url,
                                'font-medium text-blue-500': link.active,
                            }"
                        >
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
