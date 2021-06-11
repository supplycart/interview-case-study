import { MutationTree } from 'vuex'

import { Cart } from '@/types'

import { State } from './state'
import { CartMutationTypes } from './mutation-types'

export type Mutations<S = State> = {
  [CartMutationTypes.SET_CART](state: S, payload: Cart[]): void
  [CartMutationTypes.ADD_CART](state: S, payload: Cart): void
  [CartMutationTypes.REMOVE_CART](state: S, payload: Cart): void
}

export const mutations: MutationTree<State> & Mutations = {
  [CartMutationTypes.SET_CART](state: State, data: Cart[]) {
    state.cart = data
    console.log(state.cart)
  },
  [CartMutationTypes.ADD_CART](state: State, data: Cart) {
    const index = state.cart.findIndex(
      (cart) => cart.productId === data.productId
    )

    if (index !== -1) {
      state.cart[index].quantity += 1
    } else {
      state.cart.push(data)
    }
  },
  [CartMutationTypes.REMOVE_CART](state: State, data: Cart) {
    const index = state.cart.findIndex(
      (cart) => cart.productId === data.productId
    )
    if (index !== -1) {
      if (state.cart[index].quantity > 1) {
        state.cart[index].quantity -= data.quantity
      } else {
        state.cart.splice(index, 1)
      }
    }
  },
}
