import { GetterTree } from 'vuex'

// eslint-disable-next-line import/no-cycle
import { RootState } from '@/store'

import { Notification } from '@/types'

import { State } from './state'

export type Getters = {
  getNotification(state: State): Notification | null
  hasNotification(state: State): boolean
}

export const getters: GetterTree<State, RootState> & Getters = {
  getNotification: (state) => ({
    title: state.notificationTitle,
    subtitle: state.notificationSubtitle,
    type: state.notificationType,
  }),
  hasNotification: (state) =>
    !!state.notificationTitle &&
    !!state.notificationSubtitle &&
    !!state.notificationType,
}
