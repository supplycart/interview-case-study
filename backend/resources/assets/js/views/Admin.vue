<template>
    <div>
        <div class="container">
            <h2 class="text-2xl">Admin Dashboard</h2>
        </div>
        <div class="container">
            <div class="row">
                <nav class="bg-white pt-2 mb-8 mt-4">
                    <div class="-mb-px flex">
                        <a
                            class="no-underline border-b-2 uppercase tracking-wide font-bold text-xs py-3 mr-8"
                            v-bind:class="{
                                selected: isActive === 'main',
                                'border-transparent': isActive !== 'main',
                            }"
                            href="#"
                            @click="setComponent('main')"
                        >
                            Dashboard
                        </a>
                        <a
                            class="no-underline border-b-2 uppercase tracking-wide font-bold text-xs py-3 mr-8"
                            v-bind:class="{
                                selected: isActive === 'orders',
                                'border-transparent': isActive !== 'orders',
                            }"
                            href="#"
                            @click="setComponent('orders')"
                        >
                            Orders
                        </a>
                        <a
                            class="no-underline border-b-2 uppercase tracking-wide font-bold text-xs py-3 mr-8"
                            v-bind:class="{
                                selected: isActive === 'products',
                                'border-transparent': isActive !== 'products',
                            }"
                            href="#"
                            @click="setComponent('products')"
                        >
                            Products
                        </a>
                        <a
                            class="no-underline text-grey-dark border-b-2 uppercase tracking-wide font-bold text-xs py-3"
                            v-bind:class="{
                                selected: isActive === 'users',
                                'border-transparent': isActive !== 'users',
                            }"
                            href="#"
                            @click="setComponent('users')"
                        >
                            Users
                        </a>
                    </div>
                </nav>

                <div class="col-md-9">
                    <component :is="activeComponent"></component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Main from "../components/admin/Main";
import Users from "../components/admin/Users";
import Products from "../components/admin/Products";
import Orders from "../components/admin/Orders";

export default {
    data() {
        return {
            user: null,
            activeComponent: null,
            isActive: 'main',
            attachFile(event) {
                this.attachment = event.target.files[0];
            },
        };
    },
    components: {
        Main,
        Users,
        Products,
        Orders,
    },
    beforeMount() {
        this.setComponent(this.$route.params.page);
        this.user = JSON.parse(localStorage.getItem("bigStore.  d fuser"));
        axios.defaults.headers.common["Content-Type"] = "application/json";
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + localStorage.getItem("bigStore.jwt");
    },
    methods: {
        setComponent(value) {
            if (value) {
                this.isActive = value;
            }
            switch (value) {
                case "users":
                    this.activeComponent = Users;
                    this.$router.push({
                        name: "admin-pages",
                        params: { page: "users" },
                    });
                    break;
                case "orders":
                    this.activeComponent = Orders;
                    this.$router.push({
                        name: "admin-pages",
                        params: { page: "orders" },
                    });
                    break;
                case "products":
                    this.activeComponent = Products;
                    this.$router.push({
                        name: "admin-pages",
                        params: { page: "products" },
                    });
                    break;
                default:
                    this.activeComponent = Main;
                    this.$router.push({ name: "admin" });
                    break;
            }
        },
    },
};
</script>

<style scoped>
a.selected {
    color: #059669;
    border-bottom-color: #059669;
}
</style>
