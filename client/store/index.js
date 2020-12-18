
/**
 * define state params
 * @return object
 */
export const state = () => ({
  loading: false,
  products: [],
  authUser: {},
  userInfo: {
    isLoggedIn: false,
    isSignedUp: false,
    hasSearched: false,
    name: '',
    productTitleSearched: ''
  },
  systemInfo: {
    openLoginModal: false,
    openSignupModal: false,
    openCheckoutModal: false
  }
})

/**
 * define getter data for use global
 * @type object
 */
export const getters = {
  productsAdded: state => {
    return state.products.filter(el => {
      return el.isAddedToCart;
    });
  },
  productsAddedToFavourite: state => {
    return state.products.filter(el => {
      return el.isFavourite;
    });
  },
  getProductById: state => id => {
    return state.products.find(product => product.id == id);
  },
  isUserLoggedIn: state => {
    return state.userInfo.isLoggedIn;
  },
  isUserSignedUp: state => {
    return state.userInfo.isSignedUp;
  },
  getUserName: state => {
    return state.userInfo.name;
  },
  getUserInfo: state => {
    return state.authUser
  },
  isLoginModalOpen: state => {
    return state.systemInfo.openLoginModal;
  },
  isSignupModalOpen: state => {
    return state.systemInfo.openSignupModal;
  },
  isCheckoutModalOpen: state => {
    return state.systemInfo.openCheckoutModal;
  },
  quantity: state => {
    return state.products.quantity;
  },
  getProducts: state => {
    return state.products;
  },
  getCart: state => {
    return state.cartItems
  }
}

/**
 * define mutate onject
 * @type object
 */
export const mutations = {
  setLoading(state, loading) {
    state.loading = loading
  },
  
  addToCart: (state, id) => {
    state.products.forEach(el => {
      if (id === el.id) {
        el.isAddedToCart = true;
      }
    });
  },
  setAddedBtn: (state, data) => {
    state.products.forEach(el => {
      if (data.id === el.id) {
        el.isAddedBtn = data.status;
      }
    });
  },
  removeFromCart: (state, id) => {
    state.products.forEach(el => {
      if (id === el.id) {
        el.isAddedToCart = false;
      }
    });
  },
  removeProductsFromFavourite: state => {
    state.products.filter(el => {
      el.isFavourite = false;
    });
  },
  isUserLoggedIn: (state, isUserLoggedIn) => {
    state.userInfo.isLoggedIn = isUserLoggedIn;
  },
  isUserSignedUp: (state, isSignedUp) => {
    state.userInfo.isSignedUp = isSignedUp;
  },
  setHasUserSearched: (state, hasSearched) => {
    state.userInfo.hasSearched = hasSearched;
  },
  setUserName: (state, name) => {
    state.userInfo.name = name;
  },
  setUserInfo: (state, info) => {
    state.authUser = info
  },
  setProductTitleSearched: (state, titleSearched) => {
    state.userInfo.productTitleSearched = titleSearched;
  },
  showLoginModal: (state, show) => {
    state.systemInfo.openLoginModal = show;
  },
  showSignupModal: (state, show) => {
    state.systemInfo.openSignupModal = show;
  },
  showCheckoutModal: (state, show) => {
    state.systemInfo.openCheckoutModal = show;
  },
  addToFavourite: (state, id) => {
    state.products.forEach(el => {
      if (id === el.id) {
        el.isFavourite = true;
      }
    });
  },
  removeFromFavourite: (state, id) => {
    state.products.forEach(el => {
      if (id === el.id) {
        el.isFavourite = false;
      }
    });
  },
  quantity: (state, data) => {
    state.products.forEach(el => {
      if (data.id === el.id) {
        el.quantity = data.quantity;
      }
    });
  },
  loadProducts: (state, products) => {
    state.products = products
  }
}

/**
 * define actions make call APIs
 * @type object
 */
export const actions = {
  /**
   * make call API login and set state for user information
   * @param dispatch
   * @param commit
   * @param data
   * @return {Promise<void>}
   */
  async postLogin({ dispatch, commit }, data) {
    const res = await this.$axios.$post(`/login`, data)
    if(res.statusCode === 200) {
      this.$axios.setToken(res.data.token, 'Bearer')
      localStorage.setItem('token', res.data.token)
      localStorage.setItem('user', JSON.stringify(res.data))
      commit('setUserInfo', res.data)
      commit('isUserLoggedIn', true)
      commit('setUserName', res.data.name)
    } else {
      this.$axios.setToken(false)
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      commit('setUserInfo', {})
      commit('isUserLoggedIn', false)
      commit('setUserName', '')
    }
  },
  
  /**
   * make call API register new account
   * @param dispatch
   * @param commit
   * @param data
   * @return {Promise<*>}
   */
  async postRegister({ dispatch, commit }, data) {
    const res = await this.$axios.$post(`/register`, data)
    if(res.statusCode === 200) {
      const { data: { message, userInfo } } = res
      this.$axios.setToken(userInfo.token, 'Bearer')
      localStorage.setItem('token', userInfo.token)
      commit('setUserInfo', userInfo)
      commit('setUserName', userInfo.name)
      commit('isUserLoggedIn', true)
      commit('isUserLoggedIn', true);
    } else {
      this.$axios.setToken(false)
      localStorage.removeItem('token')
      commit('setUserInfo', {})
      commit('setUserName', '')
      commit('isUserLoggedIn', false)
      commit('isUserLoggedIn', false);
    }
    return res
  },
  
  /**
   * make call API logout
   * @param dispatch
   * @param commit
   * @return {Promise<*>}
   */
  async postLogout({ dispatch, commit }) {
    return await this.$axios.$post(`/logout`)
  },
  
  /**
   * make call API get products list
   * @param dispatch
   * @param commit
   * @return {Promise<void>}
   */
  async getProducts({ dispatch, commit }) {
    const res = await this.$axios.$get(`/products`)
    const products = (res.statusCode === 200) ? res.data : []
    commit('loadProducts', products)
  },
  
  /**
   * make call API get product by id
   * @param dispatch
   * @param commit
   * @param productId
   * @return {Promise<void>}
   */
  async getProductById({ dispatch, commit }, productId) {
    return await this.$axios.$get(`/product/${productId}`)
  },
  
  /**
   * make call API add cart to make order into db
   * @param dispatch
   * @param commit
   * @param data
   * @return {Promise<*>}
   */
  async addCart({ dispatch, commit }, data) {
    return await this.$axios.$post(`/add-cart`, data)
  },
  
  /**
   * make call API get list orders of current user
   * @param dispatch
   * @param commit
   * @return {Promise<*>}
   */
  async getOrders({ dispatch, commit }) {
    return await this.$axios.$get(`/orders`)
  },
  
  /**
   * make call API get detail order by id
   * @param dispatch
   * @param commit
   * @param orderId
   * @return {Promise<*>}
   */
  async getOrderById({ dispatch, commit }, orderId) {
    return await this.$axios.$get(`/order/${orderId}`)
  }
}
