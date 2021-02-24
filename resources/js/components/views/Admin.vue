  <template>
        <div>
            <div class="flex items-center justify-center text-white-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl bg-gray-300 p-5">
                <h2 class="my-4 text-3xl md:text-5xl font-bold leading-tight">Admin Dashboard</h2>
            </div>
            <div class="container mx-auto px-4">
                <div class="row">
                    <div class="col-md-3">
                        <ul style="list-style-type:none" class="p-2">
                            <li class="active"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-1 rounded-full" @click="setComponent('main')">Dashboard</button></li>
                            <li><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-1 rounded-full" @click="setComponent('orders')">Orders</button></li>
                            <li><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-1 rounded-full" @click="setComponent('products')">Products</button></li>
                            <li><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-1 rounded-full" @click="setComponent('users')">Users</button></li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <component :is="activeComponent"></component>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
    import Main from '../admin/main'
    import Users from '../admin/Users'
    import Products from '../admin/Products'
    import Orders from '../admin/Orders'

    export default {
        data() {
            return {
                user: null,
                activeComponent: null
            }
        },
        components: {
            Main, Users, Products, Orders
        },
        beforeMount() {
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('bigStore.  d fuser'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bigStore.jwt')
        },
        methods: {
            setComponent(value) {
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name: 'admin-pages', params: {page: 'users'}})
                        break;
                    case "orders":
                        this.activeComponent = Orders
                        this.$router.push({name: 'admin-pages', params: {page: 'orders'}})
                        break;
                    case "products":
                        this.activeComponent = Products
                        this.$router.push({name: 'admin-pages', params: {page: 'products'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name: 'admin'})
                        break;
                }
            }
        }
    }
    </script>

    <style scoped>
    .hero-section { height: 20vh; background: #ababab; align-items: center; margin-bottom: 20px; margin-top: -20px; }
    .title { font-size: 60px; color: #ffffff; }
    </style>