import type { NotificationTitle, NotificationSubtitle } from '@/types'
import { NotificationType } from '@/types'

const defaultType = NotificationType.SUCCESS

export type State = {
  notificationTitle: NotificationTitle
  notificationSubtitle: NotificationSubtitle
  notificationType: NotificationType
}

export const state: State = {
  notificationTitle: '',
  notificationSubtitle: '',
  notificationType: defaultType,
}
