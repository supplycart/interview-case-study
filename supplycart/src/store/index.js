import { createStore } from "vuex";

export default createStore({
    state() {
        return {
            cartProducts: []
        }
    },
    mutations: {
        addProductToCart(state, product){
            state.cartProducts.unshift(product);
        },
        removeFromCart(state, product){
            const arr = state.cartProducts;
            for( var i = 0; i < arr.length; i++){ 
                if ( arr[i].id === product.id) { 
                    arr.splice(i, 1); 
                    return; 
                }
            
            }
        }
    },
    getters: {
        getProducts(state){
            return state.cartProducts
        },
        getTotalPrice(state){
            var sum = 0;
            state.cartProducts.map(
                product => sum+=product.price
            )
            return sum;
        }

    }
});