import { ActionContext, ActionTree } from 'vuex'

// eslint-disable-next-line import/no-cycle
import { RootState, store } from '@/store'

import { NotificationType, Notification } from '@/types'
import { State } from './state'
import { Mutations } from './mutations'
import { NotificationMutationTypes } from './mutation-types'
import { NotificationActionTypes } from './action-types'

type AugmentedActionContext = {
  commit<K extends keyof Mutations>(
    key: K,
    payload?: Parameters<Mutations[K]>[1]
  ): ReturnType<Mutations[K]>
} & Omit<ActionContext<State, RootState>, 'commit'>

export interface Actions {
  [NotificationActionTypes.NOTIFY](
    { commit }: AugmentedActionContext,
    { title, subtitle, type }: Notification
  ): void
  [NotificationActionTypes.DISMISS]({ commit }: AugmentedActionContext): void
}

export const actions: ActionTree<State, RootState> & Actions = {
  [NotificationActionTypes.NOTIFY](
    { commit },
    { title, subtitle, type = NotificationType.SUCCESS }
  ) {
    commit(NotificationMutationTypes.SET_DATA, {
      title,
      subtitle,
      type,
    })

    setTimeout(() => {
      store.dispatch(NotificationActionTypes.DISMISS)
    }, 2500)
  },
  [NotificationActionTypes.DISMISS]({ commit }) {
    commit(NotificationMutationTypes.CLEAR_DATA)
  },
}
