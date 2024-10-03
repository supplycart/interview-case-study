<template>
    <section aria-labelledby="payment-and-shipping-heading" class="bg-white p-6 col-start-1 row-start-1 mx-auto w-full">
        <h2 id="payment-and-shipping-heading" class="sr-only">Payment and shipping details</h2>

        <form @submit.prevent="submitForm()">
            <div class="mx-auto px-4 w-full lg:px-0">
                <div>
                    <h3 id="contact-info-heading" class="text-lg font-medium text-gray-900">Contact information</h3>

                    <div class="mt-6 grid grid-cols-2 gap-x-4 gap-y-6 sm:grid-cols-4">
                        <div class="col-span-2 sm:col-span-4">
                            <InputLabel for="name" value="Name" />
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="col-span-1 sm:col-span-2">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="col-span-1 sm:col-span-2">
                            <InputLabel for="phone" value="Phone" />
                            <TextInput
                                id="phone"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.phone"
                                required
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <h3 class="text-lg font-medium text-gray-900">Payment details</h3>

                    <div class="mt-6 grid grid-cols-3 gap-x-4 gap-y-6 sm:grid-cols-4">
                        <div class="col-span-3 sm:col-span-4">
                            <InputLabel for="card-number" value="Card Number" />
                            <TextInput
                                id="card-number"
                                type="text"
                                pattern="\d*"
                                maxlength="12"
                                class="mt-1 block w-full"
                                v-model="form.cardNumber"
                                required
                                autocomplete="cc-number"
                                placeholder="123412341234"
                            />
                            <InputError class="mt-2" :message="form.errors.cardNumber" />
                        </div>

                        <div class="col-span-2 sm:col-span-3">
                            <InputLabel for="card-expiration" value="Expiration date (MM/YY)" />
                            <TextInput
                                id="card-expiration"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.cardExpiration"
                                required
                                autocomplete="cc-exp"
                            />
                            <InputError class="mt-2" :message="form.errors.cardExpiration" />
                        </div>

                        <div>
                            <InputLabel for="cvc" value="CVC" />
                            <TextInput
                                id="cvc"
                                type="text"
                                pattern="\d*"
                                maxlength="3"
                                class="mt-1 block w-full"
                                v-model="form.cardCvc"
                                required
                                autocomplete="csc"
                                placeholder="123"
                            />
                            <InputError class="mt-2" :message="form.errors.cardCvc" />
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <h3 class="text-lg font-medium text-gray-900">Shipping address</h3>

                    <div class="mt-6 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-3">
                        <div class="sm:col-span-3">
                            <InputLabel for="address" value="Address" />
                            <TextInput
                                id="address"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.address"
                                required
                                autocomplete="street-address"
                            />
                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>

                        <div>
                            <InputLabel for="city" value="City" />
                            <TextInput
                                id="city"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.city"
                                required
                                autocomplete="address-level2"
                            />
                            <InputError class="mt-2" :message="form.errors.city" />
                        </div>

                        <div>
                            <InputLabel for="state" value="State / Province" />
                            <TextInput
                                id="state"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.state"
                                required
                                autocomplete="address-level1"
                            />
                            <InputError class="mt-2" :message="form.errors.state" />
                        </div>

                        <div>
                            <InputLabel for="postal-code" value="Postal code (5 digit label)" />
                            <TextInput
                                id="postal-code"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.zipCode"
                                pattern="\d*"
                                maxlength="5"
                                required
                                autocomplete="postal-code"
                            />
                            <InputError class="mt-2" :message="form.errors.zipCode" />
                        </div>
                    </div>

                    <label class="mt-6 w-full flex items-center">
                        <Checkbox name="remember" v-model:checked="form.saveInfo" />
                        <span class="ms-2 text-sm text-gray-600">Update Profile</span>
                    </label>

                    <InputError class="mt-6" :message="formError" />
                </div>

                <div class="mt-10 flex justify-end border-gray-200 pt-6 gap-3">
                    <Link
                        :href="route('cart.index')"
                        v-if="!isPaying"
                        @click="proceedToCheckout.backToCart()"
                        v-html="proceedToCheckout.continueShoppingCopy"
                        class="cursor-pointer inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline"
                    />
                    <button
                        :disabled="isPaying"
                        :class="[
                        {'cursor-not-allowed hover:bg-gray-400' : isPaying},
                        isPaying ? 'bg-gray-300' : 'bg-indigo-700' ,
                       ]"
                        class="flex rounded-lg px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300"
                    >
                        <Spinner v-if="isPaying" class="mr-3" />
                        {{ isPaying ? 'Processing' : 'Pay Now' }}
                    </button>
                </div>
            </div>
        </form>
    </section>
</template>

<script setup>
import {Link, router, useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {checkoutStore} from "@/checkoutStore.js";
import {ref} from "vue";
import Spinner from "@/Components/Spinner.vue";
import Checkbox from "@/Components/Checkbox.vue";
import {cartCounterStore} from "@/cartCounter.js";

const props = defineProps({
    cartItems: Array,
    paymentInfo: Object
})

const cartCounter = cartCounterStore();
const proceedToCheckout = checkoutStore();
const user = usePage().props.auth.user;
const isPaying = ref(false);
const formError = ref();

const form = useForm({
    name: user.name,
    email: user.email,
    phone: user.phone,
    cardNumber: props.paymentInfo?.card_number,
    cardExpiration: props.paymentInfo?.card_expiration,
    cardCvc: '',
    address: user.address,
    city: user.city,
    state: user.state,
    zipCode: user.zip_code,
    saveInfo: false,
})


function submitForm() {
    form.clearErrors();
    isPaying.value = true;

    axios({
        method: 'post',
        url: route('order.store'),
        data: form.data()
    }).then(response => {
        cartCounter.reset();
        const orderNumber = response.data.orderNumber;

        router.visit(route('order.summary', orderNumber));
    }).catch(e => {
        formError.value =  e.response.data.message;
    }).finally(() => {
        isPaying.value = false;
    })
}
</script>
