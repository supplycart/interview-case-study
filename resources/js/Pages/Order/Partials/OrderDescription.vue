<template>
    <div class="mt-6 sm:col-span-7 sm:mt-0 md:row-end-1">
        <h3 class="text-lg font-medium text-gray-900">
            <a :href="route('products.show', product.id)">{{ product.name }}</a>
        </h3>
        <p class="mt-1 font-medium text-gray-900">{{ product.price }}</p>
        <p class="mt-3 text-gray-500">{{ product.description }}</p>
    </div>
    <div class="sm:col-span-12 md:col-span-7">
        <dl class="grid grid-cols-1 gap-y-8 border-b border-gray-200 py-8 sm:grid-cols-3 sm:gap-x-6 sm:py-6 md:py-10">
            <div>
                <dt class="font-medium text-gray-900">Quantity</dt>
                <dd class="mt-3 text-gray-500">
                    <span class="block">{{ product.quantity }}</span>
                </dd>
            </div>
            <div>
                <dt class="font-medium text-gray-900">Original Price (Discount)</dt>
                <dd class="mt-3 space-y-3 text-gray-500">
                    <p>{{ product.currency }} {{ product.original_price }} ({{ product.currency }}  {{ product.discount }})</p>
                </dd>
            </div>
            <div>
                <dt class="font-medium text-gray-900">Total Price</dt>
                <dd class="mt-3 space-y-3 text-gray-500">
                    <p>{{ product.currency }} {{ product.total_price }}</p>
                </dd>
            </div>
        </dl>
    </div>
</template>

<script setup>
defineProps({
    product: Object
});
</script>
