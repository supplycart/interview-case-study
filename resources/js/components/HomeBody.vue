<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row pb-3">
                    <div class="form-group col-10">
                        <input v-model="search" type="text" class="form-control input-sm" placeholder="Search"
                               autocomplete="search">
                    </div>

                    <div class="form-group col-2">
                        <select class="form-select">
                            <option selected>Category</option>
                            <option value="1">Food</option>
                            <option value="2">Drink</option>
                        </select>
                    </div>
                </div>

                <div class="card mb-3" v-for="item in getItems">
                    <div class="row card-body">
                        <img :src="'/storage/' + item.image" class="w-50" alt="item image">
                        <div class="w-50">
                            <p class="h4 fw-bold">{{ item.name }}</p>
                            <p class="">{{ item.desc }}</p>
                            <p class="h5 fw-bold position-absolute bottom-0 mb-3">
                                ${{ parseFloat(item.price).toFixed(2) }}
                            </p>
                            <button class="btn btn-success position-absolute bottom-0 end-0 mb-3 me-3 text-white" @click="addToCart(item.id)">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        search: '',
        items: [],
    }),
    mounted() {
        this.loadItems();
    },
    methods: {
        loadItems: function () {
            axios.get('/api/home').then((response) => {
                this.items = response.data;
            }).catch((error) => {
                console.log(error);
            });
        },
        addToCart: function (id) {
            const data = {'item_id': id};
            axios.post(`/cart`, data).then((response) => {
                console.log('item added');
            }).catch((error) => {
                console.log(error.response.data);
            });
        },
    },
    computed: {
        getItems: function () {
            const temp = [];
            this.items.forEach((value) => {
                if (value['name'].toString().includes(this.search.trim()))
                    temp.push(value);
            });
            return temp;
        },
    },
};
</script>
