import { Product } from '@/types'

export type State = {
  products: Array<Product>
}

export const state: State = {
  products: [],
}
