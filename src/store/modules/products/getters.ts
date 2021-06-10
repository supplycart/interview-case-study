import { GetterTree } from 'vuex'

// eslint-disable-next-line import/no-cycle
import { RootState } from '@/store'

import { Product } from '@/types'
import { State } from './state'

export type Getters = {
  products(state: State): Product[]
}

export const getters: GetterTree<State, RootState> & Getters = {
  products(state) {
    return state.products
  },
}
