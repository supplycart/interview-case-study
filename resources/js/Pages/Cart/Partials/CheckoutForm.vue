<template>
    <section aria-labelledby="payment-and-shipping-heading" class="bg-white p-6 col-start-1 row-start-1 mx-auto w-full">
        <h2 id="payment-and-shipping-heading" class="sr-only">Payment and shipping details</h2>

        <form @submit.prevent="form.post(route('cart.checkout'))">
            <div class="mx-auto px-4 w-full lg:px-0">
                <div>
                    <h3 id="contact-info-heading" class="text-lg font-medium text-gray-900">Contact information</h3>

                    <div class="mt-6">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
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
                                class="mt-1 block w-full"
                                v-model="form.cardNumber"
                                required
                                autofocus
                                autocomplete="cc-number"
                            />
                            <InputError class="mt-2" :message="form.errors.cardNumber" />
                        </div>

                        <div class="col-span-2 sm:col-span-3">
                            <InputLabel for="expiration-date" value="Expiration date (MM/YY)" />
                            <TextInput
                                id="expiration-date"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.expirationDate"
                                required
                                autofocus
                                autocomplete="cc-exp"
                            />
                            <InputError class="mt-2" :message="form.errors.expirationDate" />
                        </div>

                        <div>
                            <InputLabel for="cvc" value="CVC" />
                            <TextInput
                                id="cvc"
                                type="text"
                                pattern="\d*"
                                maxlength="3"
                                class="mt-1 block w-full"
                                v-model="form.cvc"
                                required
                                autofocus
                                autocomplete="csc"
                            />
                            <InputError class="mt-2" :message="form.errors.cvc" />
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
                                autofocus
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
                                autofocus
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
                                autofocus
                                autocomplete="address-level1"
                            />
                            <InputError class="mt-2" :message="form.errors.state" />
                        </div>

                        <div>
                            <InputLabel for="postal-code" value="Postal code" />
                            <TextInput
                                id="postal-code"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.postalCode"
                                required
                                autofocus
                                autocomplete="postal-code"
                            />
                            <InputError class="mt-2" :message="form.errors.postalCode" />
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex justify-end border-gray-200 pt-6 gap-3">
                    <Link
                        :href="route('cart.index')"
                        @click="proceedToCheckout.backToCart()"
                        v-html="proceedToCheckout.continueShoppingCopy"
                        class="cursor-pointer inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline"
                    />
                    <button class="rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Pay now</button>
                </div>
            </div>
        </form>
    </section>
</template>

<script setup>
import {Link, useForm, usePage} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {checkoutStore} from "@/checkoutStore.js";

const props = defineProps({
    cartItems: Array
})

const proceedToCheckout = checkoutStore();

const user = usePage().props.auth.user;

const form = useForm({
    email: user.email,
    cardNumber: '',
    expirationDate: '',
    cvc: '',
    address: user.address,
    city: user.city,
    state: user.state,
    postalCode: user.zip_code
})
</script>
