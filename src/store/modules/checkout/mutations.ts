import { MutationTree } from 'vuex'

import { Checkout } from '@/types'

import { State } from './state'
import { CheckoutMutationTypes } from './mutation-types'

export type Mutations<S = State> = {
  [CheckoutMutationTypes.SET_CHECKOUT](state: S, payload: Checkout): void
  [CheckoutMutationTypes.CLEAR_CHECKOUT](state: S): void
}

export const mutations: MutationTree<State> & Mutations = {
  [CheckoutMutationTypes.SET_CHECKOUT](state: State, data: Checkout) {
    state.checkout = data
  },
  [CheckoutMutationTypes.CLEAR_CHECKOUT](state: State) {
    state.checkout = null
  },
}
