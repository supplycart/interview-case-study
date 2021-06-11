export type NotificationTitle = string

export type NotificationSubtitle = string

export enum NotificationType {
  SUCCESS = 'success',
  ERROR = 'error',
}

export type Notification = {
  title: NotificationTitle
  subtitle: NotificationSubtitle
  type: NotificationType
}
