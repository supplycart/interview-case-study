<template>
    <div class="flex flex-col max-w-full overflow-x-hidden shadow-md">
        <table class="overflow-x-auto w-full bg-white">
            <thead class="bg-blue-100 border-b border-gray-300">
                <tr>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Id
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Product
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Units
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Price
                    </th>
                    <th class="p-4 text-left text-sm font-medium text-gray-500">
                        Description
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm divide-y divide-gray-300">
                <tr
                    v-for="(product, index) in products"
                    :key="index"
                    @dblclick="editingItem = product"
                >
                    <td class="p-4 whitespace-nowrap">{{ index + 1 }}</td>
                    <td
                        class="p-4 whitespace-nowrap"
                        v-html="product.name"
                    ></td>
                    <td class="p-4 whitespace-nowrap" v-model="product.units">
                        {{ product.units }}
                    </td>
                    <td class="p-4 whitespace-nowrap" v-model="product.price">
                        {{ product.price }}
                    </td>
                    <td class="p-4 whitespace-nowrap" v-model="product.price">
                        {{ product.description }}
                    </td>
                </tr>
            </tbody>
        </table>

        <modal
            @close="endEditing"
            :product="editingItem"
            v-show="editingItem != null"
        ></modal>
        <modal
            @close="addProduct"
            :product="addingProduct"
            v-show="addingProduct != null"
        ></modal>
        <br />
        <button
            class="bg-green-100 text-green-800 text-xs font-semibold px-4 py-2 border-0"
            @click="newProduct"
        >
            Add New Product
        </button>
    </div>
</template>

<script>
import Modal from "./ProductModal";

export default {
    data() {
        return {
            products: [],
            editingItem: null,
            addingProduct: null,
        };
    },
    components: { Modal },
    beforeMount() {
        axios
            .get("/api/products/")
            .then((response) => (this.products = response.data));
    },
    methods: {
        newProduct() {
            this.addingProduct = {
                name: null,
                units: null,
                price: null,
                image: null,
                description: null,
            };
        },
        endEditing(product) {
            this.editingItem = null;

            let index = this.products.indexOf(product);
            let name = product.name;
            let units = product.units;
            let price = product.price;
            let description = product.description;

            axios
                .put(`/api/products/${product.id}`, {
                    name,
                    units,
                    price,
                    description,
                })
                .then((response) => (this.products[index] = product));
        },
        addProduct(product) {
            this.addingProduct = null;

            let name = product.name;
            let units = product.units;
            let price = product.price;
            let description = product.description;
            let image = product.image;

            axios
                .post("/api/products/", {
                    name,
                    units,
                    price,
                    description,
                    image,
                })
                .then((response) => this.products.push(product));
        },
    },
};
</script>
