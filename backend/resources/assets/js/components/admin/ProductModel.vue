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
                            <div class="mt-10">
                                <input type="file" id="file" @change="attachFile" />
                            </div>

                        </div>
                        <div>
                            <label for="name">Name</label>
                            <input
                                id="name"
                                type="text"
                                v-model="data.name"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                            />

                            <label for="units">Units</label>
                            <input
                                id="units"
                                type="text"
                                v-model="data.units"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                            />

                            <label for="price">Price</label>
                            <input
                                id="price"
                                type="text"
                                v-model="data.price"
                                required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm mb-4"
                            />

                            <label for="description">Description</label>
                            <textarea
                                class="border rounded-md resize-none w-full h-72"
                                v-model="data.description"
                                placeholder="description"
                            ></textarea>
                            <div class="flex gap-0.5 mt-4"></div>
                        </div>
                    </section>
                </main>

                <div
                    class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                >
                    <button
                        type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                        @click="uploadFile"
                    >
                        Finish
                    </button>
                    <button
                        type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        @click="closeModal"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>

<script>
export default {
    props: ["product"],
    data() {
        return {
            attachment: null,
        };
    },
    computed: {
        data: function () {
            if (this.product != null) {
                return this.product;
            }
            return {
                name: "",
                units: "",
                price: "",
                description: "",
                image: false,
            };
        },
    },
    methods: {
        attachFile(event) {
            this.attachment = event.target.files[0];
        },
        uploadFile(event) {
            if (this.attachment != null) {
                var formData = new FormData();
                formData.append("image", this.attachment);
                let headers = { "Content-Type": "multipart/form-data" };
                axios
                    .post("/api/upload-file", formData, { headers })
                    .then((response) => {
                        this.product.image = response.data;
                        this.$emit("close", this.product);
                    });
            } else {
                this.$emit("close", this.product);
            }
        },
        closeModal(event) {
            this.$emit("close", this.product);
        },
    },
};
</script>
