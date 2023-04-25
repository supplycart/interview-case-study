<template>
    <Head :title="`Products | ${product.name}`" />

    <component :is="$page.props.auth.user ? AuthenticatedLayout : GuestLayout">
        <div class="bg-white">
        <div class="pt-6">
            <nav aria-label="Breadcrumb">
            <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <li v-for="breadcrumb in breadcrumbs" :key="breadcrumb.id">
                <div class="flex items-center">
                    <a :href="breadcrumb.href" class="mr-2 text-sm font-medium text-gray-900">{{ breadcrumb.name }}</a>
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                    </svg>
                </div>
                </li>
                <li class="text-sm">
                <a :href="product.href" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ product.name }}</a>
                </li>
            </ol>
            </nav>

            <!-- Image gallery -->
            <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
            <div class="aspect-h-4 aspect-w-3 hidden overflow-hidden rounded-lg lg:block">
                <img :src="product.image" :alt="product.name" class="h-full w-full object-cover object-center" />
            </div>
            </div>

            <!-- Category Tags -->
            <div class="mt-6 mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="flex flex-wrap -m-1">
                    <div v-for="category in product.categories" :key="category.id" class="m-1">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            {{ category.name }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Product info -->
            <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ product.name }}</h1>
                </div>

                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl tracking-tight text-gray-900">${{ product.price }}</p>

                    <form class="mt-10" @submit.prevent="addToCart(product)">
                        <!-- Attributes -->
                        <!-- <div v-for="attr in product.attributes" :key="attr.id" class="mt-10">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">{{ attr.name }}</h3>
                            </div>

                            <RadioGroup v-model="selectedAttrs[attr.id]" class="mt-4">
                                <RadioGroupLabel class="sr-only">Choose a {{ attr.name }}</RadioGroupLabel>
                                <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                                <RadioGroupOption as="template" v-for="opt in attr.options" :key="opt.id" :value="opt.id" v-slot="{ active, checked }">
                                    <div :class="['cursor-pointer bg-white text-gray-900 shadow-sm', active ? 'ring-2 ring-indigo-500' : '', 'group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6']">
                                        <RadioGroupLabel as="span">{{ opt.value }}</RadioGroupLabel>
                                        <span :class="[active ? 'border' : 'border-2', checked ? 'border-indigo-500' : 'border-transparent', 'pointer-events-none absolute -inset-px rounded-md']" aria-hidden="true" />
                                    </div>
                                </RadioGroupOption>
                                </div>
                            </RadioGroup>
                        </div> -->
                        <button :disabled="loading" type="submit" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Add to cart
                        </button>
                    </form>
                </div>
                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                    <!-- Description and details -->
                    <div>
                        <h3 class="sr-only">Description</h3>

                        <div class="space-y-6">
                            <p class="text-base text-gray-900">{{ product.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </component>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { router, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import Toast from '@/Components/Toast.js';
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

const breadcrumbs = [
    { name: 'Products', href: route('products.index') }
]

defineProps({
    product: {
        type: Object,
        required: true
    }
})

const loading = ref(false)

function addToCart(product) {
    this.loading = true
    router.post(route('cart.add'), {
        slug: product.slug,
        options: this.selectedAttrs
    }, {
        onError: errors => {
            debugger
            this.loading = false
            Toast.fire({
                text: errors.message,
                icon: 'error',
            })
        },
        onSuccess: page => {
            // Check if user logged in
            if (page.props.ziggy.location === route('login')) {
                return
            }

            setTimeout(() => {
                this.loading = false
                Toast.fire({
                    text: 'Product added to cart!',
                    icon: 'success',
                })
            }, 500)
        }
    })
}

const selectedAttrs = ref([]);

</script>