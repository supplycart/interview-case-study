<template>
    <div class="w-100 mt-5">
        <div class="container">
            <div class="">
                <div class="w-full items-center bg-transparent border border-solid border-indigo-500 hover:bg-indigo-500 hover:text-white active:bg-indigo-600 font-bold uppercase px-8 py-3 rounded outline-none focus:outline-none mr-1 mb-1" @click="showAll()">
                    <h5 class="text-center">Show all products</h5>
                </div>
            </div>
            <div class="flex">
                <div class="flex-1 text-center bg-transparent border border-solid border-indigo-500 hover:bg-indigo-500 hover:text-white active:bg-indigo-600 font-bold uppercase px-8 py-3 rounded outline-none focus:outline-none mr-1 mb-1" v-for="category in this.categories">
                    <h5 class="text-center" @click="selectCat(category.id)">{{category.categoryname}}</h5>
                </div>
            </div>
            <div class="flex ">
                <div class="flex-1 text-center bg-transparent border border-solid border-indigo-500 hover:bg-indigo-500 hover:text-white active:bg-indigo-600 font-bold uppercase px-8 py-3 rounded outline-none focus:outline-none mr-1 mb-1" v-for="subcategory in filterSubcat">
                    <h5 class="text-center" @click="selectSubcat(subcategory.id)">{{subcategory.subcategoryname}}</h5>
                </div>
            </div>
            <div class="flex flex-wrap mb-4 ml-7 mt-5">
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 mb-4 text-center" v-for="item in filterProduct">
                    <div class="rounded overflow-hidden shadow-lg mb-5">
                        <div class="flex justify-center m-5">
                            <img :src="'/images/'+item.img" class="w-24">
                        </div>
                        <!-- <div class="text-xl mb-2">{{item.img}}</div> -->
                        <div class="font-bold text-xl mb-2">{{item.name}}</div>
                        <div class="text-xl mb-2">RM{{item.price}}</div>
                        <button @click="addToCart(item.name, item.price)" class="mt-6 mb-4 inline-flex items-center px-6 py-3 text-white font-semibold bg-blue-300 rounded-md shadow-sm hover:bg-blue-700">Add to cart</button>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props: ['products', 'categories', 'subcategories'],

    data(){
        return{
            selectedcategory: '',
            selectedsubcategory: '',
            name: '',
            price: '',
            // cartElements: [],
            // qty: [],
        }
    },
    
    methods: {
        selectCat: function (id){
            this.selectedcategory = id;
            this.selectedsubcategory = '';
        },
        selectSubcat: function (id){
            this.selectedsubcategory = id;
        },
        showAll: function (){
            this.selectedcategory = '';
            this.selectedsubcategory = '';
        },
        addToCart: function(name, price){
            // this.cartElements.push({
            //     "name" : name,
            //     "price" : price,
            // });
            // alert('added')
            this.name = name;
            this.price = price;
            bus.$emit('product-added', name, price)
        },
    },

    

    computed: {
        filterSubcat: function(){
            return this.subcategories.filter((sub) => sub.category_id == this.selectedcategory);
        },

        filterProduct: function(){
            if(this.selectedcategory === '' && this.selectedsubcategory === ''){
                return this.products;
            }else if (this.selectedcategory === '' && this.selectedsubcategory != ''){
                return this.products.filter((item) => item.subcategory_id == this.selectedsubcategory);
            }else if (this.selectedcategory != '' && this.selectedsubcategory === ''){
                return this.products.filter((item) => item.category_id == this.selectedcategory);
            }else if (this.selectedcategory != '' && this.selectedsubcategory != ''){
                return this.products.filter((item) => item.subcategory_id == this.selectedsubcategory);
            }
        },
    }
}
</script>