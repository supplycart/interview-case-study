import { MutationTree } from 'vuex'

import { Product } from '@/types'

import { State } from './state'
import { ProductMutationTypes } from './mutation-types'

export type Mutations<S = State> = {
  [ProductMutationTypes.SET_PRODUCTS](state: S, payload: Array<Product>): void
}

export const mutations: MutationTree<State> & Mutations = {
  [ProductMutationTypes.SET_PRODUCTS](state: State, products: Array<Product>) {
    state.products = products
  },
}
