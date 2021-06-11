import { ActionContext, ActionTree } from 'vuex'
// eslint-disable-next-line import/no-cycle
import axios from '@/plugins/axios'

// eslint-disable-next-line import/no-cycle
import { RootState, store } from '@/store'

import { State } from './state'
import { Mutations } from './mutations'
import { CheckoutMutationTypes } from './mutation-types'
import { CheckoutActionTypes } from './action-types'
import { CartActionTypes } from '../cart/action-types'

type AugmentedActionContext = {
  commit<K extends keyof Mutations>(
    key: K,
    payload?: Parameters<Mutations[K]>[1]
  ): ReturnType<Mutations[K]>
} & Omit<ActionContext<State, RootState>, 'commit'>

export interface Actions {
  [CheckoutActionTypes.GET_CHECKOUT](
    { commit }: AugmentedActionContext,
    { checkoutId }: { checkoutId: number }
  ): Promise<void>
  [CheckoutActionTypes.CHECKOUT]({
    commit,
  }: AugmentedActionContext): Promise<void>
  [CheckoutActionTypes.SUBMIT_CHECKOUT](
    { commit }: AugmentedActionContext,
    { checkoutId }: { checkoutId: number }
  ): Promise<void>
}

export const actions: ActionTree<State, RootState> & Actions = {
  [CheckoutActionTypes.GET_CHECKOUT]({ commit }, { checkoutId }) {
    return axios.get(`/checkout/continue/${checkoutId}`).then((response) => {
      commit(CheckoutMutationTypes.SET_CHECKOUT, response.data.data)
    })
  },
  [CheckoutActionTypes.CHECKOUT]({ commit }) {
    return axios.post('/checkout').then((response) => {
      store.dispatch(CartActionTypes.GET_CART)
      commit(CheckoutMutationTypes.SET_CHECKOUT, response.data.data)
    })
  },
  [CheckoutActionTypes.SUBMIT_CHECKOUT]({ commit }, { checkoutId }) {
    return axios.put(`/checkout/${checkoutId}`).then(() => {
      commit(CheckoutMutationTypes.CLEAR_CHECKOUT)
    })
  },
}
