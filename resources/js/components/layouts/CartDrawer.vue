<template>
    <div>
        <div @mouseleave="isOpen=false" class="h-64 justify-start">
            <div class="relative ">
                <div class="flex flex-row cursor-pointer truncate p-2 px-4  rounded">
                    <div></div>
                    <div class="flex flex-row-reverse ml-2 w-full">
                        <div @mouseover="isOpen = true" slot="icon" class="relative">
                            <div
                                class="absolute text-xs rounded-full -mt-1 -mr-2 px-1 font-bold top-0 right-0 bg-red-700 text-white">
                                {{ cart.length }}
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-shopping-cart w-6 h-6 mt-2">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <default-transition>
                    <div v-show="isOpen" class="absolute w-full  rounded-b border-t-0 z-50">
                        <div class="shadow-xl w-64">
                            <div v-for="product in previewCart" :key="product.id"
                                 class="p-2 flex bg-white hover:bg-gray-100 cursor-pointer border-b border-gray-100"
                                 style="">
                                <div class="p-2 w-12"><img
                                    src="https://dummyimage.com/50x50/bababa/0011ff&amp;text=50x50"
                                    alt="img product"></div>
                                <div class="flex-auto text-sm w-32">
                                    <div class="font-bold">{{ product.product.title | limitWords }}</div>
                                    <!--                                    <div class="truncate">Product 1 description</div>-->
                                    <div class="text-gray-400">Amount: {{ product.amount }}</div>
                                </div>
                                <div class="flex flex-col w-18 font-medium items-end">
                                    {{ 'RM' + totalForEachItem(product) }}
                                </div>
                            </div>
                            <div class="p-4 justify-center flex">
                                <button @click="redirectToCartPage"
                                        class="text-base  undefined  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
        hover:bg-teal-700 hover:text-teal-100
        text-teal-700n">View cart (RM {{ total }})
                                </button>
                            </div>
                        </div>
                    </div>
                </default-transition>

            </div>
        </div>
        <div class="h-32"></div>
    </div>

</template>
<script>


import {mapGetters} from "vuex";

export default {
    name: "CartDrawer",
    data() {
        return {
            isOpen: false
        }
    },
    created() {
        this.$store.dispatch('cart/fetchAddedProducts');
    },
    computed: {
        ...mapGetters(
            'cart', [
                'cart', 'total'
            ]
        ),
        previewCart() {
            return this.cart.slice(0, 3)
        }
    },
    methods: {
        hideCartDrawer() {
            this.isOpen = false;
        },
        totalForEachItem(product) {
            return (product.price.price * product.amount).toFixed(2);
        },
        redirectToCartPage() {
            if (this.$router.currentRoute.name !== 'cart') {
                this.$router.push({name: 'cart'});
            }
        }
    }
}
</script>

<style scoped>

</style>
