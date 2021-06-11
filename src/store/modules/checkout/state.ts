import { Checkout } from '@/types'

export type State = {
  checkout: Checkout | null
}

export const state: State = {
  checkout: null,
}
