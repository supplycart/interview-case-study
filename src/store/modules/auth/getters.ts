import { GetterTree } from 'vuex'

// eslint-disable-next-line import/no-cycle
import { RootState } from '@/store'

import { State } from './state'

export type Getters = {
  loggedIn(state: State): boolean
}

export const getters: GetterTree<State, RootState> & Getters = {
  loggedIn(state) {
    console.log(state)
    return !!state.user
  },
}
