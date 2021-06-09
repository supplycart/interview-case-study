import { ActionContext, ActionTree } from 'vuex'
import axios from 'axios'

// eslint-disable-next-line import/no-cycle
import { RootState } from '@/store'

import { LoginCredentials, RegisterCredentials } from '@/types'
import { State } from './state'
import { Mutations } from './mutations'
import { AuthMutationTypes } from './mutation-types'
import { AuthActionTypes } from './action-types'

type AugmentedActionContext = {
  commit<K extends keyof Mutations>(
    key: K,
    payload?: Parameters<Mutations[K]>[1]
  ): ReturnType<Mutations[K]>
} & Omit<ActionContext<State, RootState>, 'commit'>

export interface Actions {
  [AuthActionTypes.LOGIN](
    { commit }: AugmentedActionContext,
    { email, password }: LoginCredentials
  ): Promise<void>
  [AuthActionTypes.REGISTER](
    { commit }: AugmentedActionContext,
    { name, email, password, passwordConfirmation }: RegisterCredentials
  ): Promise<void>
  [AuthActionTypes.LOGOUT]({ commit }: AugmentedActionContext): void
}

export const actions: ActionTree<State, RootState> & Actions = {
  [AuthActionTypes.LOGIN]({ commit }, { email, password }) {
    return axios
      .post('//interview-case-study-backend.test/api/login', {
        email,
        password,
      })
      .then(({ data }) => {
        commit(AuthMutationTypes.SET_USER_DATA, {
          user: {
            id: data.user.id,
            name: data.user.name,
            email: data.user.email,
            createdAt: data.user.created_at,
            updatedAt: data.user.updated_at,
          },
          accessToken: data.access_token,
        })
      })
  },
  [AuthActionTypes.REGISTER](
    { commit },
    { name, email, password, passwordConfirmation }
  ) {
    return axios
      .post('//interview-case-study-backend.test/api/register', {
        name,
        email,
        password,
        password_confirmation: passwordConfirmation,
      })
      .then(({ data }) => {
        commit(AuthMutationTypes.SET_USER_DATA, {
          user: {
            id: data.user.id,
            name: data.user.name,
            email: data.user.email,
            createdAt: data.user.created_at,
            updatedAt: data.user.updated_at,
          },
          accessToken: data.access_token,
        })
      })
  },
  [AuthActionTypes.LOGOUT]({ commit }) {
    commit(AuthMutationTypes.CLEAR_USER_DATA)
  },
}
