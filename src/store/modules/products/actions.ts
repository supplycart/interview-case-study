// eslint-disable-next-line import/no-cycle
import { RootState } from '@/store'
import { ActionContext, ActionTree } from 'vuex'
// eslint-disable-next-line import/no-cycle
import axios from '@/plugins/axios'
import { Product } from '@/types'
import { Mutations } from './mutations'
import { State } from './state'
import { ProductActionTypes } from './action-types'
// import { ProductMutationTypes } from './mutation-types'

type AugmentedActionContext = {
  commit<K extends keyof Mutations>(
    key: K,
    payload?: Parameters<Mutations[K]>[1]
  ): ReturnType<Mutations[K]>
} & Omit<ActionContext<State, RootState>, 'commit'>

export interface Actions {
  [ProductActionTypes.GET_PRODUCTS]({
    commit,
  }: AugmentedActionContext): void | Product[]
}

export const actions: ActionTree<State, RootState> & Actions = {
  async [ProductActionTypes.GET_PRODUCTS]() {
    const data = await axios.get('/products')

    return data.data
  },
}
