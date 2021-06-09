import { MutationTree } from 'vuex'

import { Notification } from '@/types'

import { State } from './state'
import { NotificationMutationTypes } from './mutation-types'

export type Mutations<S = State> = {
  [NotificationMutationTypes.SET_DATA](state: S, payload: Notification): void
}

export const mutations: MutationTree<State> & Mutations = {
  [NotificationMutationTypes.SET_DATA](
    state: State,
    notification: Notification
  ) {
    state.notificationTitle = notification.title
    state.notificationSubtitle = notification.subtitle
    state.notificationType = notification.type
  },
}
