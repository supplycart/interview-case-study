import axios from 'axios'
import { MutationTree } from 'vuex'

import { AuthData } from '@/types'

import { State } from './state'
import { AuthMutationTypes } from './mutation-types'

export type Mutations<S = State> = {
  [AuthMutationTypes.SET_USER_DATA](state: S, payload: AuthData): void
  [AuthMutationTypes.CLEAR_USER_DATA](state: S): void
}

export const mutations: MutationTree<State> & Mutations = {
  [AuthMutationTypes.SET_USER_DATA](state: State, data: AuthData) {
    state.user = data.user
    state.accessToken = data.accessToken
    localStorage.setItem('user', JSON.stringify(data.user))
    localStorage.setItem('accessToken', JSON.stringify(data.accessToken))
    axios.defaults.headers.common.Authorization = `Bearer ${data.accessToken}`
  },
  [AuthMutationTypes.CLEAR_USER_DATA](state: State) {
    console.log('hello')
    state.user = null
    state.accessToken = null
    localStorage.removeItem('user')
    localStorage.removeItem('accessToken')
    window.location.reload()
  },
}
