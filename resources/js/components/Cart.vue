<template>
    <div v-if="products.length > 0" class="h-full flex flex-col bg-white shadow-xl">
        <form @submit.prevent="submitForm()">
            <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
                <div class="mt-8">
                    <div class="flow-root">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                            <li v-for="product in products" :key="product.id" class="py-6 flex">
                            <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                <img :src="product.imageSrc" :alt="product.imageAlt" class="w-full h-full object-center object-cover" />
                            </div>

                            <div class="ml-4 flex-1 flex flex-col">
                                <div>
                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                        <h3>{{ product.name }}</h3>
                                        <p class="ml-4">{{ calculatePrice(product.price,product.total) }}</p>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">{{ product.color }}</p>
                                    <p class="mt-1 text-sm text-gray-500">{{ product.size }}</p>
                                </div>
                                <div class="flex-1 flex items-end justify-between text-sm">
                                    <p class="text-gray-500">Quantity: {{ product.total }}</p>
                                    <div class="flex">
                                        <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500" @click="removeProduct(product.color,product.size)">Remove</button>
                                    </div>
                                </div>
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                <div class="flex justify-between text-base font-medium text-gray-900">
                    <p>Subtotal</p>
                    <p>{{ calculateTotal() }}</p>
                </div>
                <p class="mt-0.5 text-sm text-gray-500">Price including taxes and shipping fee.</p>
                <div class="mt-6">
                    <button type="submit" class="mt-6 w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Checkout</button>
                </div>
                <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                    <p>
                    or <button type="button" class="text-indigo-600 font-medium hover:text-indigo-500" @click="returnPage()">Continue Shopping<span aria-hidden="true"> &rarr;</span></button>
                    </p>
                </div>
            </div>
        </form>
    </div>

    <div v-else class="h-full flex flex-col bg-white shadow-xl">
        <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
            <h1 class="text-center">No item added to this cart.</h1>
        </div>
    </div>

    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <CheckCircleIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900"> Thank You.</DialogTitle>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Your order have been successfully placed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false" ref="cancelButtonRef">Closed</button>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>

    <TransitionRoot as="template" :show="close">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="close = false">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <XCircleIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900"> Remove Item.</DialogTitle>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Your item have been successfully removed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="close = false" ref="cancelButtonRef">Closed</button>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
    import { ref } from 'vue'
    import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
    import { CheckCircleIcon,XCircleIcon } from '@heroicons/vue/outline'

    export default {
        components: {
            Dialog,
            DialogOverlay,
            DialogTitle,
            TransitionChild,
            TransitionRoot,
            CheckCircleIcon,
            XCircleIcon,
        },
        data() {
            return {
                products: Array,
                open: Boolean(false),
                close: Boolean(false),
                subTotal: Number
            }
        },
        props: {
            submitRoute: String(),
            removeRoute: String(),
            returnRoute: String(),
            cartData: Array,
        },
        mounted() {
            this.products = this.cartData
        },
        methods: {
            calculatePrice (price,total){
                const totalPrice = parseInt(price.replace('RM','')) * parseInt(total)
                return 'RM '+ totalPrice.toFixed(2)
            },
            calculateTotal (){
                this.subTotal = 0;
                this.cartData.forEach((item)=>{
                    this.subTotal = this.subTotal + parseInt(item.price.replace('RM','')) * parseInt(item.total)
                })
                return 'RM '+ this.subTotal.toFixed(2)
            },
            removeProduct(color,size) {
                this.close = ref(true);
                axios.post(this.removeRoute,[color,size]).then(response => {
                    this.products = response.data
                }).catch(error => console.log(error));
            },
            submitForm() {
                this.open = ref(true);
                axios.post(this.submitRoute,this.products).then((response) => {
                    new Promise(resolve => {
                        setTimeout(resolve, 3000)
                        location.href = response.data
                    })
                }).catch(error => console.log(error));
            },
            returnPage() {
                window.location = this.returnRoute;
            }
        }
    }
</script>