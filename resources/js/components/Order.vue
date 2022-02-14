<template>
    <div v-if="order" class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Info</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in order" :key="item.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" :src="item.imageSrc" :alt="item.imageAlt" />
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">
                                                {{ item.name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ item.price }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ item.status }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div @click="openOrder(item.id)">
                                        <p class="text-indigo-600 hover:text-indigo-900">View Product</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div v-else class="h-full flex flex-col bg-white shadow-xl">
        <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
            <h1 class="text-center">No order being made yet.</h1>
        </div>
    </div>

    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
            <div class="flex min-h-screen text-center md:block md:px-2 lg:px-4" style="font-size: 0">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity md:block" />
                </TransitionChild>

                <span class="hidden md:inline-block md:align-middle md:h-screen" aria-hidden="true">&#8203;</span>
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 md:translate-y-0 md:scale-95" enter-to="opacity-100 translate-y-0 md:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 md:scale-100" leave-to="opacity-0 translate-y-4 md:translate-y-0 md:scale-95">
                    <div class="flex text-base text-left transform transition w-full md:inline-block md:max-w-2xl md:px-4 md:my-8 md:align-middle lg:max-w-4xl">
                        <div class="w-full relative flex items-center bg-white px-4 pt-14 pb-8 overflow-hidden shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                            <button type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8" @click="open = false">
                                <span class="sr-only">Close</span>
                                <XIcon class="h-6 w-6" aria-hidden="true" />
                            </button>

                            <div class="w-full grid grid-cols-1 gap-y-8 gap-x-6 items-start sm:grid-cols-12 lg:gap-x-8">
                                <div class="aspect-w-2 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden sm:col-span-4 lg:col-span-5">
                                    <img :src="orderList.imageSrc" :alt="orderList.imageAlt" class="object-center object-cover" />
                                </div>
                                <div class="sm:col-span-8 lg:col-span-7">
                                    <h2 class="text-2xl font-extrabold text-gray-900 sm:pr-12">
                                        {{ orderList.name }}
                                    </h2>

                                    <section aria-labelledby="information-heading" class="mt-2">
                                        <h3 id="information-heading" class="sr-only">Order information</h3>

                                        <p class="text-2xl text-gray-900">
                                            {{ orderList.price }}
                                        </p>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
    import { ref } from 'vue'
    import {
            Dialog,
            DialogOverlay,
            RadioGroup,
            RadioGroupLabel,
            RadioGroupOption,
            Disclosure,
            DisclosureButton,
            DisclosurePanel,
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,
            TransitionChild,
            TransitionRoot,
        } from '@headlessui/vue'
    import { XIcon } from '@heroicons/vue/outline'
    import { StarIcon, ChevronDownIcon, FilterIcon, MinusSmIcon, PlusSmIcon, ShoppingCartIcon, CheckCircleIcon } from '@heroicons/vue/solid'

    export default {
        components: {
            Dialog,
            DialogOverlay,
            RadioGroup,
            RadioGroupLabel,
            RadioGroupOption,
            Disclosure,
            DisclosureButton,
            DisclosurePanel,
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,
            TransitionChild,
            TransitionRoot,
            ChevronDownIcon,
            FilterIcon,
            MinusSmIcon,
            PlusSmIcon,
            ShoppingCartIcon,
            CheckCircleIcon,
            StarIcon,
            XIcon,
        },
        data() {
            return {
                order: Array,
                orderList: Object,
                open: Boolean(false)
            }
        },
        props: {
            orderData: Array,
        },
        mounted() {
            this.order = this.orderData
        },
        methods: {
            openOrder(id) {
                this.orderData.forEach((item)=>{
                    if(item.id == id){
                        console.log(item)
                        this.open = ref(true)
                        this.orderList = ref(item)
                    }
                })
            },
        }
    }
</script>