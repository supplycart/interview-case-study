import { ActionContext, ActionTree } from 'vuex'
// eslint-disable-next-line import/no-cycle
import axios from '@/plugins/axios'

// eslint-disable-next-line import/no-cycle
import { RootState, store } from '@/store'

import { State } from './state'
import { Mutations } from './mutations'
import { CartMutationTypes } from './mutation-types'
import { CartActionTypes } from './action-types'

type AugmentedActionContext = {
  commit<K extends keyof Mutations>(
    key: K,
    payload?: Parameters<Mutations[K]>[1]
  ): ReturnType<Mutations[K]>
} & Omit<ActionContext<State, RootState>, 'commit'>

export interface Actions {
  [CartActionTypes.GET_CART]({ commit }: AugmentedActionContext): Promise<void>
  [CartActionTypes.ADD_CART](
    { commit }: AugmentedActionContext,
    { productId, quantity }: { productId: number; quantity: number }
  ): Promise<void>
  [CartActionTypes.REMOVE_CART](
    { commit }: AugmentedActionContext,
    { productId, quantity }: { productId: number; quantity: number }
  ): void
}

export const actions: ActionTree<State, RootState> & Actions = {
  [CartActionTypes.GET_CART]({ commit }) {
    return axios.get('/cart').then((response) => {
      commit(CartMutationTypes.SET_CART, response.data.data)
    })
  },
  [CartMutationTypes.ADD_CART]({ commit }, { productId, quantity }) {
    return axios
      .post('/cart', {
        productId,
        quantity,
      })
      .then((response) => {
        commit(CartMutationTypes.ADD_CART, response.data.data)
      })
  },
  // eslint-disable-next-line no-empty-pattern
  [CartMutationTypes.REMOVE_CART]({}, { productId, quantity }) {
    axios
      .delete(`/cart`, {
        data: {
          productId,
          quantity,
        },
      })
      .then(() => {
        store.dispatch(CartActionTypes.GET_CART)
      })
  },
}
