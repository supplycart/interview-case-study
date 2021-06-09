import type { User, AccessToken } from '@/types'

export type State = {
  user: User | null
  accessToken: AccessToken | null
}

export const state: State = {
  user: null,
  accessToken: null,
}
