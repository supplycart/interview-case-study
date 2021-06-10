// eslint-disable-next-line import/no-cycle
import { RootState } from '@/store'
import { ActionContext, ActionTree } from 'vuex'
// eslint-disable-next-line import/no-cycle
import http from '@/plugins/axios'
import { Mutations } from './mutations'
import { State } from './state'
import { ProductActionTypes } from './action-types'
import { ProductMutationTypes } from './mutation-types'

type AugmentedActionContext = {
  commit<K extends keyof Mutations>(
    key: K,
    payload?: Parameters<Mutations[K]>[1]
  ): ReturnType<Mutations[K]>
} & Omit<ActionContext<State, RootState>, 'commit'>

export interface Actions {
  [ProductActionTypes.GET_PRODUCTS]({
    commit,
  }: AugmentedActionContext): Promise<void>
}

export const actions: ActionTree<State, RootState> & Actions = {
  [ProductActionTypes.GET_PRODUCTS]({ commit }) {
    return http.get('/products').then((res) => {
      commit(ProductMutationTypes.SET_PRODUCTS, res.data.data)
    })
  },
}
