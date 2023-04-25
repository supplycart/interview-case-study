<template>
    <Head title="My Cart" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Cart</h2>
        </template>
        <div class="mt-5 mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-3/4">
                    <div class="w-full mt-6 px-6 py-4 mb-10">
                        <form>
                            <div class="space-y-12">
                                <div class="border-b border-gray-900/10 pb-12">
                                    <h2 class="text-base font-semibold leading-7 text-gray-900">Billing Information</h2>

                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        <div class="sm:col-span-3">
                                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                            <div class="mt-2">
                                            <input v-model="formData.billing_name" type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                                            </div>
                                        </div>

                                        <div class="sm:col-span-4">
                                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                            <div class="mt-2">
                                            <input v-model="formData.billing_email" id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                            </div>
                                        </div>

                                        <div class="col-span-full">
                                            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Street address</label>
                                            <div class="mt-2">
                                                <input v-model="formData.billing_address" type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                            </div>
                                        </div>

                                        <div class="sm:col-span-2 sm:col-start-1">
                                            <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                                            <div class="mt-2">
                                                <input v-model="formData.billing_city" type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                            </div>
                                        </div>

                                        <div class="sm:col-span-2">
                                            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                                            <div class="mt-2">
                                                <input  v-model="formData.billing_country" type="text" name="country" id="country" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                            </div>
                                        </div>

                                        <div class="sm:col-span-2">
                                            <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal code</label>
                                            <div class="mt-2">
                                            <input v-model ="formData.billing_postalcode" type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="md:w-1/4">
                    <div class="bg-white shadow-md overflow-hidden sm:rounded-lg">
                        <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">

                            <div class="mt-8">
                                <div class="flow-root">
                                    <p v-if="items.length <= 0" class="text-center text-sm text-gray-500 mb-3">No item in cart</p>
                                    <ul role="list" class="-my-6 divide-y divide-gray-200">
                                        <li v-for="item in items" :key="item.id" class="flex py-6">
                                            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                <img :src="item.product.image" :alt="item.product.name" class="h-full w-full object-cover object-center" />
                                            </div>

                                            <div class="ml-4 flex flex-1 flex-col">
                                                <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3>
                                                    <a :href="item.product.href">{{ item.product.name }}</a>
                                                    </h3>
                                                    <p class="ml-4">${{ item.product.price }}</p>
                                                </div>
                                                <p class="mt-1 text-sm text-gray-500">{{ item.color }}</p>
                                                </div>
                                                <div class="flex flex-1 items-end justify-between text-sm">
                                                <p class="text-gray-500">Qty {{ item.quantity }}</p>

                                                <div class="flex">
                                                    <button :disabled="loading" type="button" @click="removeFromCart(item.product)" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                                </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Subtotal</p>
                                <p>${{ total }}</p>
                            </div>
                            <div class="mt-6">
                                <button @click="checkout()" type="button" :disabled="items.length <= 0 || loading" class="mx-auto flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-20 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</button>
                            </div>
                            <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                <p>
                                or
                                <Link :href="route('products.index')" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    Continue Shopping
                                    <span aria-hidden="true"> &rarr;</span>
                                </Link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { reactive, ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import Toast from '@/Components/Toast.js';
import Swal from 'sweetalert2';

defineProps({
    cart: {
        type: Object,
        required: true
    },
    items: {
        type: Array,
        required: true
    }
})

const page = usePage()

const total = computed(() => {
    return page.props.items.reduce((total, item) => {
        return total + (item.price * item.quantity)
    }, 0)
})

const loading = ref(false)

const sameAsBilling = ref(false)

const formData = reactive({
    billing_name: '',
    billing_address: '',
    billing_city: '',
    billing_region: '',
    billing_postalcode: '',
    billing_country: '',
    billing_phone: '',
    billing_email: '',

    /** Shipping */
    shipping_name: '',
    shipping_address: '',
    shipping_city: '',
    shipping_country: '',
    shipping_postalcode: '',
    shipping_country: '',
    shipping_phone: '',
    shipping_email: '',
})

function removeFromCart(product) {
    this.loading = true
    router.post(route('cart.remove'), {
        slug: product.slug
    }, {
        onSuccess: page => {
            // Check if user logged in
            if (page.props.ziggy.location === route('login')) {
                return
            }
            setTimeout(() => {
                this.loading = false
                Toast.fire({
                    text: 'Product removed to cart!',
                    icon: 'success',
                })
            }, 500)
        }
    })
}

function checkout() {
    this.loading = true

    router.post(route('cart.checkout'), {
        ...this.formData
    }, {
        onError: (errors) => {
            Swal.fire({
                text: 'Checkout failed!',
                icon: 'error',
                html: Object.keys(errors).map(key => `<li>${errors[key]}</li>`).join('')
            })
        },
        onSuccess: page => {
            // Check if user logged in
            if (page.props.ziggy.location === route('login')) {
                return
            }
            Toast.fire({
                text: 'Checkout success!',
                icon: 'success',
            })
        },
        onFinish: () => {
            setTimeout(() => {
                this.loading = false
            }, 500)
        }
    })
}
</script>