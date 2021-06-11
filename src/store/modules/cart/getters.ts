import { GetterTree } from 'vuex'

// eslint-disable-next-line import/no-cycle
import { RootState } from '@/store'

import { Cart } from '@/types'
import { State } from './state'

export type Getters = {
  cart(state: State): Cart[]
}

export const getters: GetterTree<State, RootState> & Getters = {
  cart(state) {
    return state.cart
  },
}
