<template>
    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span
                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                aria-hidden="true"
                >&#8203;</span
            >
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle max-w-2xl sm:w-full"
                role="dialog"
                aria-modal="true"
                aria-labelledby="modal-headline"
            >
                <main class="place-items-stretch">
                    <h3 class="uppercase text-black text-xl my-4 mx-5 font-medium">
                        Item Added To Cart
                    </h3>
                    <section
                        class="flex flex-grow flex-row gap-11 py-10 px-5 bg-white"
                    >
                        <div
                            class="text-green-500 flex flex-col justify-center"
                        >
                            <img
                                :src="data.image"
                                v-show="data.image != null"
                            />
                        </div>
                        <div class="text-green-500">
                            <h3
                                class="uppercase text-black text-2xl font-medium"
                                v-html="data.name"
                            ></h3>
                            <h3 class="text-2xl font-semibold mb-7">
                                $ {{ data.price }}
                            </h3>
                            <div class="pb-5">
                                <small class="text-black">{{
                                    data.description
                                }}</small>
                            </div>
                        </div>
                    </section>
                </main>

                <div
                    class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                >
                    <button
                        type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                        @click="goToCart"
                    >
                        Go To Cart
                    </button>
                    <button
                        type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        @click="closeModal"
                    >
                        Continue Shopping
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["product"],
    data() {
        return {
            attachment: null
        };
    },
    computed: {
        data: function() {
            if (this.product != null) {
                return this.product;
            }
            return {
                name: "",
                units: "",
                price: "",
                description: "",
                image: false
            };
        }
    },
    methods: {
        goToCart(event) {
            this.$router.push("/cart");
        },
        closeModal(event) {
            console.log(event);
            this.$emit("close", this.product);
        }
    }
};
</script>
