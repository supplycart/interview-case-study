<template>
    <div class="container">
        <div class="flex justify-center">
            <table class="table-fixed">
                <thead>
                    <tr>
                        <th class="w-70 px-4 py-2">Name</th>
                        <th class="w-30 px-4 py-2">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in this.cart">
                        <td class="border px-4 py-2">{{item.name}}</td>
                        <td class="border px-4 py-2">RM{{item.price}}</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2 text-red-600 font-bold">
                            Grand Total: RM{{carttotal}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" ><button @click="checkout(carttotal)" class="w-full text-center bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase px-8 py-3 rounded outline-none focus:outline-none mr-1 mb-1">Checkout</button></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
</template>
<script>
export default {
    props:['cart','carttotal'],

    data(){
        return{
            checkoutCart: [],
        }
    },

    methods:{
        addToCart(item){
            bus.$emit('product-added',item);
        },
        removeFromCart(item){
            bus.$emit('remove-product',item);
        },
        checkout: function(total){
            this.checkoutCart.push({
                "total" : total
            });
            console.log(total)
            alert("Your total: RM"+total)
        }
    },

    mounted(){
        console.log(this.carttotal)
    }


}
</script>