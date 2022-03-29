<template>
    <base-dialog :close="close" :is-open="isOpen">
        <div
            class="dialog wide"
        >
            <button class="absolute -right-4 -top-4 bg-blue-400 rounded-full p-2 hover:bg-blue-600 disabled:bg-gray-300" @click="close" :disabled="loading">
                <XIcon class="w-6 h-6 text-white"/>
            </button>
            <div class="grid grid-cols-2 gap-6">
                <img :src="product.picture" class="col-1 w-full" :alt="product.name"/>
                <div class="col-1 flex flex-col">
                    <h5 class="text-md mb-2 font-bold">{{ product.category.name }}</h5>
                    <h2 class="text-3xl font-bold my-4">
                        {{ product.name }}
                    </h2>
                    <div class="mt-2 flex flex-wrap ">
                        <span class="bg-teal-300 py-1 px-2 rounded-full mr-2 text-sm mb-2 "
                            v-for="tag in product.tags.split('>').slice(0,-1)">{{tag}}</span>
                    </div>
                    <h5 class="text-lg my-2 font-bold">RM{{ product.price }}</h5>
                    <div class="my-4">
                        <p class="text-md text-gray-700">
                            {{ product.description }}
                        </p>
                    </div>
                    <spacer/>
                    <div class="grid grid-cols-2 gap-8">
                        <number-input :value="inventory" @change="updateValue"/>
                        <button class="button col-1" @click="addToCart" :disabled="loading || inventory === 0">
                            <span v-if="!loading">Add to cart</span>
                            <spinner class="w-6 h-6 fill-blue-400" v-if="loading"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </base-dialog>
    <information-dialog :is-open="showDialog" title="Adding to Cart" :description="success ? 'Added Successfully!'
    : 'This product is already added to your cart, please view it from your cart'" @close="showDialog = false"
    :error="!success"/>
</template>

<script>
import {DialogTitle, DialogDescription} from "@headlessui/vue";
import BaseDialog from "./BaseDialog";
import Spacer from "./Spacer";
import {XIcon} from "@heroicons/vue/solid"
import NumberInput from "./NumberInput";
import InformationDialog from "./InformationDialog";
import Spinner from "./Spinner";

export default {
    name: "ProductDialog",
    props: ["product", "isOpen"],
    components: {Spinner, InformationDialog, NumberInput, Spacer, BaseDialog, DialogTitle, DialogDescription, XIcon},
    emits: ["close"],
    methods: {
        close() {
            if (this.loading) {
                return;
            }
            this.inventory = 0;
            this.$emit("close");
        },
        updateValue(e) {
            this.inventory = e;
        },
        async addToCart() {
            this.loading = true;
            await axios.post("/api/cart", {
                "product_id": this.product.id,
                "quantity": this.inventory
            }).then((res) => {
                this.success = true;
            }).catch((err) => {
                this.success = false;
            }).finally(() => {
                this.showDialog = true;
                this.loading = false;
            })
        }
    },
    data() {
        return {
            inventory: 0,
            loading: false,
            success: false,
            showDialog: false
        }
    }
}
</script>

<style scoped>
.wide {
    width: 50vw;
}
</style>
