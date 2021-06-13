import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    allProducts: [],
    cart: [],

    totalCart: 0,
    totalPrice: 0,

    showGradient: true,

    discount: 1, // 1 = no discount, 0.85 = 15% discount

    historyText: '',
    activityText: '',

    verified: null
  },
  mutations: {
    countTotal (state) {
      let totalCount = state.cart.map(c => Object.keys(c['sizes']).reduce((a, b) => { return a + c['sizes'][b] }, 0));
      state.totalCart = totalCount.reduce((a, b) => { return a + b }, 0);
      
      state.totalPrice = 0;
      totalCount.forEach((c, i) => state.totalPrice += ((state.cart[i]['product']['price'] * state.discount) * c));
    }
  }
})