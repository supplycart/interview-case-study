import { GetterTree } from 'vuex'

// eslint-disable-next-line import/no-cycle
import { RootState } from '@/store'

import { Checkout } from '@/types'
import { State } from './state'

export type Getters = {
  getCheckout(state: State): Checkout | null
}

export const getters: GetterTree<State, RootState> & Getters = {
  getCheckout(state) {
    return state.checkout
  },
}
