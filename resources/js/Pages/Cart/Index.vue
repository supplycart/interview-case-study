<script setup>
import { onMounted, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, usePage, useForm, router } from '@inertiajs/vue3';
import { loadStripe } from '@stripe/stripe-js';

const props = defineProps({
    carts: {
        type: Array,
    },
    total: {
        type: String,
    },
});

const url = usePage().props.s3.url;
const stripe = ref(null);
const elements = ref(null);
const form = useForm({
    amount: (props.total == 0) ? props.total : parseFloat((parseFloat(props.total.replace(/,/g, '')) * 100).toFixed(2)),
    method: '',
    cart: (props.carts) ? props.carts[0].cart_id : '',
});

onMounted(async () => {
    stripe.value = await loadStripe(usePage().props.stripe.key);
    elements.value = stripe.value.elements();

    const cardElement = elements.value.create('card');
    cardElement.mount('#card-element');
});

const handleSubmit = async () => {
    const { error, paymentMethod } = await stripe.value.createPaymentMethod({
        type: 'card',
        card: elements.value.getElement('card'),
    });

    if (error) {
        console.log(error);
    } else {
        form.method = paymentMethod.id;
        form.post(route('stripe.pay'), {
            preserveScroll: true,
        });
    }
};

const handleDelete = (id) => {
    router.visit(route('cartitems.destroy', id), { method: 'delete' });
}
</script>

<template>
    <Head title="Cart" />

    <AuthenticatedLayout>
        <div class="flex items-end lg:flex-row flex-col justify-end" id="cart">
            <div class="w-full lg:px-8 lg:py-14 md:px-6 px-4 md:py-8 py-4 light:bg-white overflow-y-auto overflow-x-hidden">
                <div v-for="(cart, index) in carts" :key="index" class="md:flex items-strech py-8 md:py-10 lg:py-8 border-t border-gray-50">
                    <div class="md:w-4/12 2xl:w-1/4 w-full">
                        <img :src="url+cart.product.image" alt="Black Leather Bag" width="200" class="h-full object-center object-cover md:block hidden" />
                        <img :src="url+cart.product.image" alt="Black Leather Bag" class="md:hidden w-full h-full object-center object-cover" />
                    </div>
                    <div class="md:pl-3 md:w-8/12 2xl:w-3/4 flex flex-col justify-center">
                        <div class="flex items-center justify-between w-full pt-1">
                            <p class="text-base font-black leading-none text-gray-800 dark:text-white">{{ cart.product.name }}</p>
                        </div>
                        <p class="text-xs leading-3 text-gray-600 dark:text-white py-4">Quantity: {{ cart.quantity }}</p>
                        <div class="flex items-center justify-between pt-5">
                            <p class="text-base font-black leading-none text-gray-800 dark:text-white">${{ cart.product.price }}</p>
                            <p class="text-xs leading-3 underline text-red-500 pl-5 cursor-pointer" @click="handleDelete(cart.id)">Remove</p>
                        </div>
                    </div>
                </div>

                <hr class="w-full bg-gray-200 my-6" />

                <div class="flex justify-end items-center">
                    <form @submit.prevent="handleSubmit" class="lg:w-1/3 w-full bg-gray-50 p-5 my-5">
                        <div class="my-4">
                            <p class="cursor-pointer hover:underline duration-100 font-normal text-base leading-4 text-gray-600 mr-5">Total: ${{ total }}</p>
                            <InputError class="mt-2" :message="form.errors.amount" />
                        </div>
                        <div class="my-4">
                            <label for="card-element">Credit or debit card:</label>
                            <div id="card-element"></div>
                            <InputError class="mt-2" :message="form.errors.method" />
                            <InputError class="mt-2" :message="form.errors.cart" />
                        </div>
                        <button class="text-base leading-none w-1/4 py-5 bg-gray-700 border-gray-700 hover:bg-gray-500 hover:border-gray-500 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700 text-white" type="submit">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
