<template>
    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden pb-4">
        <div class="flex items-end justify-end h-56 w-full bg-cover"
             style="background-image: url('https://images.unsplash.com/photo-1495856458515-0637185db551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80')">
            <button
                class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </button>
        </div>
        <div class="px-5 py-3">
            <h3 class="text-gray-700 uppercase">Classic watch</h3>
            <span class="text-gray-500 mt-2">RM {{ product.price.price }}</span>
        </div>
        <div class="flex">
            <div class="flex custom-number-input h-10 w-6/12 ml-2">
<!--                <label for="custom-input-number" class="w-full text-gray-700 text-sm font-semibold">Amount-->
<!--                </label>-->
                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                    <button @click="quantity = quantity - 1" data-action="decrement"
                            class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                        <span class="m-auto text-2xl font-thin">−</span>
                    </button>
                    <input type="number"
                           v-model.number="quantity"
                           class="outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                           name="custom-input-number"/>
                    <button @click="quantity = quantity + 1" data-action="increment"
                            class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                        <span class="m-auto text-2xl font-thin">+</span>
                    </button>
                </div>
            </div>
            <div class="flex ml-5">
                <button @click="addToCart" class="bg-primary text-white bg-green-600 text-sm py-3 px-4 border border-primary rounded font-bold flex items-center">Add to cart</button>
            </div>

        </div>

    </div>

</template>

<script>
export default {
    props: {
        product: Object,
        default: () => {
            return {
                price: 10,
                title: 'Test'
            }
        }
    },
    name: "Product",
    // computed : {
    //     quantity: {
    //         set(val) {
    //             console.log(val);
    //         },
    //         get() {
    //             return this.quantity;
    //         }
    //     }
    // }
    data() {
        return {
            quantity: 1
        }
    },
    watch: {
        quantity(val) {
            if (val === "") return;

            if (this.quantity <= 0) {
                this.quantity = 1;
            }
        }
    },
    methods : {
        addToCart() {
            console.log('added')
        }
    }
}
</script>

<style scoped>

</style>
