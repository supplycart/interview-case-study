<script setup>
import { Head, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Tabs from '@/Pages/Good/Tabs.vue'
import '@splidejs/vue-splide/css/sea-green'
import { useFormat } from '@/composables/format'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { toast } from 'vue3-toastify';

const props = defineProps({
    good: Object
})
const { formatMoney } = useFormat()

const store = async () => {
    try {
        await router.post(route('cart.store', props.good.data))
        toast.success('Item added to cart successfully!')
    } catch (error) {
        toast.error('Failed to add item to cart.')
    }
}
</script>

<template>
    <Head :title="good.data.title" />

    <AuthenticatedLayout :title="good.title">
        <section v-if="good" class="bg-gray-100 p-4 text-gray-900 dark:bg-gray-900 dark:text-gray-400 sm:p-6 lg:p-8">
            <div class="overflow-hidden bg-white px-4 shadow-sm dark:bg-gray-800 sm:rounded-lg sm:px-6 lg:px-8">
                <Tabs :good="good.data.id" />

                <div class="container flex flex-wrap overflow-hidden py-4">
                    <div class="flex w-full justify-center md:w-1/2">
                        <img
                            :alt="good.data.title"
                            :title="good.data.title"
                            class="h-auto w-full rounded object-cover object-center"
                            src="https://via.placeholder.com/150"
                        />
                    </div>
                    <div class="mt-4 w-full md:w-1/2 lg:mt-0 lg:py-6 lg:pl-10">
                        <h2 class="title-font text-sm tracking-widest text-gray-500">{{ good.data.brand.name }}</h2>
                        <h1 class="title-font mb-1 text-3xl font-medium text-grey">{{ good.data.title }}</h1>
                        <div class="mb-4 flex">
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="mt-2 flex flex-col">
                                <p v-if="good.data.old_price" class="mt-1 text-sm font-medium text-gray-500 dark:text-gray-300">
                                    <span class="line-through">{{ formatMoney(good.old_price) }}</span>
                                </p>
                                <p
                                    :class="[
                                        good.old_price ? 'text-red-600 dark:text-rose-600' : 'text-gray-900 dark:text-gray-300',
                                        'text-3xl font-medium'
                                    ]"
                                >
                                    {{ formatMoney(good.data.price) }}
                                </p>
                            </div>
                            <primary-button class="self-end" @click.prevent="store">
                                <font-awesome-icon :icon="['fas', 'cart-plus']" class="mr-2" />
                                <span>Add to cart</span>
                            </primary-button>
                        </div>
                        <p class="mt-4 leading-relaxed">{{ good.data.description }}</p>
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>
