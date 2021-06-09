import { ActionContext, ActionTree } from 'vuex'

// eslint-disable-next-line import/no-cycle
import { RootState } from '@/store'

import { NotificationType, Notification } from '@/types'
import { State } from './state'
import { Mutations } from './mutations'
import { NotificationMutationTypes } from './mutation-types'
import { NotificationActionTypes } from './action-types'

type AugmentedActionContext = {
  commit<K extends keyof Mutations>(
    key: K,
    payload: Parameters<Mutations[K]>[1]
  ): ReturnType<Mutations[K]>
} & Omit<ActionContext<State, RootState>, 'commit'>

export interface Actions {
  [NotificationActionTypes.NOTIFY](
    { commit }: AugmentedActionContext,
    { title, subtitle, type }: Notification
  ): void
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
  },
}
