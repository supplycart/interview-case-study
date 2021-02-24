<template>
    <div>
        <table
            class="min-w-full divide-y divide-gray-100 shadow-sm border-gray-200 border"
        >
            <thead class="bg-gray-50">
                <tr>
                    <th
                        scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b"
                    >
                        No.
                    </th>
                    <th
                        scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b"
                    >
                        Product
                    </th>
                    <th
                        scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b"
                    >
                        Units
                    </th>
                    <th
                        scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b"
                    >
                        Price
                    </th>
                    <th
                        scope="col"
                        class="px-3 py-2 font-semibold text-left bg-gray-100 border-b"
                    >
                        Description
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                <tr
                    v-for="(product, index) in products"
                    @key="index"
                    @dblclick="editingItem = product"
                >
                    <td class="px-3 py-2 whitespace-no-wrap">
                        {{ index + 1 }}
                    </td>
                    <td
                        class="px-3 py-2 whitespace-no-wrap"
                        v-html="product.name"
                    ></td>
                    <td
                        class="px-3 py-2 whitespace-no-wrap"
                        v-model="product.units"
                    >
                        {{ product.units }}
                    </td>
                    <td
                        class="px-3 py-2 whitespace-no-wrap"
                        v-model="product.price"
                    >
                        {{ product.price }}
                    </td>
                    <td
                        class="px-3 py-2 whitespace-no-wrap"
                        v-model="product.price"
                    >
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
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
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
            addingProduct: null
        };
    },
    components: { Modal },
    beforeMount() {
        axios
            .get("/api/products/")
            .then(response => (this.products = response.data));
    },
    methods: {
        newProduct() {
            this.addingProduct = {
                name: null,
                units: null,
                price: null,
                image: null,
                description: null
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
                    description
                })
                .then(response => (this.products[index] = product));
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
                    image
                })
                .then(response => this.products.push(product));
        }
    }
};
</script>
