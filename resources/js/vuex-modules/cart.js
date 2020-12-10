import productRepository from "../repositories/productRepository";
import addedProductRepository from "../repositories/addedProductRepository";
import orderRepository from "../repositories/orderRepository";

const state = () => ({
    cart: [],
    total: 0
});

// getters
const getters = {
    cart: (state) => {
        return state.cart;
    },
    total: (state) => {
        return state.cart
            .filter(x => x.selected === true)
            .map(x => x.price.price * x.amount)
            .reduce((a, b) => a + b, 0)
            .toFixed(2);
    },
};

// mutations
const mutations = {
    cart: (state, payload) => {
        state.cart = payload;
    },
    updateProductInCart: (state, payload) => {
        const productIndex = state.cart.findIndex(x => x.id === payload.id);

        if (productIndex === -1) return null;

        state.cart.splice(productIndex, 1, payload);
    }
};

const actions = {
    async fetchAddedProducts(state) {
        const response = await addedProductRepository.all();
        state.commit('cart', response.data.data.map(x => {
            return {
                ...x,
                selected: true
            }
        }));
    },
    async addProduct(state, payload) {
        await addedProductRepository.store(payload);
    },
    async updateProduct(state, payload) {
        await addedProductRepository.update(payload);
    },
    async deleteProduct(state, itemId) {
        await addedProductRepository.delete(itemId);
        state.commit('cart', state.state.cart.filter(x => x.id !== itemId));
    },
    async orderProducts(state) {
        await orderRepository.store({
            products: state.state.cart
                .filter(x => x.selected === true && x.amount > 0)
                .map(x => {
                    return {
                        id: x.id,
                        product_id: x.product.id,
                        product_prices_id: x.price.id,
                        amount: x.amount
                    }
                })
        });
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
