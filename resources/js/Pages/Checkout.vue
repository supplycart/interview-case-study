<template>

    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Checkout
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <breeze-validation-errors class="mb-4" />
                    <form @submit.prevent="submit">
                        <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1 lg:grid-cols-2 gap-4 leading-loose">
                            <div class="">
                                <ShippingInfo
                                    :form="form"
                                ></ShippingInfo>
                            </div>
                            <div class="">
                                <div class="col-span-1 lg:col-span-4 order-first lg:order-last">
                                    <OrderSummary
                                        :actionRoute="actionRoute"
                                        :actionText="actionText"
                                        :isCheckout="isCheckout"
                                        :subtotal="subtotal"
                                    >
                                    </OrderSummary>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import BreezeValidationErrors from '@/Components/ValidationErrors'
import ShippingInfo from '@/Components/Orders/ShippingInfo'
import OrderSummary from '@/Components/Orders/Summary'

export default {
    components: {
        OrderSummary,
        ShippingInfo,
        BreezeAuthenticatedLayout,
        BreezeValidationErrors,
    },
    created() {
        this.read();
    },
    data() {
        return {
            form: this.$inertia.form({
                first_name: '',
                last_name: '',
                country: '',
                street_address: '',
                city: '',
                state: '',
                postcode: '',
                phone_number: '',
                notes: '',
            }),
            isCheckout: true,
            actionRoute: null,
            actionText: 'Place order',
            products: [],
        };
    },
    computed: {
        subtotal() {
            return this.products.reduce(
                (sum, item) => sum + Number(item.price * item.incart_qty),
                0
            ).toFixed(2);
        },
    },
    methods: {
        async read() {
            await axios
                .get(route('api.cart.read'))
                .then(response => {
                    this.products = response.data;
                });
        },
        submit() {
            this.form.post(route('api.order.create'), {
                onFinish: (response) => {
                },
            })
        },
    },
}
</script>
