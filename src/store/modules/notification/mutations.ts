import { MutationTree } from 'vuex'

import { Notification, NotificationType } from '@/types'

import { State } from './state'
import { NotificationMutationTypes } from './mutation-types'

export type Mutations<S = State> = {
  [NotificationMutationTypes.SET_DATA](state: S, payload: Notification): void
  [NotificationMutationTypes.CLEAR_DATA](state: S): void
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
  [NotificationMutationTypes.CLEAR_DATA](state: State) {
    state.notificationTitle = ''
    state.notificationSubtitle = ''
    state.notificationType = NotificationType.SUCCESS
  },
}
