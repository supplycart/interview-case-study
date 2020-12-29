import Vue from 'vue'
import Vuex from 'vuex'
import * as type from './mutation-types'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
      token: localStorage.token,
      login_fail: false,

      products: [],
      categories: [],
      brands: [],

      carts: [],
      totalPrice: 0,

      orders: []
    },
    mutations: {
        [type.UPDATE_TOKEN](state, payload) {
            state.token = ''
        },
        [type.AUTHENTICATION_SUCCESS](state, payload) {
            state.token = payload.token
            state.login_fail = false
        },
        [type.AUTHENTICATION_FAIL](state) {
            state.login_fail = true
        },
        [type.SAVE_CATEGORIES](state, payload) {
            state.categories = payload.categories
        },
        [type.SAVE_BRANDS](state, payload) {
            state.brands = payload.brands
        },
        [type.SAVE_PRODUCTS](state, payload) {
            state.products = payload.products
        },
        [type.SAVE_CART](state, payload) {
            state.carts = payload.carts
            state.totalPrice = payload.totalPrice
        },
        [type.UPDATE_CART](state, payload) {
            state.carts = payload.carts
            state.totalPrice = payload.totalPrice
        },
        [type.CLEAR_CART](state) {
            state.carts = []
            state.totalPrice = 0
        },
        [type.SAVE_ORDERS](state, payload) {
            state.orders = payload.orders
        },
    },
    actions: {
        async login({ commit }, data) {
            await axios.post("/api/auth/login", {email: data.email, password: data.password} )
            .then(response => {
                commit(type.AUTHENTICATION_SUCCESS, {token: response.data.access_token})
                localStorage.token = response.data.access_token
            })
            .catch(error => {
                console.log(error)
                commit(type.AUTHENTICATION_FAIL)
            })
        },
        async register({ commit }, data) {
            await axios.post("/api/auth/register", {name: data.name, email: data.email, password: data.password} )
            .then(response => {
                commit(type.AUTHENTICATION_SUCCESS, {token: response.data.access_token})
                localStorage.token = response.data.access_token
            })
            .catch(error => {
                console.log(error)
                commit(type.AUTHENTICATION_FAIL)
            })
        },
        async fetchProducts({ commit, state }) {
            const response = await axios.get("/api/auth/products", {
                headers: {
                    'Authorization': `Bearer ${state.token}`
                }
            })
            .then(response => {
                commit(type.SAVE_PRODUCTS, {products: response.data.products})
            })
            .catch(error=> {
                if (error.response.status === 401) {
                    localStorage.token = ''
                    commit(type.UPDATE_TOKEN)
                }
            })
        },
        async fetchCategories ({ commit, state }) {
            const response = await axios.get("/api/auth/categories", {
                headers: {
                    'Authorization': `Bearer ${state.token}`
                }
            })
            .then(response => {
                let categories = []
                response.data.categories.forEach((e) => {
                    let category = {
                        ...e,
                        quantity: 0
                    }
                    categories.push(category)
                })
    
                state.products.forEach((e) => {
                    let index = categories.findIndex(el => el.id === e.category_id)
                    categories[index] = {
                        ...categories[index],
                        quantity: categories[index].quantity + 1
                    }
                })
    
                commit(type.SAVE_CATEGORIES, {categories: categories})
            })
            .catch(error=> {
                if (error.response.status === 401) {
                    localStorage.token = ''
                    commit(type.UPDATE_TOKEN)
                }
            })
        },
        async fetchBrands ({ commit, state }) {
            await axios.get("/api/auth/brands", {
                headers: {
                    'Authorization': `Bearer ${state.token}`
                }
            })
            .then(response => {
                let brands = []
                response.data.brands.forEach((e) => {
                    let brand = {
                        ...e,
                        quantity: 0
                    }
                    brands.push(brand)
                })
    
                state.products.forEach((e) => {
                    let index = brands.findIndex(el => el.id === e.brand_id)
                    brands[index] = {
                        ...brands[index],
                        quantity: brands[index].quantity + 1
                    }
                })
    
                commit(type.SAVE_BRANDS, {brands: brands})
            })
            .catch(error=> {
                if (error.response.status === 401) {
                    localStorage.token = ''
                    commit(type.UPDATE_TOKEN)
                }
            })
        },
        async fetchCart ({ commit, state }) {
            return new Promise(async (resolve, reject) => {
                await axios.get("/api/auth/cart", {
                    headers: {
                        'Authorization': `Bearer ${localStorage.token}`
                    }
                })
                .then(response => {
                    let carts = []
                    let totalPrice = 0
    
                    if (response.data.carts.length !== 0) {
                        let requests = response.data.carts.map( async (e) => {
                            let product = await axios.get("/api/auth/products/" + e.product_id, {
                                headers: { 'Authorization': `Bearer ${state.token}` }
                            })
                            
                            let item = {
                                id: e.product_id,
                                name: product.data.product.name,
                                price: product.data.product.price.toFixed(2),
                                stock: product.data.product.stock,
                                image: product.data.product.image,
                                quantity: e.quantity
                            }
                            carts.push(item)
                            totalPrice = totalPrice + item.price * item.quantity
                        })
                    
                        Promise.all(requests).then(() => {
                            commit(type.SAVE_CART, {carts: carts, totalPrice: totalPrice})
                            resolve()
                        });
                    } else {
                        commit(type.SAVE_CART, {carts: carts, totalPrice: totalPrice})
                        resolve()
                    }
                })
                .catch(error=> {
                    if (error.response.status === 401) {
                        localStorage.token = ''
                        commit(type.UPDATE_TOKEN)
                    }
                    reject()
                })
            })
        },
        async updateCartQuantity({ commit, state }, data) {
            let index = data.index
            let quantity = data.quantity
            let carts = [...state.carts]
            let totalPrice = state.totalPrice - carts[index].price * carts[index].quantity
            
            if (quantity === 0) {
                if (carts.length === 1) {
                    await this.dispatch('clearCart')
                } else {
                    await this.dispatch('deleteCartItem', {carts, totalPrice, index})
                }
            } else {
                let product = {
                    ...carts[index],
                    quantity: quantity >=  carts[index].stock ? carts[index].stock : quantity
                }
                carts[index] = product
                totalPrice = totalPrice + carts[index].price * carts[index].quantity
                
                await this.dispatch('updateCart', {carts, totalPrice, index})
            }
        },
        async addCartQuantity({ commit, state }, data) {
            let index = data.index
            
            let product = {
                ...state.carts[index],
                quantity: state.carts[index].quantity >=  state.carts[index].stock ? state.carts[index].stock : state.carts[index].quantity + 1
            }
            
            let carts = [...state.carts]
            carts[index] = product
            let totalPrice = state.totalPrice + parseInt(state.carts[index].price)

            await this.dispatch('updateCart', {carts, totalPrice, index})
        },
        async reduceCartQuantity({ commit, state }, data) {
            let index = data.index
            let quantity = state.carts[index].quantity;
            let totalPrice = state.totalPrice
            let carts = [...state.carts]

            if (quantity === 1) {
                if (carts.length === 1) {
                    await this.dispatch('clearCart')
                } else {
                    totalPrice = totalPrice - parseInt(carts[index].price)
                    await this.dispatch('deleteCartItem', {carts, totalPrice, index})
                }
            } else {
                quantity = quantity - 1
                let product = {
                    ...carts[index],
                    quantity
                }
                totalPrice = totalPrice - parseInt(carts[index].price)
                carts[index] = product

                await this.dispatch('updateCart', {carts, totalPrice, index})
            }
        },
        async updateCart({ commit, state }, data) {
            let carts = data.carts
            let index = data.index
            let totalPrice = data.totalPrice

            await axios.put("/api/auth/cart/" + carts[index].id, {quantity: carts[index].quantity}, {
                headers: {
                    'Authorization': `Bearer ${state.token}`
                }
            }).then( response => {
                console.log(response.data.message)
                commit(type.UPDATE_CART, {carts, totalPrice})
            })
            .catch(error=> {
                if (error.response.status === 401) {
                    localStorage.token = ''
                    commit(type.UPDATE_TOKEN)
                }
            })
        },
        async deleteCartItem({ commit, state }, data) {
            let id = data.carts[data.index].id

            let carts = data.carts.filter((e) => e.id !== id)
            let totalPrice = data.totalPrice

            await axios.delete("/api/auth/cart/" + id, {
                headers: {
                    'Authorization': `Bearer ${state.token}`
                }
            })
            .then(response => {
                console.log(response.data.message)
                commit(type.UPDATE_CART, {carts, totalPrice})
            })
            .catch(error=> {
                if (error.response.status === 401) {
                    localStorage.token = ''
                    commit(type.UPDATE_TOKEN)
                }
            })
        },
        async clearCart({ commit, state }) {
            await axios.delete("/api/auth/cart", {
                headers: {
                    'Authorization': `Bearer ${state.token}`
                }
            })
            .then(() => {
                commit(type.CLEAR_CART)
            })
            .catch(error=> {
                if (error.response.status === 401) {
                    localStorage.token = ''
                    commit(type.UPDATE_TOKEN)
                }
            })
        },
        async fetchOrders({ commit, state }) {
            await axios.get("/api/auth/orders", {
                headers: {
                    'Authorization': `Bearer ${state.token}`
                }
            })
            .then(response => {
                let orders = []
                response.data.results.forEach( res => {
    
                    let order = {
                        id: res.order.id,
                        created_at: new Date(res.order.created_at).toLocaleString(),
                        total_cost: res.order.total_cost,
                        products: res.products
                    }
                    orders.push(order)
                })
                orders.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    
                commit(type.SAVE_ORDERS, {orders: orders})
            })
            .catch(error=> {
                if (error.response.status === 401) {
                    localStorage.token = ''
                    commit(type.UPDATE_TOKEN)
                }
            })
        },
        logout({ commit }) {
            commit(type.UPDATE_TOKEN)
        },
    }
})

export default store