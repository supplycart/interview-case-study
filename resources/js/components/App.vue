<template>
    <div class="h-screen bg-white">
        <div class="flex">
            <div class="bg-blue-800 w-48 border-r-2">
                <nav>
                    <img src="test.png"  alt="">
                </nav>
            </div>
            <div>
                <div></div>
                <div class="flex">
                    <div class="col " v-for="column in columns">
                        <div class="p-6 max-w-sm rounded overflow-hidden shadow-lg p-6" v-for="product in column">
                            <img class="object-contain h-48" :src="product.image_src" alt="Sunset in the mountains" >
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ product.name }}</div>
                                <p class="text-gray-700 text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                                </p>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2" @click.prevent="addToCart">
                                    RM {{ product.price }}
                                </span>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded-full">
                                    Add to Cart
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.col {
    margin: 10px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.item-container {
    padding: 5px;
    margin: 5px;
}
</style>

<script>
export default {
    name: "App",
    data() {
        return {
            cols:3,
            products: [],
            $user:[]
        };
    },
    created() {
        axios.get("/api/products")
            .then(res => {
                console.log(res.data)
                this.products = res.data
            })
            .catch(err => console.error(err));
        axios.get("/api/user")
            .then(res => {
                console.log('hello')
                this.user = res.data
            })
            .catch(err => console.error(err));
    },
    computed: {
        columns () {
            let columns = []
            let mid = Math.ceil(this.products.length / this.cols)
            for (let col = 0; col < this.cols; col++) {
                columns.push(this.products.slice(col * mid, col * mid + mid))
            }
            return columns
        }
    },
    // methods:{
    //     addToCart(){
    //         axios.post('/cart', {
    //             user_id: this.users[0].id
    //         })
    //             .then(res => {
    //                 const data = res.data;
    //                 this.products.push(res.data);
    //             })
    //             .catch(err => console.error(err));
    //     }
    // }
};
</script>
