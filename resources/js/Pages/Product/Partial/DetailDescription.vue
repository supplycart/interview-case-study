<template>
    <div class="w-full md:w-1/2 px-4">
        <h2 class="text-3xl font-bold mb-2">{{ product.name }}</h2>
        <div class="mb-4">
            <span class="text-2xl font-bold mr-2">{{ product.currency }} {{ product.price }}</span>
        </div>
        <p class="text-gray-700 mb-6">{{ product.description }}</p>

        <ProductAttribute :brand="brand" :categories="categories"></ProductAttribute>

        <div class="mb-6">
            <InputLabel for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</InputLabel>
            <TextInput v-model="quantity" type="number" min="1" @change="updateQuantity" />
        </div>

        <div class="flex space-x-4 mb-6">
            <AddToCart :product-id="product.id" :quantity="quantity"></AddToCart>
        </div>
    </div>
</template>
<script setup>
import AddToCart from "@/Components/Cart/AddToCart.vue";
import {computed, ref} from "vue";
import ProductAttribute from "@/Pages/Product/Partial/ProductAttribute.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    product: Object
})

const categories = computed(() => {
    return props.product.categories;
});

const brand = computed(() => {
    return props.product.brand;
});

const quantity = ref(1);

function updateQuantity(event) {
    quantity.value = event.target.value;
}
</script>
